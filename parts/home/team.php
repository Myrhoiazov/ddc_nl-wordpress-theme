<?php
$edition = isset($args['edition']) ? $args['edition'] : false;
// the query.
$args = [
	'post_type' => 'team',
	'posts_per_page' => -1,
	'nopaging' => true,
	'tax_query' => [
		[
			'taxonomy' => 'cat',
			'terms' => 'team',
			'field' => 'slug',
			'include_children' => true,
			'operator' => 'IN'
		]
	]
];

if ($edition) {
	$args['tax_query'] = [
		'relation' => 'AND',
		[
			'taxonomy' => 'team_edition',
			'field' => 'slug',
			'terms' => $edition,
		],
		[
			'taxonomy' => 'cat',
			'terms' => 'team',
			'field' => 'slug',
			'include_children' => true,
			'operator' => 'IN'
		]
	];
}
$the_query = new WP_Query($args); ?>

<?php if ($the_query->have_posts()) : ?>
	<!-- pagination here -->
	 <div class="row team-row">
		 <!-- the loop -->
		 <?php
		 while ($the_query->have_posts()) :
			 $the_query->the_post();
		 ?>
			 <span class="col-6 col-lg-3 team">
				 <?php if (has_post_thumbnail()): ?>
					 <div class="img-wrap ">
						 <?php $src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large') ?>
						 <img loading="lazy" decoding="async" src="<?php echo $src[0] ?>" alt="<?php echo get_the_title(); ?>">
					 </div>
				 <?php endif; ?>
				 <?php the_title('<h3>', '</h3>'); ?>
			 </span>
		 <?php endwhile; ?>
		 <!-- end of the loop -->
	 </div>

	<!-- pagination here -->

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>