<div id="header-tab-mblp-4-product-titles">
    <div class="wpm-control-row wpm-inner-tab-content">
        <h4><?php _e('Описание товара', 'mbl_admin'); ?>:</h4>
        <div class="wpm-row">
            <label>
                <input type="hidden" name="main_options[mblp_design][product_titles][disable_desc]" value="off">
                <input type="checkbox"
                       name="main_options[mblp_design][product_titles][disable_desc]"
                    <?php echo wpm_option_is('mblp_design.product_titles.disable_desc', 'on') ? ' checked' : ''; ?> />
                <?php _e('Отключить', 'mbl_admin'); ?>
            </label>
        </div>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста', 'mbl_admin'), 'key' => 'mblp_design.product_titles.desc_color', 'default' => '868686', 'main' => true)) ?>
        <br>

        <h4><?php _e('Время доступа', 'mbl_admin'); ?>:</h4>
        <div class="wpm-row">
            <label>
                <input type="hidden" name="main_options[mblp_design][product_titles][disable_time]" value="off">
                <input type="checkbox"
                       name="main_options[mblp_design][product_titles][disable_time]"
                    <?php echo wpm_option_is('mblp_design.product_titles.disable_time', 'on') ? ' checked' : ''; ?> />
                <?php _e('Отключить', 'mbl_admin'); ?>
            </label>
        </div>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста', 'mbl_admin'), 'key' => 'mblp_design.product_titles.time_color', 'default' => '868686', 'main' => true)) ?>
        <br>

        <h4><?php _e('Цена', 'mbl_admin'); ?>:</h4>
        <div class="wpm-row">
            <label>
                <input type="hidden" name="main_options[mblp_design][product_titles][disable_price]" value="off">
                <input type="checkbox"
                       name="main_options[mblp_design][product_titles][disable_price]"
                    <?php echo wpm_option_is('mblp_design.product_titles.disable_price', 'on') ? ' checked' : ''; ?> />
                <?php _e('Отключить', 'mbl_admin'); ?>
            </label>
        </div>
        <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста', 'mbl_admin'), 'key' => 'mblp_design.product_titles.price_color', 'default' => '868686', 'main' => true)) ?>
        <br>

    </div>
</div>