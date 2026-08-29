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

<?php if (have_posts()) while (have_posts()) : the_post(); ?>
	<section id="single">
		<a href="<?php echo esc_url(get_site_url()); ?>/" class="small-logo">
			<span class="year"><?php echo esc_html(NEXT_EDITION_YEAR); ?></span>
			<img loading="lazy" decoding="async" src="<?php echo esc_url(get_template_directory_uri()) ?>/images/ddc_logo_white.png" alt="">
			<div class="place">
				Amsterdam
			</div>
		</a>
		<div class="container">
			<div class="row">
				<div class="col-12 mb-4 d-flex justify-content-end justify-content-lg-start">
					<a href="javascript:void(0);" onclick="history.back();" class="btn btn-link text-light back-btn text-decoration-none">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
						</svg>
						Back
					</a>
				</div>
				<div class="col-lg-4">
					<?php if (has_post_thumbnail()): ?>
						<div class="img-wrap">
							<div class="inner"></div>
							<?php $src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large') ?>
							<img loading="lazy" decoding="async" src="<?php echo esc_url($src[0]) ?>" alt="">
						</div>
					<?php endif; ?>
				</div>
				<div class="col-lg-8">
					<div class="inner-field">
						<h1>
							<?php the_title(); ?>
						</h1>
						<div class="description"><?php the_content(); ?></div>
						<h3 class="mt-5 mb-4 d-none d-lg-block">
							<?php echo __('Video\'s', 'wp_denysmyr') ?>
						</h3>
						<div class="row video-row mt-5 mt-lg-0">
							<?php
							$youtube = new Youtube;
							for ($i = 1; $i <= 6; $i++) {
								$field = sprintf('video_%02d', $i);
								$videoData = $youtube->getYoutubeId(get_post_meta(get_the_ID(), $field, true));
								$video_url = $videoData->url;
								$video_id = $videoData->id;

								if (empty($video_url)) {
									continue;
								}
							?>
								<div class="col-12 col-lg-6 mb-5">
									<a data-fslightbox="gallery" class="magic-hover magic-hover__square d-block" href="<?php echo esc_url($video_url); ?>">
										<span class="video-wrap ratio ratio-16x9 d-block">
											<img src="https://i3.ytimg.com/vi/<?php echo esc_attr($video_id) ?>/hqdefault.jpg" alt="">
										</span>
									</a>
								</div>
							<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-5 pb-5">
				<div class="col-8 offset-4" style="padding-left: 5rem;">
				</div>
			</div>
		</div>
	</section>


<?php endwhile; ?>

<?php
$BsWp->get_template_parts([
	'parts/shared/footer',
	'parts/shared/cookiebar',
	'parts/shared/html-footer'
]);
?>
