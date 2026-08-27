<?php
/**
 * Template name: Contact
 */
$BsWp = new BsWp;

$BsWp->get_template_parts([
	'parts/shared/html-header',
	'parts/shared/header'
]);
?>

<div class="banner" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
</div>

<div class="contact-page">

	<!-- ── Заголовок страницы ────────────────────────────────────────────── -->
	<div class="container">
		<div class="row">
			<div class="col-12 pt-5 pb-3">
				<?php if (have_posts()) while (have_posts()) : the_post(); ?>
					<h1 class="contact-page__title"><?php the_title(); ?></h1>
					<?php
					$subtitle = get_post_meta(get_the_ID(), 'sub_title', true);
					if (!empty($subtitle)) :
					?>
						<p class="contact-page__subtitle"><?php echo esc_html($subtitle); ?></p>
					<?php endif; ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
			</div>
		</div>
	</div>

	<!-- ── Студии ───────────────────────────────────────────────────────── -->
	<div class="container-fluid px-0">
		<div class="contact-locations">
			<div class="container">
				<h2 class="contact-locations__heading">Наши студии</h2>

				<div class="row g-4">

					<!-- Rotterdam -->
					<div class="col-12 col-lg-6">
						<div class="contact-loc">
							<div class="contact-loc__map">
								<iframe
									loading="lazy"
									title="Talent Center DDC Rotterdam"
									src="https://maps.google.com/maps?q=Van+Alkemadehof+51,+3031+PB+Rotterdam,+Netherlands&output=embed&z=15&hl=ru"
									allowfullscreen>
								</iframe>
							</div>
							<div class="contact-loc__info">
								<h3 class="contact-loc__city">Rotterdam</h3>
								<address class="contact-loc__address">
									Van Alkemadehof 51<br>
									3031 PB Rotterdam<br>
									Nederland
								</address>
								<a
									href="https://maps.google.com/maps?q=Van+Alkemadehof+51,+3031+PB+Rotterdam,+Netherlands"
									class="contact-loc__link"
									target="_blank"
									rel="noopener">
									Открыть в Google Maps →
								</a>
							</div>
						</div>
					</div>

					<!-- Amsterdam 1 -->
					<div class="col-12 col-lg-6">
						<div class="contact-loc">
							<div class="contact-loc__map">
								<iframe
									loading="lazy"
									title="Talent Center DDC Amsterdam Hoogoorddreef"
									src="https://maps.google.com/maps?q=Hoogoorddreef+74,+1101+BG+Amsterdam,+Netherlands&output=embed&z=15&hl=ru"
									allowfullscreen>
								</iframe>
							</div>
							<div class="contact-loc__info">
								<h3 class="contact-loc__city">Amsterdam <span>— Hoogoorddreef</span></h3>
								<address class="contact-loc__address">
									Hoogoorddreef 74<br>
									1101 BG Amsterdam<br>
									Nederland
								</address>
								<a
									href="https://maps.google.com/maps?q=Hoogoorddreef+74,+1101+BG+Amsterdam,+Netherlands"
									class="contact-loc__link"
									target="_blank"
									rel="noopener">
									Открыть в Google Maps →
								</a>
							</div>
						</div>
					</div>

					<!-- Amsterdam 2 -->
					<div class="col-12 col-lg-6">
						<div class="contact-loc">
							<div class="contact-loc__map">
								<iframe
									loading="lazy"
									title="Talent Center DDC Amsterdam Nieuwe Achtergracht"
									src="https://maps.google.com/maps?q=Nieuwe+Achtergracht+170,+1018+WV+Amsterdam,+Netherlands&output=embed&z=15&hl=ru"
									allowfullscreen>
								</iframe>
							</div>
							<div class="contact-loc__info">
								<h3 class="contact-loc__city">Amsterdam <span>— Nieuwe Achtergracht</span></h3>
								<address class="contact-loc__address">
									Nieuwe Achtergracht 170<br>
									1018 WV Amsterdam<br>
									Nederland
								</address>
								<a
									href="https://maps.google.com/maps?q=Nieuwe+Achtergracht+170,+1018+WV+Amsterdam,+Netherlands"
									class="contact-loc__link"
									target="_blank"
									rel="noopener">
									Открыть в Google Maps →
								</a>
							</div>
						</div>
					</div>

					<!-- Apeldoorn -->
					<div class="col-12 col-lg-6">
						<div class="contact-loc">
							<div class="contact-loc__map">
								<iframe
									loading="lazy"
									title="Talent Center DDC Apeldoorn"
									src="https://maps.google.com/maps?q=Musschenbroekstraat+19,+7316+JD+Apeldoorn,+Netherlands&output=embed&z=15&hl=ru"
									allowfullscreen>
								</iframe>
							</div>
							<div class="contact-loc__info">
								<h3 class="contact-loc__city">Apeldoorn</h3>
								<address class="contact-loc__address">
									Musschenbroekstraat 19<br>
									7316 JD Apeldoorn<br>
									Nederland
								</address>
								<a
									href="https://maps.google.com/maps?q=Musschenbroekstraat+19,+7316+JD+Apeldoorn,+Netherlands"
									class="contact-loc__link"
									target="_blank"
									rel="noopener">
									Открыть в Google Maps →
								</a>
							</div>
						</div>
					</div>

					<!-- Arnhem -->
					<div class="col-12 col-lg-6">
						<div class="contact-loc">
							<div class="contact-loc__map">
								<iframe
									loading="lazy"
									title="Talent Center DDC Arnhem"
									src="https://maps.google.com/maps?q=Kazerneplein+6,+6822+ET+Arnhem,+Netherlands&output=embed&z=15&hl=ru"
									allowfullscreen>
								</iframe>
							</div>
							<div class="contact-loc__info">
								<h3 class="contact-loc__city">Arnhem</h3>
								<address class="contact-loc__address">
									Kazerneplein 6-2<br>
									6822 ET Arnhem<br>
									Nederland
								</address>
								<a
									href="https://maps.google.com/maps?q=Kazerneplein+6,+6822+ET+Arnhem,+Netherlands"
									class="contact-loc__link"
									target="_blank"
									rel="noopener">
									Открыть в Google Maps →
								</a>
							</div>
						</div>
					</div>

				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .contact-locations -->
	</div>

	<!-- ── Форма + соцсети ──────────────────────────────────────────────── -->
	<div class="container">
		<div class="row py-5">

			<div class="col-lg-6">

				<!-- Реквизиты -->
				<div class="contact-details">
					<h2 class="contact-details__heading">Напишите нам</h2>
					<div class="contact-details__grid">
						<div class="contact-details__item">
							<span class="contact-details__label">Email</span>
							<a class="contact-details__value" href="mailto:info@talentcenterddc.nl">info@talentcenterddc.nl</a>
						</div>
						<div class="contact-details__item">
							<span class="contact-details__label">Instagram</span>
							<a class="contact-details__value" href="https://www.instagram.com/ddc_nl/" target="_blank" rel="noopener">@ddc_nl</a>
						</div>
						<div class="contact-details__item">
							<span class="contact-details__label">KvK</span>
							<span class="contact-details__value">90720814</span>
						</div>
						<div class="contact-details__item">
							<span class="contact-details__label">BTW (VAT)</span>
							<span class="contact-details__value">NL004836578B09</span>
						</div>
					</div>
				</div>

				<!-- CF7 форма -->
				<?php echo do_shortcode('[contact-form-7 id="c223c72" title="Contact form"]'); ?>
			</div>

			<div class="col-lg-6 mt-4 mt-lg-0">
				<?php if (is_active_sidebar('insta_widget')) : ?>
					<?php dynamic_sidebar('insta_widget'); ?>
				<?php endif; ?>
				<nav id="socials_nav" class="w-100 d-flex mobile-xs justify-content-between mt-3">
					<a href="https://www.instagram.com/ddc_nl/" target="_blank" title="Instagram Talent Center DDC" class="magic-hover effect magic-hover__square is-black is-rounded">
						<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
					</a>
					<a href="https://www.tiktok.com/@talent.center.ddc" target="_blank" title="TikTok Talent Center DDC" class="magic-hover effect magic-hover__square is-black is-rounded">
						<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
					</a>
					<a href="https://www.youtube.com/channel/UCVzMFcw7IkqWvxmtdgBMnhQ" target="_blank" title="YouTube Talent Center DDC" class="magic-hover effect magic-hover__square is-black is-rounded youtube">
						<svg viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"><path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/></svg>
					</a>
					<a href="https://www.facebook.com/talentcenterddc/" target="_blank" title="Facebook Talent Center DDC" class="magic-hover effect magic-hover__square is-black is-rounded">
						<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/></svg>
					</a>
				</nav>
			</div>

		</div>
	</div>

</div><!-- .contact-page -->

<?php
$BsWp->get_template_parts([
	'parts/modals/contact',
	'parts/shared/footer',
	'parts/shared/cookiebar',
	'parts/shared/html-footer'
]);
?>
