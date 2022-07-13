<div id="header-tab-mblp-5-errors">
    <div class="wpm-control-row wpm-inner-tab-content">
        <?php wpm_render_partial('options/text-row', 'admin', array('label' => __('Превышено время ожидания от сервера', 'mbl_admin'), 'key' => 'mblp_texts.error_time_limit')) ?>

        <div class="wpm-row">
            <label>
            <?php _e('Ввод логина кириллическими символами', 'mbl_admin') ?>:
                <input type="text"
                       name="main_options[mblp_texts][error_login]"
                       class="large-text"
                       value="<?php echo wpm_get_option('mblp_texts.error_login', __('Некорректный логин. Для логина разрешены только буквы латинского алфавита и цифры', 'mbl')); ?>"
                >
            </label>
        </div>
    </div>
</div>