# Use Polylang (free) with language-prefixed URLs for site-wide multilingual

The site had no multilingual plugin and only one bespoke pattern: `templates/agreement-template.php` inlines all languages in one DOM and toggles visibility with JS. We chose Polylang (free tier), with a language prefix in the URL (`/nl/`, `/ru/`, `/uk/`, `/en/`), for the rest of the site instead of extending that inline-toggle pattern, adopting WPML, or building a custom rewrite-based solution. Polylang Free already covers what we need — per-language URLs, automatic hreflang tags, and field/image synchronization between translations — at no license cost; the inline-toggle approach doesn't scale past a single funnel page (it duplicates markup per language and produces no separate indexable URLs).

**Considered options**: extending the Agreement page's inline `data-lang` toggle site-wide; WPML (paid); a fully custom rewrite-based i18n layer in the theme.

**Consequences**: the Agreement page keeps its own separate multilingual pattern permanently — a deliberate exception, not something left unmigrated by oversight.
