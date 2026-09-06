<?php
/**
 * Language helpers shared across theme code that needs to know the current
 * site language before Polylang is installed. Once Polylang is active,
 * ddc_get_current_language() picks it up automatically via pll_current_language() —
 * call sites never need to change.
 */

function ddc_normalize_language_code($raw): string
{
    $code = strtolower(substr((string) $raw, 0, 2));
    $allowed = ['ru', 'nl', 'uk', 'en'];

    return in_array($code, $allowed, true) ? $code : 'ru';
}

// NOTE: the 'ru' fallback below assumes the WP site locale is Russian; verify against production before/at deploy.
function ddc_get_current_language(?string $requested = null): string
{
    if ($requested !== null && $requested !== '') {
        return ddc_normalize_language_code($requested);
    }

    if (function_exists('pll_current_language')) {
        $pll_lang = pll_current_language();
        if ($pll_lang) {
            return ddc_normalize_language_code($pll_lang);
        }
    }

    return 'ru';
}

function ddc_get_city_display_name(string $city_key, ?string $lang = null): string
{
    static $names = [
        'amsterdam' => ['ru' => 'Амстердам', 'uk' => 'Амстердам', 'nl' => 'Amsterdam', 'en' => 'Amsterdam'],
        'rotterdam' => ['ru' => 'Роттердам', 'uk' => 'Роттердам', 'nl' => 'Rotterdam', 'en' => 'Rotterdam'],
        'apeldoorn' => ['ru' => 'Апелдорн',  'uk' => 'Апелдорн',  'nl' => 'Apeldoorn', 'en' => 'Apeldoorn'],
        'arnhem'    => ['ru' => 'Арнем',     'uk' => 'Арнем',     'nl' => 'Arnhem',    'en' => 'Arnhem'],
        'utrecht'   => ['ru' => 'Утрехт',    'uk' => 'Утрехт',    'nl' => 'Utrecht',   'en' => 'Utrecht'],
        'denhaag'   => ['ru' => 'Гаага',     'uk' => 'Гаага',     'nl' => 'Den Haag',  'en' => 'The Hague'],
    ];

    $lang = $lang !== null ? ddc_normalize_language_code($lang) : ddc_get_current_language();
    $city = $names[$city_key] ?? null;

    if ($city === null) {
        return ucfirst($city_key);
    }

    return $city[$lang] ?? $city['ru'];
}

/**
 * Small static UI-string lookup for text hardcoded directly in template files
 * (not wrapped in __()/_e() — this theme has no working gettext pipeline for
 * page content, per docs/spec/multilingual/MULTILINGUAL_SPEC.md section 3).
 * Same pattern as ddc_get_city_display_name() above: a plain array keyed by a
 * short slug, not a gettext .po/.mo setup — appropriate for the handful of
 * static headings/labels this theme actually has outside post content, not a
 * substitute for gettext if that list grows much larger.
 */
function ddc_ui_text(string $key, ?string $lang = null): string
{
    static $strings = [
        'contact_studios_heading' => ['ru' => 'Наши студии', 'uk' => 'Наші студії', 'nl' => 'Onze studio\'s', 'en' => 'Our studios'],
        'contact_write_heading'   => ['ru' => 'Напишите нам', 'uk' => 'Напишіть нам', 'nl' => 'Schrijf ons', 'en' => 'Get in touch'],
        'contact_open_maps'       => ['ru' => 'Открыть в Google Maps →', 'uk' => 'Відкрити в Google Maps →', 'nl' => 'Openen in Google Maps →', 'en' => 'Open in Google Maps →'],
        'contact_modal_title'     => ['ru' => 'Свяжитесь с нами', 'uk' => 'Зв\'яжіться з нами', 'nl' => 'Neem contact op', 'en' => 'Contact us'],
    ];

    $lang = $lang !== null ? ddc_normalize_language_code($lang) : ddc_get_current_language();
    $entry = $strings[$key] ?? null;

    if ($entry === null) {
        return $key;
    }

    return $entry[$lang] ?? $entry['ru'];
}

/**
 * The contact modal's CF7 form (id 7a094fd, see parts/modals/contact.php) is a
 * single WordPress-admin-edited form shared by every Site Language — its
 * labels/placeholders/button are authored in Russian only and CF7 has no
 * per-language variant here. This does literal string substitution on the
 * rendered form HTML to localize the visible text for nl/uk/en, leaving the
 * ru original (and the Telegram/WhatsApp/Email option labels, which are brand
 * names, not translated) untouched. Scoped to this one form's markup —
 * not a general-purpose CF7 filter.
 */
function ddc_localize_cf7_form_html(string $html, ?string $lang = null): string
{
    $lang = $lang !== null ? ddc_normalize_language_code($lang) : ddc_get_current_language();

    if ($lang === 'ru') {
        return $html;
    }

    static $strings = [
        ['ru' => 'Ваше имя',                         'uk' => 'Ваше ім\'я',                            'nl' => 'Uw naam',                          'en' => 'Your name'],
        ['ru' => 'Ваш электронный адрес',            'uk' => 'Ваша електронна адреса',                'nl' => 'Uw e-mailadres',                   'en' => 'Your email address'],
        ['ru' => 'Электронный адрес',                'uk' => 'Електронна адреса',                     'nl' => 'E-mailadres',                      'en' => 'Email address'],
        ['ru' => 'Тема сообщения',                   'uk' => 'Тема повідомлення',                     'nl' => 'Onderwerp',                        'en' => 'Subject'],
        ['ru' => 'Ваше сообщение',                    'uk' => 'Ваше повідомлення',                     'nl' => 'Uw bericht',                       'en' => 'Your message'],
        ['ru' => 'Как с вами удобнее связаться?',    'uk' => 'Як з вами зручніше зв\'язатися?',       'nl' => 'Hoe kunnen we u het beste bereiken?', 'en' => 'How would you like to be contacted?'],
        ['ru' => 'Телефон (привязан к мессенджеру)', 'uk' => 'Телефон (прив\'язаний до месенджера)', 'nl' => 'Telefoonnummer (bij de messenger)', 'en' => 'Phone (linked to messenger)'],
        ['ru' => 'Отправить',                         'uk' => 'Надіслати',                             'nl' => 'Verzenden',                        'en' => 'Send'],
    ];

    foreach ($strings as $entry) {
        $target = $entry[$lang] ?? null;
        if ($target !== null && $target !== $entry['ru']) {
            $html = str_replace($entry['ru'], $target, $html);
        }
    }

    return $html;
}
