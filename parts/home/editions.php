<?php
// the query.
$the_query = new WP_Query($args); ?>

<?php if ($the_query->have_posts()) { ?>
    <!-- pagination here -->


    <div class="row">

        <!-- the loop -->
        <?php
        while ($the_query->have_posts()) :
            $the_query->the_post();
            $editionImage = get_post_meta(get_the_ID(), 'edition_image', true);
            $editionUrl = get_post_meta(get_the_ID(), 'edition_url', true);
            $editionDate = get_post_meta(get_the_ID(), 'edition_date', true);
            $editionLocation = get_post_meta(get_the_ID(), 'edition_location', true);
        ?>
            <div class="col-lg-6 mb-4">
                <?php if(empty($editionUrl)): ?>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#eventixModal" class="edition-item effect">
                <?php else: ?>
                    <a href="<?php echo $editionUrl; ?>" class="edition-item effect">
                <?php endif; ?>
                    <h3>
                        <?php the_title() ?>
                    </h3>
                    <span class="img-wrap magic-hover magic-hover__square mb-5 d-block">
                        <img src="<?php echo $editionImage; ?>" loading="lazy" decoding="async" alt="<?php echo get_the_title(); ?>">
                    </span>
                    <strong>
                        <?php echo __('Location', 'wp_denysmyr') ?>
                    </strong><br>
                    <?php echo $editionLocation ?><br>
                    <strong class="mt-3 d-inline-block">
                        <?php echo __('Date', 'wp_denysmyr') ?>
                    </strong><br>
                    <?php echo $editionDate ?>
                </a>
            </div>
        <?php endwhile; ?>
        <!-- end of the loop -->
    </div>


    <!-- pagination here -->

    <?php wp_reset_postdata(); ?>

<?php } else { ?>
    <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
<?php }; ?>