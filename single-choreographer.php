<?php

/**
 * The Template for displaying all single posts
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
		<a href="<?php echo get_site_url(); ?>/" class="small-logo">
			<span class="year"><?php echo NEXT_EDITION_YEAR; ?></span>
			<img loading="lazy" decoding="async" src="<?php echo get_template_directory_uri() ?>/images/ddc_logo_white.png" alt="">
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
							<?php $country = get_post_meta(get_the_ID(), 'country', true); ?>
							<div class="country <?php echo esc_attr(strtolower(preg_replace('/[^a-z]/i', '-', $country))); ?>">
								<?php echo esc_html($country) ?>
							</div>
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
						<?php
						$instagram = get_post_meta(get_the_ID(), 'instagram', true);
						$tiktok = get_post_meta(get_the_ID(), 'tiktok', true);
						$website = get_post_meta(get_the_ID(), 'website', true);
						$instagramName = '';
						$tiktokName = '';
						$websiteName = '';
						if (!empty($instagram)) {
							preg_match('/.*instagram.com\/([^\/?]+)/', $instagram, $matches);
							if (!empty($matches[1])) {
								$instagramName = '@' . $matches[1];
							}
						}
						if (!empty($tiktok)) {
							preg_match('/.*tiktok.com\/(.*)/', $tiktok, $matches);
							if (!empty($matches[1])) {
								$tiktokName = $matches[1];
							}
						}
						if (!empty($website)) {
							preg_match('/(https|http):\/\/([^\/]+)/', $website, $matches);
							if (!empty($matches[2])) {
								$websiteName = $matches[2];
							}
						}
						?>
						<?php if (!empty($tiktok) || !empty($instagram) || !empty($website)): ?>
							<nav id="social-nav">
								<?php if (!empty($instagram)): ?>
									<span>
										<a href="<?php echo esc_url($instagram); ?>" target="_blank" class="magic-hover magic-hover__square">
											<span class="icon">
												<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
													<path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
												</svg>
											</span>
											<?php echo esc_html($instagramName); ?>
										</a>
									</span>
								<?php endif; ?>
								<?php if (!empty($tiktok)): ?>
									<span>
										<a href="<?php echo esc_url($tiktok); ?>" target="_blank" class="magic-hover magic-hover__square">
											<span class="icon">
												<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
													<path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z" />
												</svg>
											</span>
											<?php echo esc_html($tiktokName); ?>
										</a>
									</span>
								<?php endif; ?>
								<?php if (!empty($website)): ?>
									<span>
										<a href="<?php echo esc_url($website); ?>" target="_blank" class="magic-hover magic-hover__square">
											<span class="icon">
												<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
													<path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
												</svg>
											</span>
											<?php echo esc_html($websiteName); ?>
										</a>
									</span>
								<?php endif; ?>

							</nav>
						<?php endif; ?>
						<h3 class="mt-5 mb-4 d-none d-lg-block">
							<?php echo __('Video\'s', 'wp_denysmyr') ?>
						</h3>
						<div class="row video-row mt-5 mt-lg-0">
			
							<?php
							$youtube = new Youtube;
							$download_01 = get_post_meta(get_the_ID(), 'download_01', true);
							$videoData = $youtube->getYoutubeId(get_post_meta(get_the_ID(), 'video_01', true));
							$video_01 = $videoData->url;
							$video_01_id = $videoData->id;
			
							?>
							<?php if (!empty($video_01)): ?>
								<div class="col-12 col-lg-6 mb-5 position-relative">
								<?php if(is_user_logged_in() && !empty($download_01)): ?>
									<a href="<?php echo esc_url($download_01); ?>" class="btn-download me-2 me-lg-3" target="_blank" download></a>
								<?php endif; ?>
									<a data-fslightbox="gallery" class="magic-hover magic-hover__square d-block" href="<?php echo esc_url($video_01); ?>">
										<span class="video-wrap ratio ratio-16x9 d-block">
											<img src="https://i3.ytimg.com/vi/<?php echo esc_attr($video_01_id) ?>/hqdefault.jpg" alt="">
										</span>
									</a>
								</div>
							<?php endif; ?>
							<?php
							$download_02 = get_post_meta(get_the_ID(), 'download_02', true);
							$videoData = $youtube->getYoutubeId(get_post_meta(get_the_ID(), 'video_02', true));
							$video_02 = $videoData->url;
							$video_02_id = $videoData->id;
			
							?>
							<?php if (!empty($video_02)): ?>
								<div class="col-12 col-lg-6 mb-5 position-relative">
									<?php if(is_user_logged_in() && !empty($download_02)): ?>
										<a href="<?php echo esc_url($download_02); ?>" class="btn-download me-3" target="_blank" download></a>
									<?php endif; ?>
									<a data-fslightbox="gallery" class="magic-hover magic-hover__square" href="<?php echo esc_url($video_02); ?>">
										<span class="video-wrap ratio ratio-16x9 d-block">
											<img src="https://i3.ytimg.com/vi/<?php echo esc_attr($video_02_id) ?>/hqdefault.jpg" alt="">
										</span>
									</a>
								</div>
							<?php endif; ?>
							<?php
							$videoData = $youtube->getYoutubeId(get_post_meta(get_the_ID(), 'video_03', true));
							$video_03 = $videoData->url;
							$video_03_id = $videoData->id;
			
							?>
							<?php if (!empty($video_03)): ?>
								<div class="col-12 col-lg-6 mb-5">
									<a data-fslightbox="gallery" class="magic-hover magic-hover__square" href="<?php echo esc_url($video_03); ?>">
										<span class="video-wrap ratio ratio-16x9 d-block">
											<img src="https://i3.ytimg.com/vi/<?php echo esc_attr($video_03_id) ?>/hqdefault.jpg" alt="">
										</span>
									</a>
								</div>
							<?php endif; ?>
							<?php
							$video_04 = get_post_meta(get_the_ID(), 'video_04', true);
							$video_04_id = '';
							if (!empty($video_04)) {
								preg_match('/v=([A-Za-z0-9_-]+)/', $video_04, $matches);
								if (!empty($matches[1])) {
									$video_04_id = $matches[1];
								}
							}
			
							?>
							<?php if (!empty($video_04)): ?>
								<div class="col-12 col-lg-6 mb-5">
									<a data-fslightbox="gallery" class="magic-hover magic-hover__square" href="<?php echo esc_url($video_04); ?>">
										<span class="video-wrap ratio ratio-16x9 d-block">
											<img src="https://i3.ytimg.com/vi/<?php echo esc_attr($video_04_id) ?>/hqdefault.jpg" alt="">
										</span>
									</a>
								</div>
							<?php endif; ?>
							<?php
							$video_05 = get_post_meta(get_the_ID(), 'video_05', true);
							$video_05_id = '';
							if (!empty($video_05)) {
								preg_match('/v=([A-Za-z0-9_-]+)/', $video_05, $matches);
								if (!empty($matches[1])) {
									$video_05_id = $matches[1];
								}
							}
			
							?>
							<?php if (!empty($video_05)): ?>
								<div class="col-12 col-lg-6 mb-5">
									<a data-fslightbox="gallery" class="magic-hover magic-hover__square" href="<?php echo esc_url($video_05); ?>">
										<span class="video-wrap ratio ratio-16x9 d-block">
											<img src="https://i3.ytimg.com/vi/<?php echo esc_attr($video_05_id) ?>/hqdefault.jpg" alt="">
										</span>
									</a>
								</div>
							<?php endif; ?>
							<?php
							$video_06 = get_post_meta(get_the_ID(), 'video_06', true);
							$video_06_id = '';
							if (!empty($video_06)) {
								preg_match('/v=([A-Za-z0-9_-]+)/', $video_06, $matches);
								if (!empty($matches[1])) {
									$video_06_id = $matches[1];
								}
							}
			
							?>
							<?php if (!empty($video_06)): ?>
								<div class="col-12 col-lg-6 mb-5">
									<a data-fslightbox="gallery" class="magic-hover magic-hover__square" href="<?php echo esc_url($video_06); ?>">
										<span class="video-wrap ratio ratio-16x9 d-block">
											<img src="https://i3.ytimg.com/vi/<?php echo esc_attr($video_06_id) ?>/hqdefault.jpg" alt="">
										</span>
									</a>
								</div>
							<?php endif; ?>
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