<?php

/**
 * Template name: tickets
 *
 * Please see /external/bootstrap-utilities.php for info on BsWp::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Bootstrap 5.3.2
 * @autor 		ddc_nl
 */
$BsWp = new BsWp;

$BsWp->get_template_parts([
    'parts/shared/html-header',
    'parts/shared/header'
]);
?>

<?php if (have_posts()) while (have_posts()) : the_post(); ?>
    <section id="tickets">
        <a href="<?php echo get_site_url(); ?>/" class="small-logo">
            <span class="year">2026</span>
            <img loading="lazy" decoding="async" src="<?php echo get_template_directory_uri() ?>/images/ddc_logo_white.png" alt="">
            <div class="place">
                Amsterdam
            </div>
        </a>
        <div class="container">
            <div class="row">
                <div class="col-12">
					<div class="content">
						<h1 class="mb-3">
							<?php the_title(); ?>
                            <img class="smile" src="<?php echo get_template_directory_uri() ?>/images/ddc_logo.png" alt="" width="160">
						</h1>
						<?php
						$subtitle = get_post_meta(get_the_ID(), 'sub_title', true);
						?>
						<?php if (!empty($subtitle)): ?>
							<h2 class="subtitle">
								<?php echo $subtitle ?>
							</h2>
						<?php endif; ?>
						<div class="description"><?php the_content(); ?></div>
						<?php
						// the query.
						$args = [
							'post_type' => 'tickets',
							'posts_per_page' => -1,
							'nopaging' => true,
							'order' => 'ASC'
						];
						$the_query = new WP_Query( $args ); ?>

						<?php if ( $the_query->have_posts() ) : ?>
							<div class="row tickets-row mt-2 mt-lg-5">
								<!-- pagination here -->
							
								<!-- the loop -->
								<?php while ( $the_query->have_posts() ) :
									$the_query->the_post();
									?>
									<div class="col-lg-4 mb-3 mb-lg-5">
										<div class="ticket" style="opacity: 1;">
											<?php if(has_post_thumbnail()): ?>
												<div class="img-wrap magic-hover magic-hover__square bdb-0">
													<?php $src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large') ?>
													<img loading="lazy" decoding="async" src="<?php echo $src[0] ?>" alt=" <?php the_title(); ?>">
												</div>
											<?php endif; ?>
										</div>
									</div>
									<div class="col-lg-8 mb-5 desc">
										<?php the_title( '<h3>', '</h3>' ); ?>
										<?php the_content(); ?>
									</div>
								<?php endwhile; ?>
								<!-- end of the loop -->
								 <div class="col-12 text-center d-grid d-lg-block">
									<button class="btn btn-primary btn-lg magic-hover magic-hover__square is-black js-payment mb-3 mb-lg-0 btn-round" data-bs-toggle="modal" data-bs-target="#eventixModal">
										<?php echo __('Buy ticket now!', 'ddc_nl') ?>
									</button>
									<button class="btn btn-primary btn-lg magic-hover magic-hover__square is-black btn-round" data-bs-toggle="modal" data-bs-target="#terms">
										<?php echo __('Terms and conditions', 'ddc_nl') ?>
									</button>
								 </div>
							
								<!-- pagination here -->
							</div>
							<?php wp_reset_postdata(); ?>

						<?php else : ?>
							<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
						<?php endif; ?>
					</div>
                </div>
            </div>
        </div>
    </section>


<?php endwhile; ?>

<?php
$BsWp->get_template_parts([
    'parts/modals/eventix',
    'parts/modals/termsandconditions',
    'parts/shared/footer',
	'parts/shared/cookiebar',
    'parts/shared/html-footer'
]);
?>