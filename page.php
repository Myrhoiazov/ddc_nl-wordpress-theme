<?php

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Please see /external/bootsrap-utilities.php for info on BsWp::get_template_parts()
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
<div class="banner" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
    <div class="data">
        <h1 class="mb-4">
           <?php the_title(); ?>
       </h1>
       
       <?php the_content(); ?>
    </div>
</div>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="content">
					<?php if (have_posts()) while (have_posts()) : the_post(); ?>

						<h1 class="mb-3">
							<?php the_title(); ?>
						</h1>
						<?php the_content(); ?>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</div>

<?php
$BsWp->get_template_parts([
	'parts/shared/footer',
	'parts/shared/cookiebar',
	'parts/shared/html-footer'
]);
?>