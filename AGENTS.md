# Инструкции для агента — DDC NL WordPress Theme

Этот файл задает правила для AI-агентов и разработчиков, работающих с WordPress-темой `ddc_nl`.

## 1. Контекст проекта

- **Бренд и термины**: перед изменением публичных текстов, названий страниц, шаблонов или доменной терминологии прочитайте `CONTEXT.md`. Используйте актуальные названия `Talent Center DDC` и `DDC NL`.
- **README как входная точка**: перед настройкой репозитория, секретов или локального окружения проверьте `README.md`.
- **Боевой сайт**: изменения в шаблонах, хуках, стилях и ассетах должны быть минимальными и проверяемыми. Не переименовывайте публичные slug, template name, CSS/JS id или class без проверки их использования в PHP, JS, SCSS и WordPress-админке.

## 2. Контроль версий и GitHub

- **Репозиторий**: remote `origin` должен указывать на `git@github.com:Myrhoiazov/ddc_nl-wordpress-theme.git`.
- **Основная ветка**: `main` подготовлена как чистый initial commit без старой истории проекта. Не возвращайте legacy remote и не пушьте старую историю.
- **Перед коммитом**: выполните `git status --short --branch` и проверьте, что в индекс не попали секреты, приватные медиа, `.DS_Store`, `.env`, `node_modules/`, `images/` или `videos/`.
- **Сообщения коммитов**: используйте понятные сообщения. Для обычной разработки предпочтительны Conventional Commits: `feat:`, `fix:`, `chore:`, `refactor:`.
- **Push в main**: перед push в `main` поднимите версию темы, сделайте release commit и поставьте соответствующий Git tag. Пушьте только после проверок. Если сеть заблокирована песочницей, повторите `git push` с запросом разрешения.

## 3. Структура темы

- **PHP**: `functions.php`, `includes/`, `templates/`, `page-templates/`, `parts/`, `header*.php`, `footer*.php`, `home.php`, `single*.php`.
- **Стили**: исходники находятся в `scss/`, собранные файлы в `style.css`, `css/` и `style.css.map`.
- **JavaScript**: проектные скрипты находятся в `js/`. Минифицированные сторонние библиотеки не переписывайте без необходимости.
- **Медиа**: `images/` и `videos/` являются локальным контентом и намеренно не отслеживаются Git.

## 4. Безопасность и приватные данные

- **Секреты вне темы**: не храните токены, пароли, ключи API, Telegram credentials, настройки базы данных и приватные URL в файлах темы.
- **Где хранить секреты**: используйте `wp-config.php`, переменные окружения или настройки хостинга. Тема ожидает `TELEGRAM_TOKEN` и `TELEGRAM_CHAT_ID` как constants или env values.
- **Медиа вне Git**: не добавляйте `images/` и `videos/` через `git add -f` и не переносите приватный/лицензионный контент в отслеживаемые директории.
- **Legacy branding**: не возвращайте старые бренды, старые домены и устаревшие идентификаторы. После массовых замен проверяйте весь код через `rg`.

## 5. Проверки перед релизом

- **PHP lint**: для измененных PHP-файлов запускайте `php -l`.
- **Template lint**: после правок шаблонов проверяйте `templates/`, `page-templates/`, `parts/`, `includes/`, `home.php`, `header*.php`, `footer*.php`.
- **JS syntax**: для измененных проектных JS-файлов запускайте `node --check`, кроме сторонних минифицированных библиотек.
- **Version bump**: перед push в `main` обновите `Version:` в `style.scss`, `style.css` и `css/style.css`. Затем создайте release commit вида `chore: release X.Y.Z` и tag `vX.Y.Z`.
- **Brand scan**: перед коммитом проверяйте отсутствие legacy strings. Не сохраняйте сами legacy-строки в документации; используйте временный локальный список или placeholder-ы:
  ```bash
  rg -n -uu -i "<legacy-token-1>|<legacy-token-2>" . --glob '!.git/**' --glob '!node_modules/**'
  ```
- **Secret scan**: перед push выполните целевой поиск по staged или committed tree на токены, ключи и пароли.

## 6. Инструкции для Claude/Codex

- **Единый источник**: `CLAUDE.md` должен оставаться короткой ссылкой на этот файл. Основные правила поддерживайте здесь, чтобы не расходились инструкции между агентами.
- **Commit attribution**: never add `Co-authored-by`, `Generated-by`, `--co-author`, AI attribution trailers, or similar metadata to commits unless the user explicitly asks for it.
