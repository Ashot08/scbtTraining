<div class="modal fade" id="wpmp_user_offer" tabindex="-1" role="dialog" aria-labelledby="user_agreement" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button"
                        class="close"
                        data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only"><?php _e('закрыть', 'mbl'); ?></span>
                </button>
                <h4 class="modal-title" id="registration_label"><?php echo wpm_get_option('mblp_texts.offer_title', __('Оферта', 'mbl')); ?></h4>
            </div>
            <div class="modal-body">
                <?php echo wpautop(stripslashes(wpm_get_option('mblp_texts.offer_text'))); ?>
            </div>
            <div class="modal-footer">
                <a type="button"
                   style="float: left"
                   class="btn btn-danger reject-button"
                   id="wpm_user_offer_reject"
                   href=""><?php _e('Не принимаю', 'mbl'); ?></a>

                <a type="button"
                   id="wpm_user_offer_accept"
                   class="btn btn-primary btn-success"
                ><?php _e('Принимаю', 'mbl'); ?></a>
            </div>
        </div>
    </div>
</div>