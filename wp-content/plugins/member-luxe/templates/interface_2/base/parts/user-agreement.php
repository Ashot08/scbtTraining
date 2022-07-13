<div class="user-agreement">
    <label>
        <input name="user_agreement" type="checkbox" class="user_agreement_input" tabindex="91" />
        &nbsp;<?php _e('Принимаю', 'wpm'); ?>
        <a class="link"
           data-toggle="modal"
           data-target="#wpm_user_agreement"><?php echo wpm_get_option('user_agreement.registration_link_title', __('пользовательское соглашение', 'wpm')); ?></a>
    </label>
</div>
<script type="text/javascript">
    jQuery(function ($) {
        $(document).on('click', '#wpm_user_agreement_reject', function(){
            var $button = $('.register-submit.mbl-uareq, .wpm-sign-in-button.mbl-uareq');
            
            $('#wpm_user_agreement').modal('hide');
            $('.user_agreement_input').prop('checked', false);
            $button.prop('disabled', true);
            $button.each(function() {
                $(this).closest('form').find('.mbl-access-sc').addClass('mbl-access-locked');
            });

            return false;
        });
        $(document).on('click', '#wpm_user_agreement_accept', function(){
            var $button = $('.register-submit.mbl-uareq, .wpm-sign-in-button.mbl-uareq');
            
            $('#wpm_user_agreement').modal('hide');
            $('.user_agreement_input').prop('checked', true);
            $button.prop('disabled', false);
            
            $button.each(function() {
                $(this).closest('form').find('.mbl-access-sc').removeClass('mbl-access-locked');
            });

            return false;
        });
        $(document).on('change', '.user_agreement_input', function() {
            var $this = $(this),
                $form = $this.closest('form');
            $form.find('.register-submit.mbl-uareq, .wpm-sign-in-button.mbl-uareq').prop('disabled', !$this.prop('checked'));
            $form.find('.mbl-access-sc')[$this.prop('checked') ? 'removeClass' : 'addClass']('mbl-access-locked');
        });
    });
</script>