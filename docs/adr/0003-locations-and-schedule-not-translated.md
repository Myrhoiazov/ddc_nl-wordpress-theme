# Locations and Schedule are not translated per Site Language

`locations` and `schedule` hold address, pricing, and class-time data that is factually identical regardless of the visitor's Site Language, unlike `choreographer`, `styles`, `team`, and `faq`, which hold genuinely language-specific marketing copy. We excluded `locations` and `schedule` from Polylang's per-language post duplication, keeping each as a single source of truth, and instead added a small set of per-language display-name fields on `locations` for the city name (e.g. transliterated Cyrillic forms for Russian/Ukrainian visitors). Duplicating these posts per language would let address or price drift out of sync across four copies with no corresponding benefit, since the underlying facts don't vary by language.

**Consequences**: don't "fix" these two post types to look like the other translated CPTs by enabling Polylang translation on them — the asymmetry with `choreographer`/`styles`/`team`/`faq` is intentional.
