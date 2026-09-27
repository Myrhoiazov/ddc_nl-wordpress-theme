<?php

/**
 * Encapsulates Generation Batch storage for the AI Черновики generator.
 * Callers only ever talk to this class — neither the admin screen nor the
 * cron jobs know (or need to know) that each batch physically lives in its
 * own WordPress option, indexed by a second option listing recent batch
 * ids.
 *
 * A batch always covers all four Site Languages at once
 * (docs/adr/0008-ai-drafts-always-generate-all-languages.md); this class
 * tracks one status entry per language so a failure in one language never
 * touches the other three.
 */
class AiDraftBatchRepository
{
	private const OPTION_PREFIX = 'ddc_ai_batch_';
	private const INDEX_OPTION = 'ddc_ai_batches_index';
	private const MAX_BATCHES_IN_INDEX = 50;

	private const LANGUAGES = ['ru', 'nl', 'uk', 'en'];

	private const LANGUAGE_DEFAULTS = [
		'status'        => 'pending',
		'post_id'       => null,
		'error_message' => null,
		'retry_count'   => 0,
		'updated_at'    => null,
	];

	/**
	 * Creates a batch with all four languages set to "pending" and returns
	 * its id. The slug is generated once by the caller (shared across all
	 * four languages) and stored here, not regenerated per language.
	 */
	public function createBatch(string $topic, string $contentType, string $context, string $slug): string
	{
		$batchId = wp_generate_uuid4();

		$languages = [];
		foreach (self::LANGUAGES as $language) {
			$languages[$language] = self::LANGUAGE_DEFAULTS;
		}

		update_option($this->optionName($batchId), [
			'id'           => $batchId,
			'topic'        => $topic,
			'content_type' => $contentType,
			'context'      => $context,
			'slug'         => $slug,
			'created_at'   => time(),
			'languages'    => $languages,
		], false);

		$this->prependToIndex($batchId);

		return $batchId;
	}

	public function getBatch(string $batchId): ?array
	{
		$batch = get_option($this->optionName($batchId), null);

		return is_array($batch) ? $batch : null;
	}

	/**
	 * Most recently created batches first, capped at $limit.
	 */
	public function getRecentBatches(int $limit = 20): array
	{
		$batches = [];

		foreach ($this->getIndex() as $batchId) {
			if (count($batches) >= $limit) {
				break;
			}

			$batch = $this->getBatch($batchId);

			if ($batch !== null) {
				$batches[] = $batch;
			}
		}

		return $batches;
	}

	public function markLanguageInProgress(string $batchId, string $language): void
	{
		$this->updateLanguage($batchId, $language, [
			'status'     => 'in_progress',
			'updated_at' => time(),
		]);
	}

	public function markLanguageSucceeded(string $batchId, string $language, int $postId): void
	{
		$this->updateLanguage($batchId, $language, [
			'status'        => 'success',
			'post_id'       => $postId,
			'error_message' => null,
			'updated_at'    => time(),
		]);
	}

	public function markLanguageFailed(string $batchId, string $language, string $errorMessage): void
	{
		$this->updateLanguage($batchId, $language, [
			'status'        => 'error',
			'error_message' => $errorMessage,
			'updated_at'    => time(),
		]);
	}

	/**
	 * Records another retry attempt for a language and returns the new
	 * count, so the caller (cron wiring) can decide whether to schedule
	 * another attempt or leave the language for manual retry.
	 */
	public function incrementRetryCount(string $batchId, string $language): int
	{
		$batch = $this->getBatch($batchId);

		if ($batch === null || !isset($batch['languages'][$language])) {
			return 0;
		}

		$retryCount = (int) ($batch['languages'][$language]['retry_count'] ?? 0) + 1;

		$this->updateLanguage($batchId, $language, ['retry_count' => $retryCount]);

		return $retryCount;
	}

	private function updateLanguage(string $batchId, string $language, array $changes): void
	{
		$batch = $this->getBatch($batchId);

		if ($batch === null || !isset($batch['languages'][$language])) {
			return;
		}

		$batch['languages'][$language] = array_merge($batch['languages'][$language], $changes);

		update_option($this->optionName($batchId), $batch, false);
	}

	private function getIndex(): array
	{
		$index = get_option(self::INDEX_OPTION, []);

		return is_array($index) ? $index : [];
	}

	private function prependToIndex(string $batchId): void
	{
		$index = array_slice(
			array_merge([$batchId], $this->getIndex()),
			0,
			self::MAX_BATCHES_IN_INDEX
		);

		update_option(self::INDEX_OPTION, $index, false);
	}

	private function optionName(string $batchId): string
	{
		return self::OPTION_PREFIX . $batchId;
	}
}
