<?php

/**
 * Normalizes a raw Instagram Graph API media item into the shape this
 * theme stores and consumes internally (docs/spec/instagram — section 9,
 * "Что хранить"). Pure data shaping only: no HTTP, no WordPress storage.
 */
class InstagramMedia
{
	public static function normalize(array $rawItem): array
	{
		return [
			'instagram_media_id' => (string) ($rawItem['id'] ?? ''),
			'permalink'          => (string) ($rawItem['permalink'] ?? ''),
			'media_url'          => $rawItem['media_url'] ?? null,
			'thumbnail_url'      => $rawItem['thumbnail_url'] ?? null,
			'caption'            => (string) ($rawItem['caption'] ?? ''),
			'published_at'       => (string) ($rawItem['timestamp'] ?? ''),
			'media_type'         => (string) ($rawItem['media_type'] ?? ''),
			'media_product_type' => (string) ($rawItem['media_product_type'] ?? ''),
		];
	}

	/**
	 * `permalink` is the canonical Instagram link (spec section 9) and
	 * `instagram_media_id` is the dedupe key (spec section 37) — a
	 * normalized item missing either can't be identified or linked, so
	 * it's not usable regardless of whether media_url/thumbnail_url exist.
	 */
	public static function isUsable(array $normalized): bool
	{
		return $normalized['instagram_media_id'] !== '' && $normalized['permalink'] !== '';
	}
}
