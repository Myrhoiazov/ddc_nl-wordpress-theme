<?php
/**
 * Template name: Cart
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Please see /external/bootsrap-utilities.php for info on BsWp::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Bootstrap 5.0.0-beta
 * @author 		DenysMyr
 */
?>
<?php BsWp::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<div class="container">
    <div class="row">
	<?php if ( have_posts()) while ( have_posts() ) : the_post(); ?>
        <div class="col-12">
            <h2>
                <?php the_title(); ?>
            </h2>
            <?php the_content(); ?>
        </div>
	<?php endwhile; ?>
    </div>
</div>

<?php BsWp::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>
