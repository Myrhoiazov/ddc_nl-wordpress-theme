---
name: e2e-test
description: Browser QA for the DDC NL WordPress theme on local XAMPP or a supplied URL. Use before PR when templates, forms, front-end JavaScript, SCSS/CSS, navigation, or public WordPress pages changed, and ad hoc to reproduce a reported UI/visual bug without full automated test coverage.
---

# DDC NL Browser QA

Use this skill to verify user-facing behavior for the DDC NL WordPress theme, whether checking a diff before a PR or reproducing a bug report on demand. It complements static checks; it does not replace PHP lint, JS syntax checks, review, or brand/secret scans.

## Inputs

Before testing, read:

- `AGENTS.md`
- `README.md`
- `CONTEXT.md` when public copy or labels changed

## Base URL

Determine the base URL from the user, local WordPress/XAMPP configuration, or a running local server. Common local candidates:

- `http://localhost/ddc_nl/`
- `http://127.0.0.1/ddc_nl/`
- A URL supplied by the user

For local XAMPP, prefer checking the existing site instead of restarting services.

1. Probe the likely local URL with `curl -I` or a browser navigation.
2. If the site is unavailable, identify the missing prerequisite without stopping unrelated services.
3. Do not edit secrets or WordPress configuration to make QA pass.

If no URL can be discovered, report that browser QA is blocked and continue with static verification.

Completion criterion: a reachable base URL is known, or the blocker is documented.

## Pages to Check

When verifying a diff, choose pages affected by it first. When reproducing a reported bug, start with the page where the issue occurs. When unsure, include:

- Home page.
- Schedule or location page if enrollment/navigation changed.
- Trial Lesson or contact form page if forms/CTA changed.
- Agreement page if formal copy/templates changed.
- Any changed custom template under `templates/`, `page-templates/`, or `parts/`.

Completion criterion: every changed or reported user-facing path has at least one rendered-page check.

## Browser Assertions

Use browser automation or manual inspection to verify:

- The page renders without visible PHP warnings, raw shortcodes, or broken markup.
- Header/footer/navigation are present and menus/CTA links target the expected pages.
- No new console errors appear during load and primary interactions.
- Network requests for changed interactions do not fail unexpectedly.
- Forms can be filled and validated with test data, without sending real private customer data unless the user explicitly approves a live submission.
- Desktop and mobile viewports remain readable when layout changed.
- Public text follows `Talent Center DDC` / `DDC NL` terminology from `CONTEXT.md`.

Prefer DOM assertions for exact checks and screenshots for layout evidence.

## Safety

- Contact requests are private customer communication. Use test data and stop before live submission unless the task specifically requires submission testing and the user approved it.
- If Telegram integration is involved, verify configuration presence without exposing token values, chat IDs, database credentials, or private URLs.
- Do not add files from `images/` or `videos/` to Git.
- Do not stop or restart XAMPP services unless the user explicitly approves it.

## Cleanup

Close pages opened for testing when using browser automation. Leave the user's existing browser tabs and local services alone.

## Reporting

Report:

- Base URL tested.
- Pages and viewports checked.
- Console/network/form findings.
- Any skipped checks and why.

Completion criterion: the report gives enough detail for another agent or human to reproduce the QA result.
