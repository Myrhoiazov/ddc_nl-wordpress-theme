<?php
/**
 * Template name: Schedule
 */
$BsWp = new BsWp;

$BsWp->get_template_parts([
	'parts/shared/html-header',
	'parts/shared/header'
]);

$args = [
	'post_type'      => 'schedule',
	'posts_per_page' => -1,
	'nopaging'       => true,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
];
$schedule_query = new WP_Query($args);
?>

<div class="schedule-page">

	<!-- Hero -->
	<section class="schedule-hero" style="<?php $thumb = get_the_post_thumbnail_url(); if ($thumb) echo 'background-image: url(' . esc_url($thumb) . ');'; ?>">
		<div class="schedule-hero__overlay"></div>
		<div class="container schedule-hero__inner">
			<?php if (have_posts()) while (have_posts()) : the_post(); ?>
				<span class="schedule-hero__eyebrow"><?php esc_html_e('Talent Center DDC', 'wp_denysmyr'); ?></span>
				<h1 class="schedule-hero__title"><?php the_title(); ?></h1>
				<?php
				$subtitle = get_post_meta(get_the_ID(), 'sub_title', true);
				if ($subtitle) echo '<p class="schedule-hero__sub">' . esc_html($subtitle) . '</p>';
				?>
			<?php endwhile; ?>
		</div>
	</section>

	<!-- Cards -->
	<section class="schedule-cities">
		<div class="container">
			<?php if ($schedule_query->have_posts()) : ?>
				<div class="row g-4">
					<?php while ($schedule_query->have_posts()) : $schedule_query->the_post(); ?>
						<div class="col-12 col-lg-6">
							<article class="schedule-card">
								<h2 class="schedule-card__city">
									<a href="<?php the_permalink(); ?>" class="schedule-card__link"><?php the_title(); ?></a>
								</h2>
								<div class="schedule-card__content">
									<?php the_content(); ?>
								</div>
							</article>
						</div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- CTA -->
	<section class="schedule-cta">
		<div class="container text-center">
			<p class="schedule-cta__text"><?php esc_html_e('Не нашли подходящее время? Напишите нам — подберём вариант.', 'wp_denysmyr'); ?></p>
			<button type="button" class="schedule-cta__btn" data-bs-toggle="modal" data-bs-target="#contact_form">
				<?php esc_html_e('Связаться с нами', 'wp_denysmyr'); ?>
			</button>
		</div>
	</section>

</div>

<?php
$BsWp->get_template_parts([
	'parts/modals/contact',
	'parts/shared/footer',
	'parts/shared/cookiebar',
	'parts/shared/html-footer'
]);
?>
