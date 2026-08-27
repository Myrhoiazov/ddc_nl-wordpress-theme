<?php

$youtube = new Youtube;

/** @var wpdb $wpdb */
global $wpdb;
$user = uwp_get_displayed_user();
$query = "SELECT * from {$wpdb->prefix}uwp_usermeta WHERE user_id = %d";
$profileInfoSql = $wpdb->prepare($query, [$user->ID]);
$profileInfo = $wpdb->get_row($profileInfoSql);

echo do_shortcode("[uwp_profile_header disable_greedy=" . $args['disable_greedy'] . "]");


?>

<ul class="list-group  list-group-flush">

    <?php if (!empty($profileInfo->first_name)): ?>
        <li class="list-group-item">
            <div class="fw-bold">
                First name
            </div>
            <?php echo $profileInfo->first_name ?>
        </li>
    <?php endif; ?>
    <?php if (!empty($profileInfo->last_name)): ?>
        <li class="list-group-item">
            <div class="fw-bold">
                Last name
            </div>
            <?php echo $profileInfo->last_name ?>
        </li>
    <?php endif; ?>
    <?php if (!empty($profileInfo->dance_school)): ?>
        <li class="list-group-item">
            <div class="fw-bold">
                Dance school
            </div>
            <?php echo $profileInfo->dance_school ?>
        </li>
    <?php endif; ?>
    <?php if (!empty($profileInfo->level)): ?>
        <li class="list-group-item">
            <div class="fw-bold">
                Level
            </div>
            <?php echo $profileInfo->level ?>
        </li>
    <?php endif; ?>
</ul>

<?php 
$videoData = $youtube->getYoutubeId($profileInfo->youtube_video_01);
$video_01 = $videoData->url;
$video_01_id = $videoData->id;
$videoData = $youtube->getYoutubeId($profileInfo->youtube_video_02);
$video_02 = $videoData->url;
$video_02_id = $videoData->id;
$videoData = $youtube->getYoutubeId($profileInfo->youtube_video_03);
$video_03 = $videoData->url;
$video_03_id = $videoData->id;
$videoData = $youtube->getYoutubeId($profileInfo->youtube_video_04);
$video_04 = $videoData->url;
$video_04_id = $videoData->id;
$videoData = $youtube->getYoutubeId($profileInfo->youtube_video_05);
$video_05 = $videoData->url;
$video_05_id = $videoData->id;
$videoData = $youtube->getYoutubeId($profileInfo->youtube_video_06);
$video_06 = $videoData->url;
$video_06_id = $videoData->id;
?>

<?php if(false && $user->roles[0] == 'heelsmaster'): ?>
    <div class="voting d-flex flex-column mb-4">
        <div class="current-count d-flex flex-column mb-2">SW
            <strong>
                Current votes
            </strong>
            <?php 
                $sql = " SELECT id as count FROM {$wpdb->prefix}votes WHERE master = %d" ;
                $result = $wpdb->get_results($wpdb->prepare($sql, [$user->ID]));
            ?>
            <?php echo !empty($result) ? count($result) : 0; ?>
        </div>
        <div class="input-wrap">
            <button class="btn btn-lg btn-primary mb-3" onclick="vote(event, h<?php echo $user->ID ?>);">
                Vote for me
            </button><br>
            <div class="alert alert-success success" role="alert" style="display: none;">
                Thanks for you're vote!
            </div>
            <div class="alert alert-info failure" role="alert" style="display: none;">
                You already voted, only one vote allowed
            </div>

        </div>
    </div>
<?php endif; ?>

<?php if(!empty($video_01)): ?>
    <div class="row">
        <div class="col-12">
            <h3 class="mt-3">
                Videos
            </h3>
        </div>
        <?php if (!empty($video_01)): ?>
            <div class="col-12 col-lg-4 mb-4">
                <a data-fslightbox="gallery" class="magic-hover magic-hover__square" href="<?php echo $video_01; ?>">
                    <span class="video-wrap ratio ratio-16x9 d-block">
                        <img src="https://i3.ytimg.com/vi/<?php echo $video_01_id ?>/hqdefault.jpg" class="object-fit-cover" alt="">
                    </span>
                </a>
            </div>
        <?php endif; ?>
        <?php if (!empty($video_02)): ?>
            <div class="col-12 col-lg-4 mb-4">
                <a data-fslightbox="gallery" class="magic-hover magic-hover__square" href="<?php echo $video_02; ?>">
                    <span class="video-wrap ratio ratio-16x9 d-block">
                        <img class="object-fit-cover" src="https://i3.ytimg.com/vi/<?php echo $video_02_id ?>/hqdefault.jpg" alt="">
                    </span>
                </a>
            </div>
        <?php endif; ?>
        <?php if (!empty($video_03)): ?>
            <div class="col-12 col-lg-4 mb-4">
                <a data-fslightbox="gallery" class="magic-hover magic-hover__square" href="<?php echo $video_03; ?>">
                    <span class="video-wrap ratio ratio-16x9 d-block">
                        <img class="object-fit-cover" src="https://i3.ytimg.com/vi/<?php echo $video_03_id ?>/hqdefault.jpg" alt="">
                    </span>
                </a>
            </div>
        <?php endif; ?>
        <?php if (!empty($video_04)): ?>
            <div class="col-12 col-lg-4 mb-4">
                <a data-fslightbox="gallery" class="magic-hover magic-hover__square" href="<?php echo $video_04; ?>">
                    <span class="video-wrap ratio ratio-16x9 d-block">
                        <img class="object-fit-cover" src="https://i3.ytimg.com/vi/<?php echo $video_04_id ?>/hqdefault.jpg" alt="">
                    </span>
                </a>
            </div>
        <?php endif; ?>
        <?php if (!empty($video_05)): ?>
            <div class="col-12 col-lg-4 mb-4">
                <a data-fslightbox="gallery" class="magic-hover magic-hover__square" href="<?php echo $video_05; ?>">
                    <span class="video-wrap ratio ratio-16x9 d-block">
                        <img class="object-fit-cover" src="https://i3.ytimg.com/vi/<?php echo $video_05_id ?>/hqdefault.jpg" alt="">
                    </span>
                </a>
            </div>
        <?php endif; ?>
        <?php if (!empty($video_06)): ?>
            <div class="col-12 col-lg-4 mb-4">
                <a data-fslightbox="gallery" class="magic-hover magic-hover__square" href="<?php echo $video_06; ?>">
                    <span class="video-wrap ratio ratio-16x9 d-block">
                        <img class="object-fit-cover" src="https://i3.ytimg.com/vi/<?php echo $video_06_id ?>/hqdefault.jpg" alt="">
                    </span>
                </a>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

<nav id="socials_nav" class="w-100 mt-3 d-flex xs justify-content-between" style="max-width: 330px; margin: 0;">
    <?php if(!empty($profileInfo->instagram)): ?>
        <a href="<?php echo $profileInfo->instagram ?>" target="_blank" class="magic-hover effect magic-hover__square is-black is-rounded">
            <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
            </svg>
        </a>
    <?php endif; ?>
    <?php if(!empty($profileInfo->tiktok)): ?>
        <a href="<?php echo $profileInfo->tiktok; ?>" target="_blank" class="magic-hover effect magic-hover__square is-black is-rounded">
            <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                <path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z" />
            </svg>
        </a>
    <?php endif; ?>
    <?php if(!empty($profileInfo->facebook)): ?>
        <a href="<?php echo $profileInfo->facebook ?>" target="_blank" class="magic-hover effect magic-hover__square is-black is-rounded">
            <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                <path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z" />
            </svg>
        </a>
    <?php endif; ?>
</nav>

