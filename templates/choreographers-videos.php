<?php

/**
 * Template name: choreographers videos
 *
 * Please see /external/bootstrap-utilities.php for info on BsWp::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Bootstrap 5.3.2
 * @autor 		ddc_nl
 */
$BsWp = new BsWp;
$youtube = new Youtube;

$BsWp->get_template_parts([
    'parts/shared/html-header',
    'parts/shared/header'
]);
?>

<?php if (have_posts()) while (have_posts()) : the_post(); ?>
    <section id="choreographers_videos">
        <a href="<?php echo get_site_url(); ?>/" class="small-logo">
            <span class="year"><?php echo NEXT_EDITION_YEAR; ?></span>
            <img loading="lazy" decoding="async" src="<?php echo get_template_directory_uri() ?>/images/ddc_logo_white.png" alt="">
            <div class="place">
                Amsterdam
            </div>
        </a>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="mb-3">
                        <?php the_title(); ?>
                    </h1>
                    <div class="filter-row">
                        <button onclick="shuffleInstance.filter(Shuffle.ALL_ITEMS);" class="btn btn-primary btn-sm me-2 mb-2 d-none d-lg-inline-block">
                            All
                        </button>
                        <?php
                        $args = [
                            'post_type' => 'choreographer',
                            'posts_per_page' => -1,
                            'nopaging' => true,
                            'order' => 'ASC'
                        ];
                        $query1 = new WP_Query($args);
                        $postArr = [];

                        // The Loop
                        while ($query1->have_posts()) {
                            $query1->the_post();
                            $postArr[get_the_ID()] = get_the_title();
                            echo '<button class="btn btn-primary btn-sm me-2 mb-2 d-none d-lg-inline-block" onclick="shuffleInstance.filter(\'' . get_the_ID() . '\');">' . get_the_title() . '</button>';
                        }

                        wp_reset_postdata();

                        ?>
                        <div class="d-block d-lg-none" data-bs-theme="dark">
                            <label for="">
                                Filter
                            </label>
                            <select class="form-select" onchange="Videos.filter(this.value);">
                                <option value="all">All</option>
                                <?php foreach($postArr as $key => $name): ?>
                                    <option value="<?php echo $key; ?>">
                                        <?php echo $name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <?php
                    // the query.
                    $the_query = new WP_Query($args); ?>

                    <?php if ($the_query->have_posts()) : ?>
                        <div class="row video-row mt-5">

                            <!-- pagination here -->

                            <!-- the loop -->
                            <?php
                            while ($the_query->have_posts()) :
                                $the_query->the_post();
                                $country = get_post_meta(get_the_ID(), 'country', true);
                            ?>

                                <?php
                                $videoData = $youtube->getYoutubeId(get_post_meta(get_the_ID(), 'video_01', true));
                                $video_01 = $videoData->url;
                                $video_01_id = $videoData->id;
                                ?>
                                <?php if (!empty($video_01)): ?>
                                    <div class="col-12 col-lg-3 col-md-6 mb-5 video" data-groups='["<?php echo get_the_ID(); ?>"]'>
                                        <a data-fslightbox="gallery" class="magic-hover magic-hover__square d-block" href="<?php echo $video_01; ?>">
                                            <span class="video-wrap ratio ratio-16x9 d-block">
                                                <img src="https://i3.ytimg.com/vi/<?php echo $video_01_id ?>/hqdefault.jpg" alt="">
                                            </span>
                                        </a>
                                        <h5 class="mt-3 mt-lg-2 text-center text-lg-start">
                                            <?php echo get_the_title(); ?>
                                        </h5>
                                    </div>
                                <?php endif; ?>
                                <?php
                                $videoData = $youtube->getYoutubeId(get_post_meta(get_the_ID(), 'video_02', true));
                                $video_02 = $videoData->url;
                                $video_02_id = $videoData->id;
                                ?>
                                <?php if (!empty($video_02)): ?>
                                    <div class="col-12 col-lg-3 col-md-6 mb-5 video" data-groups='["<?php echo get_the_ID(); ?>"]'>
                                        <a data-fslightbox="gallery" class="magic-hover magic-hover__square" href="<?php echo $video_02; ?>">
                                            <span class="video-wrap ratio ratio-16x9 d-block">
                                                <img src="https://i3.ytimg.com/vi/<?php echo $video_02_id ?>/hqdefault.jpg" alt="">
                                            </span>
                                        </a>
                                        <h5 class="mt-3 mt-lg-2 text-center text-lg-start">
                                            <?php echo get_the_title(); ?>
                                        </h5>
                                    </div>
                                <?php endif; ?>
                                <?php
                                $videoData = $youtube->getYoutubeId(get_post_meta(get_the_ID(), 'video_03', true));
                                $video_03 = $videoData->url;
                                $video_03_id = $videoData->id;
                                ?>
                                <?php if (!empty($video_03)): ?>
                                    <div class="col-12 col-lg-3 col-md-6 mb-5 video" data-groups='["<?php echo get_the_ID(); ?>"]'>
                                        <a data-fslightbox="gallery" class="magic-hover magic-hover__square" href="<?php echo $video_03; ?>">
                                            <span class="video-wrap ratio ratio-16x9 d-block">
                                                <img src="https://i3.ytimg.com/vi/<?php echo $video_03_id ?>/hqdefault.jpg" alt="">
                                            </span>
                                        </a>
                                        <h5 class="mt-3 mt-lg-2 text-center text-lg-start">
                                            <?php echo get_the_title(); ?>
                                        </h5>
                                    </div>
                                <?php endif; ?>
                                <?php
                                $videoData = $youtube->getYoutubeId(get_post_meta(get_the_ID(), 'video_04', true));
                                $video_04 = $videoData->url;
                                $video_04_id = $videoData->id;
                                ?>
                                <?php if (!empty($video_04)): ?>
                                    <div class="col-12 col-lg-3 col-md-6 mb-5 video" data-groups='["<?php echo get_the_ID(); ?>"]'>
                                        <a data-fslightbox="gallery" class="magic-hover magic-hover__square" href="<?php echo $video_04; ?>">
                                            <span class="video-wrap ratio ratio-16x9 d-block">
                                                <img src="https://i3.ytimg.com/vi/<?php echo $video_04_id ?>/hqdefault.jpg" alt="">
                                            </span>
                                        </a>
                                        <h5 class="mt-3 mt-lg-2 text-center text-lg-start">
                                            <?php echo get_the_title(); ?>
                                        </h5>
                                    </div>
                                <?php endif; ?>
                                <?php
                                $videoData = $youtube->getYoutubeId(get_post_meta(get_the_ID(), 'video_05', true));
                                $video_05 = $videoData->url;
                                $video_05_id = $videoData->id;
                                ?>
                                <?php if (!empty($video_05)): ?>
                                    <div class="col-12 col-lg-3 col-md-6 mb-5 video" data-groups='["<?php echo get_the_ID(); ?>"]'>
                                        <a data-fslightbox="gallery" class="magic-hover magic-hover__square" href="<?php echo $video_05; ?>">
                                            <span class="video-wrap ratio ratio-16x9 d-block">
                                                <img src="https://i3.ytimg.com/vi/<?php echo $video_05_id ?>/hqdefault.jpg" alt="">
                                            </span>
                                        </a>
                                        <h5 class="mt-3 mt-lg-2 text-center text-lg-start">
                                            <?php echo get_the_title(); ?>
                                        </h5>
                                    </div>
                                <?php endif; ?>
                                <?php
                                $videoData = $youtube->getYoutubeId(get_post_meta(get_the_ID(), 'video_06', true));
                                $video_06 = $videoData->url;
                                $video_06_id = $videoData->id;
                                ?>
                                <?php if (!empty($video_06)): ?>
                                    <div class="col-12 col-lg-3 col-md-6 mb-5 video" data-groups='["<?php echo get_the_ID(); ?>"]'>
                                        <a data-fslightbox="gallery" class="magic-hover magic-hover__square" href="<?php echo $video_06; ?>">
                                            <span class="video-wrap ratio ratio-16x9 d-block">
                                                <img src="https://i3.ytimg.com/vi/<?php echo $video_06_id ?>/hqdefault.jpg" alt="">
                                            </span>
                                        </a>
                                        <h5 class="mt-3 mt-lg-2 text-center text-lg-start">
                                            <?php echo get_the_title(); ?>
                                        </h5>
                                    </div>
                                <?php endif; ?>
                            <?php endwhile; ?>
                            <!-- end of the loop -->

                            <!-- pagination here -->
                            <div class="col-12 col-lg-3 col-md-6 js-shuffle-sizer"></div>
                        </div>

                        <?php wp_reset_postdata(); ?>

                    <?php else : ?>
                        <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>


<?php endwhile; ?>

<?php
$BsWp->get_template_parts([
    'parts/shared/footer',
    'parts/shared/cookiebar',
    'parts/shared/html-footer'
]);
?>