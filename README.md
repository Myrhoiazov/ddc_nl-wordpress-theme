# DDC NL WordPress Theme

Custom WordPress theme for the Talent Center DDC NL website.

## Project Context

Read [CONTEXT.md](./CONTEXT.md) before changing public copy, page names, or domain language. The site now uses the `Talent Center DDC` / `DDC NL` naming and should not reintroduce legacy event branding.

## Theme Structure

- `functions.php` - theme setup, assets, structured data, admin cleanup, and integrations.
- `templates/` - custom WordPress page templates.
- `page-templates/` - WooCommerce-related page templates.
- `parts/` - reusable template parts for headers, footer, forms, home sections, and modals.
- `includes/` - custom post types and taxonomies.
- `scss/` - source styles.
- `css/`, `js/`, `fonts/` - front-end assets used by the theme.

## Local Setup

Place this folder in:

```text
wp-content/themes/ddc_nl
```

Install JavaScript dependencies only when needed:

```bash
npm install
```

`node_modules/` is intentionally ignored and should not be committed.

## Secrets

Do not store secrets in this theme. Keep production values in `wp-config.php`, server environment variables, or hosting-level secret storage.

Current private configuration expected by the theme:

```php
define('TELEGRAM_TOKEN', '...');
define('TELEGRAM_CHAT_ID', '...');
```

The theme can also read these values from environment variables named `TELEGRAM_TOKEN` and `TELEGRAM_CHAT_ID`.

## Media Content

The `images/` and `videos/` folders are intentionally ignored so private or licensed content is not pushed to GitHub. Keep production media in WordPress uploads, deployment storage, or a private asset pipeline.

## GitHub Repository

This theme is connected to:

```text
git@github.com:Myrhoiazov/ddc_nl-wordpress-theme.git
```

The local `main` branch was prepared as a clean initial commit so legacy project history is not pushed to the new repository.

To check the current repository setup:

```bash
git remote -v
git status --short --branch
```

To publish changes:

```bash
git status --short
git add -A
git commit -m "Describe your change"
git push -u origin main
```

Check `git status --ignored` if you need to confirm that local secrets and media are hidden.
