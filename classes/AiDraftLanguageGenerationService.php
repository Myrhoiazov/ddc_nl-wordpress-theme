<?php

/**
 * Orchestrates one language of one Generation Batch:
 *
 *   OpenAI content -> wp_insert_post (draft) -> Polylang language + shared
 *   slug -> link as translation of any siblings already created in this
 *   batch -> Content Type meta -> AIOSEO SEO fields -> repository status.
 *
 * A failure at the OpenAI step, or a missing Polylang/AIOSEO integration,
 * leaves no post behind and marks only this language as failed — the other
 * three languages of the batch are untouched (see AiDraftBatchRepository).
 */
class AiDraftLanguageGenerationService
{
	private const CONTENT_TYPE_META_KEY = '_ddc_ai_content_type';
	private const SECONDARY_KEYWORDS_META_KEY = '_ddc_ai_secondary_keywords';

	private AiDraftOpenAiClient $openAiClient;
	private AiDraftBatchRepository $repository;

	public function __construct(AiDraftOpenAiClient $openAiClient, AiDraftBatchRepository $repository)
	{
		$this->openAiClient = $openAiClient;
		$this->repository = $repository;
	}

	public function generate(string $batchId, string $language): bool
	{
		$batch = $this->repository->getBatch($batchId);

		if ($batch === null || !isset($batch['languages'][$language])) {
			return false;
		}

		if ($batch['languages'][$language]['status'] === 'success') {
			return true;
		}

		if (!$this->integrationsAvailable()) {
			$this->repository->markLanguageFailed($batchId, $language, 'Polylang or AIOSEO is not active.');

			return false;
		}

		$this->repository->markLanguageInProgress($batchId, $language);

		$content = $this->openAiClient->generateLanguageContent(
			$batch['topic'],
			$batch['content_type'],
			$batch['context'],
			$language,
			$batch['slug']
		);

		if (is_wp_error($content)) {
			$this->repository->markLanguageFailed($batchId, $language, $content->get_error_message());

			return false;
		}

		$postId = wp_insert_post([
			'post_type'    => 'post',
			'post_status'  => 'draft',
			'post_title'   => $content['title'],
			'post_content' => $content['body'],
			'post_excerpt' => $content['excerpt'],
			'post_name'    => $batch['slug'],
		], true);

		if (is_wp_error($postId)) {
			$this->repository->markLanguageFailed($batchId, $language, $postId->get_error_message());

			return false;
		}

		pll_set_post_language($postId, $language);
		$this->enforceSharedSlug($postId, $batch['slug']);
		$this->linkTranslations($batchId, $language, $postId);

		update_post_meta($postId, self::CONTENT_TYPE_META_KEY, $batch['content_type']);
		update_post_meta($postId, self::SECONDARY_KEYWORDS_META_KEY, $content['secondary_keywords']);
		$this->saveSeoFields($postId, $content);

		$this->repository->markLanguageSucceeded($batchId, $language, $postId);

		return true;
	}

	private function integrationsAvailable(): bool
	{
		return function_exists('pll_set_post_language')
			&& function_exists('pll_save_post_translations')
			&& class_exists('AIOSEO\\Plugin\\Common\\Models\\Post');
	}

	/**
	 * wp_insert_post() runs its own slug-uniqueness check before this post
	 * has a Polylang language, so the theme's wp_unique_post_slug filter
	 * (functions.php) can't yet tell it apart from a same-language
	 * conflict and may suffix it (e.g. `-2`). Re-applying the slug here,
	 * after the language is set, lets that filter allow the shared slug.
	 */
	private function enforceSharedSlug(int $postId, string $sharedSlug): void
	{
		$post = get_post($postId);

		if ($post !== null && $post->post_name !== $sharedSlug) {
			wp_update_post(['ID' => $postId, 'post_name' => $sharedSlug]);
		}
	}

	/**
	 * Links this post as a translation of every sibling in the batch that
	 * has already succeeded. Re-reads the batch instead of reusing the
	 * caller's snapshot, since sibling language jobs may have completed
	 * concurrently since this job started.
	 */
	private function linkTranslations(string $batchId, string $language, int $postId): void
	{
		$batch = $this->repository->getBatch($batchId);

		if ($batch === null) {
			return;
		}

		$translations = [$language => $postId];

		foreach ($batch['languages'] as $siblingLanguage => $entry) {
			if ($siblingLanguage !== $language && $entry['status'] === 'success' && $entry['post_id']) {
				$translations[$siblingLanguage] = (int) $entry['post_id'];
			}
		}

		pll_save_post_translations($translations);
	}

	/**
	 * A failure here (e.g. AIOSEO's internal save path throwing) leaves a
	 * usable draft behind with no SEO fields rather than discarding the
	 * post — same "partial success over total rollback" stance as the
	 * Instagram sync (InstagramRepository::recordFailedAttempt()).
	 */
	private function saveSeoFields(int $postId, array $content): void
	{
		try {
			AIOSEO\Plugin\Common\Models\Post::savePost($postId, [
				'title'         => $content['seo_title'],
				'description'   => $content['seo_description'],
				'focus_keyword' => $content['focus_keyword'],
			]);
		} catch (\Throwable $exception) {
			error_log(sprintf('[AI Draft] AIOSEO save failed for post %d: %s', $postId, $exception->getMessage()));
		}
	}
}
