<?php

/**
 * Encapsulates the Instagram Reels cache storage. Frontend and sync code
 * only talk to this class — neither knows (or needs to know) that the
 * cache physically lives in a single WordPress option.
 *
 * A failed sync must never erase a working cache (spec section 13), so
 * this class exposes separate "replace on success" / "record failure"
 * operations instead of one generic save().
 */
class InstagramRepository
{
	private const OPTION_NAME = 'ddc_instagram_reels_cache';

	private const DEFAULTS = [
		'items'                   => [],
		'last_sync_attempt_at'    => null,
		'last_successful_sync_at' => null,
		'last_sync_status'        => null,
		'cached_items_count'      => 0,
	];

	public function getItems(): array
	{
		return $this->getCache()['items'];
	}

	public function hasCache(): bool
	{
		return !empty($this->getItems());
	}

	/**
	 * Replaces the cached snapshot after a successful sync.
	 */
	public function saveSuccessful(array $items): void
	{
		$now = time();

		update_option(self::OPTION_NAME, [
			'items'                   => array_values($items),
			'last_sync_attempt_at'    => $now,
			'last_successful_sync_at' => $now,
			'last_sync_status'        => 'ok',
			'cached_items_count'      => count($items),
		], false);
	}

	/**
	 * Records that a sync attempt failed, without touching the existing
	 * `items` snapshot — the last successful cache is kept as-is.
	 */
	public function recordFailedAttempt(): void
	{
		$cache = $this->getCache();
		$cache['last_sync_attempt_at'] = time();
		$cache['last_sync_status'] = 'error';

		update_option(self::OPTION_NAME, $cache, false);
	}

	/**
	 * Observability fields only (no items) — last_sync_attempt_at,
	 * last_successful_sync_at, last_sync_status, cached_items_count.
	 * Not consumed by anything yet (no admin UI in this iteration —
	 * see spec section 12); kept for a future manual-refresh screen.
	 */
	public function getSyncMeta(): array
	{
		$cache = $this->getCache();
		unset($cache['items']);

		return $cache;
	}

	private function getCache(): array
	{
		$cache = get_option(self::OPTION_NAME, []);

		if (!is_array($cache)) {
			$cache = [];
		}

		return array_merge(self::DEFAULTS, $cache);
	}
}
