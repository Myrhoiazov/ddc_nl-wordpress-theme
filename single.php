<?php
/**
 * The Template for displaying all single posts
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

<?php if ( have_posts() ) while ( have_posts() ) : the_post();
	$post_id       = get_the_ID();
	$primary_cat   = ddc_news_primary_category( $post_id );
	$reading_time  = ddc_reading_time_minutes( get_the_content() );
	$toc           = ddc_build_toc( apply_filters( 'the_content', get_the_content() ) );
	$hero_thumb    = get_the_post_thumbnail_url( $post_id, 'large' );
	$back_url      = ddc_news_page_url();
?>

	<div class="post-page">

		<section class="post-hero" <?php if ( $hero_thumb ) : ?>style="background-image: url('<?php echo esc_url( $hero_thumb ); ?>');"<?php endif; ?>>
			<span class="post-hero__overlay"></span>
			<a href="<?php echo esc_url( $back_url ); ?>" class="post-back post-back--top">&larr; <?php esc_html_e( 'К блогу', 'wp_denysmyr' ); ?></a>
			<div class="container post-hero__inner">
				<?php if ( $primary_cat ) : ?>
					<span class="post-hero__cat post-hero__cat--<?php echo esc_attr( ddc_news_category_accent( $primary_cat->term_id ) ); ?>"><?php echo esc_html( mb_strtoupper( $primary_cat->name ) ); ?></span>
				<?php endif; ?>
				<h1 class="post-hero__title"><?php the_title(); ?></h1>
				<div class="post-hero__meta">
					<span><?php echo esc_html( get_the_date() ); ?></span>
					<span><?php echo esc_html( get_the_author() ); ?></span>
					<span><?php echo esc_html( sprintf( __( '%d мин. чтения', 'wp_denysmyr' ), $reading_time ) ); ?></span>
				</div>
			</div>
		</section>

		<section class="post-content-section">
			<div class="container">
				<div class="post-layout<?php echo empty( $toc['items'] ) ? ' post-layout--no-toc' : ''; ?>">
					<div class="post-body">
						<?php echo $toc['html']; ?>
					</div>

					<?php if ( ! empty( $toc['items'] ) ) : ?>
						<aside class="post-toc">
							<div class="post-toc__title"><?php esc_html_e( 'Содержание', 'wp_denysmyr' ); ?></div>
							<ul class="post-toc__list">
								<?php foreach ( $toc['items'] as $item ) : ?>
									<li>
										<a class="post-toc__link" href="#<?php echo esc_attr( $item['id'] ); ?>"><?php echo esc_html( $item['text'] ); ?></a>
										<?php if ( ! empty( $item['children'] ) ) : ?>
											<ol class="post-toc__children">
												<?php foreach ( $item['children'] as $child ) : ?>
													<li><a class="post-toc__link" href="#<?php echo esc_attr( $child['id'] ); ?>"><?php echo esc_html( $child['text'] ); ?></a></li>
												<?php endforeach; ?>
											</ol>
										<?php endif; ?>
									</li>
								<?php endforeach; ?>
							</ul>
						</aside>
					<?php endif; ?>
				</div>
			</div>
		</section>

		<?php
		$related_args = [
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => 3,
			'post__not_in'   => [ $post_id ],
		];

		if ( $primary_cat ) {
			$related_args['category_name'] = $primary_cat->slug;
		}

		$related_query = new WP_Query( $related_args );
		?>

		<?php if ( $related_query->have_posts() ) : ?>
			<section class="post-related">
				<div class="container">
					<hr class="post-divider">
					<a href="<?php echo esc_url( $back_url ); ?>" class="post-back post-back--bottom">&larr; <?php esc_html_e( 'Назад к блогу', 'wp_denysmyr' ); ?></a>

					<h2 class="post-related__title"><?php esc_html_e( 'Похожие материалы', 'wp_denysmyr' ); ?></h2>

					<div class="news-grid">
						<?php while ( $related_query->have_posts() ) : $related_query->the_post();
							$related_cat = ddc_news_primary_category( get_the_ID() );
						?>
							<a href="<?php the_permalink(); ?>" class="news-card">
								<span class="news-card__media">
									<?php if ( has_post_thumbnail() ) : ?>
										<img class="news-card__img" loading="lazy" decoding="async" src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) ); ?>" alt="<?php the_title_attribute(); ?>">
									<?php endif; ?>
									<span class="news-date-badge news-card__date">
										<span class="news-date-badge__day"><?php echo esc_html( get_the_date( 'd' ) ); ?></span>
										<span class="news-date-badge__month"><?php echo esc_html( mb_strtoupper( get_the_date( 'M' ) ) ); ?></span>
									</span>
								</span>
								<span class="news-card__body">
									<?php if ( $related_cat ) : ?>
										<span class="news-card__cat news-card__cat--<?php echo esc_attr( ddc_news_category_accent( $related_cat->term_id ) ); ?>"><?php echo esc_html( mb_strtoupper( $related_cat->name ) ); ?></span>
									<?php endif; ?>
									<span class="news-card__title"><?php the_title(); ?></span>
								</span>
							</a>
						<?php endwhile; ?>
					</div>
				</div>
			</section>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>

		<?php comments_template( '', true ); ?>

	</div>

<?php endwhile; ?>

<?php
$BsWp->get_template_parts([
	'parts/shared/footer',
	'parts/shared/cookiebar',
	'parts/shared/html-footer'
]);
?>
