# Instagram Reels Module — WordPress E2E Specification

## 1. Цель

Реализовать для WordPress-сайта изолированный модуль интеграции с Instagram, который:

- подключается к Instagram Professional Account через официальный Instagram API;
- получает Reels указанного Instagram-аккаунта;
- сохраняет полученные данные локально в WordPress как кеш;
- не обращается к Instagram API при каждом открытии главной страницы;
- отображает максимум 12 последних Reels;
- выводит Reels в формате существующего слайдера сайта;
- наследует существующую стилистику темы;
- не создаёт отдельную дизайн-систему;
- позволяет воспроизводить видео непосредственно на сайте;
- запускает видео без звука;
- первый клик запускает Reel;
- повторный клик по уже активному Reel открывает оригинальный Reel в Instagram;
- корректно работает при недоступности Instagram API;
- не ломает страницу при отсутствии `media_url`;
- реализован end-to-end: API → cache → backend → frontend → interaction → fallback.

---

# 2. Основные требования

## 2.1 Instagram

Использовать официальный Instagram API.

Не использовать:

- HTML scraping instagram.com;
- неофициальные API;
- headless-browser scraping;
- iframe scraping;
- сторонние Instagram scraping SaaS без отдельного согласования;
- Instagram embed как основной механизм получения контента.

Интеграция должна работать только с аккаунтом, для которого есть корректная авторизация.

Предпочтительно использовать:

Instagram API with Instagram Login

для Professional Instagram Account.

Минимально необходимый read permission:

`instagram_business_basic`

Если текущая инфраструктура проекта уже использует Facebook Login / Meta Graph API, агент должен сначала проверить существующую реализацию и не создавать параллельную авторизацию без необходимости.

---

# 3. Discovery перед реализацией

До изменения кода агент обязан провести discovery.

Порядок:

1. Graphify.
2. `rg`.
3. targeted file reads.
4. Только затем implementation.

Нельзя начинать с чтения всей темы WordPress.

Нужно определить существующие:

- структуру темы;
- frontend entrypoints;
- PHP service classes;
- API clients;
- AJAX / REST patterns;
- cron implementation;
- admin settings;
- slider/carousel implementation;
- JS framework или vanilla JS pattern;
- SCSS/CSS architecture;
- naming conventions;
- WordPress hooks;
- caching patterns;
- custom database tables;
- options API usage;
- logging/error handling;
- frontend breakpoints;
- существующий Instagram block, если он уже существует.

Особенно проверить наличие:

- Swiper;
- Slick;
- Splide;
- Glide;
- Owl Carousel;
- собственного slider implementation.

Если slider library уже используется, переиспользовать её.

Не подключать новую slider dependency без необходимости.

---

# 4. Архитектурный принцип

Instagram функциональность должна быть отдельным bounded module.

Пример логической структуры:

```text
Instagram/
├── Application/
│   ├── InstagramSyncService.php
│   └── InstagramFeedService.php
│
├── Domain/
│   ├── InstagramMedia.php
│   ├── InstagramMediaRepository.php
│   └── InstagramMediaType.php
│
├── Infrastructure/
│   ├── InstagramApiClient.php
│   ├── WordPressInstagramRepository.php
│   └── InstagramCron.php
│
├── Presentation/
│   ├── InstagramBlock.php
│   ├── instagram-reels.php
│   └── assets/
│       ├── instagram-reels.js
│       └── instagram-reels.scss
│
└── InstagramModule.php
```

Это пример логической декомпозиции.

Не создавать такую физическую структуру автоматически, если она конфликтует с текущей архитектурой проекта.

Главное требование:

Instagram integration должна быть максимально локализована и не распределяться случайными функциями по теме.

---

# 5. Ответственности модулей

## InstagramApiClient

Отвечает только за работу с Instagram API.

Responsibilities:

- HTTP request;
- authorization;
- pagination при необходимости;
- response parsing;
- API error normalization;
- timeout;
- validation response.

Не должен:

- писать HTML;
- работать со slider;
- самостоятельно сохранять данные в WordPress;
- знать о frontend.

---

## InstagramSyncService

Оркестрирует процесс:

```text
Instagram API
    ↓
filter Reels
    ↓
normalize
    ↓
validate
    ↓
store cache
```

Responsibilities:

- получить media;
- выбрать только Reels;
- отсортировать по времени;
- ограничить количество;
- нормализовать response;
- передать данные repository;
- записать время последней успешной синхронизации.

---

## InstagramMediaRepository

Инкапсулирует хранение кеша.

Frontend и Presentation слой не должны знать, где физически хранится cache.

---

## InstagramFeedService

Возвращает готовые данные для frontend.

Например:

```php
$reels = $instagramFeedService->getLatest(12);
```

---

# 6. Какие Instagram поля получать

Минимальный набор:

```text
id
media_type
media_product_type
media_url
thumbnail_url
permalink
timestamp
caption
```

Дополнительно при необходимости:

```text
username
shortcode
```

Основной фильтр:

```text
media_product_type === REELS
```

Если API implementation проекта требует другую комбинацию полей, использовать эквивалентное официальное поле.

---

# 7. Domain model

Нормализованный Reel должен выглядеть примерно следующим образом:

```text
InstagramMedia

id
type
productType
videoUrl
thumbnailUrl
permalink
caption
publishedAt
syncedAt
```

PHP representation может быть DTO, value object или typed array в зависимости от существующей архитектуры.

Не внедрять новый архитектурный стиль только ради этого модуля.

---

# 8. Cache / Database

## Основной принцип

Главная страница не должна обращаться к Instagram API.

Flow:

```text
Instagram API
       ↓
scheduled sync
       ↓
WordPress DB
       ↓
InstagramFeedService
       ↓
homepage
```

---

# 9. Что хранить

Не хранить только одну ссылку.

Для каждого Reel хранить:

```text
instagram_media_id
permalink
media_url
thumbnail_url
caption
published_at
synced_at
media_type
media_product_type
```

`permalink` считать canonical Instagram URL.

`media_url` считать runtime asset URL, который может быть обновлён следующей синхронизацией.

---

# 10. Стратегия хранения

Перед созданием отдельной таблицы агент обязан проверить существующие project patterns.

Допустимые варианты:

### Option A — WordPress option / transient

Подходит, если:

- хранится только 12–20 объектов;
- данные используются только как cache;
- нет необходимости делать SQL queries по отдельным Reel.

Например:

```text
ddc_instagram_reels_cache
```

JSON/serialized normalized collection.

### Option B — custom table

Использовать только если проект уже применяет repository/custom tables или есть реальная необходимость.

Например:

```text
wp_ddc_instagram_media
```

Не создавать custom table автоматически без justification.

### Recommendation

Для максимум 12 Reels предпочтительно использовать простой isolated cache через WordPress Options API или существующий cache mechanism проекта.

---

# 11. Cache refresh

Instagram API не должен вызываться при page render.

Синхронизацию выполнять через:

```text
WP-Cron
```

или существующий scheduler проекта.

Рекомендуемый interval:

```text
1–3 часа
```

Default:

```text
2 часа
```

Интервал должен быть configurable либо вынесен в константу.

---

# 12. Manual refresh

Если проект уже имеет admin settings infrastructure, добавить:

```text
Refresh Instagram feed
```

Кнопка должна:

1. выполнить sync;
2. показать success/error;
3. показать timestamp последней успешной синхронизации.

Не создавать отдельный массивный admin UI только ради одной кнопки.

---

# 13. Failure strategy

Instagram API downtime не должен ломать homepage.

Если новый sync завершился ошибкой:

```text
KEEP LAST SUCCESSFUL CACHE
```

Нельзя очищать cache при API failure.

Flow:

```text
API request
   ↓
success?
 /     \
yes     no
 ↓       ↓
replace  keep previous cache
cache    + log error
```

---

# 14. Empty cache

Если cache ещё не существует и Instagram недоступен:

frontend block должен:

```text
render nothing
```

или использовать существующий theme fallback.

Не показывать посетителю:

- PHP warning;
- API error;
- stack trace;
- placeholder `"Instagram unavailable"`.

---

# 15. Ограничение Reels

Backend должен отдавать максимум:

```text
12
```

Reels.

Frontend не должен получать 100 записей, чтобы потом скрывать лишние.

Количество:

```text
MAX_REELS = 12
```

---

# 16. Ordering

По умолчанию:

```text
published_at DESC
```

То есть самые новые Reel первыми.

---

# 17. Frontend rendering

Использовать существующую theme architecture.

Не создавать отдельный React/Vue bundle, если сайт его не использует.

Предпочтительно:

```text
PHP markup
+
existing slider
+
small isolated JS controller
+
small SCSS module
```

---

# 18. Slider

Slider должен наследовать существующий компонент сайта.

Перед реализацией найти:

```bash
rg -n "swiper|slick|splide|carousel|slider" .
```

и определить canonical implementation.

Если используется Swiper:

создать новый instance на существующей версии Swiper.

Не подключать второй Swiper.

---

# 19. Responsive behaviour

Количество видимых карточек должно соответствовать существующим breakpoint conventions темы.

Ориентир, если текущая тема не определяет иное:

```text
mobile:
1.2–1.5 cards

tablet:
2–3 cards

desktop:
3–4 cards
```

Но существующая theme layout имеет приоритет.

---

# 20. Reel aspect ratio

Не искажать видео.

Использовать:

```css
aspect-ratio: 9 / 16;
object-fit: cover;
```

или существующий эквивалент темы.

---

# 21. Initial state

До запуска видео показывать:

```text
thumbnail
```

и существующий play indicator.

Не загружать все 12 full-size video streams сразу, если этого можно избежать.

---

# 22. Video loading

Предпочтительный markup:

```html
<video
    muted
    playsinline
    preload="metadata"
    poster="..."
></video>
```

Обязательные свойства:

```text
muted
playsinline
```

Видео должно стартовать:

```text
без звука
```

Не добавлять autoplay всей ленты.

---

# 23. Первый клик

Поведение Reel card:

### Initial state

```text
poster
+
play UI
```

### Первый клик

1. предотвратить navigation;
2. установить video source, если используется lazy source;
3. остановить активное видео другой карточки;
4. запустить выбранное видео;
5. `muted = true`;
6. `playsInline = true`;
7. добавить state:

```text
is-playing
```

---

# 24. Второй клик

Если пользователь нажимает второй раз на Reel, который уже находится в состоянии:

```text
is-playing
```

открыть:

```text
permalink
```

Instagram Reel.

Например:

```javascript
window.open(permalink, '_blank', 'noopener,noreferrer');
```

или существующий безопасный navigation pattern проекта.

---

# 25. Interaction state machine

Логика должна быть явной.

```text
IDLE
 ↓ click
PLAYING
 ↓ click
OPEN_INSTAGRAM
```

Другой Reel:

```text
Reel A PLAYING
 ↓ click Reel B
Reel A PAUSED
Reel B PLAYING
```

---

# 26. Только одно активное видео

Одновременно должно играть максимум одно видео.

При запуске нового:

```text
pause previous video
```

Опционально:

```text
previous.currentTime = 0
```

если это соответствует UX существующего сайта.

---

# 27. Slider drag vs click

Особенно важно.

Swipe/drag слайдера не должен восприниматься как:

```text
click
```

и не должен запускать Reel или открывать Instagram.

Агент должен использовать API существующей slider library для определения dragging/moving state либо реализовать минимальный movement threshold.

---

# 28. Navigation arrows

Нажатия на:

- previous;
- next;
- pagination;
- scrollbar;

не должны:

- запускать видео;
- открывать Instagram.

---

# 29. Accessibility

Минимально:

- интерактивный элемент доступен с keyboard;
- есть `aria-label`;
- focus visible наследует theme;
- Instagram navigation доступна keyboard;
- poster имеет корректный accessible context;
- reduced motion не должен ломать компонент.

Не внедрять отдельную accessibility framework.

---

# 30. Missing media_url

`media_url` нельзя считать гарантированным единственным источником отображения.

Если:

```text
media_url === null
```

но есть:

```text
thumbnail_url
permalink
```

карточка всё равно должна отображаться.

Поведение:

```text
thumbnail
↓ click
Instagram permalink
```

То есть Reel остаётся доступным пользователю, но inline playback отключается.

---

# 31. Broken video

Если `<video>` получает:

```text
error
```

frontend должен:

1. остановить loading state;
2. вернуть poster/thumbnail;
3. следующий click открыть Instagram permalink.

Не оставлять бесконечный spinner.

---

# 32. Security

Access Token:

НИКОГДА не передавать frontend.

Запрещено:

```text
data-access-token
window.instagramToken
HTML comments
JS bundle
REST response
```

Token хранится server-side.

Использовать существующий project configuration mechanism.

Приоритет:

```text
environment / wp-config constants
```

над hardcoded secrets.

---

# 33. Token configuration

Пример:

```php
define('DDC_INSTAGRAM_ACCESS_TOKEN', '...');
```

Но агент обязан сначала проверить существующий способ хранения secrets в проекте.

Не коммитить реальные credentials.

---

# 34. API timeout

Instagram request должен иметь ограниченный timeout.

Например:

```text
5–10 seconds
```

Cron не должен зависать бесконечно.

---

# 35. API pagination

Не загружать весь Instagram history.

Цель:

получить достаточно последних media, чтобы найти максимум 12 Reels.

Например:

```text
page 1
↓
filter REELS
↓
12 found?
yes → stop
no → fetch next page
```

Ввести разумный upper bound.

Например:

```text
MAX_API_PAGES = 3–5
```

Чтобы sync не превратился в бесконечный crawler.

---

# 36. API rate limits

Синхронизация должна быть centralized.

Нельзя:

```text
API request per visitor
API request per Reel
API request per slide
```

---

# 37. Duplicate handling

Instagram media ID является canonical unique identifier.

Repeated sync не должен создавать duplicates.

Если используется collection cache:

новый successful sync просто заменяет normalized snapshot.

Если используется table:

использовать update/upsert по:

```text
instagram_media_id
```

---

# 38. Frontend payload

Frontend получает только данные, необходимые для отображения:

```text
id
permalink
videoUrl
thumbnailUrl
caption
publishedAt
```

Не отдавать:

- access token;
- raw API response;
- debug fields;
- internal errors.

---

# 39. Rendering approach

Предпочтительно SSR через PHP.

То есть:

```text
WordPress
 ↓
InstagramFeedService
 ↓
PHP template
 ↓
HTML
 ↓
slider JS enhancement
```

Не использовать дополнительный frontend REST request, если он не нужен.

Это уменьшает:

- JS complexity;
- API calls;
- layout shift;
- loading state;
- количество failure points.

---

# 40. CSS

Новая стилистика не придумывается.

Использовать существующие:

- variables;
- spacing;
- typography;
- border radius;
- container sizes;
- breakpoints;
- arrow styles;
- slider controls.

Перед созданием CSS агент должен найти существующие аналоги через `rg`.

Например:

```bash
rg -n "border-radius|swiper-button|slider|carousel" path/to/theme
```

---

# 41. CSS isolation

Все новые selectors должны быть scoped.

Например:

```text
.instagram-reels
.instagram-reels__slide
.instagram-reels__media
.instagram-reels__video
```

или существующий BEM convention проекта.

Запрещено:

```css
video {}
.swiper-slide {}
button {}
```

если это глобально влияет на сайт.

---

# 42. JS isolation

Не создавать глобальные variables.

Предпочтительно:

```javascript
class InstagramReels
```

или существующий module pattern.

Компонент должен инициализироваться только при наличии блока:

```text
[data-instagram-reels]
```

---

# 43. No duplicated dependencies

Запрещено подключать:

- новый jQuery;
- новую версию Swiper;
- lodash;
- React;
- сторонний Instagram SDK;

если equivalent functionality уже существует.

---

# 44. WordPress integration point

Блок должен подключаться через существующий architecture pattern:

- PHP partial;
- shortcode;
- Gutenberg block;
- page builder component;
- template function;

в зависимости от того, что уже используется проектом.

Не создавать shortcode, если сайт строит главную через template components.

Не создавать Gutenberg block, если Gutenberg в проекте не используется для этой страницы.

---

# 45. Recommended public interface

Например:

```php
InstagramModule::render();
```

или:

```php
echo $instagramBlock->render();
```

Главная страница должна знать только Presentation interface.

---

# 46. Logging

При sync error логировать:

```text
request failure
status code
normalized Meta error code
timestamp
```

Не логировать:

```text
access token
authorization header
other secrets
```

---

# 47. Observability

Желательно хранить:

```text
last_sync_attempt_at
last_successful_sync_at
last_sync_status
cached_items_count
```

Это значительно облегчает диагностику.

---

# 48. Performance

Homepage rendering не должно зависеть от внешней сети.

Performance target:

```text
0 Instagram HTTP requests during normal page render
```

Видео не должны все одновременно загружаться полностью.

---

# 49. Lazy loading

Рекомендуется:

poster загружается сразу или через существующий image lazy loader.

Video URL можно хранить:

```html
data-src="..."
```

и переносить в:

```html
src
```

только после первого interaction.

Это снизит bandwidth.

---

# 50. Degraded mode

Полная цепочка fallback:

```text
media_url exists
    ↓
inline video playback

media_url missing
    ↓
thumbnail + Instagram link

thumbnail missing
    ↓
existing neutral media placeholder / block fallback

Instagram API fails
    ↓
last successful cache

API fails + no cache
    ↓
do not render component
```

---

# 51. Testing

Нужны тесты на уровне, который уже поддерживает проект.

Не устанавливать новый test framework только ради Instagram.

---

# 52. Backend tests

Проверить минимум:

### API normalization

```text
REELS included
IMAGE excluded
CAROUSEL excluded
```

### max results

```text
<= 12
```

### ordering

```text
newest first
```

### cache

Successful sync:

```text
cache updated
```

Failed sync:

```text
existing cache preserved
```

### duplicates

Repeated Instagram IDs:

```text
no duplicate result
```

### missing media_url

```text
record remains usable
```

---

# 53. Frontend tests

Проверить:

```text
first click → play
```

```text
video muted === true
```

```text
second click → Instagram
```

```text
click Reel B → Reel A pauses
```

```text
slider drag → no video start
```

```text
slider drag → no Instagram navigation
```

```text
missing media_url → click opens Instagram
```

```text
video error → fallback remains usable
```

---

# 54. E2E scenario

Основной E2E:

```text
Instagram contains Reel
↓
sync runs
↓
Reel stored in cache
↓
homepage rendered
↓
Reel visible in slider
↓
user clicks Reel
↓
video plays muted
↓
user clicks same Reel again
↓
Instagram permalink opens
```

---

# 55. Cron E2E

```text
cached Reel exists
↓
Instagram API unavailable
↓
cron executes
↓
sync fails
↓
existing cache remains
↓
homepage still renders cached Reel
```

---

# 56. Manual QA

Desktop:

- Chrome;
- Firefox;
- Safari.

Mobile:

- iOS Safari;
- Android Chrome where available.

Особенно проверить:

```text
playsinline
muted playback
touch swipe
touch click
Instagram navigation
```

---

# 57. Definition of Done

Задача считается завершённой, если:

- Instagram Professional Account подключён через официальный API;
- access token существует только server-side;
- последние Reels успешно синхронизируются;
- Reels кешируются локально;
- homepage не вызывает Instagram API;
- отображается максимум 12 Reels;
- показываются только Reels;
- порядок newest first;
- используется существующий slider;
- новый дизайн не создан;
- component наследует тему;
- первый click запускает видео;
- video всегда стартует muted;
- video работает inline;
- второй click открывает Instagram;
- одновременно играет только один Reel;
- slider swipe не вызывает click behaviour;
- отсутствующий `media_url` не ломает карточку;
- Instagram downtime не ломает homepage;
- старый cache сохраняется при failure;
- secrets не появляются frontend;
- код изолирован от остальных feature modules;
- нет duplicated frontend dependencies;
- существующие проверки проекта проходят;
- добавлены релевантные тесты;
- implementation документирован.

---

# 58. Out of Scope

В эту итерацию НЕ входят:

- публикация Reels из WordPress в Instagram;
- управление комментариями;
- Instagram Direct;
- аналитика Instagram;
- likes/views statistics;
- импорт Stories;
- импорт обычных image posts;
- импорт carousel posts;
- автоматическое создание WordPress posts;
- скачивание видео в WordPress Media Library;
- хранение локальной копии каждого MP4;
- изменение existing design system;
- создание нового slider framework.

---

# 59. Implementation order

Работать вертикальными итерациями.

## Phase 1 — Discovery

Никаких изменений кода.

Найти:

- architecture;
- Instagram-related code;
- current slider;
- configuration patterns;
- cache patterns;
- cron patterns;
- homepage integration point;
- frontend JS structure;
- frontend SCSS structure;
- tests.

Результат:

```text
dependency map
+
implementation plan
```

---

## Phase 2 — Instagram infrastructure

Реализовать:

```text
InstagramApiClient
```

и normalization.

Без frontend.

---

## Phase 3 — cache

Реализовать:

```text
repository
sync service
cron
failure preservation
```

---

## Phase 4 — server-side rendering

Реализовать:

```text
feed service
template
max 12
```

---

## Phase 5 — slider

Интегрировать существующую slider implementation.

---

## Phase 6 — video behaviour

Добавить:

```text
first click → muted playback
second click → Instagram
single active video
drag protection
fallback
```

---

## Phase 7 — tests

Запустить сначала самые узкие проверки.

Порядок:

```text
specific test
↓
module tests
↓
frontend/build checks
↓
project CI
```

---

## Phase 8 — final verification

Проверить:

```text
git diff
```

и убедиться, что изменения относятся только к Instagram feature и действительно необходимым integration points.

---

# 60. Ключевой архитектурный принцип

Результат должен выглядеть так:

```text
                    ┌───────────────────┐
                    │   Instagram API   │
                    └─────────┬─────────┘
                              │
                              │ scheduled sync
                              ▼
                    ┌───────────────────┐
                    │ InstagramApiClient│
                    └─────────┬─────────┘
                              │
                              ▼
                    ┌───────────────────┐
                    │ InstagramSync     │
                    │ Service           │
                    └─────────┬─────────┘
                              │
                              ▼
                    ┌───────────────────┐
                    │ Local Cache / DB  │
                    └─────────┬─────────┘
                              │
                              ▼
                    ┌───────────────────┐
                    │ InstagramFeed     │
                    │ Service           │
                    └─────────┬─────────┘
                              │
                              ▼
                    ┌───────────────────┐
                    │ WordPress Template│
                    └─────────┬─────────┘
                              │
                              ▼
                    ┌───────────────────┐
                    │ Existing Slider   │
                    └─────────┬─────────┘
                              │
                              ▼
                    ┌───────────────────┐
                    │ Small JS Controller│
                    │ play / IG redirect │
                    └───────────────────┘
```

Главный принцип:

**Instagram является внешним источником данных, а не runtime dependency главной страницы.**

Главная страница всегда работает с локальным кешем.