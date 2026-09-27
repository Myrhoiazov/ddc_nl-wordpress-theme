<?php

/**
 * Talks to the OpenAI Chat Completions API for the AI Черновики generator.
 *
 * Only responsible for the HTTP call and response shape: prompt building,
 * request/response handling, and error normalization. Knows nothing about
 * WordPress posts, Polylang, AIOSEO, or batch storage — see
 * AiDraftLanguageGenerationService for orchestration and
 * AiDraftBatchRepository for persistence.
 *
 * The shared slug (see docs/adr/0007-llm-authored-slug-for-ai-drafts.md)
 * is generated once per batch via generateSlug() and must be passed into
 * every generateLanguageContent() call for that batch — this class has no
 * memory of previous calls, so reusing the slug is the caller's job.
 */
class AiDraftOpenAiClient
{
	private const API_URL = 'https://api.openai.com/v1/chat/completions';
	private const REQUEST_TIMEOUT_SECONDS = 30;

	private const LANGUAGE_NAMES = [
		'ru' => 'Russian',
		'nl' => 'Dutch',
		'uk' => 'Ukrainian',
		'en' => 'English',
	];

	/**
	 * House style for every generated Blog Post, distilled from a content
	 * brief the site owner supplied for one specific article ("Танцы для
	 * детей: 10 причин попробовать") into rules that apply to *any* topic —
	 * the durable persona/tone/SEO/format contract lives here; the
	 * topic-specific outline (how many H2 sections, which FAQ questions)
	 * is left for the model to design per request in generateLanguageContent().
	 *
	 * Deliberately does not ask for real internal links (e.g. to a specific
	 * dance style's page) — the model has no access to this site's actual
	 * URLs, so it only mentions those topics as plain text.
	 */
	private const SYSTEM_PROMPT = <<<'PROMPT'
		You are an SEO copywriter and content editor for Talent Center DDC, a modern dance school in the Netherlands for children, teenagers, and adults.

		Audience: parents of children and teenagers considering dance as a hobby, and adults looking for dance classes. Give them genuinely useful information and gently guide them toward a trial lesson — never through pressure or exaggerated promises.

		Structure (adapt to the given content type — a full article for "Статья"/"Article"; shorter and without a mandatory FAQ for "Новость"/"News" or "Анонс"/"Announcement"):
		- Do NOT start with an H1 or repeat the topic as a heading — the page this
		  renders on already displays the post's title above the body in its own
		  styled banner, so an H1 here would show twice. Start directly with the
		  introduction.
		- A short introduction.
		- Several H2 sections whose number and focus you design specifically for the given topic — never reuse a fixed list of reasons from a different topic.
		- For a full article, an FAQ section near the end: 3-5 H3 questions parents realistically ask, with concise answers.
		- A soft, non-pushy call to action toward a trial lesson.

		You may mention the school's dance styles (e.g. Hip-Hop, Jazz Funk, Contemporary), its schedule, and its trial lesson as plain text where natural — never as hyperlinks, since you don't have this site's real URLs.

		Style: natural human language; warm, modern, professional tone; no aggressive sales or ad-like phrasing; never promise medical or psychological outcomes; no keyword stuffing or repeating the same point for length; short paragraphs; use lists where they aid readability; no emoji in the body.

		SEO: use the main keyword naturally in the first paragraph, one or two H2 sections, and the conclusion. Use related keywords only where they fit naturally.

		Output: a clean HTML fragment for the body using only article/h2/h3/p/strong/ul/li — no h1, no CSS, no JavaScript, no inline styles.
		PROMPT;

	private string $apiKey;
	private string $model;

	public function __construct(string $apiKey, string $model)
	{
		$this->apiKey = $apiKey;
		$this->model = $model;
	}

	/**
	 * One call, shared across every language of a Generation Batch.
	 *
	 * @return string|WP_Error A sanitize_title()-safe slug, or WP_Error on failure.
	 */
	public function generateSlug(string $topic, string $context)
	{
		$prompt = "Topic: {$topic}\n" . ($context !== '' ? "Context: {$context}\n" : '')
			. "Suggest one short, English, SEO-friendly URL slug for a blog post about this topic. "
			. 'Respond as JSON: {"slug": "..."}.';

		$result = $this->request($prompt);

		if (is_wp_error($result)) {
			return $result;
		}

		$slug = sanitize_title((string) ($result['slug'] ?? ''));

		if ($slug === '') {
			return new WP_Error('ai_draft_empty_slug', 'OpenAI response did not contain a usable slug.');
		}

		return $slug;
	}

	/**
	 * @return array|WP_Error Keys: title, body, excerpt, seo_title, seo_description, focus_keyword, secondary_keywords. WP_Error on failure.
	 */
	public function generateLanguageContent(string $topic, string $contentType, string $context, string $language, string $slug)
	{
		$languageName = self::LANGUAGE_NAMES[$language] ?? $language;

		$prompt = "Topic: {$topic}\n"
			. "Content type: {$contentType}\n"
			. ($context !== '' ? "Context: {$context}\n" : '')
			. "Shared URL slug for this post (do not translate or change it): {$slug}\n"
			. "Write this blog post in {$languageName}, following the house style and structure rules. "
			. 'Respond as JSON with keys: title, body, excerpt, seo_title (max ~60 characters), '
			. 'seo_description (~150-160 characters), focus_keyword, secondary_keywords (a comma-separated '
			. 'list of up to 5 related keywords).';

		$result = $this->request($prompt, self::SYSTEM_PROMPT);

		if (is_wp_error($result)) {
			return $result;
		}

		$expectedKeys = ['title', 'body', 'excerpt', 'seo_title', 'seo_description', 'focus_keyword', 'secondary_keywords'];
		$content = [];

		foreach ($expectedKeys as $key) {
			$content[$key] = trim((string) ($result[$key] ?? ''));
		}

		if ($content['title'] === '' || $content['body'] === '') {
			return new WP_Error('ai_draft_incomplete_content', 'OpenAI response was missing a title or body.');
		}

		return $content;
	}

	/**
	 * @return array|WP_Error Decoded JSON object from the model's reply, or WP_Error on failure.
	 */
	private function request(string $prompt, ?string $systemPrompt = null)
	{
		if ($this->apiKey === '') {
			return new WP_Error('ai_draft_not_configured', 'OpenAI API key is not configured.');
		}

		$messages = [];

		if ($systemPrompt !== null) {
			$messages[] = ['role' => 'system', 'content' => $systemPrompt];
		}

		$messages[] = ['role' => 'user', 'content' => $prompt];

		$response = wp_remote_post(self::API_URL, [
			'timeout' => self::REQUEST_TIMEOUT_SECONDS,
			'headers' => [
				'Authorization' => 'Bearer ' . $this->apiKey,
				'Content-Type'  => 'application/json',
			],
			'body' => wp_json_encode([
				'model'           => $this->model,
				'response_format' => ['type' => 'json_object'],
				'messages'        => $messages,
			]),
		]);

		if (is_wp_error($response)) {
			return new WP_Error('ai_draft_request_failed', $response->get_error_message());
		}

		$statusCode = (int) wp_remote_retrieve_response_code($response);
		$body = json_decode(wp_remote_retrieve_body($response), true);

		if ($statusCode !== 200 || !is_array($body)) {
			return new WP_Error(
				'ai_draft_api_error',
				sprintf('OpenAI API request failed with status %d', $statusCode),
				['status' => $statusCode]
			);
		}

		$messageContent = $body['choices'][0]['message']['content'] ?? null;
		$decoded = is_string($messageContent) ? json_decode($messageContent, true) : null;

		if (!is_array($decoded)) {
			return new WP_Error('ai_draft_invalid_response', 'OpenAI response did not contain valid JSON content.');
		}

		return $decoded;
	}
}
