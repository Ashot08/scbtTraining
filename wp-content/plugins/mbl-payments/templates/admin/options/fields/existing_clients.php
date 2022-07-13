<div id="header-tab-mblp-1-existing-clients">
    <div class="wpm-control-row wpm-inner-tab-content">
        <div class="wpm-row">
            <label>
                <input type="checkbox"
                       name="main_options[mblp][existing_clients][surname]"
                    <?php echo wpm_option_is('mblp.existing_clients.surname', 'on') ? ' checked' : ''; ?> />
                <?php _e('Фамилия', 'mbl_admin'); ?>
            </label>
        </div>
        <div class="wpm-row">
            <label>
                <input type="checkbox"
                       name="main_options[mblp][existing_clients][name]"
                    <?php echo wpm_option_is('mblp.existing_clients.name', 'on') ? ' checked' : ''; ?> />
                <?php _e('Имя', 'mbl_admin'); ?>
            </label>
        </div>
        <div class="wpm-row">
            <label>
                <input type="checkbox"
                       name="main_options[mblp][existing_clients][patronymic]"
                    <?php echo wpm_option_is('mblp.existing_clients.patronymic', 'on') ? ' checked' : ''; ?> />
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
                       name="main_options[mblp][existing_clients][phone]"
                    <?php echo wpm_option_is('mblp.existing_clients.phone', 'on') ? ' checked' : ''; ?> />
                <?php _e('Телефон', 'mbl_admin'); ?>
            </label>
        </div>
        <div class="wpm-row">
            <label>
                <input type="checkbox"
                       name="main_options[mblp][existing_clients][comment]"
                    <?php echo wpm_option_is('mblp.existing_clients.comment', 'on') ? ' checked' : ''; ?> />
                <?php _e('Комментарий к заказу', 'mbl_admin'); ?>
            </label>
        </div>
    </div>
</div>