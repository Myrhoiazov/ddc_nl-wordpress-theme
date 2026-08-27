<?php

/**
 * Template name: Second edition
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



<section id="intro">
    <div class="video-wrap">
        <div class="top"></div>
        <div class="bottom"></div>
        <div class="video">
            <video muted autoplay loop playsinline width="250">
                <source src="<?php echo get_template_directory_uri() ?>/videos/secondEditionReel.webm" type="video/webm" media="(max-width: 599px)" />
                <source src="<?php echo get_template_directory_uri() ?>/videos/secondEdition.webm" type="video/webm" />
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
                    <?php the_content() ?>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom"></div>
</section>
<section id="choreographer">
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
                    Choreographers
                </h2>
                <?php $BsWp->get_template_parts(['parts/home/choreographers'], ['edition' => 'second']) ?>
            </div>
        </div>
    </div>
</section>
<section id="highlights">
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
                <?php $BsWp->get_template_parts(['parts/home/highlights'], ['edition' => 'second']) ?>
            </div>
        </div>
    </div>
</section>
<section id="competition">
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
                <h2>
                    Competition Winners
                </h2>
                <?php $BsWp->get_template_parts(['parts/home/winners']) ?>
            </div>
        </div>
    </div>
</section>
<section id="ddc_nl_social">
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
                <?php $BsWp->get_template_parts(['parts/home/team'], ['edition' => 'second']) ?>
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
                <?php $BsWp->get_template_parts(['parts/home/support-team'], ['edition' => 'second']) ?>
            </div>
        </div>
    </div>
</section>
<section id="partners">
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
                    Partners
                </h2>
                <?php $BsWp->get_template_parts(['parts/home/partners'], [
                    'post_type' => 'partners',
                    'post_per_page' => -1,
                    'nopagging' => true
                ]) ?>
            </div>
        </div>
    </div>
</section>
<section id="special_thanks">
    <span class="small-logo">
        <span class="year black">2024</span>
        <img loading="lazy" decoding="async" src="<?php echo get_template_directory_uri() ?>/images/ddc_logo.png" alt="">
        <div class="place">
            Amsterdam
        </div>
    </span>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="thanks-card">
                    <h2>
                        Special thanks
                    </h2>
                    <p>
                        A special thanks to all the company's friends and other people who made this possible.
                    </p>
                    <p>
                        Here a list of all the people we wanted to say a special thanks to.<br>
                        The team of the <a href="https://www.amsterdam.nl/sport/sporthallen/sporthallen-zuid/" class="magic-hover magic-hover__square" target="_blank">sporthallen zuid</a> and in special Gilbert for great support you have a good heart.
                    </p>
                    <p>
                        Also the moving company <a href="https://www.studentverhuisservice.nl/verhuisbedrijf-amsterdam/" class="magic-hover magic-hover__square" target="_blank">studentverhuisservice</a> Amsterdam is a top company, they are fast and have a good quality service.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <?php if (is_active_sidebar('insta_widget')) : ?>
                    <?php dynamic_sidebar('insta_widget'); ?>
                <?php endif; ?>
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

<?php
$BsWp->get_template_parts([
    'parts/modals/eventix',
    'parts/shared/footer',
    'parts/shared/cookiebar',
    'parts/shared/html-footer'
]);
?>