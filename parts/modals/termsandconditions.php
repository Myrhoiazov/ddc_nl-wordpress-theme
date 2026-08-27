<div class="modal fade" id="terms" tabindex="-1" aria-labelledby="termsLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsLabel">Terms and conditions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php 
                
                $termsAndCondition = get_post(293);
                echo wpautop($termsAndCondition->post_content);
                
                ?>
            </div>
        </div>
    </div>
</div>