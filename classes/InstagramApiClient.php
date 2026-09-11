<?php

/**
 * Talks to the Instagram Graph API (Instagram API with Instagram Login)
 * for a single Professional Account.
 *
 * Only responsible for the HTTP call: authorization, pagination, response
 * validation, error normalization, and timeout. Knows nothing about
 * WordPress storage, caching, or rendering — see InstagramSyncService for
 * orchestration and InstagramRepository for persistence.
 */
class InstagramApiClient
{
	private const API_BASE = 'https://graph.instagram.com';
	private const API_VERSION = 'v21.0';
	private const MEDIA_FIELDS = 'id,media_type,media_product_type,media_url,thumbnail_url,permalink,timestamp,caption,username';
	private const REQUEST_TIMEOUT_SECONDS = 8;
	private const MAX_PAGES = 5;

	private string $accessToken;

	public function __construct(string $accessToken)
	{
		$this->accessToken = $accessToken;
	}

	/**
	 * Pages through the account's media feed only as far as needed to
	 * collect up to $maxItems Reels. Instagram returns media newest-first,
	 * so the result is newest-first too. Stops after self::MAX_PAGES
	 * regardless of how many Reels were found, so a sparse account can't
	 * turn this into an unbounded crawl.
	 *
	 * @return array|WP_Error Raw REELS media items (Instagram field names), or WP_Error on failure.
	 */
	public function fetchReels(int $maxItems)
	{
		if ($this->accessToken === '') {
			return new WP_Error('instagram_not_configured', 'Instagram access token is not configured.');
		}

		$reels = [];
		$url = $this->buildInitialUrl();
		$pagesFetched = 0;

		while ($url !== null && $pagesFetched < self::MAX_PAGES && count($reels) < $maxItems) {
			$pagesFetched++;

			$page = $this->requestPage($url);
			if (is_wp_error($page)) {
				return $page;
			}

			foreach ($page['data'] as $item) {
				if (is_array($item) && ($item['media_product_type'] ?? '') === 'REELS') {
					$reels[] = $item;
				}
			}

			$url = $page['paging']['next'] ?? null;
		}

		return array_slice($reels, 0, $maxItems);
	}

	private function buildInitialUrl(): string
	{
		return add_query_arg(
			[
				'fields'       => self::MEDIA_FIELDS,
				'access_token' => $this->accessToken,
			],
			self::API_BASE . '/' . self::API_VERSION . '/me/media'
		);
	}

	/**
	 * @return array|WP_Error Decoded response body, or WP_Error on failure.
	 */
	private function requestPage(string $url)
	{
		$response = wp_remote_get($url, [
			'timeout' => self::REQUEST_TIMEOUT_SECONDS,
		]);

		if (is_wp_error($response)) {
			return new WP_Error('instagram_request_failed', $response->get_error_message());
		}

		$statusCode = (int) wp_remote_retrieve_response_code($response);
		$body = json_decode(wp_remote_retrieve_body($response), true);

		if ($statusCode !== 200 || !is_array($body) || !isset($body['data']) || !is_array($body['data'])) {
			return new WP_Error(
				'instagram_api_error',
				sprintf('Instagram API request failed with status %d', $statusCode),
				[
					'status'          => $statusCode,
					'meta_error_code' => is_array($body) ? ($body['error']['code'] ?? null) : null,
					'meta_error_type' => is_array($body) ? ($body['error']['type'] ?? null) : null,
				]
			);
		}

		return $body;
	}
}
