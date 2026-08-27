<?php
/**
 * Template name: FAQ
 */
$BsWp = new BsWp;
$BsWp->get_template_parts([
    'parts/shared/html-header',
    'parts/shared/header'
]);
?>

<div class="banner" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
    <div class="data">
        <h1><?php the_title(); ?></h1>
    </div>
</div>

<section class="faq-section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1">

                <?php
                if (have_posts()) while (have_posts()) : the_post();
                    $args = [
                        'post_type'      => 'faq',
                        'posts_per_page' => -1,
                        'nopaging'       => true,
                        'orderby'        => ['menu_order', 'ID'],
                    ];
                    $the_query = new WP_Query($args);
                ?>

                <?php if ($the_query->have_posts()) : ?>
                    <div class="faq-accordion" id="faq">
                        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                            <div class="faq-item">
                                <button
                                    class="faq-question"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#faq_<?php echo get_the_ID(); ?>"
                                    aria-expanded="false"
                                    aria-controls="faq_<?php echo get_the_ID(); ?>"
                                >
                                    <span><?php the_title(); ?></span>
                                    <span class="faq-icon" aria-hidden="true">
                                        <svg class="faq-icon__plus"  viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
                                        <svg class="faq-icon__minus" viewBox="0 0 24 24"><path d="M5 12h14"/></svg>
                                    </span>
                                </button>
                                <div id="faq_<?php echo get_the_ID(); ?>" class="faq-answer collapse" data-bs-parent="#faq">
                                    <div class="faq-answer__inner">
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <p><?php esc_html_e('Вопросы не найдены.', 'wp_denysmyr'); ?></p>
                <?php endif; ?>

                <?php endwhile; ?>

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
