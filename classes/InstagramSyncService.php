<?php

/**
 * Orchestrates one Instagram sync run:
 *
 *   API client -> filter (already REELS-only) -> normalize -> validate
 *   -> dedupe -> sort newest-first -> cap at MAX_REELS -> repository
 *
 * On API failure, the existing cache is left untouched (spec section 13)
 * and the failure is logged server-side without any secret in it.
 */
class InstagramSyncService
{
	private InstagramApiClient $apiClient;
	private InstagramRepository $repository;

	public function __construct(InstagramApiClient $apiClient, InstagramRepository $repository)
	{
		$this->apiClient = $apiClient;
		$this->repository = $repository;
	}

	public function run(int $maxItems = DDC_INSTAGRAM_MAX_REELS): bool
	{
		$rawReels = $this->apiClient->fetchReels($maxItems);

		if (is_wp_error($rawReels)) {
			$this->logFailure($rawReels);
			$this->repository->recordFailedAttempt();

			return false;
		}

		$normalized = $this->normalizeAndDedupe($rawReels);
		usort($normalized, static function (array $a, array $b): int {
			return strtotime($b['published_at'] ?: '0') <=> strtotime($a['published_at'] ?: '0');
		});
		$normalized = array_slice($normalized, 0, $maxItems);

		$this->repository->saveSuccessful($normalized);

		return true;
	}

	/**
	 * Normalizes each raw item, drops ones missing id/permalink, and
	 * dedupes by instagram_media_id (spec section 37) — a repeated ID
	 * within the same response keeps whichever occurrence has the more
	 * recent published_at, not just whichever came last in the array.
	 */
	private function normalizeAndDedupe(array $rawReels): array
	{
		$byId = [];

		foreach ($rawReels as $rawItem) {
			$item = InstagramMedia::normalize($rawItem);

			if (!InstagramMedia::isUsable($item)) {
				continue;
			}

			$id = $item['instagram_media_id'];
			$isNewer = !isset($byId[$id])
				|| strtotime($item['published_at'] ?: '0') > strtotime($byId[$id]['published_at'] ?: '0');

			if ($isNewer) {
				$byId[$id] = $item;
			}
		}

		return array_values($byId);
	}

	private function logFailure(WP_Error $error): void
	{
		$data = $error->get_error_data();
		$data = is_array($data) ? $data : [];

		error_log(sprintf(
			'[Instagram Sync] failed: %s (code=%s, status=%s, meta_error_code=%s) at %s',
			$error->get_error_message(),
			$error->get_error_code(),
			$data['status'] ?? 'n/a',
			$data['meta_error_code'] ?? 'n/a',
			gmdate('c')
		));
	}
}
