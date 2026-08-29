<?php

/**
 * Template name: Styles
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
?>

<?php if (have_posts()) while (have_posts()) : the_post(); ?>
    <section id="styles">
        <a href="<?php echo esc_url(get_site_url()); ?>/" class="small-logo">
            <span class="year"><?php echo esc_html(NEXT_EDITION_YEAR); ?></span>
            <img loading="lazy" decoding="async" src="<?php echo esc_url(get_template_directory_uri()) ?>/images/ddc_logo_white.png" alt="">
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
                    <div class="description mb-5"><?php the_content(); ?></div>
                    <?php
                    // the query.
                    $args = [
                        'post_type' => 'styles',
                        'posts_per_page' => -1,
                        'nopaging' => true,
                        'orderby' => 'menu_order',
                        'order' => 'ASC'
                    ];
                    $the_query = new WP_Query( $args ); ?>

                    <?php if ( $the_query->have_posts() ) : ?>
                        <div class="row choreographer-row mt-5">

                            <!-- pagination here -->

                            <!-- the loop -->
                            <?php
                            while ( $the_query->have_posts() ) :
                                $the_query->the_post();
                                ?>
                                <a href="<?php the_permalink(); ?>" class="col-6 col-lg-3 choreographer" style="opacity: 1;">
                                    <?php if(has_post_thumbnail()): ?>
                                        <div class="img-wrap magic-hover magic-hover__square bdb-0">
                                            <?php $src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large') ?>
                                            <img loading="lazy" decoding="async" src="<?php echo esc_url($src[0]) ?>" alt="">
                                        </div>
                                    <?php endif; ?>
                                    <?php the_title( '<h3>', '</h3>' ); ?>
                                </a>
                            <?php endwhile; ?>
                            <!-- end of the loop -->

                            <!-- pagination here -->
                        </div>

                        <?php wp_reset_postdata(); ?>

                    <?php else : ?>
                        <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
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
