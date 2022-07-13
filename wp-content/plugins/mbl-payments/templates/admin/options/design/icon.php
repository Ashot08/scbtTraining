<div id="header-tab-mblp-4-icon">
    <div class="wpm-control-row wpm-inner-tab-content">
        <h4><?php _e('Иконка корзины', 'mbl_admin'); ?>:</h4>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет корзины', 'mbl_admin'), 'key' => 'mblp_design.cart.color', 'default' => '868686', 'main' => true)) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет корзины при наведении', 'mbl_admin'), 'key' => 'mblp_design.cart.hover_color', 'default' => '2E2E2E', 'main' => true)) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет активной корзины', 'mbl_admin'), 'key' => 'mblp_design.cart.active_color', 'default' => '2E2E2E', 'main' => true)) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет круга под цифрами', 'mbl_admin'), 'key' => 'mblp_design.cart.numbers_bg', 'default' => 'DD3D31', 'main' => true)) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет цифр', 'mbl_admin'), 'key' => 'mblp_design.cart.numbers_color', 'numbers_color' => 'FFFFFF', 'main' => true)) ?>
    </div>
</div>