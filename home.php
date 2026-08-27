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

<section id="intro">
    <div class="video-wrap">
        <div class="top"></div>
        <div class="bottom"></div>
        <div class="video">
            <div id="player"></div>
            <script>
                // 2. This code loads the IFrame Player API code asynchronously.
                window.addEventListener('load', () => {
                    var tag = document.createElement('script');
                    tag.src = "https://www.youtube.com/iframe_api";
                    tag.async = true;
                    tag.defer = true;
                    var firstScriptTag = document.getElementsByTagName('script')[0];
                    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
                });
                // 3. This function creates an <iframe> (and YouTube player)
                //    after the API code downloads.
                var player;

                function onYouTubeIframeAPIReady() {
                    player = new YT.Player('player', {
                        height: '390',
                        width: '640',
                        videoId: 'ZsjOYxZ0PhY',
                        playerVars: {
                            'playsinline': 1,
                            'autoplay': 1,
                            'mute': 1,
                            'controls': 0,
                            'fs': 0,
                            'iv_load_policy': 3,
                            'loop': 1,
                            'playlist': 'ZsjOYxZ0PhY'
                        },
                        events: {
                            'onReady': onPlayerReady,
                        }
                    });

                }
                // 4. The API will call this function when the video player is ready.
                function onPlayerReady(event) {
                    player.setPlaybackQuality('highres');
                    event.target.playVideo();
                }
                // 5. The API calls this function when the player's state changes.
                //    The function indicates that when playing a video (state=1),
                //    the player should play for six seconds and then stop.
                var done = false;

                function stopVideo() {
                    player.stopVideo();
                }
            </script>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center text-lg-start">
                <div class="intro-txt">
                    <span class="main-logo">
                        <span class="year">2024</span>
                        <img loading="eager" src="<?php echo get_template_directory_uri() ?>/images/ddc_logo.png" alt="">
                        <div class="place">
                            Amsterdam
                        </div>
                    </span>
                    <?php the_content(); ?>
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
    <div class="container" data-scene>
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
                <div class="row highlight-row mt-5">
                    <div class="col-12 col-lg-4 highlight">
                        <a data-fslightbox="gallery" class="magic-hover magic-hover__square" href="https://www.youtube.com/watch?v=ZsjOYxZ0PhY">
                            <span class="img-wrap">
                                <img src="https://i3.ytimg.com/vi/ZsjOYxZ0PhY/maxresdefault.jpg" alt="">
                            </span>
                        </a>
                    </div>
                </div>
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
        <span class="year">2025</span>
        <img src="<?php echo get_template_directory_uri() ?>/images/ddc_logo.png" alt="">
        <div class="place">
            Amsterdam
        </div>
    </span>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>
                    DDC NL 2025 Amsterdam
                </h2>
                <p class="">
                    Whe are already planning the event for next year, if you don't want to miss out on our next event.<br>
                    Join our mailing list to get the latests updates and don't forget to join our socials.
                </p>
                <div class="row">
                    <div class="col-lg-6">
                        <?php echo do_shortcode('[mc4wp_form id=17]'); ?>
                    </div>
                    <div class="col-lg-6">
                        <nav id="socials_nav" class="w-100 d-flex justify-content-between">
                            <a href="https://www.instagram.com/ddc_nl/" target="_blank" class="magic-hover magic-hover__square is-black is-rounded">
                                <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                            </a>
                            <a href="https://www.tiktok.com/@ddc_nl" target="_blank" class="magic-hover magic-hover__square is-black is-rounded">
                                <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
                            </a>
                            <a href="https://www.youtube.com/channel/UCPl87It6Tm9XEeatPJ0qsSg" target="_blank" class="magic-hover magic-hover__square is-black is-rounded youtube">
                                <svg viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"><path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/></svg>
                            </a>
                            <a href="https://www.facebook.com/people/talentcenterddc/61550918400370/" target="_blank" class="magic-hover magic-hover__square is-black is-rounded">
                                <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/></svg>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="team">
    <span class="small-logo">
        <span class="year">2024</span>
        <img src="<?php echo get_template_directory_uri() ?>/images/ddc_logo_white.png" alt="">
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
                <?php if ( is_active_sidebar( 'insta_widget' ) ) : ?>
                    <?php dynamic_sidebar( 'insta_widget' ); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
$BsWp->get_template_parts([
    'parts/shared/footer',
    'parts/shared/cookiebar',
    'parts/shared/html-footer'
]);
?>