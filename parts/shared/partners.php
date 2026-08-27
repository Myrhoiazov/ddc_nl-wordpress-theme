<?php
// the query.
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) { ?>
	<!-- pagination here -->

    <div class="container mt-lg-5">
        <div class="row">
            
            <!-- the loop -->
            <?php
            while ( $the_query->have_posts() ) :
                $the_query->the_post();
                $website = get_post_meta(get_the_ID(), 'website', true);
                ?>
                <?php if(has_post_thumbnail()){ ?>          
                    <div class="col-6 col-md-3">
                        <a href="<?php echo $website ?>" class="logo-img" target="_blank" title="<?php echo get_the_title(); ?>">
                            <?php $src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large') ?>
                            <img loading="lazy" decoding="async" src="<?php echo $src[0] ?>" alt="<?php echo get_the_title(); ?>">
                        </a>
                    </div>
                <?php }; ?>
            <?php endwhile; ?>
            <!-- end of the loop -->
        </div>
    </div>

	<!-- pagination here -->

	<?php wp_reset_postdata(); ?>

<?php } else { ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php }; ?>
