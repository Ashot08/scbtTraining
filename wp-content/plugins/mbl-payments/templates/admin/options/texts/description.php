<div id="header-tab-mblp-5-description">
    <div class="wpm-control-row wpm-inner-tab-content">
        <?php wpm_render_partial('options/text-row', 'admin', ['label' => __('Описание товара', 'mbl_admin'), 'key' => 'mblp_texts.cart_desc']) ?>
        <?php wpm_render_partial('options/text-row', 'admin', ['label' => __('Время доступа к товару', 'mbl_admin'), 'key' => 'mblp_texts.cart_time']) ?>
        <?php wpm_render_partial('options/text-row', 'admin', ['label' => __('Неограниченное время доступа', 'mbl_admin'), 'key' => 'mblp_texts.unlimited_access']) ?>
        <?php wpm_render_partial('options/text-row', 'admin', ['label' => __('Цена', 'mbl_admin'), 'key' => 'mblp_texts.cart_price']) ?>
        <?php wpm_render_partial('options/text-row', 'admin', ['label' => __('Цена товара с нулевой стоимостью', 'mbl_admin'), 'key' => 'mblp_texts.cart_free_price']) ?>
    </div>
</div>
