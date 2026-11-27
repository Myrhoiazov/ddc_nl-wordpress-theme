/* "Генерация ИИ" admin screen: featured image picker for the generation form. */
jQuery(function ($) {
	var $input = $('#ddc_ai_draft_thumbnail_id');
	var $preview = $('#ddc_ai_draft_thumbnail_preview');
	var $remove = $('#ddc_ai_draft_thumbnail_remove');
	var frame;

	if (!$input.length || !window.wp || !wp.media) {
		return;
	}

	$('#ddc_ai_draft_thumbnail_select').on('click', function () {
		if (!frame) {
			frame = wp.media({
				title: 'Обложка записи',
				button: { text: 'Использовать как обложку' },
				library: { type: 'image' },
				multiple: false
			});

			frame.on('select', function () {
				var attachment = frame.state().get('selection').first().toJSON();
				var size = (attachment.sizes && (attachment.sizes.medium || attachment.sizes.thumbnail)) || attachment;

				$input.val(attachment.id);
				$preview.empty().append(
					$('<img>', { src: size.url, alt: '' }).css({ maxWidth: '240px', height: 'auto', display: 'block' })
				);
				$remove.prop('hidden', false);
			});
		}

		frame.open();
	});

	$remove.on('click', function () {
		$input.val('');
		$preview.empty();
		$remove.prop('hidden', true);
	});
});
