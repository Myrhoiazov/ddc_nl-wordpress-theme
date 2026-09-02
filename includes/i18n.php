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
    ];

    $lang = $lang !== null ? ddc_normalize_language_code($lang) : ddc_get_current_language();
    $entry = $strings[$key] ?? null;

    if ($entry === null) {
        return $key;
    }

    return $entry[$lang] ?? $entry['ru'];
}
