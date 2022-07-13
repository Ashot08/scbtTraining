<div id="header-tab-mblp-4-product-content">
    <div class="wpm-control-row wpm-inner-tab-content">
        <h4><?php _e('Название товара', 'mbl_admin'); ?>:</h4>
        <?php wpm_render_partial('options/checkbox-row', 'admin', array('label' => __('Отключить', 'mbl_admin'), 'key' => 'mblp_design.product_content.disable_title')) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста', 'mbl_admin'), 'key' => 'mblp_design.product_content.title_color', 'default' => 'FFFFFF', 'main' => true)) ?>
        <br>

        <h4><?php _e('Описание товара', 'mbl_admin'); ?>:</h4>
        <?php wpm_render_partial('options/checkbox-row', 'admin', array('label' => __('Отключить', 'mbl_admin'), 'key' => 'mblp_design.product_content.disable_desc')) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста', 'mbl_admin'), 'key' => 'mblp_design.product_content.desc_color', 'default' => '000000', 'main' => true)) ?>
        <br>

        <h4><?php _e('Время доступа', 'mbl_admin'); ?>:</h4>
        <?php wpm_render_partial('options/checkbox-row', 'admin', array('label' => __('Отключить', 'mbl_admin'), 'key' => 'mblp_design.product_content.disable_time')) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста', 'mbl_admin'), 'key' => 'mblp_design.product_content.time_color', 'default' => '000000', 'main' => true)) ?>
        <br>

        <h4><?php _e('Цена', 'mbl_admin'); ?>:</h4>
        <?php wpm_render_partial('options/checkbox-row', 'admin', array('label' => __('Отключить', 'mbl_admin'), 'key' => 'mblp_design.product_content.disable_price')) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста', 'mbl_admin'), 'key' => 'mblp_design.product_content.price_color', 'default' => '000000', 'main' => true)) ?>
        <br>

        <h4><?php _e('Удаление товара', 'mbl_admin'); ?>:</h4>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет фона', 'mbl_admin'), 'key' => 'mblp_design.product_content.delete_bg', 'default' => 'e1e1e1', 'main' => true)) ?>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет крестика', 'mbl_admin'), 'key' => 'mblp_design.product_content.delete_color', 'default' => '444', 'main' => true)) ?>

    </div>
</div>