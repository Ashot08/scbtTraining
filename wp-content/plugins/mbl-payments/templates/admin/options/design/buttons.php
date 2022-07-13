<div id="header-tab-mblp-4-buttons">
    <div class="wpm-control-row wpm-inner-tab-content">
        <h4><?php _e('Кнопка оформления заказа', 'mbl_admin'); ?>:</h4>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста', 'mbl_admin'), 'key' => 'mblp_design.buttons.order_btn_color', 'default' => 'FFFFFF', 'main' => true)) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста при наведении', 'mbl_admin'), 'key' => 'mblp_design.buttons.order_btn_hover_color', 'default' => 'FFFFFF', 'main' => true)) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста при клике', 'mbl_admin'), 'key' => 'mblp_design.buttons.order_btn_active_color', 'default' => 'FFFFFF', 'main' => true)) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет кнопки', 'mbl_admin'), 'key' => 'mblp_design.buttons.order_btn_bg', 'default' => 'A0B0A1', 'main' => true)) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет кнопки при наведении', 'mbl_admin'), 'key' => 'mblp_design.buttons.order_btn_hover_bg', 'default' => 'ADBEAD', 'main' => true)) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет кнопки при клике', 'mbl_admin'), 'key' => 'mblp_design.buttons.order_btn_active_bg', 'default' => '8E9F8F', 'main' => true)) ?>
        <br>

        <h4><?php _e('Итоговая цена', 'mbl_admin'); ?>:</h4>
        <div class="wpm-row">
            <label>
                <input type="hidden" name="main_options[mblp_design][buttons][order_total_disable]" value="off">
                <input type="checkbox"
                       name="main_options[mblp_design][buttons][order_total_disable]"
                    <?php echo wpm_option_is('mblp_design.buttons.order_total_disable', 'on') ? ' checked' : ''; ?> />
                <?php _e('Отключить', 'mbl_admin'); ?>
            </label>
        </div>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста', 'mbl_admin'), 'key' => 'mblp_design.buttons.order_total_color', 'default' => '868686', 'main' => true)) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет суммы', 'mbl_admin'), 'key' => 'mblp_design.buttons.order_total_sum_color', 'default' => '4A4A4A', 'main' => true)) ?>
        <br>

        <h4><?php _e('Кнопка возвращения', 'mbl_admin'); ?>:</h4>
        <div class="wpm-row">
            <label>
                <input type="hidden" name="main_options[mblp_design][buttons][back_btn_disable]" value="off">
                <input type="checkbox"
                       name="main_options[mblp_design][buttons][back_btn_disable]"
                    <?php echo wpm_option_is('mblp_design.buttons.back_btn_disable', 'on') ? ' checked' : ''; ?> />
                <?php _e('Отключить', 'mbl_admin'); ?>
            </label>
        </div>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста', 'mbl_admin'), 'key' => 'mblp_design.buttons.back_btn_color', 'default' => 'FFFFFF', 'main' => true)) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста при наведении', 'mbl_admin'), 'key' => 'mblp_design.buttons.back_btn_hover_color', 'default' => 'FFFFFF', 'main' => true)) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста при клике', 'mbl_admin'), 'key' => 'mblp_design.buttons.back_btn_active_color', 'default' => 'FFFFFF', 'main' => true)) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет кнопки', 'mbl_admin'), 'key' => 'mblp_design.buttons.back_btn_bg', 'default' => 'C28D8D', 'main' => true)) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет кнопки при наведении', 'mbl_admin'), 'key' => 'mblp_design.buttons.back_btn_hover_bg', 'default' => 'A17575', 'main' => true)) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет кнопки при клике', 'mbl_admin'), 'key' => 'mblp_design.buttons.back_btn_active_bg', 'default' => '864747', 'main' => true)) ?>
    </div>
</div>