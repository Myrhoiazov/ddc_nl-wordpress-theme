<?php

/**
 * Template name: First edition
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Please see /external/bootsrap-utilities.php for info on BsWp::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Bootstrap 5.3.3
 * @autor 		ddc_nl
 */
$BsWp = new BsWp;

$BsWp->get_template_parts([
    'parts/shared/html-header',
    'parts/shared/header'
]);
?>

<?php if (have_posts()) while (have_posts()) : the_post(); ?>

    <section id="intro">
        <div class="video-wrap">
            <div class="top"></div>
            <div class="bottom"></div>
            <div class="video">
                <video muted autoplay loop playsinlineS width="250">
                    <source src="<?php echo get_template_directory_uri() ?>/videos/hd-reel.webm" type="video/webm" media="(max-width: 599px)" />
                    <source src="<?php echo get_template_directory_uri() ?>/videos/hd.webm" type="video/webm" />
                    <source src="<?php echo get_template_directory_uri() ?>/videos/hd.mp4" type="video/mp4" />
                </video>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center text-lg-start effect">
                    <div class="intro-txt">
                        <span class="main-logo">
                            <span class="year">2024</span>
                            <img loading="eager" src="<?php echo get_template_directory_uri() ?>/images/ddc_logo.png" alt="">
                            <div class="place">
                                Amsterdam
                            </div>
                        </span>
                        <h1>
                            <?php the_title(); ?>
                        </h1>
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="choreographer">
        <span class="small-logo">
            <span class="year">2024</span>
            <img loading="lazy" decoding="async" src="<?php echo get_template_directory_uri() ?>/images/ddc_logo_white.png" alt="">
            <div class="place">
                Amsterdam
            </div>
        </span>
        <div class="container" data-scene>
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-5">
                        Choreographers
                    </h2>
                    <?php $BsWp->get_template_parts(['parts/home/choreographers'], ['edition' => 'first']) ?>
                </div>
            </div>
        </div>
    </section>
    <section id="highlights" data-scene>
        <span class="small-logo">
            <span class="year white">2024</span>
            <img loading="lazy" decoding="async" src="<?php echo get_template_directory_uri() ?>/images/ddc_logo_white.png" alt="">
            <div class="place">
                Amsterdam
            </div>
        </span>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>
                        Highlights
                    </h2>
                    <p>
                        Here are some of the highlights of the event.
                    </p>
                    <?php $BsWp->get_template_parts(['parts/home/highlights'], ['edition' => 'first']) ?>
                </div>
            </div>
        </div>
    </section>
    <section id="ddc_nl_social">
        <span class="small-logo">
            <span class="year"><?php echo NEXT_EDITION_YEAR; ?></span>
            <img loading="laz" decoding="async" src="<?php echo get_template_directory_uri() ?>/images/ddc_logo.png" alt="">
            <div class="place">
                Amsterdam
            </div>
        </span>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php $BsWp->get_template_parts(['parts/shared/sign-up-form']) ?>
                </div>
            </div>
        </div>
    </section>
    <section id="team">
        <span class="small-logo">
            <span class="year">2024</span>
            <img loading="lazy" decoding="async" src="<?php echo get_template_directory_uri() ?>/images/ddc_logo_white.png" alt="">
            <div class="place">
                Amsterdam
            </div>
        </span>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-5">
                        Team
                    </h2>
                    <?php $BsWp->get_template_parts(['parts/home/team'], ['edition' => 'first']) ?>
                </div>
            </div>
        </div>
    </section>
    <section id="team2">
        <span class="small-logo">
            <span class="year">2024</span>
            <img loading="lazy" decoding="async" src="<?php echo get_template_directory_uri() ?>/images/ddc_logo.png" alt="">
            <div class="place">
                Amsterdam
            </div>
        </span>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-5">
                        Audio / Visual
                    </h2>
                    <?php $BsWp->get_template_parts(['parts/home/support-team'], ['edition' => 'first']) ?>
                </div>
            </div>
        </div>
    </section>
    <section id="next_edition">
        <span class="small-logo">
            <span class="year"><?php echo NEXT_EDITION_YEAR; ?></span>
            <img loading="lazy" decoding="async" src="<?php echo get_template_directory_uri() ?>/images/ddc_logo.png" alt="">
            <div class="place">
                Amsterdam
            </div>
        </span>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-5 text-center">
                        Next edition is coming in:
                    </h2>
                    <?php $BsWp->get_template_parts(['parts/home/next-event']) ?>
                </div>
            </div>
        </div>
    </section>


<?php endwhile; ?>

<?php
$BsWp->get_template_parts([
    'parts/modals/eventix',
    'parts/shared/footer',
    'parts/shared/cookiebar',
    'parts/shared/html-footer'
]);
?>