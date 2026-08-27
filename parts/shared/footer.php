
<?php if(is_page() && !get_page_template_slug() && !is_front_page() && !is_home()): ?></div><?php endif; ?>
<footer id="footer" class="position-relative">
	<div class="container footer-container">
		<div class="row">
			<div class="col-lg-4 mb-5 mb-lg-0">
				<h3 class="mb-3"> <?php _e('Talent Center DDC', 'wp_denysmyr') ?></h3>
                <ul>
                    <li>
                        <p>
                        <?php _e('Talent Center DDC — развивает творческие способности, дисциплину и умение работать, отдавая все силы для достижения целей.', 'wp_denysmyr'); ?>
                        </p>

                        <p>
                        <?php _e('Даёт возможность получать удовольствие и радость в процессе обучения и открытия нового.', 'wp_denysmyr'); ?>
                        </p>
                    </li>
                </ul>
			</div>
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h3 class="mb-3 ps-lg-3"> <?php _e('Menu', 'wp_denysmyr'); ?> </h3>
                <?php if (has_nav_menu('footer_nav')) : 
						wp_nav_menu([
							'theme_location' => 'footer_nav',
							'menu_class' => 'list-group list-group-flush nav flex-column',
							'container_class' => 'list-group-item list-group-item-action',
							'container' => 'ul',
							'walker'         	=> new bootstrap_5_wp_nav_menu_walker(),
							'fallback_cb' => false
						]);
					endif;
					?>
            </div>
			<div class="col-lg-4 mb-5 mb-lg-0">
				<h3 class="mb-3"> <?php _e('Наши контакты:', 'wp_denysmyr'); ?> </h3>
				<ul class="list-group list-group-flush">
                    <li class="list-group-item border-bottom-0 ps-0">
                       <?php _e('Talent Center DDC:', 'wp_denysmyr'); ?>
                       <br>
					</li>
					<li class="list-group-item border-bottom-0 ps-0 pt-0">
						<a href="mailto:info@talentcenterddc.nl" class="contact">
							info@talentcenterddc.nl
						</a>
					</li>
					<li class="list-group-item border-bottom-0 ps-0">
                        <br>
                        <?php _e('VAT nummer: NL004836578B09', 'wp_denysmyr'); ?>
                        <br>    
                        <?php _e('Chamber of Commerce: 90720814', 'wp_denysmyr'); ?>
					</li>
				</ul>
			</div>
            <div class="col-12">
                <h5 class="mb-3"> <?php _e('Ми в социальных сетях:', 'wp_denysmyr') ?></h5>
                <nav class="w-100 d-flex socials_nav xs">
                    <a href="https://www.instagram.com/ddc_nl/" target="_blank" title="Talent Center DDC NL Instagram" class="magic-hover effect magic-hover__square is-black is-rounded">
                        <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                            <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                        </svg>
                    </a>
                    <a href="https://www.tiktok.com/@talent.center.ddc" target="_blank" title="Talent Center DDC NL TikTok" class="magic-hover effect magic-hover__square is-black is-rounded">
                        <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                            <path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z" />
                        </svg>
                    </a>
                    <a href="https://www.youtube.com/channel/UCVzMFcw7IkqWvxmtdgBMnhQ" target="_blank" title="Talent Center DDC NL Youtube" class="magic-hover effect magic-hover__square is-black is-rounded youtube">
                        <svg viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg">
                            <path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z" />
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/talentcenterddc/" target="_blank" title="Talent Center DDC NL Facebook" class="magic-hover effect magic-hover__square is-black is-rounded">
                        <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                            <path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z" />
                        </svg>
                    </a>
                </nav>
            </div>
		</div>
	</div>
	<p class="m-0 py-3 px-3 text-center bg-black text-white w-100 copyright-footer d-flex justify-content-center" style="font-size: 13px;">
		<span>© <?php echo date('Y') ?> Talen Center DDC <span>|</span><br> All Rights Reserved.</span>
	</p>
</footer>
</main>

