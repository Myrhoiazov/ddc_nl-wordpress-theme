<?php
/**
 * Instagram Reels section. Renders nothing when there is no cached data
 * yet (first deploy before the first successful cron sync, or Instagram
 * unavailable with an empty cache) — no placeholder, no error text.
 *
 * Expects $args['reels'] — the array from InstagramFeedService::getLatest().
 */
$reels = $args['reels'] ?? [];

if (empty($reels)) {
    return;
}

$fallback_poster = 'https://talentcenterddc.nl/wp-content/uploads/2025/12/faq-talent-center-ddc.jpg';
?>
<section class="instagram-reels" data-instagram-reels>
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-12 col-lg-6">
                <span class="sub-title"><?php echo __('Мы в Instagram', 'wp_denysmyr'); ?></span>
                <h2 class="main-title"><?php echo __('СВЕЖИЕ<br>REELS', 'wp_denysmyr'); ?></h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="swiper instagram-reels-swiper">
            <div class="swiper-wrapper">
                <?php foreach ($reels as $reel) :
                    $poster = !empty($reel['thumbnailUrl']) ? $reel['thumbnailUrl'] : $fallback_poster;
                    $aria_label = !empty($reel['caption'])
                        ? wp_trim_words(wp_strip_all_tags($reel['caption']), 20)
                        : __('Открыть Reel в Instagram', 'wp_denysmyr');
                ?>
                    <div class="swiper-slide">
                        <a
                            href="<?php echo esc_url($reel['permalink']); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="instagram-reels__card"
                            data-instagram-reels-item
                            data-permalink="<?php echo esc_url($reel['permalink']); ?>"
                            <?php if (!empty($reel['videoUrl'])) : ?>
                                data-video-src="<?php echo esc_url($reel['videoUrl']); ?>"
                            <?php endif; ?>
                            aria-label="<?php echo esc_attr($aria_label); ?>"
                        >
                            <img class="instagram-reels__poster" src="<?php echo esc_url($poster); ?>" alt="" loading="lazy" decoding="async">
                            <span class="instagram-reels__play" aria-hidden="true">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z" fill="currentColor" /></svg>
                            </span>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>
