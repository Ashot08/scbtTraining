<div id="header-tab-mblp-4-upsells">
    <div class="wpm-control-row wpm-inner-tab-content">
        <h4><?php _e('Заголовок', 'mbl_admin'); ?>:</h4>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста заголовка дополнительных предложений', 'mbl_admin'), 'key' => 'mblp_design.upsells.header_color', 'default' => '868686', 'main' => true)) ?>
        <br>

        <h4><?php _e('Апселы', 'mbl_admin'); ?>:</h4>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет названий дополнительных предложений', 'mbl_admin'), 'key' => 'mblp_design.upsells.titles_color', 'default' => '444', 'main' => true)) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет фона добавления', 'mbl_admin'), 'key' => 'mblp_design.upsells.button_bg', 'default' => 'A0B0A1', 'main' => true)) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет иконки добавления', 'mbl_admin'), 'key' => 'mblp_design.upsells.button_color', 'default' => 'FFFFFF', 'main' => true)) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет фона добавления при наведении', 'mbl_admin'), 'key' => 'mblp_design.upsells.button_hover_bg', 'default' => 'ADBEAD', 'main' => true)) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет иконки добавления при наведении', 'mbl_admin'), 'key' => 'mblp_design.upsells.button_hover_color', 'default' => 'FFFFFF', 'main' => true)) ?>
    </div>
</div>