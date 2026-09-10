# Agent Instructions — DDC NL WordPress Theme

Operating contract for AI agents working in this repository. This file tells
an agent **how to work here** — for project knowledge, setup, or specialized
contracts, follow the routing below instead of reading everything up front.

## Purpose

Answer: *how should an agent behave in this repository?* This is not a
project encyclopedia — domain knowledge lives in `CONTEXT.md`, human setup in
`README.md`, and detailed contracts in `docs/`.

## Sources of Truth

Each kind of information has exactly one canonical home. If two documents
seem to disagree, the row below wins for that kind of information.

| Information | Canonical source |
|---|---|
| Agent operating rules | `AGENTS.md` (this file) |
| Human setup / project entry | `README.md` |
| Domain terminology / public-copy rules | `CONTEXT.md` |
| Multilingual system contract | `docs/spec/multilingual/MULTILINGUAL_SPEC.md`, `docs/spec/multilingual/GLOSSARY.md` |
| Camp landing page contract | `docs/spec/camp/LITO_DANCE_CAMP_2027_SPEC.md` |
| Locked architecture/product decisions | `docs/adr/*.md` |
| Planned refactors | `docs/roadmap/*.md` |
| Step-by-step execution procedure | `.agents/skills/*/SKILL.md` |
| End-to-end task coordination | `.agents/agents/dev-loop.md` |
| Claude-specific adapter | `CLAUDE.md` — stays a thin pointer to this file; do not duplicate rules there |

## Mandatory Rules (Always)

These apply regardless of task type:

- Always respond to the user in Russian, regardless of the language of the
  task, the code, or this file.
- This is a production site. Changes to templates, hooks, styles, and assets
  must be minimal and verifiable. Never rename a public slug, template name,
  or CSS/JS id/class without checking every PHP, JS, SCSS, and
  WordPress-admin usage first.
- Before changing public copy, page names, templates, or domain terminology,
  read `CONTEXT.md` and use the current `Talent Center DDC` / `DDC NL`
  naming — never reintroduce legacy event branding.
- Never store tokens, passwords, API keys, Telegram credentials, database
  settings, or private URLs in theme files. They belong in `wp-config.php`,
  environment variables, or hosting-level secret storage — see README's
  "Secrets" section for the exact variables this theme reads.
- `images/` and `videos/` are intentionally untracked. Never `git add -f`
  them and never move private/licensed content into a tracked directory.
- `origin` must stay `git@github.com:Myrhoiazov/ddc_nl-wordpress-theme.git`.
  `main` was seeded as a clean initial commit — never restore or push the
  old project history.
- Never add `Co-authored-by`, `Generated-by`, `--co-author`, or other AI
  attribution trailers to commits unless the user explicitly asks for it.
- Run `git status --short --branch` before committing and confirm no
  secrets, private media, `.DS_Store`, `.env`, or `node_modules/` are staged.

## Context Loading

Read the smallest relevant context required to complete the task safely and
correctly — do not read the whole repository's documentation for every task.

```text
Task
 ↓
Read AGENTS.md
 ↓
Inspect repository state
 ↓
Classify task
 ↓
Load only relevant context
 ↓
Inspect relevant code
 ↓
Implement
 ↓
Validate
```

Routing — load the doc on the right only when the task actually touches that
topic:

```text
setup / local environment / repo layout / secrets
→ README.md

domain terminology / public-copy rules / brand language
→ CONTEXT.md

multilingual behavior (Polylang, per-language content, translated CPTs)
→ docs/spec/multilingual/MULTILINGUAL_SPEC.md, docs/spec/multilingual/GLOSSARY.md

why a multilingual/product decision was made the way it was
→ docs/adr/*.md

/camp/ landing page content or behavior
→ docs/spec/camp/LITO_DANCE_CAMP_2027_SPEC.md

this documentation architecture itself
→ docs/roadmap/REFACTOR_PROJECT_AI_CONTEXT_ARCHITECTURE.md

multi-file, risky, or unclear implementation work
→ .agents/skills/planning-and-task-breakdown/SKILL.md

end-to-end coordination from intake to PR
→ .agents/agents/dev-loop.md, .agents/skills/agent-loop/SKILL.md
```

Do not invent a route to a document that doesn't exist in this repository.

## Task Routing (Skills)

Skills load on demand — do not read a `SKILL.md` unless the task matches its
description below.

| Task looks like | Skill |
|---|---|
| Multi-file, risky, or unclear work; needs breaking into steps | `.agents/skills/planning-and-task-breakdown/SKILL.md` |
| Implementing a feature or bugfix (PHP, JS, hooks, forms, templates) | `.agents/skills/tdd/SKILL.md` |
| Work is implemented and ready to check before publishing | `.agents/skills/code-review/SKILL.md` |
| Templates, forms, front-end JS, SCSS/CSS, or navigation changed | `.agents/skills/e2e-test/SKILL.md` |
| User is reporting a bug conversationally / needs a filed issue | `.agents/skills/qa/SKILL.md` |
| Ready to branch, commit, push, and open a PR | `.agents/skills/pull-request/SKILL.md` |
| Coordinating the full loop end-to-end | `.agents/skills/agent-loop/SKILL.md` via `.agents/agents/dev-loop.md` |

## Conditional Rules

Only load the rules for the kind of change actually being made.

**When templates/PHP change**
- Run `php -l` on every changed PHP file.
- Re-check `templates/`, `page-templates/`, `parts/`, `includes/`,
  `home.php`, `header*.php`, `footer*.php` for anything the change touches.

**When styles change**
- Source lives in `scss/`; never hand-edit a compiled `.css` file — rebuild
  it: `sass style.scss style.css --style=compressed --source-map`.
- `css/` root holds third-party/vendor styles (Bootstrap, animate.css, etc.).
  `css/pages/style-<page>.scss` are the per-template stylesheets (only the
  active template's CSS loads, instead of every page shipping every
  template's styles) — rebuild each changed one the same way, e.g.
  `sass css/pages/style-home.scss css/pages/style-home.css --style=compressed --source-map`.
  Conditional loading lives in `functions.php`'s `bootstrap_script_init()`.

**When JavaScript changes**
- Run `node --check` on changed project files in `js/`.
- Don't rewrite minified third-party libraries unless there's a specific
  reason to.

**When public copy or branding changes**
- Read `CONTEXT.md` first.
- Before committing, scan for legacy strings. Don't store the legacy strings
  themselves in documentation — use a local placeholder list:
  ```bash
  rg -n -uu -i "<legacy-token-1>|<legacy-token-2>" . --glob '!.git/**' --glob '!node_modules/**'
  ```

**When releasing to `main`**
- Bump `Version:` in `style.scss` and rebuild `style.css` so the compiled
  file's version matches.
- Create a release commit `chore: release X.Y.Z` and tag `vX.Y.Z`.
- Run a targeted secret scan over the staged/committed tree before pushing.
- If the network is sandboxed, retry `git push` with permission rather than
  skipping it.

**When documentation changes**
- Verify every Markdown link in the changed file resolves to a file that
  actually exists in this repository (there is no `docs:links` script in
  `package.json` yet, so check manually).

## Workflow

1. Read this file.
2. Inspect repository state (`git status`, relevant files).
3. Classify the task using Context Loading + Task Routing above.
4. Load only the context that classification points to.
5. Inspect the relevant code before changing it.
6. Implement.
7. Validate (see below).

## Validation

- **PHP lint**: `php -l` on every changed PHP file.
- **Template check**: re-check `templates/`, `page-templates/`, `parts/`,
  `includes/`, `home.php`, `header*.php`, `footer*.php` after template edits.
- **JS syntax**: `node --check` on changed project JS (skip minified vendor
  libraries).
- **Version/build**: when releasing, bump `Version:` in `style.scss` and
  rebuild with `sass style.scss style.css --style=compressed --source-map`.
- **Brand scan**: before commit, confirm no legacy strings remain (see the
  placeholder `rg` command above).
- **Secret scan**: before push, target staged/committed files for tokens,
  keys, and passwords.

## Git and Pull Requests

- Commit messages should be clear; prefer Conventional Commits (`feat:`,
  `fix:`, `chore:`, `refactor:`) for normal development.
- Changes are published as pull requests on a feature branch, not pushed
  directly to `main` — see `.agents/skills/pull-request/SKILL.md` for the
  branch → commit → push → PR steps.
- Before pushing to `main`, follow the release checklist under "When
  releasing to `main`" above.

## Agents and Skills

- Primary flow for autonomous work: `.agents/skills/agent-loop/SKILL.md`. It
  covers intake, planning, TDD implementation, checks, review, browser QA,
  and PR publishing.
- `.agents/agents/dev-loop.md` is a thin wrapper over `agent-loop` — it must
  not duplicate the full process described there.
- Local skills are adapted to WordPress/XAMPP, the public language in
  `CONTEXT.md`, contact-request privacy, and the Git rules in this file.
- **Deploy gate**: production deploy is not yet automated in `.agents`. Add
  an explicit deploy contract before letting an agent run a deploy
  end-to-end.

## Definition of Done

A task is done when: it's implemented within scope, the relevant validation
in this file passes, code review has no blocking findings, browser QA is
complete when UI/template/JS/CSS behavior changed, and — when publishing was
requested — a pull request URL exists.
