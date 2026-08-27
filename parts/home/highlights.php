<?php
$edition = isset($args['edition']) ? $args['edition'] : false;
$video_block = isset($args['video_block']) ? $args['video_block'] : false;

// the query.
$args = [
    'post_type' => 'highlights',
    'posts_per_page' => -1,
    'nopaging' => true,
    'order' => 'ASC'
];


if ($edition) {
    $args['tax_query'][] = [
        'taxonomy' => 'video_edition',
        'field' => 'slug',
        'terms' => $edition,
    ];
}

if ($video_block) {
    $args['tax_query'][] = [
        'taxonomy' => 'video_block',
        'field' => 'slug',
        'terms' =>  $video_block,
    ];
}

$args['tax_query']['relation'] = 'AND';

$the_query = new WP_Query($args); ?>

<?php if ($the_query->have_posts()) : ?>
    <div class="row highlight-row mt-5">

        <!-- pagination here -->

        <!-- the loop -->
        <?php
        while ($the_query->have_posts()) :
            $the_query->the_post();
            $video = get_post_meta(get_the_ID(), 'video_01', true);
            $download = get_post_meta(get_the_ID(), 'download_01', true);
            $video_id = '';
            if (!empty($video)) {
                preg_match('/v=(.*)/', $video, $matches);
                if (!empty($matches[1])) {
                    $video_id = $matches[1];
                }
            }
        ?>
            <div href="<?php the_permalink(); ?>" class="col-12 col-lg-4 mb-5 highlight position-relative">
                <?php if(is_user_logged_in() && !empty($download)): ?>
                    <a href="<?php echo $download; ?>" class="btn-download" target="_blank" download></a>
                <?php endif; ?>
                <a data-fslightbox="gallery" class="magic-hover magic-hover__square" href="<?php echo $video; ?>">
                    <span class="img-wrap">
                        <img src="https://i3.ytimg.com/vi/<?php echo $video_id ?>/maxresdefault.jpg" loading="lazy" decoding="async" alt="<?php echo get_the_title(); ?>">
                    </span>
                </a>
            </div>
        <?php endwhile; ?>
        <!-- end of the loop -->

        <!-- pagination here -->
    </div>

    <?php wp_reset_postdata(); ?>

<?php else : ?>
    <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>