<?php

/**
 * The Template for displaying a single dance style (CPT `styles`)
 *
 * Please see /external/bootstrap-utilities.php for info on BsWp::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Bootstrap 5.3.2
 * @author 		DenysMyr
 */
$BsWp = new BsWp;

$BsWp->get_template_parts([
	'parts/shared/html-header',
	'parts/shared/header'
]);
?>

<div class="styles-page">

	<?php if (have_posts()) while (have_posts()) : the_post(); ?>

		<!-- Hero -->
		<section class="styles-hero" style="<?php $thumb = get_the_post_thumbnail_url(); if ($thumb) echo 'background-image: url(' . esc_url($thumb) . ');'; ?>">
			<div class="styles-hero__overlay"></div>
			<div class="container styles-hero__inner">
				<span class="styles-hero__eyebrow"><?php esc_html_e('Talent Center DDC', 'wp_denysmyr'); ?></span>
				<h1 class="styles-hero__title"><?php the_title(); ?></h1>
			</div>
		</section>

		<!-- Content -->
		<?php if (trim(get_the_content())) : ?>
			<section class="styles-content">
				<div class="container">
					<div class="styles-content__inner">
						<?php the_content(); ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

	<?php endwhile; ?>

	<!-- Videos -->
	<section class="styles-videos">
		<div class="container">
			<?php
			$youtube = new Youtube;
			$videos = [];
			for ($i = 1; $i <= 6; $i++) {
				$field = sprintf('video_%02d', $i);
				$videoData = $youtube->getYoutubeId(get_post_meta(get_the_ID(), $field, true));
				if (!empty($videoData->url)) {
					$videos[] = $videoData;
				}
			}
			?>
			<?php if ($videos) : ?>
				<h2 class="styles-videos__title"><?php esc_html_e("Video's", 'wp_denysmyr'); ?></h2>
				<div class="row g-4">
					<?php foreach ($videos as $videoData) : ?>
						<div class="col-6 col-lg-4">
							<a data-fslightbox="gallery" class="styles-video-card" href="<?php echo esc_url($videoData->url); ?>">
								<img loading="lazy" decoding="async" src="https://i3.ytimg.com/vi/<?php echo esc_attr($videoData->id) ?>/hqdefault.jpg" alt="">
								<span class="styles-video-card__play" aria-hidden="true">
									<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z" fill="currentColor" /></svg>
								</span>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

</div>

<?php
$BsWp->get_template_parts([
	'parts/shared/footer',
	'parts/shared/cookiebar',
	'parts/shared/html-footer'
]);
?>
