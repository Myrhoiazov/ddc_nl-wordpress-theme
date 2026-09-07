<?php

/**
 * Template name: News
 *
 * Listing page for standard WordPress posts: category filter pills, a
 * search box, the newest matching post shown large, and the rest in a grid.
 * Filtering/search/pagination are plain GET page loads — no AJAX/JS.
 *
 * Please see /external/bootstrap-utilities.php for info on BsWp::get_template_parts()
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

$news_page_url = get_permalink();
?>

<?php if (have_posts()) while (have_posts()) : the_post(); ?>
    <section class="news-hero">
        <div class="container">
            <h1 class="news-hero__title"><?php the_title(); ?></h1>
            <?php if (trim(get_the_content())) : ?>
                <div class="news-hero__sub"><?php the_content(); ?></div>
            <?php endif; ?>
        </div>
    </section>
<?php endwhile; ?>

<?php
$news_cat    = isset($_GET['cat']) ? sanitize_title(wp_unslash($_GET['cat'])) : '';
$news_search = isset($_GET['q']) ? sanitize_text_field(wp_unslash($_GET['q'])) : '';
$news_paged  = isset($_GET['pg']) ? max(1, absint($_GET['pg'])) : 1;

$news_categories = get_categories([
    'hide_empty' => true,
]);

$news_query_args = [
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 10,
    'paged'          => $news_paged,
];

if ($news_cat) {
    $news_query_args['category_name'] = $news_cat;
}

if ($news_search) {
    $news_query_args['s'] = $news_search;
}

$news_query = new WP_Query($news_query_args);
?>

<section class="news-page">
    <div class="container">

        <div class="news-toolbar">
            <div class="news-filter">
                <a
                    href="<?php echo esc_url(add_query_arg(array_filter(['q' => $news_search]), $news_page_url)); ?>"
                    class="news-filter__pill<?php echo $news_cat === '' ? ' is-active' : ''; ?>"
                ><?php esc_html_e('Все', 'wp_denysmyr'); ?></a>
                <?php foreach ($news_categories as $news_category) : ?>
                    <a
                        href="<?php echo esc_url(add_query_arg(array_filter(['cat' => $news_category->slug, 'q' => $news_search]), $news_page_url)); ?>"
                        class="news-filter__pill<?php echo $news_cat === $news_category->slug ? ' is-active' : ''; ?>"
                    ><?php echo esc_html($news_category->name); ?></a>
                <?php endforeach; ?>
            </div>

            <form class="news-search" method="get" action="<?php echo esc_url($news_page_url); ?>">
                <?php if ($news_cat) : ?>
                    <input type="hidden" name="cat" value="<?php echo esc_attr($news_cat); ?>">
                <?php endif; ?>
                <input
                    type="search"
                    name="q"
                    class="news-search__input"
                    placeholder="<?php esc_attr_e('Поиск по блогу', 'wp_denysmyr'); ?>"
                    value="<?php echo esc_attr($news_search); ?>"
                >
            </form>
        </div>

        <?php if ($news_query->have_posts()) : ?>

            <?php
            $news_posts    = $news_query->posts;
            $news_featured = array_shift($news_posts);
            ?>

            <?php if ($news_featured) : setup_postdata($news_featured); ?>
                <a href="<?php echo esc_url(get_permalink($news_featured)); ?>" class="news-featured" <?php if (has_post_thumbnail($news_featured)) : ?>style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url($news_featured, 'large')); ?>');" <?php endif; ?>>
                    <span class="news-featured__overlay"></span>
                    <span class="news-date-badge news-featured__date">
                        <span class="news-date-badge__day"><?php echo esc_html(get_the_date('d', $news_featured)); ?></span>
                        <span class="news-date-badge__month"><?php echo esc_html(mb_strtoupper(get_the_date('M', $news_featured))); ?></span>
                    </span>
                    <span class="news-featured__body">
                        <span class="news-featured__title"><?php echo esc_html(get_the_title($news_featured)); ?></span>
                        <span class="news-featured__excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt($news_featured), 28)); ?></span>
                    </span>
                </a>
            <?php endif; ?>

            <?php if (!empty($news_posts)) : ?>
                <div class="news-grid">
                    <?php foreach ($news_posts as $news_post) : setup_postdata($news_post);
                        $news_primary_cat = ddc_news_primary_category($news_post->ID);
                    ?>
                        <a href="<?php echo esc_url(get_permalink($news_post)); ?>" class="news-card">
                            <span class="news-card__media">
                                <?php if (has_post_thumbnail($news_post)) : ?>
                                    <img class="news-card__img" loading="lazy" decoding="async" src="<?php echo esc_url(get_the_post_thumbnail_url($news_post, 'medium_large')); ?>" alt="<?php echo esc_attr(get_the_title($news_post)); ?>">
                                <?php endif; ?>
                                <span class="news-date-badge news-card__date">
                                    <span class="news-date-badge__day"><?php echo esc_html(get_the_date('d', $news_post)); ?></span>
                                    <span class="news-date-badge__month"><?php echo esc_html(mb_strtoupper(get_the_date('M', $news_post))); ?></span>
                                </span>
                            </span>
                            <span class="news-card__body">
                                <?php if ($news_primary_cat) : ?>
                                    <span class="news-card__cat news-card__cat--<?php echo esc_attr(ddc_news_category_accent($news_primary_cat->term_id)); ?>"><?php echo esc_html(mb_strtoupper($news_primary_cat->name)); ?></span>
                                <?php endif; ?>
                                <span class="news-card__title"><?php echo esc_html(get_the_title($news_post)); ?></span>
                            </span>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>

            <?php if ($news_query->max_num_pages > 1) : ?>
                <nav class="news-pagination" aria-label="<?php esc_attr_e('Навигация по страницам', 'wp_denysmyr'); ?>">
                    <?php if ($news_paged > 1) : ?>
                        <a class="news-pagination__link" href="<?php echo esc_url(add_query_arg(array_filter(['cat' => $news_cat, 'q' => $news_search, 'pg' => $news_paged - 1]), $news_page_url)); ?>">&larr; <?php esc_html_e('Назад', 'wp_denysmyr'); ?></a>
                    <?php else : ?>
                        <span class="news-pagination__link is-disabled">&larr; <?php esc_html_e('Назад', 'wp_denysmyr'); ?></span>
                    <?php endif; ?>

                    <span class="news-pagination__count"><?php echo esc_html($news_paged); ?> / <?php echo esc_html($news_query->max_num_pages); ?></span>

                    <?php if ($news_paged < $news_query->max_num_pages) : ?>
                        <a class="news-pagination__link" href="<?php echo esc_url(add_query_arg(array_filter(['cat' => $news_cat, 'q' => $news_search, 'pg' => $news_paged + 1]), $news_page_url)); ?>"><?php esc_html_e('Вперед', 'wp_denysmyr'); ?> &rarr;</a>
                    <?php else : ?>
                        <span class="news-pagination__link is-disabled"><?php esc_html_e('Вперед', 'wp_denysmyr'); ?> &rarr;</span>
                    <?php endif; ?>
                </nav>
            <?php endif; ?>

        <?php else : ?>
            <p class="news-empty"><?php esc_html_e('Sorry, no posts matched your criteria.', 'wp_denysmyr'); ?></p>
        <?php endif; ?>

    </div>
</section>

<?php
$BsWp->get_template_parts([
    'parts/shared/footer',
    'parts/shared/cookiebar',
    'parts/shared/html-footer'
]);
?>
