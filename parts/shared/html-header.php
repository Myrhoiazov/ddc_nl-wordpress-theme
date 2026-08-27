<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <?php $ddc_theme_version = wp_get_theme()->get('Version'); ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(add_query_arg('v', $ddc_theme_version, get_template_directory_uri() . '/images/apple-touch-icon.png')); ?>">
  <link rel="icon" type="image/svg+xml" href="<?php echo esc_url(add_query_arg('v', $ddc_theme_version, get_template_directory_uri() . '/images/favicon.svg')); ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url(add_query_arg('v', $ddc_theme_version, get_template_directory_uri() . '/images/favicon-32x32.png')); ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url(add_query_arg('v', $ddc_theme_version, get_template_directory_uri() . '/images/favicon-16x16.png')); ?>">
  <link rel="shortcut icon" href="<?php echo esc_url(add_query_arg('v', $ddc_theme_version, get_template_directory_uri() . '/images/favicon.ico')); ?>">
  <link rel="manifest" href="<?php echo esc_url(add_query_arg('v', $ddc_theme_version, get_template_directory_uri() . '/images/site.webmanifest')); ?>">
  <link rel="mask-icon" href="<?php echo esc_url(add_query_arg('v', $ddc_theme_version, get_template_directory_uri() . '/images/safari-pinned-tab.svg')); ?>" color="#e8408a">
  <link rel="dns-prefetch" href="https://i3.ytimg.com/" />
  <link rel="preconnect" href="https://www.googletagmanager.com/" />
  <link rel="preconnect" href="https://www.recaptcha.net/" />
  <link rel="preconnect" href="https://www.gstatic.com/" />


  <meta name="msapplication-TileColor" content="#e8408a">
  <meta name="msapplication-config" content="<?php echo esc_url(add_query_arg('v', $ddc_theme_version, get_template_directory_uri() . '/images/browserconfig.xml')); ?>">
  <meta name="theme-color" content="#e8408a">

  <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/fonts/Poppins-Regular.woff" as="font" type="font/woff" crossorigin>
  <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/fonts/Poppins-Bold.woff" as="font" type="font/woff" crossorigin>
  <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/fonts/Poppins-SemiBold.woff" as="font" type="font/woff" crossorigin>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100..900&family=Six+Caps&display=swap" rel="stylesheet">

  <?php wp_head(); ?>
  <meta property="og:image" content="https://talentcenterddc.nl/wp-content/uploads/2025/12/faq-talent-center-ddc.jpg" />
  <script>
    window.dataLayer = window.dataLayer || [];
    const gtag = (arguments) => {
      dataLayer.push(arguments);
    }

    const ad_storage = localStorage.getItem('ad_storage'),
      personalization_storage = localStorage.getItem('personalization_storage'),
      analytics_storage = localStorage.getItem('analytics_storage');

    let showCookieBar = false;


    if (ad_storage === null && personalization_storage === null && analytics_storage === null) {
      showCookieBar = true;
    } else if (analytics_storage !== null && analytics_storage == 'granted') {
      localStorage.setItem('analytics_granted', true);
    }

    localStorage.setItem('show_cookiebar', showCookieBar);

    gtag('consent', 'default', {
      'ad_storage': 'denied',
      'ad_user_data': 'denied',
      'ad_personalization': 'denied',
      'analytics_storage': 'denied',
      'personalization_storage': 'denied',
    });

    gtag('set', 'ads_data_redaction', true);

    if (ad_storage !== null && personalization_storage !== null && analytics_storage !== null) {

      gtag('consent', 'update', {
        'ad_storage': (ad_storage ? ad_storage : 'denied'),
        'ad_user_data': (ad_storage ? ad_storage : 'denied'),
        'ad_personalization': (ad_storage ? ad_storage : 'denied'),
        'analytics_storage': (analytics_storage ? analytics_storage : 'denied'),
        'personalization_storage': (personalization_storage ? personalization_storage : 'denied'),
      });

      dataLayer.push({
        'event': 'cookie_consent_update'
      });

      if (ad_storage === 'granted') {
        dataLayer.push({
          'event': 'cookie_consent_marketing'
        });
      }

      if (personalization_storage === 'granted') {
        dataLayer.push({
          'event': 'cookie_consent_preferences'
        });
      }

      if (analytics_storage === 'granted') {
        dataLayer.push({
          'event': 'cookie_consent_statistics'
        });
      }


    }


    if (showCookieBar) {

      document.addEventListener('DOMContentLoaded', () => {
        const introText = document.querySelector('#intro .effect');
        if (introText) {
          introText.style.opacity = 1;
          introText.style.animation = '';
          introText.style.transition = 'none';
        }
      });
    }
  </script>
 <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MS4J23HR');</script>
<!-- End Google Tag Manager -->
</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MS4J23HR"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
