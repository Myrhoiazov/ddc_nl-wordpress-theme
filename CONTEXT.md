# DDC NL Project Context

Project and domain knowledge for the Talent Center DDC NL WordPress theme —
what an agent needs to know to understand the project correctly. For agent
operating rules, see `AGENTS.md`; for local setup, see `README.md`.

## Domain Language

This section describes the public language for the site. Use these terms
when naming user-facing content and discussing site changes, especially
after the move away from the older event branding.

**Talent Center DDC**:
The dance school brand presented to students, parents, and partners. Use this for the organization name on public pages.
_Avoid_: Legacy event branding

**DDC NL**:
The short project and theme label for the Netherlands site. Use this as the neutral replacement for legacy event references in code-facing labels or compact UI copy.
_Avoid_: Legacy event branding

**Dance Style**:
A class direction offered by the school, such as Kids Dance, Hip-Hop, Contemporary, Jazz Funk, or Street Jazz. Do not use the school brand as a dance style unless the business explicitly names a program that way.
_Avoid_: Event category, camp type

**Schedule**:
The public view of cities, groups, and class times where visitors decide which location or lesson fits them. Treat schedule content as enrollment-oriented.
_Avoid_: Timetable dump, event agenda

**Location**:
A physical city or studio place where Talent Center DDC classes happen. Location names should be specific enough for parents to recognize which one they mean.
_Avoid_: Venue, stage, camp city, Branch, Филиал

**Choreographer**:
A teacher or dance professional presented through profile and video pages. Use this term for artist/teacher profile content, not for general staff.
_Avoid_: Performer, ambassador, master

**Team Member**:
A person presented as part of the school team but not necessarily as a choreographer profile. Use this for staff/support/team sections.
_Avoid_: Choreographer, partner

**Partner**:
An external organization or supporter displayed on the site. Partners are distinct from locations, teachers, and team members.
_Avoid_: Sponsor when the relationship is not explicitly sponsorship

**FAQ**:
A question-and-answer item that reduces uncertainty for parents and students. FAQ copy should stay practical and enrollment-focused.
_Avoid_: Help article, blog post

**Blog Post**:
A standard WordPress `post` shown on the site's blog listing and single pages (`templates/news-template.php`, `single.php`). Not a custom post type.
_Avoid_: Article, news item

**Content Type**:
The editorial format of a Blog Post — Статья (Article), Новость (News), or Анонс (Announcement) by default, extensible in code. Independent from Category, which groups Blog Posts by topic/rubric rather than format.
_Avoid_: Post type, category, rubric

**Generation Batch**:
One submission of Topic, Content Type, and Context to the AI Черновики generator, producing one Blog Post per Site Language.
_Avoid_: Generation request, batch job

**AI Draft**:
A Blog Post created by the AI Черновики generator rather than written directly by an editor. Every AI Draft starts as `draft` in all Site Languages from the same Generation Batch, and needs an editor to add a Category and featured image before publishing.
_Avoid_: AI-generated post, auto post

**Agreement**:
The class agreement and payment mandate shown as a multilingual web page. Use this term for the formal enrollment contract.
_Avoid_: PDF contract, terms page

**Trial Lesson**:
The first introductory class used as the main conversion action for new students. Use this as the default call to action when inviting families to start.
_Avoid_: Free class unless it is explicitly free

**Contact Request**:
A submitted lead or message from a visitor through the site forms. It may include preferred messenger details and should be treated as private customer communication.
_Avoid_: Telegram message, ticket

**Site Language**:
One of the languages a visitor can browse Talent Center DDC content in (Russian, Dutch, Ukrainian, English). Content and navigation for a Site Language are only shown to visitors once that language meets its Launch Baseline.
_Avoid_: Locale, translation, language version

**Default Language**:
The Site Language served at the site's root address without a language prefix. Which Site Language holds this role can change over time as other languages reach their Launch Baseline — it is not a fixed identity of one language.
_Avoid_: Primary language, canonical language

**Launch Baseline**:
The minimum set of pages and content a Site Language must have translated before that language is shown to visitors and opened to search engines.
_Avoid_: Core pages, MVP translation

## Related Documentation

These terms are the source vocabulary for the specs and decisions below —
read the relevant one when a task actually touches that area:

- `docs/spec/multilingual/MULTILINGUAL_SPEC.md` — the multilingual system contract (Polylang, per-language content, translated CPTs).
- `docs/spec/multilingual/GLOSSARY.md` — NL/RU/UK/EN term translations, sourced from this file.
- `docs/spec/camp/LITO_DANCE_CAMP_2027_SPEC.md` — the `/camp/` landing page contract.
- `docs/adr/0001-polylang-for-multilingual.md` — why Polylang over WPML or a custom i18n layer.
- `docs/adr/0002-russian-default-language-until-dutch-parity.md` — why Russian, not Dutch, is the current Default Language.
- `docs/adr/0003-locations-and-schedule-not-translated.md` — why `locations`/`schedule` are exceptions to per-language content.
- `docs/adr/0004-no-flags-in-language-switcher.md` and `docs/adr/0005-language-switcher-uses-short-codes.md` — why the language switcher looks the way it does.
- `docs/adr/0006-aioseo-write-via-model-not-filters.md` — why AI Draft SEO fields are written through AIOSEO's model instead of its render filters.
- `docs/adr/0007-llm-authored-slug-for-ai-drafts.md` — why an AI Draft's SEO-URL comes from the LLM instead of `sanitize_title()`.
- `docs/adr/0008-ai-drafts-always-generate-all-languages.md` — why a Generation Batch always produces all four Site Language AI Drafts.
