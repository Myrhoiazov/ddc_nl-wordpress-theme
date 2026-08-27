<?php

/**
 * Template name: ambassador
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

$BsWp->get_template_parts([
	'parts/shared/html-header',
	'parts/shared/header'
]);
?>
	<a href="<?php echo get_site_url(); ?>/" class="small-logo">
		<span class="year white"><?php echo NEXT_EDITION_YEAR; ?></span>
		<img loading="lazy" decoding="async" src="<?php echo get_template_directory_uri() ?>/images/ddc_logo_white.png" alt="">
		<div class="place">
			Amsterdam
		</div>
	</a>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="content">
                    <div class="row">
                        <div class="col-lg-6 ps-lg-4">
                            <?php if (have_posts()) while (have_posts()) : the_post(); ?>
        
                                <h1 class="mt-4">
                                    <?php the_title(); ?>
                                </h1>
                                <?php 
                                $subtitle = get_post_meta(get_the_ID(), 'sub_title', true);
                                ?>
                                <?php if(!empty($subtitle)): ?>
                                    <h2 class="mb-4 subtitle">
                                        <?php echo $subtitle ?>
                                    </h2>
                                <?php endif; ?>
                                <?php the_content(); ?>
        
                            <?php endwhile; ?>
                        </div>
                        <div class="col-lg-6">
                            <?php echo do_shortcode('[contact-form-7 id="ad5a83d" title="Ambassador"]'); ?>
                        </div>
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