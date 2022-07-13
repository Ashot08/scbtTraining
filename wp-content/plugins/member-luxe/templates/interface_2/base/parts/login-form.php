<?php $standalone = isset($standalone) ? $standalone : false; ?>
<?php $userAgreementRequired = apply_filters('mbl_user_agreement_login_required', wpm_option_is('user_agreement.enabled_login', 'on')) && apply_filters('mbl_user_agreement_login_option', false); ?>
<form class="login" method="post">
    <?php if ($full && !$standalone) : ?>
        <div class="dropdown-panel-header text-right">
            <a class="close-dropdown-panel"><?php _e('закрыть', 'mbl'); ?><span class="close-button"><span class="icon-close"></span></span> </a>
        </div>
    <?php endif; ?>
    <div class="form-fields-group">
        <p class="status"></p>
        <div class="form-group form-icon form-icon-user">
            <input type="text" name="username"  class="form-control" placeholder="<?php _e('Логин', 'mbl'); ?>" required="">
        </div>
        <div class="form-group form-icon form-icon-lock">
            <input type="password" name="password" class="form-control" placeholder="<?php _e('Пароль', 'mbl'); ?>" required="">
        </div>
        <?php if (!$standalone) : ?>
            <div class="form-group">
                <a href="<?php echo wp_lostpassword_url(); ?>" class="helper-link"><?php _e('Забыли пароль?', 'mbl'); ?></a>
            </div>
        <?php else : ?>
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6 text-right">
                    <div class="form-group">
                        <a href="<?php echo wp_lostpassword_url(); ?>" class="helper-link"><?php _e('Забыли пароль?', 'mbl'); ?></a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        
    </div>
    
    <?php do_action('mbl_registration_before_captcha'); ?>
    
    <?php if (wpm_option_is('main.enable_captcha', 'on') && wpm_option_is('main.enable_captcha_login', 'on')) : ?>
        <div class="form-fields-group">
            <div class="g-recaptcha"
                 data-sitekey="<?php echo wpm_get_option('main.captcha_key'); ?>"
                 data-is-mobile="<?php echo MBLStats::isMobile() ? 1 : 0; ?>"
            ></div>
        </div>
    <?php endif; ?>

    <button type="submit"
            <?php echo $userAgreementRequired ? 'disabled="disabled"' : ''; ?>
            class="mbr-btn btn-default btn-solid btn-green text-uppercase wpm-sign-in-button <?php echo $userAgreementRequired ? 'mbl-uareq' : ''; ?>"
    ><?php _e('Войти', 'mbl'); ?></button>

    <?php if (!$userAgreementRequired && wpm_option_is('user_agreement.enabled_login', 'on')) : ?>
        <div class="mbl-user-agreement-row">
            <a href="#wpm_user_agreement_text"
               data-toggle="modal"
               data-target="#wpm_user_agreement_text"
            ><?php echo wpm_get_option('user_agreement.login_link_title', __('Пользовательское соглашение', 'mbl')); ?></a>
        </div>
    <?php endif; ?>
	
	<?php do_action('mbl_login_form_after_submit_btn'); ?>
    
<?php if ($full) : ?>
    <?php wp_nonce_field('wpm-ajax-login-nonce', 'security'); ?>
<?php endif; ?>
</form>
<?php if ($full) : ?>
    <script>
        jQuery(function ($) {
            $(document).on('submit', 'form.login', function (e) {
                var $form = $(this),
                    $button = $('.wpm-sign-in-button'),
                    $recaptcha = $form.find('[name="g-recaptcha-response"]');
                $button.addClass('progress-button-active');
                $form.find('p.status').show().text('<?php _e('Проверка...', 'mbl'); ?>');
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: ajaxurl,
                    xhrFields: { withCredentials: true },
                    data: {
                        'action': 'wpm_ajaxlogin',
                        'username': $form.find('[name="username"]').val(),
                        'password': $form.find('[name="password"]').val(),
                        'security': $('[name="security"]').val(),
                        'remember': $form.find('[name="remember"]').val(),
                        '_wp_http_referer': ($form.find('[name="_wp_http_referer"]').length ? $form.find('[name="_wp_http_referer"]').val() : ''),
                        'g-recaptcha-response': ($recaptcha.length ? $recaptcha.val() : '')
                    },
                    success: function (data) {
                        $form.find('p.status').text(data.message);
                        if (data.loggedin == true) {
                            location.reload(false);
                        }
                    }
                })
                .always(function(){
                    $button.removeClass('progress-button-active');
                });
                e.preventDefault();
                return false;
            });
        });
    </script>
<?php endif; ?>