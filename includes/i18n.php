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
