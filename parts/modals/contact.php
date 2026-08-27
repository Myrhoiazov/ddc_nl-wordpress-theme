<div class="modal fade" id="contact_form" tabindex="-1" aria-labelledby="contact_form_label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h4 class="modal-title" id="contact_form_label"><?php esc_html_e('Свяжитесь с нами', 'wp_denysmyr'); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <?php echo do_shortcode('[contact-form-7 id="7a094fd" title="Contact form"]'); ?>
            </div>
            <div class="modal-footer d-none">
                <button type="button" class="btn btn-secondary btn-lg me-auto p-3 px-4" data-bs-dismiss="modal">
                    <?php esc_html_e('Close', 'wp_denysmyr'); ?>
                </button>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('contact_form');
    if (!modal) return;

    modal.addEventListener('change', function (e) {
        var input = e.target.closest('.messenger-radio input[type="radio"], .messenger-checkbox input[type="checkbox"]');
        if (!input) return;
        var form = input.closest('form');
        if (!form) return;
        var phoneField = form.querySelector('#messenger-phone-field');
        if (!phoneField) return;
        // Показываем телефон только для Telegram / WhatsApp, не для Email
        var checked = form.querySelector('.messenger-radio input:checked, .messenger-checkbox input:checked');
        var val = checked ? checked.value.trim().toLowerCase() : '';
        var isEmail = val === 'email' || val === 'e-mail' || val === 'mail';
        var needsPhone = checked && !isEmail;
        phoneField.style.display = needsPhone ? 'block' : 'none';
    });

    // Сброс при закрытии модала
    modal.addEventListener('hidden.bs.modal', function () {
        var phoneField = modal.querySelector('#messenger-phone-field');
        if (phoneField) phoneField.style.display = 'none';
        modal.querySelectorAll('.messenger-radio input, .messenger-checkbox input').forEach(function (i) {
            i.checked = false;
        });
    });
});
</script>