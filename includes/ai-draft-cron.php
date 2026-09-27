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
 */

const DDC_AI_DRAFT_LANGUAGES = ['ru', 'nl', 'uk', 'en'];
const DDC_AI_DRAFT_CRON_HOOK = 'ddc_ai_draft_generate_language';

function ddc_ai_draft_schedule_batch(string $batchId): void
{
	foreach (DDC_AI_DRAFT_LANGUAGES as $language) {
		wp_schedule_single_event(time(), DDC_AI_DRAFT_CRON_HOOK, [$batchId, $language]);
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
