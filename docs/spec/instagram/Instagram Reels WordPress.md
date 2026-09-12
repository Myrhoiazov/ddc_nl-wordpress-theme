Реализуй Instagram Reels integration для WordPress согласно спецификации Instagram Reels Module.

Главная цель:

Получать Reels нашего Instagram Professional Account через официальный Instagram API, кешировать данные локально в WordPress и выводить максимум 12 последних Reels на главной странице через существующий slider сайта.

Ключевое поведение frontend:

- максимум 12 Reels;
- newest first;
- использовать существующий slider;
- первый click/tap по Reel запускает видео inline;
- видео всегда запускается без звука;
- `muted = true`;
- `playsinline`;
- второй click/tap по уже активному Reel открывает его `permalink` в Instagram;
- одновременно играет максимум одно видео;
- swipe/drag slider не должен считаться click;
- если `media_url` отсутствует или video playback невозможен, показывай thumbnail и открывай Instagram permalink;
- никаких Instagram API requests при обычном render главной страницы.

Архитектура должна быть модульной и изолированной:

```text
Instagram API
→ API client
→ sync service
→ local repository/cache
→ feed service
→ WordPress template
→ existing slider
→ isolated JS behaviour
```

## Очень важно: сначала Discovery

Пока НЕ изменяй код.

Сначала выполни только discovery + implementation planning.

Порядок поиска ОБЯЗАТЕЛЬНЫЙ:

1. Graphify.
2. `rg`.
3. targeted reads найденных файлов.
4. Full-file read только если действительно необходим.

Не сканируй весь repository.

Не загружай всю тему в context.

Не читай все PHP/SCSS/JS файлы подряд.

Найди только релевантные зависимости.

Нужно определить:

1. Где находится homepage template.
2. Как устроены существующие frontend components.
3. Какой slider/carousel уже используется.
4. Где этот slider инициализируется.
5. Как подключаются JS assets.
6. Как подключаются SCSS/CSS assets.
7. Какие существуют breakpoints.
8. Какие существуют design variables/tokens.
9. Как проект организует PHP services/classes.
10. Используется ли namespace/autoload.
11. Как проект хранит configuration/secrets.
12. Есть ли уже Instagram-related code.
13. Используются ли WordPress Options API / Transients / custom cache.
14. Есть ли существующий WP-Cron pattern.
15. Есть ли REST/AJAX infrastructure.
16. Как в проекте делается logging.
17. Какие тесты существуют.
18. Какие `package.json` / Composer scripts доступны.
19. Какой integration point минимально необходим для homepage.
20. Какие файлы будут реально затронуты.

Особенно проверь:

```bash
rg -n "instagram|swiper|slick|splide|carousel|slider|wp_schedule_event|wp_cron|transient|get_option|update_option" <relevant paths>
```

Не выполняй blind search по vendor/node_modules/build directories.

## После discovery дай мне:

### 1. Existing architecture

Кратко опиши найденный pattern.

### 2. Dependency map

В формате примерно:

```text
Homepage template
    ↓
existing Instagram section / component
    ↓
existing slider
    ↓
JS entrypoint
    ↓
SCSS module
```

и отдельно:

```text
WordPress bootstrap
    ↓
services
    ↓
cron/cache/config
```

### 3. Files involved

Раздели:

```text
Existing files to modify
New files to add
Files inspected but not modified
```

### 4. Reuse analysis

Что можно переиспользовать:

- slider;
- styles;
- config;
- cron;
- cache;
- services;
- error handling;
- tests.

### 5. Proposed module boundaries

Покажи ответственность:

```text
InstagramApiClient
InstagramSyncService
InstagramRepository
InstagramFeedService
Presentation
Frontend controller
```

Но адаптируй это под существующую архитектуру.

Не навязывай новую архитектуру, если проект уже имеет хороший pattern.

### 6. Cache recommendation

На основании существующего проекта выбери:

```text
WordPress Option
Transient
Custom table
existing cache abstraction
```

и коротко объясни выбор.

Не создавай custom DB table без реальной необходимости.

Для максимум 12 Reel предпочтение отдаётся простому local cache, если архитектура проекта это позволяет.

### 7. Implementation plan

Составь пошаговый vertical migration plan.

Пример:

```text
1. API client
2. normalization
3. repository/cache
4. sync
5. cron
6. server-rendered block
7. existing slider integration
8. video controller
9. failure fallback
10. tests
```

Каждый шаг должен оставлять приложение в рабочем состоянии.

### 8. Verification plan

Для каждого этапа укажи минимальную проверку.

Сначала narrow check.

Не запускай сразу весь CI без необходимости.

---

После завершения discovery ОСТАНОВИСЬ.

НЕ начинай implementation в том же шаге.

Жду сначала:

```text
discovery
dependency map
reuse analysis
implementation plan
test plan
```

После подтверждения/следующего задания начнём implementation.

---

## Ограничения будущей implementation

Когда начнётся implementation:

- работать только с найденными релевантными файлами;
- не менять unrelated code;
- не делать opportunistic refactoring;
- не менять public contracts без необходимости;
- не придумывать новую стилистику;
- наследовать существующие styles;
- переиспользовать существующий slider;
- не подключать новую slider library;
- не подключать второй экземпляр уже используемой библиотеки;
- не добавлять React/Vue, если их нет;
- не использовать scraping Instagram;
- не передавать access token frontend;
- не делать Instagram API request на page render;
- не очищать cache при sync failure;
- не хранить raw API response без необходимости;
- не загружать все MP4 при первом render;
- использовать lazy video source, если это совместимо с текущей архитектурой;
- сохранить `permalink` как canonical Instagram link;
- сохранить `media_url` как refreshable cached asset URL;
- учитывать отсутствие `media_url`;
- максимум 12 Reel;
- только Reels;
- newest first.

## Performance contract

На обычном запросе homepage:

```text
Instagram HTTP requests = 0
```

Внешняя сеть Instagram не должна быть частью critical rendering path.

## Security contract

Secrets:

```text
server-side only
```

Не допускаются:

```text
HTML
JS
REST response
git
logs
```

с access token.

## Frontend state contract

```text
IDLE
  ↓ first click
PLAYING
  ↓ second click
OPEN INSTAGRAM
```

При клике на другой Reel:

```text
current video pause
new video play muted
```

При slider drag:

```text
no play
no redirect
```

При отсутствующем video URL:

```text
thumbnail
↓ click
Instagram
```

## Failure contract

```text
Instagram API failed
→ keep last successful cache
→ log server-side
→ homepage continues working
```

Никогда не очищай working cache из-за temporary API failure.

## Token/context efficiency

Следуй правилам проекта по экономии LLM context:

```text
Graphify
→ rg
→ targeted read
→ edit
→ git diff
→ narrow test
```

Не перечитывай неизменённые файлы.

После изменения используй `git diff`, а не повторное чтение всего файла, когда этого достаточно.

Корректность имеет приоритет над экономией токенов, если дополнительный context действительно необходим.