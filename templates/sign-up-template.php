<?php

/**
 * Template name: Sign up
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
<div class="container">
    <div class="row">
        <div class="col-12">
            <?php if (have_posts()) while (have_posts()) : the_post(); ?>

            <div class="row">
                <div class="col-lg-6 pb-4">
                        <h1>
                            <?php the_title(); ?>
                        </h1>
                        <?php the_content(); ?>
                        <?php echo do_shortcode('[mc4wp_form id=17]'); ?>
                    </div>
                    <div class="col-lg-6">
                        <?php if(is_user_logged_in()): ?>
                            <h2 class="h1">
                                You're account
                            </h2>
                            <p>
                                You are now logged in to you're account.<br>
                                This allows you to:
                            </p>
                            <ul>
                                <li>
                                    Download videos as mp4 ( videos that are made by us, some choreographers also have external videos that can not be downloaded trough our site )
                                </li>
                            </ul>
                        <?php endif; ?>
                    </div>
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