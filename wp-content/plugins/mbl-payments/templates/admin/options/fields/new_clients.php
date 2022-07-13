<div id="header-tab-mblp-1-new-clients">
    <div class="wpm-control-row wpm-inner-tab-content">
        <div class="wpm-row">
            <label>
                <input type="checkbox"
                       name="main_options[mblp][new_clients][surname]"
                    <?php echo wpm_option_is('mblp.new_clients.surname', 'on') ? ' checked' : ''; ?> />
                <?php _e('Фамилия', 'mbl_admin'); ?>
            </label>
        </div>
        <div class="wpm-row">
            <label>
                <input type="checkbox"
                       name="main_options[mblp][new_clients][name]"
                    <?php echo wpm_option_is('mblp.new_clients.name', 'on') ? ' checked' : ''; ?> />
                <?php _e('Имя', 'mbl_admin'); ?>
            </label>
        </div>
        <div class="wpm-row">
            <label>
                <input type="checkbox"
                       name="main_options[mblp][new_clients][patronymic]"
                    <?php echo wpm_option_is('mblp.new_clients.patronymic', 'on') ? ' checked' : ''; ?> />
                <?php _e('Отчество', 'mbl_admin'); ?>
            </label>
        </div>
        <div class="wpm-row wpm-row-disabled"
             title="<?php _e('Это поле нельзя убрать из формы', 'mbl_admin') ?>">
            <label>
                <input type="checkbox" disabled checked/> <?php _e('Email', 'mbl'); ?>
            </label>
        </div>
        <div class="wpm-row">
            <label>
                <input type="checkbox"
                       name="main_options[mblp][new_clients][phone]"
                    <?php echo wpm_option_is('mblp.new_clients.phone', 'on') ? ' checked' : ''; ?> />
                <?php _e('Телефон', 'mbl_admin'); ?>
            </label>
        </div>
        
        
        <div class="wpm-row <?php echo apply_filters('payments_form_disabled_row', 'wpm-row-disabled'); ?>"
             title="<?php echo apply_filters('payments_form_disabled_row', __('Это поле нельзя убрать из регистрационной формы', 'mbl_admin')); ?>">
            <label>
                <input type="checkbox"
                       name="main_options[mblp][new_clients][login]"
					   <?php echo apply_filters('payments_form_login_enabled', 'disabled checked'); ?>
                /> <?php _e('Желаемый логин', 'mbl_admin'); ?>
            </label>
        </div>
        
        
        <div class="wpm-row <?php echo apply_filters('payments_form_disabled_row', 'wpm-row-disabled'); ?>"
             title="<?php echo apply_filters('payments_form_disabled_row', __('Это поле нельзя убрать из регистрационной формы', 'mbl_admin')); ?>">
            <label>
                <input type="checkbox"
                       name="main_options[mblp][new_clients][pass]"
					   <?php echo apply_filters('payments_form_pass_enabled', 'disabled checked'); ?>
                /> <?php _e('Желаемый пароль', 'mbl_admin'); ?>
            </label>
        </div>

        
        <div class="wpm-row">
            <label>
                <input type="checkbox"
                       name="main_options[mblp][new_clients][comment]"
                    <?php echo wpm_option_is('mblp.new_clients.comment', 'on') ? ' checked' : ''; ?> />
                <?php _e('Комментарий к заказу', 'mbl_admin'); ?>
            </label>
        </div>
    </div>
</div>