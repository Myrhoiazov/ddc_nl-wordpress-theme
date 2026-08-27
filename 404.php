<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Please see /external/bootstrap-utilities.php for info on BsWp::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Bootstrap 5.3.2
 * @author 		DenysMyr
 */

$BsWp = new BsWp;

$BsWp->get_template_parts([
	'parts/shared/html-header', 
	'parts/shared/header'
]);
?>
<section id="not_found">
	<div class="conainer">
		<div class="row">
			<div class="col-12 text-center">
				<div class="img-wrap">
					<img src="<?php echo get_template_directory_uri() ?>/images/404.webp" alt="<?php echo __('Page not found', 'wp_denysmyr'); ?>">
				</div>
				<h1>
					<?php echo __('Page not found', 'wp_denysmyr'); ?>
				</h1>
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
