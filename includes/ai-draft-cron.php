<?php

/**
 * AI Черновики generation runs as one WP-Cron single event per language of
 * a Generation Batch, following the "API client -> orchestrator ->
 * repository, failure never destroys other state" shape already used by
 * the Instagram Reels sync (functions.php) — but at per-language job
 * granularity instead of one periodic full sync, since each job is
 * triggered by a specific admin action rather than running on a schedule.
 *
 * A failed language gets exactly one automatic retry
 * (DDC_AI_DRAFT_RETRY_DELAY_SECONDS later); a second consecutive failure
 * is left for the manual "Повторить" button in the admin screen.
 *
 * Each language job also links itself to whatever siblings the repository
 * already shows as successful at that exact moment
 * (AiDraftLanguageGenerationService::linkTranslations()) — correct if the
 * 4 jobs truly run one after another, but if the host's WP-Cron ends up
 * dispatching them with genuine overlap (e.g. a real system cron hitting
 * wp-cron.php more often than one run takes to finish), two jobs can each
 * see zero completed siblings and never end up linked at all. The delayed
 * consolidation job below is a safety net for exactly that case: it runs
 * once, well after every language (including its one auto-retry) should
 * have settled, and re-links whatever the batch shows as successful by
 * then in a single authoritative call.
 */

const DDC_AI_DRAFT_LANGUAGES = ['ru', 'nl', 'uk', 'en'];
const DDC_AI_DRAFT_CRON_HOOK = 'ddc_ai_draft_generate_language';
const DDC_AI_DRAFT_LINK_HOOK = 'ddc_ai_draft_link_translations';

function ddc_ai_draft_schedule_batch(string $batchId): void
{
	foreach (DDC_AI_DRAFT_LANGUAGES as $language) {
		wp_schedule_single_event(time(), DDC_AI_DRAFT_CRON_HOOK, [$batchId, $language]);
	}

	wp_schedule_single_event(time() + DDC_AI_DRAFT_LINK_DELAY_SECONDS, DDC_AI_DRAFT_LINK_HOOK, [$batchId]);
}

add_action(DDC_AI_DRAFT_LINK_HOOK, 'ddc_ai_draft_run_link_job', 10, 1);

function ddc_ai_draft_run_link_job(string $batchId): void
{
	if (!function_exists('pll_save_post_translations')) {
		return;
	}

	$repository = new AiDraftBatchRepository();
	$batch = $repository->getBatch($batchId);

	if ($batch === null) {
		return;
	}

	$translations = [];

	foreach ($batch['languages'] as $language => $entry) {
		if ($entry['status'] === 'success' && $entry['post_id']) {
			$translations[$language] = (int) $entry['post_id'];
		}
	}

	if (count($translations) >= 2) {
		pll_save_post_translations($translations);
	}
}

/**
 * Re-schedules a single language of an existing batch — used both for the
 * one automatic retry below and for the admin screen's manual retry button
 * (Task 6), which calls this directly instead of going through
 * ddc_ai_draft_schedule_batch() so it never touches the other 3 languages.
 */
function ddc_ai_draft_schedule_language(string $batchId, string $language, int $delaySeconds = 0): void
{
	wp_schedule_single_event(time() + $delaySeconds, DDC_AI_DRAFT_CRON_HOOK, [$batchId, $language]);
}

add_action(DDC_AI_DRAFT_CRON_HOOK, 'ddc_ai_draft_run_language_job', 10, 2);

function ddc_ai_draft_run_language_job(string $batchId, string $language): void
{
	$repository = new AiDraftBatchRepository();
	$openAiClient = new AiDraftOpenAiClient(
		ddc_get_secret_value('OPENAI_API_KEY'),
		ddc_get_secret_value('OPENAI_MODEL')
	);
	$service = new AiDraftLanguageGenerationService($openAiClient, $repository);

	if ($service->generate($batchId, $language)) {
		return;
	}

	if ($repository->incrementRetryCount($batchId, $language) <= 1) {
		ddc_ai_draft_schedule_language($batchId, $language, DDC_AI_DRAFT_RETRY_DELAY_SECONDS);
	}
}
