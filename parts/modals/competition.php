<?php 

?>
<div class="modal fade" id="competition_form" tabindex="-1" aria-labelledby="competition_form_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="competition_form_label">Sign me up!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
					<?php echo do_shortcode('[my_react_app_registration]'); ?>
            </div>
            <!-- <div class="modal-footer justify-content-start">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLose</button>
            </div> -->
        </div>
    </div>
</div>