<?php

// the query.
$args = [
    'post_type' => 'choreographer',
    'posts_per_page' => -1,
    'nopaging' => true,
	'order' => 'ASC',
	'tax_query' => [
        [
            'taxonomy' => 'edition',
            'field'    => 'slug',
            'terms'    => 'four'
        ]
    ]
];

$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>
	<div class="row choreographer-row">

		<!-- pagination here -->
	
		<!-- the loop -->
		<?php
		while ( $the_query->have_posts() ) :
			$the_query->the_post();
			$country = get_post_meta(get_the_ID(), 'country', true);
			?>
			<a href="<?php the_permalink(); ?>" class="col-6 col-lg-3 choreographer <?php echo strtolower(preg_replace('/[^a-z]/i', '-', $country)); ?>">
				<?php if(has_post_thumbnail()): ?>
					<div class="img-wrap magic-hover magic-hover__square bdb-0">
						<?php if (isset($country) && $country): ?>
							<div class="country <?php echo strtolower(preg_replace('/[^a-z]/i', '-', $country)); ?>">
								<?php echo $country ?>
							</div>
						<?php endif; ?>
						<?php $src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large') ?>
						<img loading="lazy" decoding="async" src="<?php echo $src[0] ?>" alt="<?php the_title() ?>">
					</div>
				<?php endif; ?>

				<?php if (get_the_title() !== 'New Guest'): ?>
					<?php the_title('<h3>', '</h3>'); ?>
				<?php endif; ?>
			</a>
		<?php endwhile; ?>
		<!-- end of the loop -->
	
		<!-- pagination here -->
	</div>

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
