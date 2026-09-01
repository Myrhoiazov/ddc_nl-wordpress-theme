<?php
	/**
	 * Bootstrap on Wordpress functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
	 * @package 	WordPress
	 * @subpackage 	Bootstrap 5.3.2
	 * @author 		DenysMyr
	 */

	define('BOOTSTRAP_VERSION', '5.3.4');
	define('BOOTSTRAP_ICON_VERSION', '1.11.2');
	define('NEXT_EDITION_YEAR', 2026);

	/* ========================================================================================================================

	01. Add language support to theme

	======================================================================================================================== */

	add_action('after_setup_theme', 'my_theme_setup');

	function my_theme_setup(){
		load_theme_textdomain('wp_denysmyr', get_template_directory() . '/language');
	}

	/* ========================================================================================================================

	02. Required external files

	======================================================================================================================== */

	require_once( 'external/bootstrap-utilities.php' );
	require_once( 'external/bs5navwalker.php' );
	require_once( 'classes/Youtube.php' );
	require_once( 'includes/post-types.php' );
	require_once( 'includes/taxonomies.php' );
	require_once( 'includes/i18n.php' );

	/* ========================================================================================================================

    03. Add html 5 support to wordpress elements

	======================================================================================================================== */

	add_theme_support( 'html5', [
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	]);

	/**
	 * Register our sidebars and widgetized areas.
	 *
	 */
	function ddc_nl_widgets_init() {

		register_sidebar( array(
			'name'          => 'Home insta',
			'id'            => 'insta_widget',
			'before_widget' => '<div id="insta_widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		) );

	}
	add_action( 'widgets_init', 'ddc_nl_widgets_init' );

	/* ========================================================================================================================

	04. Theme specific settings

	======================================================================================================================== */

	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');

	// Theme provides its own favicon links in html-header.php — prevent WordPress
	// from injecting a competing site icon via wp_head() that can override them.
	remove_action('wp_head', 'wp_site_icon', 99);

	// Clean up title: normalize "— — Brand" or "—  Brand" double separators that
	// can appear when the stored title already ends with " — " and AIOSEO appends site name.
	add_filter('pre_get_document_title', function(string $title): string {
		if (is_page('camp')) {
			return ddc_get_camp_seo_title();
		}

		// Collapse any sequence of "—" or "–" with surrounding spaces into a single " — ".
		$title = preg_replace('/(\s*[-–—]\s*){2,}/u', ' — ', $title);
		// Remove a trailing standalone separator left if site name was stripped elsewhere.
		$title = preg_replace('/\s*[-–—]\s*$/u', '', $title);
		return $title;
	}, 99);

	function ddc_get_camp_seo_title(): string
	{
		return 'Детский танцевальный лагерь в Испании 2027 | LITO DANCE CAMP';
	}

	function ddc_get_camp_seo_description(): string
	{
		return 'LITO DANCE CAMP 2027 в Санта-Сусанне: 10 дней моря, танцев, новых друзей и ярких эмоций. 26 июля - 4 августа. Hotel Don Angel 4★.';
	}

	function ddc_get_camp_og_image(): string
	{
		return 'https://talentcenterddc.nl/wp-content/uploads/2026/03/camp-1.webp';
	}

	add_filter('aioseo_title', function(string $title): string {
		return is_page('camp') ? ddc_get_camp_seo_title() : $title;
	}, 99);

	add_filter('aioseo_description', function(string $description): string {
		return is_page('camp') ? ddc_get_camp_seo_description() : $description;
	}, 99);

	add_filter('aioseo_facebook_tags', function(array $tags): array {
		if (!is_page('camp')) {
			return $tags;
		}

		$tags['og:type'] = 'website';
		$tags['og:title'] = ddc_get_camp_seo_title();
		$tags['og:description'] = ddc_get_camp_seo_description();
		$tags['og:image'] = ddc_get_camp_og_image();
		$tags['og:url'] = home_url('/camp/');

		unset($tags['article:published_time'], $tags['article:modified_time']);

		return $tags;
	}, 99);

	add_filter('aioseo_twitter_tags', function(array $tags): array {
		if (!is_page('camp')) {
			return $tags;
		}

		$tags['twitter:card'] = 'summary_large_image';
		$tags['twitter:title'] = ddc_get_camp_seo_title();
		$tags['twitter:description'] = ddc_get_camp_seo_description();
		$tags['twitter:image'] = ddc_get_camp_og_image();

		return $tags;
	}, 99);

	add_filter('aioseo_schema_disable', function(bool $disabled): bool {
		return is_page('camp') ? true : $disabled;
	}, 99);

	// Fix empty alt attributes on images served from the Instagram Feed plugin cache.
	add_action('template_redirect', function() {
		ob_start(function(string $html): string {
			return preg_replace(
				'/(<img\b[^>]*\bsrc=["\'][^"\']*sb-instagram-feed-images[^"\']*["\'][^>]*)\balt=""/i',
				'$1alt="Talent Center DDC — фото из Instagram @ddc_nl"',
				$html
			);
		});
	});

	// ── Structured Data / JSON-LD ────────────────────────────────────────────────
	add_action('wp_head', function() {

		// 1. DanceSchool (Organization + all locations) — every page
		$org = [
			'@context'   => 'https://schema.org',
			'@type'      => 'DanceSchool',
			'name'       => 'Talent Center DDC',
			'url'        => 'https://talentcenterddc.nl',
			'logo'       => get_template_directory_uri() . '/images/apple-touch-icon.png',
			'email'      => 'info@talentcenterddc.nl',
			'vatID'      => 'NL004836578B09',
			'identifier' => ['@type' => 'PropertyValue', 'name' => 'KvK', 'value' => '90720814'],
			'sameAs'     => [
				'https://www.instagram.com/ddc_nl',
				'https://www.facebook.com/talentcenterddc',
			],
			'location' => [
				[
					'@type' => 'Place',
					'name'  => 'Talent Center DDC Rotterdam',
					'address' => ['@type' => 'PostalAddress', 'streetAddress' => 'Van Alkemadehof 51', 'postalCode' => '3031 PB', 'addressLocality' => 'Rotterdam', 'addressCountry' => 'NL'],
				],
				[
					'@type' => 'Place',
					'name'  => 'Talent Center DDC Amsterdam (Hoogoorddreef)',
					'address' => ['@type' => 'PostalAddress', 'streetAddress' => 'Hoogoorddreef 74', 'postalCode' => '1101 BG', 'addressLocality' => 'Amsterdam', 'addressCountry' => 'NL'],
				],
				[
					'@type' => 'Place',
					'name'  => 'Talent Center DDC Amsterdam (Nieuwe Achtergracht)',
					'address' => ['@type' => 'PostalAddress', 'streetAddress' => 'Nieuwe Achtergracht 170', 'postalCode' => '1018 WV', 'addressLocality' => 'Amsterdam', 'addressCountry' => 'NL'],
				],
				[
					'@type' => 'Place',
					'name'  => 'Talent Center DDC Apeldoorn',
					'address' => ['@type' => 'PostalAddress', 'streetAddress' => 'Musschenbroekstraat 19', 'postalCode' => '7316 JD', 'addressLocality' => 'Apeldoorn', 'addressCountry' => 'NL'],
				],
				[
					'@type' => 'Place',
					'name'  => 'Talent Center DDC Arnhem',
					'address' => ['@type' => 'PostalAddress', 'streetAddress' => 'Kazerneplein 6-2', 'postalCode' => '6822 ET', 'addressLocality' => 'Arnhem', 'addressCountry' => 'NL'],
				],
			],
		];
		echo '<script type="application/ld+json">' . wp_json_encode($org, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . "</script>\n";

		// 2. FAQPage — only on /faq/
		if (is_page('faq')) {
			$faq = [
				'@context'   => 'https://schema.org',
				'@type'      => 'FAQPage',
				'mainEntity' => [
					['@type' => 'Question', 'name' => 'С какого возраста можно приводить ребёнка на занятия?',    'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Мы работаем с детьми от 4 лет. Есть отдельные группы для малышей, подростков и взрослых.']],
					['@type' => 'Question', 'name' => 'Можно ли прийти на пробное занятие?',                      'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Да, первое занятие — пробное и стоит как разовое. Это помогает ребёнку познакомиться с педагогом и выбрать стиль.']],
					['@type' => 'Question', 'name' => 'Нужен ли опыт, чтобы начать танцевать?',                   'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Нет, опыт не нужен. Педагоги адаптируют упражнения под уровень каждого ребёнка.']],
					['@type' => 'Question', 'name' => 'Какие стили танцев вы преподаёте?',                        'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Kids Dance (от 4 лет), Hip-Hop, Contemporary, Jazz Funk, DDC NL (для взрослых) и Street Jazz.']],
					['@type' => 'Question', 'name' => 'Есть ли абонементы или оплата за занятие?',                'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Да, доступны ежемесячные абонементы и оплата за разовое занятие.']],
					['@type' => 'Question', 'name' => 'Помогают ли танцы адаптации детей в Нидерландах?',         'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Да, танцевальная студия — это пространство общения, дружбы и уверенности, что особенно важно для детей, которые только переехали в Нидерланды.']],
					['@type' => 'Question', 'name' => 'Как записаться на занятия?',                               'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Через форму на сайте, в Instagram @ddc_nl или в WhatsApp.']],
				],
			];
			echo '<script type="application/ld+json">' . wp_json_encode($faq, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . "</script>\n";
		}

		// 3. Event — only on /camp/
		if (is_page('camp')) {
			$event = [
				'@context'            => 'https://schema.org',
				'@type'               => 'Event',
				'name'                => 'LITO DANCE CAMP 2027',
				'startDate'           => '2027-07-26',
				'endDate'             => '2027-08-04',
				'eventStatus'         => 'https://schema.org/EventScheduled',
				'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
				'description'         => 'LITO DANCE CAMP 2027 в Санта-Сусанне: 10 дней моря, танцев, новых друзей и ярких эмоций. Hotel Don Angel 4★.',
				'location' => [
					'@type'   => 'Place',
					'name'    => 'Hotel Don Angel',
					'address' => ['@type' => 'PostalAddress', 'addressLocality' => 'Santa Susanna', 'addressRegion' => 'Catalonia', 'addressCountry' => 'ES'],
				],
				'organizer' => ['@type' => 'Organization', 'name' => 'Talent Center DDC', 'url' => 'https://talentcenterddc.nl'],
				'offers' => [
					['@type' => 'Offer', 'name' => 'PRE-SALE', 'price' => '1190', 'priceCurrency' => 'EUR', 'availability' => 'https://schema.org/SoldOut'],
					['@type' => 'Offer', 'name' => 'REGULAR', 'price' => '1390', 'priceCurrency' => 'EUR', 'availability' => 'https://schema.org/InStock'],
					['@type' => 'Offer', 'name' => 'LATE TICKET', 'price' => '1590', 'priceCurrency' => 'EUR', 'availability' => 'https://schema.org/LimitedAvailability'],
				],
			];
			echo '<script type="application/ld+json">' . wp_json_encode($event, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . "</script>\n";
		}

	}, 5);

	//add_image_size( 'name', width, height, crop true|false );

	add_action('after_setup_theme', function() {
		register_nav_menus([
			'primary' => 'Primary Navigation',
			'footer_nav' => 'Footer Navigation'
		]);
	});
	

	/* ========================================================================================================================

	05. Actions and Filters

	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'bootstrap_script_init' );

	$BsWp = new BsWp;
	add_filter( 'body_class', [$BsWp, 'add_slug_to_body_class'] );

	// Add the custom columns to the choreographer post type:
	add_filter( 'manage_choreographer_posts_columns', 'set_custom_edit_choreographer_columns' );
	function set_custom_edit_choreographer_columns($columns) {
		$date = $columns['date'];
		unset($columns['date']);
		$columns['order'] = __( 'Order', 'your_text_domain' );
		$columns['date'] = $date;

		return $columns;
	}

	// Add the data to the custom columns for the choreographer post type:
	add_action( 'manage_choreographer_posts_custom_column' , 'custom_choreographer_column', 10, 2 );
	function custom_choreographer_column( $column, $post_id ) {
		switch ( $column ) {

			case 'order' :
				$post = get_post($post_id);
				echo $post->menu_order;
				break;
		}
	}

	add_filter('get_the_author_user_nicename', 'get_the_author_user_nicename_cb', 10, 2);
	function get_the_author_user_nicename_cb($value, $user_id){
		$user_info = get_userdata($user_id);
		return $user_info->display_name;

	}

	add_filter('wpcf7_form_elements', function($content) {
		$content = preg_replace('/<p><(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>\s*<br\s*\/>\s*(<label[^>]+>[^<]+<\/label>)\s+<\/p>/i', '\2\3', $content);
	
		return $content;
	});

	add_action('after_switch_theme', function() {
		update_option('woocommerce_feature_order_attribution_enabled', '');
	});

	function ddc_nl_remove_excess_css_js() {

		wp_dequeue_style('fontawesome_stylesheet');
		if (is_home() || is_front_page()) {
			wp_dequeue_style('uwp-country-select');
			wp_dequeue_script( 'userswp' );
			wp_dequeue_script( 'country-select' );
		}

		
	}


	function remove_more_link_scroll( $link ) {
		$link = preg_replace( '|#more-[0-9]+|', '', $link );
		return $link;
	}
	add_filter( 'the_content_more_link', 'remove_more_link_scroll' );


	/* ========================================================================================================================

	07. Scripts

	======================================================================================================================== */


    // Define global variable
    $ModuleScripts = [];

    // Helper function to register module
    function wp_enqueue_module($handle, $async = false, $defer = false) 
    {
        global $ModuleScripts;
        $ModuleScripts[$handle] = [
            'async' => $async,
            'defer' => $defer
        ];
    }
    
    // Filter for adding the module functionality 
    add_filter('script_loader_tag', 'add_type_attribute' , 10, 3);

    function add_type_attribute($tag, $handle, $src) 
    {
        global $ModuleScripts;
        // use key values for comparison 
        $moduleHandles = array_keys($ModuleScripts);
        
        // If is module script make module tag
        if (in_array($handle, $moduleHandles)) {
            $async = $ModuleScripts[$handle]['async'];
            $defer = $ModuleScripts[$handle]['defer'];
            $tag = '<script type="module" src="' . esc_url( $src ) . '"' . ( $async ? ' async' : '' ) . ( $defer ? ' defer' : '' ) . '></script>';
        }

        // Remove type text/javascript obsolete in HTML5
        $tag = str_replace(' type="text/javascript"', '', $tag);

        return $tag;
    }

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	if ( !function_exists( 'bootstrap_script_init' ) ) {
		function bootstrap_script_init() {

			// Get theme version number (located in style.css)
			$theme = wp_get_theme();
			$is_home_page = is_home() || is_front_page() || is_page_template('templates/home-template.php');
			$needs_sweetalert = $is_home_page || is_page_template('templates/schedule-template.php');

			// if ($_SERVER['HTTP_HOST'] == 'talentcenterddc.nl') {
			// 	wp_enqueue_script('main_combined', get_template_directory_uri() . '/js/main-combined.js', [], BOOTSTRAP_VERSION, [
			// 		'in_footer' => true,
			// 	]);
			// } else {
				wp_enqueue_script( 'cookiemonster', get_template_directory_uri() . '/js/CookieMonster.js', [  ], BOOTSTRAP_VERSION, true );
				wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', [], BOOTSTRAP_VERSION, true );
				wp_enqueue_script( 'lightbox', get_template_directory_uri() . '/js/fslightbox.js', [ 'jquery' ], BOOTSTRAP_VERSION, true );
				if ($needs_sweetalert) {
					wp_enqueue_script('sweetalert2', 'https://cdn.jsdelivr.net/npm/sweetalert2@11', [], null, true);
				}
			// }

			if ($is_home_page) {
				wp_enqueue_script( 'flipdown', get_template_directory_uri() . '/js/flipdown.js', [ 'jquery' ], BOOTSTRAP_VERSION, [
					'in_footer' => true,
					'strategy' => 'defer'
				] );
				wp_enqueue_script( 'editions', get_template_directory_uri() . '/js/home.js', [ 'jquery', 'bootstrap' ], $theme->get( 'Version' ), [
					'in_footer' => true,
					'strategy' => 'defer'
				] );
				wp_enqueue_script( 'landing', get_template_directory_uri() . '/js/landingsPage.js', [ 'jquery', 'bootstrap', 'flipdown' ], $theme->get( 'Version' ), [
					'in_footer' => true,
					'strategy' => 'defer'
				] );
			}
			wp_enqueue_script('site', get_template_directory_uri() . '/js/app.js', [ 'jquery', 'bootstrap' ], $theme->get( 'Version' ), [
				'in_footer' => true,
				'strategy' => 'defer',
			]);
			wp_localize_script('site', 'data', [
				'url' => get_template_directory_uri()
			]);

			wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', [], BOOTSTRAP_VERSION, 'all' );
			wp_enqueue_style( 'screen', get_template_directory_uri() . '/style.css', [], $theme->get( 'Version' ), 'screen' );

			ddc_nl_remove_excess_css_js();
		}
	}

	/* ========================================================================================================================

	08. Security & cleanup wp admin

	======================================================================================================================== */

	//remove wp version
	function theme_remove_version() {
		return '';
	}

	add_filter('the_generator', 'theme_remove_version');

	//remove default footer text
	function remove_footer_admin () {
		echo "";
	}

	add_filter('admin_footer_text', 'remove_footer_admin');

	//remove wordpress logo from adminbar
	function wp_logo_admin_bar_remove() {
		global $wp_admin_bar;

		/* Remove their stuff */
		$wp_admin_bar->remove_menu('wp-logo');
	}

	add_action('wp_before_admin_bar_render', 'wp_logo_admin_bar_remove', 0);

	remove_action('welcome_panel', 'wp_welcome_panel');

	if ( !function_exists( 'custom_logo_guttenberg' ) ) {
		function custom_logo_guttenberg() {
			echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').
			'/css/admin-custom.css?v=1.0.0" />';
		}
	}


	/* ========================================================================================================================

	10. Custom login

	======================================================================================================================== */

	// Add custom css
	if ( !function_exists( 'my_custom_login' ) ) {
		function my_custom_login() {
			echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/css/custom-login-style.css?v=1.0.0" />';
		}
	}
	add_action('login_head', 'my_custom_login');

	// Link the logo to the home of our website
	if ( !function_exists( 'my_login_logo_url' ) ) {
		function my_login_logo_url() {
			return get_bloginfo( 'url' );
		}
	}
	add_filter( 'login_headerurl', 'my_login_logo_url' );

	// Change the title text
	if ( !function_exists( 'my_login_logo_url_title' ) ) {
		function my_login_logo_url_title() {
			return get_bloginfo( 'name' );
		}
	}
	add_filter( 'login_headertext', 'my_login_logo_url_title' );
	

	/* ========================================================================================================================

	11. Comments

	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	if (!function_exists( 'bootstrap_comment' )) {
		function bootstrap_comment( $comment, $args, $depth ) {
			$GLOBALS['comment'] = $comment;
			?>
			<?php if ( $comment->comment_approved == '1' ): ?>
			<li class="row">
				<div class="col-4 col-md-2">
					<?php echo get_avatar( $comment ); ?>
				</div>
				<div class="col-8 col-md-10">
					<h4><?php comment_author_link() ?></h4>
					<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
					<?php comment_text() ?>
				</div>
			<?php endif;
		}
	}

    /**
 * Подключение Swiper Slider
 */
function my_theme_connect_swiper() {
	if (!(is_front_page() || is_home() || is_page_template('templates/home-template.php'))) {
		return;
	}

    // 1. Подключаем CSS (Стили)
    wp_enqueue_style( 
        'swiper-css', // Уникальное имя
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', // Ссылка
        array(), // Зависимости (нет)
        '11.0' // Версия
    );

    // 2. Подключаем JS (Скрипт)
    wp_enqueue_script( 
        'swiper-js', // Уникальное имя
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', // Ссылка
        array(), // Зависимости (нет)
        '11.0', // Версия
        true // ВАЖНО: true означает "загрузить в футере" (перед </body>), чтобы сайт грузился быстрее
    );
}

add_action( 'wp_enqueue_scripts', 'my_theme_connect_swiper' );


// Telegram Contact Form 7 integration
add_action('rest_api_init', function () {
	register_rest_route('contact-form', '/tg', [
		'methods'  => 'POST',
		'callback' => 'send_cf7_to_telegram',
		'permission_callback' => '__return_true',
	]);

	register_rest_route('contact-form', '/camp-booking', [
		'methods'  => 'POST',
		'callback' => 'send_camp_booking_to_telegram',
		'permission_callback' => '__return_true',
	]);
});

function ddc_get_secret_value(string $constant_name, string $env_name = ''): string
{
	if (defined($constant_name)) {
		return (string) constant($constant_name);
	}

	$value = getenv($env_name ?: $constant_name);

	return $value === false ? '' : (string) $value;
}

function send_cf7_to_telegram(WP_REST_Request $request)
{
	$data = $request->get_json_params();

	// Поддерживаем оба варианта имени поля: "messenger-type" и "messenger-type[]"
	$messenger_raw = $data['messenger-type']
		?? $data['messenger-type[]']
		?? '';

	// Если пришёл массив (checkbox) — объединяем
	if (is_array($messenger_raw)) {
		$messenger_raw = implode(', ', array_filter($messenger_raw));
	}

	$messenger = trim((string) $messenger_raw);

	$phone_raw = $data['messenger-phone']
		?? $data['messenger-phone[]']
		?? '';
	$messenger_phone = trim((string) $phone_raw);

	$icons = ['Telegram' => '✈️ Telegram', 'WhatsApp' => '📱 WhatsApp'];

	$message  = "📩 <b>Новая заявка — DDC NL!</b>\n";
	$message .= "━━━━━━━━━━━━━━━━━━━━\n";
	$message .= "👤 <b>Имя:</b> "         . htmlspecialchars($data['your-name']    ?? '-') . "\n";
	$message .= "📧 <b>Email:</b> "        . htmlspecialchars($data['your-email']   ?? '-') . "\n";
	$message .= "📌 <b>Тема:</b> "         . htmlspecialchars($data['your-subject'] ?? '-') . "\n";
	$message .= "💬 <b>Сообщение:</b>\n"   . htmlspecialchars($data['your-message'] ?? '-') . "\n";
	$message .= "━━━━━━━━━━━━━━━━━━━━\n";

	if ($messenger) {
		$label = $icons[$messenger] ?? ('💬 ' . $messenger);
		$message .= "📲 <b>Связь через:</b> {$label}\n";
		if ($messenger_phone) {
			$message .= "📞 <b>Телефон:</b> " . htmlspecialchars($messenger_phone) . "\n";
		}
	} else {
		$message .= "📲 <b>Связь через:</b> не указано\n";
	}

	$token   = ddc_get_secret_value('TELEGRAM_TOKEN');
	$chat_id = ddc_get_secret_value('TELEGRAM_CHAT_ID');

	if (!$token || !$chat_id) {
		return new WP_Error(
			'telegram_not_configured',
			'Telegram integration is not configured.',
			['status' => 500]
		);
	}

	wp_remote_post("https://api.telegram.org/bot{$token}/sendMessage", [
		'body' => [
			'chat_id'    => $chat_id,
			'text'       => $message,
			'parse_mode' => 'HTML',
		],
	]);

	return ['status' => 'ok'];
}

function ddc_clean_camp_booking_field(array $data, string $key): string
{
	return trim(sanitize_text_field((string) ($data[$key] ?? '')));
}

function send_camp_booking_to_telegram(WP_REST_Request $request)
{
	$data = $request->get_json_params();
	$data = is_array($data) ? $data : [];

	$parent_name = ddc_clean_camp_booking_field($data, 'parent_name');
	$child_name = ddc_clean_camp_booking_field($data, 'child_name');
	$child_age = ddc_clean_camp_booking_field($data, 'child_age');
	$phone = ddc_clean_camp_booking_field($data, 'phone');
	$email = sanitize_email((string) ($data['email'] ?? ''));
	$messenger = ddc_clean_camp_booking_field($data, 'messenger');
	$city = ddc_clean_camp_booking_field($data, 'city');
	$comment = trim(sanitize_textarea_field((string) ($data['comment'] ?? '')));

	if (!$parent_name || !$child_name || !$child_age || !$phone || !$email || !is_email($email)) {
		return new WP_Error(
			'camp_booking_invalid',
			'Please fill in all required booking fields.',
			['status' => 400]
		);
	}

	$message  = "🏖 <b>Новая заявка — LITO DANCE CAMP 2027</b>\n";
	$message .= "━━━━━━━━━━━━━━━━━━━━\n";
	$message .= "👤 <b>Родитель:</b> " . htmlspecialchars($parent_name) . "\n";
	$message .= "🧒 <b>Ребёнок:</b> " . htmlspecialchars($child_name) . "\n";
	$message .= "🎂 <b>Возраст:</b> " . htmlspecialchars($child_age) . "\n";
	$message .= "📞 <b>Телефон:</b> " . htmlspecialchars($phone) . "\n";
	$message .= "📧 <b>Email:</b> " . htmlspecialchars($email) . "\n";
	$message .= "💬 <b>WhatsApp / Telegram:</b> " . htmlspecialchars($messenger ?: '-') . "\n";
	$message .= "📍 <b>Город:</b> " . htmlspecialchars($city ?: '-') . "\n";
	$message .= "💶 <b>Тариф:</b> REGULAR €1390, предоплата €450\n";
	$message .= "🚌 <b>Транспорт:</b> автобус оплачивается отдельно\n";
	$message .= "━━━━━━━━━━━━━━━━━━━━\n";
	$message .= "📝 <b>Комментарий:</b>\n" . htmlspecialchars($comment ?: '-') . "\n";

	$token   = ddc_get_secret_value('TELEGRAM_TOKEN');
	$chat_id = ddc_get_secret_value('TELEGRAM_CHAT_ID');

	if (!$token || !$chat_id) {
		return new WP_Error(
			'telegram_not_configured',
			'Telegram integration is not configured.',
			['status' => 500]
		);
	}

	$response = wp_remote_post("https://api.telegram.org/bot{$token}/sendMessage", [
		'body' => [
			'chat_id'    => $chat_id,
			'text'       => $message,
			'parse_mode' => 'HTML',
		],
	]);

	if (is_wp_error($response)) {
		return $response;
	}

	$response_code = wp_remote_retrieve_response_code($response);
	if ($response_code < 200 || $response_code >= 300) {
		return new WP_Error(
			'telegram_request_failed',
			'Telegram request failed.',
			['status' => 502]
		);
	}

	return ['status' => 'ok'];
}
