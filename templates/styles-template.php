<?php

/**
 * Template name: Styles
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

<div class="styles-page">

	<!-- Hero -->
	<section class="styles-hero" style="<?php $thumb = get_the_post_thumbnail_url(); if ($thumb) echo 'background-image: url(' . esc_url($thumb) . ');'; ?>">
		<div class="styles-hero__overlay"></div>
		<div class="container styles-hero__inner">
			<?php if (have_posts()) while (have_posts()) : the_post(); ?>
				<span class="styles-hero__eyebrow"><?php esc_html_e('Talent Center DDC', 'wp_denysmyr'); ?></span>
				<h1 class="styles-hero__title"><?php the_title(); ?></h1>
				<?php if (trim(get_the_content())) : ?>
					<div class="styles-hero__sub"><?php the_content(); ?></div>
				<?php endif; ?>
			<?php endwhile; ?>
		</div>
	</section>

	<!-- Grid -->
	<section class="styles-grid">
		<div class="container">
			<?php
			$args = [
				'post_type'      => 'styles',
				'posts_per_page' => -1,
				'nopaging'       => true,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
			];
			$the_query = new WP_Query($args);
			?>
			<?php if ($the_query->have_posts()) : ?>
				<div class="row g-4">
					<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
						<div class="col-6 col-lg-3">
							<a href="<?php echo esc_url(get_permalink()); ?>" class="styles-card">
								<?php
								$src = has_post_thumbnail() ? wp_get_attachment_image_src(get_post_thumbnail_id(), 'large') : false;
								if ($src) :
								?>
									<img class="styles-card__img" loading="lazy" decoding="async" src="<?php echo esc_url($src[0]); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
								<?php endif; ?>
								<span class="styles-card__overlay"></span>
								<h3 class="styles-card__title"><?php echo esc_html(get_the_title()); ?></h3>
							</a>
						</div>
					<?php endwhile; ?>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<p class="styles-empty"><?php esc_html_e('Sorry, no posts matched your criteria.', 'wp_denysmyr'); ?></p>
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
