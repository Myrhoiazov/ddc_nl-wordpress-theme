<?php

/**
 * Template name: Mailchimp thanks
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
 * @autor 		ddc_nl
 */
$BsWp = new BsWp;

$BsWp->get_template_parts([
    'parts/shared/html-header',
    'parts/shared/header'
]);
?>
<a href="<?php echo get_site_url(); ?>/" class="small-logo">
    <span class="year"><?php echo NEXT_EDITION_YEAR; ?></span>
    <img loading="lazy" decoding="async" src="<?php echo get_template_directory_uri() ?>/images/ddc_logo.png" alt="">
    <div class="place">
        Amsterdam
    </div>
</a>
<div class="container pt-5">
    <div class="row pt-5">
        <div class="col-12 text-center mt-5">
            <?php if (have_posts()) while (have_posts()) : the_post(); ?>
            
                            <div class="mailchimp-thanks-img">
                                <img src="<?php echo get_template_directory_uri() ?>/images/thanks.jpg" alt="">
                            </div>

                <h1 class="mb-4 mt-3">
                    <?php the_title(); ?>
                </h1>

                <?php the_content(); ?>
                <div class="d-grid d-lg-block mt-4">
                    <a href="<?php echo get_site_url(); ?>" class="btn btn-primary btn-lg btn-rounded">
                        Return to home
                    </a>
                </div>
            <?php endwhile; ?>
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