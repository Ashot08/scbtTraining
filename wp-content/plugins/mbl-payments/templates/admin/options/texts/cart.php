<div id="header-tab-mblp-5-cart">
    <div class="wpm-control-row wpm-inner-tab-content">
        <?php wpm_render_partial('options/text-row', 'admin', array('label' => __('Название корзины', 'mbl_admin'), 'key' => 'mblp_texts.cart')) ?>
        <?php wpm_render_partial('options/text-row', 'admin', array('label' => __('Пустая корзина', 'mbl_admin'), 'key' => 'mblp_texts.cart_empty')) ?>

        <div class="wpm-row">
            <label>
                <?php _e('Хлебные крошки', 'mbl_admin') ?>:
                <input type="text"
                       name="main_options[mblp_texts][checkout]"
                       class="large-text"
                       value="<?php echo wpm_get_option('mblp_texts.checkout', __('Оформление заказа', 'mbl_admin')); ?>"
                >
            </label>
        </div>

        <div class="wpm-row">
            <label>
                <?php _e('Комментарий к заказу', 'mbl_admin') ?>:
                <input type="text"
                       name="main_options[mblp_texts][order_comment]"
                       class="large-text"
                       value="<?php echo wpm_get_option('mblp_texts.order_comment', __('Комментарий к заказу', 'mbl_admin')); ?>"
                >
            </label>
        </div>
    </div>
</div>