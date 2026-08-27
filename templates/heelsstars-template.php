<?php

/**
 * Template name: Heels stars
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
		<span class="year white">2026</span>
		<img loading="lazy" decoding="async" src="<?php echo get_template_directory_uri() ?>/images/ddc_logo_white.png" alt="DDC NL logo">
		<div class="place">
			Amsterdam
		</div>
	</a>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="content">
                    <div class="row">
                        <div class="col-12">
                            <?php if (have_posts()) while (have_posts()) : the_post(); ?>
        
                                <h1 class="mt-4">
                                    <?php the_title(); ?>
                                    <img src="https://talentcenterddc.nl/wp-content/uploads/2025/05/ticket1.png" alt="Ticket card" class="ticket-card" width="200">
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
                        <div class="col-lg-8 offset-lg-2">
                            <?php echo do_shortcode('[contact-form-7 id="23110e8" title="Heels dance stars"]'); ?>
                        </div>
                    </div>
				</div>
			</div>
            <button type="button" class="btn btn-primary btn-lg btn-round magic-hover magic-hover__square is-black" data-bs-toggle="modal" data-bs-target="#eventixModal">
                <?php echo __('Book your spot!', 'wp_denysmyr') ?>
            </button>
		</div>
	</div>

<?php
$BsWp->get_template_parts([
    'parts/modals/eventix',
	'parts/shared/footer',
    'parts/shared/cookiebar',
	'parts/shared/html-footer'
]);
?>