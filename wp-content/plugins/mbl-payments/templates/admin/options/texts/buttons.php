<div id="header-tab-mblp-5-buttons">
    <div class="wpm-control-row wpm-inner-tab-content">
        <?php wpm_render_partial('options/text-row', 'admin', array('label' => __('Кнопка оформления заказа', 'mbl_admin'), 'key' => 'mblp_texts.cart_order')) ?>
        <?php do_action('mblp_settings_texts_after_cart_order'); ?>
        <?php wpm_render_partial('options/text-row', 'admin', array('label' => __('Итоговая цена', 'mbl_admin'), 'key' => 'mblp_texts.checkout_order')) ?>
        <?php wpm_render_partial('options/text-row', 'admin', array('label' => __('Кнопка возвращения из корзины', 'mbl_admin'), 'key' => 'mblp_texts.cart_back')) ?>
    </div>
</div>