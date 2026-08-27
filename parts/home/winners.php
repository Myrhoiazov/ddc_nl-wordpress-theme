<?php
// the query.
$args = [
	'post_type' => 'winners',
	'posts_per_page' => -1,
	'nopaging' => true
];
$the_query = new WP_Query($args); ?>

<?php if ($the_query->have_posts()) : ?>
	<div class="row winners-row">

		<!-- pagination here -->

		<!-- the loop -->
		<?php
		while ($the_query->have_posts()) :
			$the_query->the_post();
			$country = get_post_meta(get_the_ID(), 'country', true);
			$category = get_post_meta(get_the_ID(), 'category', true);
		?>
			<span class="col-12 col-lg-4 mb-4 winner <?php echo strtolower(preg_replace('/[^a-z]/i', '_', $country)); ?>">
				<div class="card">
					<div class="card-header">
						<h3>
							1st <?php echo $category ?>
						</h3>
					</div>
					<div class="card-body">
						<?php the_title(); ?>

					</div>
				</div>
			</span>
		<?php endwhile; ?>
		<!-- end of the loop -->

		<!-- pagination here -->
	</div>

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>