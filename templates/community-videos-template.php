<?php

/**
 * Template name: Community Videos
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
$youtube = new Youtube;

/** @var wpdb $wpdb */
global $wpdb;

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
            <div class="content">
                <h1 class="mb-4">
                    Community Videos
                </h1>
                <p>
                    A overview of all video's from our community.
                </p>
                <?php
                $query = "SELECT * FROM {$wpdb->prefix}uwp_usermeta";
                $result = $wpdb->get_results($wpdb->prepare($query));
                $videoList = [];
                foreach ($result as $person) {
                    if (!empty($person->youtube_video_01)) {
                        array_push($videoList, [
                            'display_name' => !empty($person->display_name) ? $person->display_name : $person->first_name . ' ' . $person->last_name,
                            'video01' => $person->youtube_video_01,
                            'video02' => $person->youtube_video_02,
                            'video03' => $person->youtube_video_03,
                            'video04' => $person->youtube_video_04,
                        ]);
                    }
                }

                ?>
                <div class="row">
                    <?php foreach ($videoList as $artist): ?>
                        <?php
                        $videoData = $youtube->getYoutubeId($artist['video01']);
                        $video_01 = $videoData->url;
                        $video_01_id = $videoData->id;
                        $videoData = $youtube->getYoutubeId($artist['video02']);
                        $video_02 = $videoData->url;
                        $video_02_id = $videoData->id;
                        $videoData = $youtube->getYoutubeId($artist['video03']);
                        $video_03 = $videoData->url;
                        $video_03_id = $videoData->id;
                        $videoData = $youtube->getYoutubeId($artist['video04']);
                        $video_04 = $videoData->url;
                        $video_04_id = $videoData->id;
                        $videoData = $youtube->getYoutubeId($artist['video05']);
                        $video_05 = $videoData->url;
                        $video_05_id = $videoData->id;
                        $videoData = $youtube->getYoutubeId($artist['video06']);
                        $video_06 = $videoData->url;
                        $video_06_id = $videoData->id;
                        ?>
                        <?php if (!empty($video_01) && !empty($video_01_id)): ?>
                            <div class="col-12 col-lg-4 mb-4">
                                <a data-fslightbox="gallery" class="magic-hover magic-hover__square text-decoration-none" href="<?php echo $video_01; ?>">
                                    <span class="video-wrap ratio ratio-16x9 d-block">
                                        <img src="https://i3.ytimg.com/vi/<?php echo $video_01_id ?>/hqdefault.jpg" class="object-fit-cover" alt="">
                                    </span>
                                    <h6 class="mt-2">
                                        <?php echo $artist['display_name'] ?>
                                    </h6>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($video_02) && !empty($video_02_id)): ?>
                            <div class="col-12 col-lg-4 mb-4">
                                <a data-fslightbox="gallery" class="magic-hover magic-hover__square text-decoration-none" href="<?php echo $video_02; ?>">
                                    <span class="video-wrap ratio ratio-16x9 d-block">
                                        <img class="object-fit-cover" src="https://i3.ytimg.com/vi/<?php echo $video_02_id ?>/hqdefault.jpg" alt="">
                                    </span>
                                    <h6 class="mt-2">
                                        <?php echo $artist['display_name'] ?>
                                    </h6>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($video_03) && !empty($video_03_id)): ?>
                            <div class="col-12 col-lg-4 mb-4">
                                <a data-fslightbox="gallery" class="magic-hover magic-hover__square text-decoration-none" href="<?php echo $video_03; ?>">
                                    <span class="video-wrap ratio ratio-16x9 d-block">
                                        <img class="object-fit-cover" src="https://i3.ytimg.com/vi/<?php echo $video_03_id ?>/hqdefault.jpg" alt="">
                                    </span>
                                    <h6 class="mt-2">
                                        <?php echo $artist['display_name'] ?>
                                    </h6>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($video_04) && !empty($video_04_id)): ?>
                            <div class="col-12 col-lg-4 mb-4">
                                <a data-fslightbox="gallery" class="magic-hover magic-hover__square text-decoration-none" href="<?php echo $video_04; ?>">
                                    <span class="video-wrap ratio ratio-16x9 d-block">
                                        <img class="object-fit-cover" src="https://i3.ytimg.com/vi/<?php echo $video_04_id ?>/hqdefault.jpg" alt="">
                                    </span>
                                    <h6 class="mt-2">
                                        <?php echo $artist['display_name'] ?>
                                    </h6>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($video_05) && !empty($video_05_id)): ?>
                            <div class="col-12 col-lg-4 mb-4">
                                <a data-fslightbox="gallery" class="magic-hover magic-hover__square text-decoration-none" href="<?php echo $video_05; ?>">
                                    <span class="video-wrap ratio ratio-16x9 d-block">
                                        <img class="object-fit-cover" src="https://i3.ytimg.com/vi/<?php echo $video_05_id ?>/hqdefault.jpg" alt="">
                                    </span>
                                    <h6 class="mt-2">
                                        <?php echo $artist['display_name'] ?>
                                    </h6>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($video_06) && !empty($video_06_id)): ?>
                            <div class="col-12 col-lg-4 mb-4">
                                <a data-fslightbox="gallery" class="magic-hover magic-hover__square text-decoration-none" href="<?php echo $video_06; ?>">
                                    <span class="video-wrap ratio ratio-16x9 d-block">
                                        <img class="object-fit-cover" src="https://i3.ytimg.com/vi/<?php echo $video_06_id ?>/hqdefault.jpg" alt="">
                                    </span>
                                    <h6 class="mt-2">
                                        <?php echo $artist['display_name'] ?>
                                    </h6>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
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