<?php

/**
 * "Генерация ИИ" admin screen: the AI Черновики generation form. Lives
 * under "Записи" (Posts) so both Administrator and Editor can reach it,
 * matching who can already create posts — no separate capability was
 * introduced for this tool.
 */

const DDC_AI_DRAFT_ADMIN_PAGE_SLUG = 'ddc-ai-drafts';
const DDC_AI_DRAFT_NONCE_ACTION = 'ddc_ai_draft_generate';
const DDC_AI_DRAFT_RETRY_NONCE_ACTION = 'ddc_ai_draft_retry';

add_action('admin_menu', 'ddc_ai_draft_register_admin_page');

function ddc_ai_draft_register_admin_page(): void
{
	add_submenu_page(
		'edit.php',
		'Генерация ИИ',
		'Генерация ИИ',
		'edit_posts',
		DDC_AI_DRAFT_ADMIN_PAGE_SLUG,
		'ddc_ai_draft_render_admin_page'
	);
}

/**
 * Values from `_default_types` are the fallback only — extend the actual
 * list via `apply_filters('ddc_blog_content_types', [...])` in a child
 * theme/mu-plugin, not through this screen (see
 * docs/adr/0008-ai-drafts-always-generate-all-languages.md's sibling
 * decision to keep this list code-only).
 */
function ddc_ai_draft_content_types(): array
{
	$defaultTypes = ['Статья', 'Новость', 'Анонс'];

	return apply_filters('ddc_blog_content_types', $defaultTypes);
}

function ddc_ai_draft_render_admin_page(): void
{
	if (!current_user_can('edit_posts')) {
		wp_die('У вас нет доступа к этой странице.');
	}

	$noticeType = isset($_GET['ddc_ai_draft_notice']) ? sanitize_key($_GET['ddc_ai_draft_notice']) : '';
	$noticeMessage = isset($_GET['ddc_ai_draft_message']) ? sanitize_text_field(wp_unslash($_GET['ddc_ai_draft_message'])) : '';

	echo '<div class="wrap"><h1>Генерация ИИ</h1>';

	if ($noticeType === 'success') {
		printf('<div class="notice notice-success"><p>%s</p></div>', esc_html($noticeMessage ?: 'Черновики поставлены в очередь на генерацию.'));
	} elseif ($noticeType === 'error') {
		printf('<div class="notice notice-error"><p>%s</p></div>', esc_html($noticeMessage ?: 'Не удалось запустить генерацию.'));
	}

	ddc_ai_draft_render_generate_form();
	ddc_ai_draft_render_batches_table();

	echo '</div>';
}

function ddc_ai_draft_render_batches_table(): void
{
	$repository = new AiDraftBatchRepository();
	$batches = $repository->getRecentBatches(20);

	echo '<h2>Недавние генерации</h2>';

	if (empty($batches)) {
		echo '<p>Пока нет ни одной генерации.</p>';

		return;
	}

	echo '<table class="wp-list-table widefat fixed striped">';
	echo '<thead><tr>'
		. '<th>Тема</th><th>Тип</th>'
		. implode('', array_map(static fn($lang) => '<th>' . esc_html(strtoupper($lang)) . '</th>', DDC_AI_DRAFT_LANGUAGES))
		. '<th>Создано</th>'
		. '</tr></thead><tbody>';

	foreach ($batches as $batch) {
		echo '<tr>';
		printf('<td>%s</td><td>%s</td>', esc_html($batch['topic']), esc_html($batch['content_type']));

		foreach (DDC_AI_DRAFT_LANGUAGES as $language) {
			echo '<td>';
			ddc_ai_draft_render_language_status_cell($batch, $language);
			echo '</td>';
		}

		printf('<td>%s</td>', esc_html(wp_date('d.m.Y H:i', $batch['created_at'])));
		echo '</tr>';
	}

	echo '</tbody></table>';
}

function ddc_ai_draft_render_language_status_cell(array $batch, string $language): void
{
	$entry = $batch['languages'][$language] ?? null;

	if ($entry === null) {
		echo '&mdash;';

		return;
	}

	$labels = [
		'pending'     => 'Ожидание',
		'in_progress' => 'В процессе',
		'success'     => 'Готово',
		'error'       => 'Ошибка',
	];

	echo esc_html($labels[$entry['status']] ?? $entry['status']);

	if ($entry['status'] === 'success' && $entry['post_id']) {
		printf(' &mdash; <a href="%s">Редактировать</a>', esc_url((string) get_edit_post_link($entry['post_id'], '')));
	}

	if ($entry['status'] === 'error') {
		?>
		<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="margin-top:4px;">
			<?php wp_nonce_field(DDC_AI_DRAFT_RETRY_NONCE_ACTION); ?>
			<input type="hidden" name="action" value="ddc_ai_draft_retry">
			<input type="hidden" name="batch_id" value="<?php echo esc_attr($batch['id']); ?>">
			<input type="hidden" name="language" value="<?php echo esc_attr($language); ?>">
			<button type="submit" class="button button-small">Повторить</button>
		</form>
		<?php
	}
}

function ddc_ai_draft_render_generate_form(): void
{
	?>
	<h2>Сгенерировать заготовку статьи и сразу отправить в редактор</h2>
	<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
		<?php wp_nonce_field(DDC_AI_DRAFT_NONCE_ACTION); ?>
		<input type="hidden" name="action" value="ddc_ai_draft_generate">

		<table class="form-table">
			<tr>
				<th scope="row"><label for="ddc_ai_draft_topic">Тема</label></th>
				<td><input type="text" id="ddc_ai_draft_topic" name="topic" class="regular-text" required
					placeholder="Например: как выбрать первый танцевальный стиль"></td>
			</tr>
			<tr>
				<th scope="row"><label for="ddc_ai_draft_content_type">Тип</label></th>
				<td>
					<select id="ddc_ai_draft_content_type" name="content_type">
						<?php foreach (ddc_ai_draft_content_types() as $type) : ?>
							<option value="<?php echo esc_attr($type); ?>"><?php echo esc_html($type); ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="ddc_ai_draft_context">Контекст (необязательно)</label></th>
				<td><textarea id="ddc_ai_draft_context" name="context" class="large-text" rows="4"></textarea></td>
			</tr>
			<tr>
				<th scope="row">Языки генерации</th>
				<td>
					<label>
						<input type="checkbox" checked disabled>
						Сразу RU / NL / UK / EN
					</label>
				</td>
			</tr>
		</table>

		<?php submit_button('Сгенерировать черновик'); ?>
	</form>
	<?php
}

add_action('admin_post_ddc_ai_draft_generate', 'ddc_ai_draft_handle_generate_submit');

function ddc_ai_draft_handle_generate_submit(): void
{
	if (!current_user_can('edit_posts')) {
		wp_die('У вас нет доступа к этому действию.');
	}

	check_admin_referer(DDC_AI_DRAFT_NONCE_ACTION);

	$topic = sanitize_text_field(wp_unslash($_POST['topic'] ?? ''));
	$context = sanitize_textarea_field(wp_unslash($_POST['context'] ?? ''));
	$contentType = ddc_ai_draft_sanitize_content_type(wp_unslash($_POST['content_type'] ?? ''));

	if ($topic === '') {
		ddc_ai_draft_redirect_with_notice('error', 'Поле «Тема» обязательно для заполнения.');
	}

	$openAiClient = new AiDraftOpenAiClient(
		ddc_get_secret_value('OPENAI_API_KEY'),
		ddc_get_secret_value('OPENAI_MODEL')
	);

	$slug = $openAiClient->generateSlug($topic, $context);

	if (is_wp_error($slug)) {
		ddc_ai_draft_redirect_with_notice('error', 'Не удалось сгенерировать слаг: ' . $slug->get_error_message());
	}

	$repository = new AiDraftBatchRepository();
	$batchId = $repository->createBatch($topic, $contentType, $context, $slug);

	ddc_ai_draft_schedule_batch($batchId);

	ddc_ai_draft_redirect_with_notice('success');
}

add_action('admin_post_ddc_ai_draft_retry', 'ddc_ai_draft_handle_retry_submit');

function ddc_ai_draft_handle_retry_submit(): void
{
	if (!current_user_can('edit_posts')) {
		wp_die('У вас нет доступа к этому действию.');
	}

	check_admin_referer(DDC_AI_DRAFT_RETRY_NONCE_ACTION);

	$batchId = sanitize_text_field(wp_unslash($_POST['batch_id'] ?? ''));
	$language = sanitize_key(wp_unslash($_POST['language'] ?? ''));

	if ($batchId === '' || !in_array($language, DDC_AI_DRAFT_LANGUAGES, true)) {
		ddc_ai_draft_redirect_with_notice('error', 'Некорректные параметры повтора.');
	}

	ddc_ai_draft_schedule_language($batchId, $language);

	ddc_ai_draft_redirect_with_notice('success', 'Повтор для этого языка поставлен в очередь.');
}

function ddc_ai_draft_sanitize_content_type(string $submitted): string
{
	$allowedTypes = ddc_ai_draft_content_types();

	return in_array($submitted, $allowedTypes, true) ? $submitted : ($allowedTypes[0] ?? $submitted);
}

/**
 * @return never
 */
function ddc_ai_draft_redirect_with_notice(string $type, string $message = '')
{
	wp_safe_redirect(add_query_arg(
		[
			'page'                 => DDC_AI_DRAFT_ADMIN_PAGE_SLUG,
			'ddc_ai_draft_notice'  => $type,
			'ddc_ai_draft_message' => $message,
		],
		admin_url('edit.php')
	));
	exit;
}
