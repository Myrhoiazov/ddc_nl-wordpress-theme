<?php

/**
 * Template name: competition
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
    <span class="year">2024</span>
    <img loading="lazy" decoding="async" src="<?php echo get_template_directory_uri() ?>/images/ddc_logo.png" alt="">
    <div class="place">
        Amsterdam
    </div>
</a>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="content">
                <?php if (have_posts()) while (have_posts()) : the_post(); ?>

                    <h1>
                        <?php the_title(); ?>
                    </h1>
                    <?php
                    $subtitle = get_post_meta(get_the_ID(), 'sub_title', true);
                    ?>
                    <?php if (!empty($subtitle)): ?>
                        <h2 class="subtitle">
                            <?php echo $subtitle ?>
                        </h2>
                    <?php endif; ?>
                    <div class="accordion accordion-flush" id="competition_accordion">
                        <?php

                        $content = get_the_content();

                        $splittedContent = explode('<h2>', $content);

                        if (!empty($splittedContent)) {
                            foreach ($splittedContent as $key => $content) {
                                if (!empty($content)) {
                                    $heading = preg_match('/(.*)<\/h2>/', $content, $matches);
                                    if (!empty($matches[0])) {
                                        $heading = $matches[0];
                                    }
                                    if (!empty($content)) {
                                        $remainingContent = str_replace($heading, '', $content);
                                        $remainingContent = substr($remainingContent, 2, strlen($remainingContent));
                        ?>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading_<?php echo $key; ?>">
                                                <button class="accordion-button <?php echo $key == 1 ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#content_<?php echo $key; ?>" aria-expanded="<?php echo $key == 2 ? 'true' : 'false'; ?>" aria-controls="content_<?php echo $key; ?>">
                                                    <?php echo $heading; ?>
                                                </button>
                                            </h2>
                                            <div id="content_<?php echo $key; ?>" class="accordion-collapse collapse <?php echo $key == 1 ? 'show' : ''; ?>" aria-labelledby="heading_<?php echo $key; ?>">
                                                <div class="accordion-body">
                                                    <?php echo $remainingContent; ?>
                                                </div>
                                            </div>
                                        </div>
                        <?php
                                    }
                                }
                            }
                        }

                        ?>
                    </div>

                <?php endwhile; ?>
                <button type="button" class="btn btn-primary btn-lg mt-5" data-bs-toggle="modal" data-bs-target="#competition_form">
                    Sign me up!
                </button>
            </div>
        </div>
    </div>
</div>

<?php
$BsWp->get_template_parts([
    'parts/modals/competition',
    'parts/shared/footer',
    'parts/shared/cookiebar',
    'parts/shared/html-footer'
]);
?>