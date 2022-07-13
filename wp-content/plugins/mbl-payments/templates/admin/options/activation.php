<?php wpm_render_partial('options/checkbox-row', 'admin', array('label' => __('Включить автоматическую активацию после успешной оплаты', 'mbl_admin'), 'key' => 'mblp.auto_activation')) ?>
<br>
<h4><?php _e('Отображаемая после оплаты страница:', 'mbl_admin'); ?></h4>
<div class="wpm-row">
    <label>
        <input type="radio"
               name="main_options[mblp][redirect_page]"
               value="activation"
            <?php echo wpm_option_is('mblp.redirect_page', 'activation', 'activation') ? ' checked' : ''; ?> />
        <?php _e('Страница активации', 'mbl_admin'); ?>
    </label>
    <br>
    <label>
        <input type="radio"
               name="main_options[mblp][redirect_page]"
               value="main"
            <?php echo wpm_option_is('mblp.redirect_page', 'main', 'activation') ? ' checked' : ''; ?> />
        <?php _e('Главная страница', 'mbl_admin'); ?>
    </label>
</div>