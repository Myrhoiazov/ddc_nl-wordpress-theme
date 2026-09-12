<?php

/**
 * Returns Instagram Reels shaped for the frontend only — id, permalink,
 * videoUrl, thumbnailUrl, caption, publishedAt (spec section 38). Never
 * the raw API response, access token, or internal cache metadata.
 */
class InstagramFeedService
{
	private InstagramRepository $repository;

	public function __construct(InstagramRepository $repository)
	{
		$this->repository = $repository;
	}

	public function getLatest(int $limit = DDC_INSTAGRAM_MAX_REELS): array
	{
		$items = array_slice($this->repository->getItems(), 0, $limit);

		return array_map([$this, 'toFrontendPayload'], $items);
	}

	private function toFrontendPayload(array $item): array
	{
		return [
			'id'          => $item['instagram_media_id'] ?? '',
			'permalink'   => $item['permalink'] ?? '',
			'videoUrl'    => $item['media_url'] ?? null,
			'thumbnailUrl' => $item['thumbnail_url'] ?? null,
			'caption'     => $item['caption'] ?? '',
			'publishedAt' => $item['published_at'] ?? '',
		];
	}
}
