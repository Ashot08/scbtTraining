<div class="options_group pricing show_if_<?php echo MBLPProduct::MBL_PRODUCT_TYPE; ?> show_if_<?php echo MBLPProduct::IPR_PRODUCT_TYPE; ?> hidden">
    <?php
    woocommerce_wp_text_input(
        array(
            'id' => 'mblp_price',
            'name' => '_regular_price',
            'value' => $product_object->get_regular_price('edit'),
            'label' => __('Цена', 'mbl_admin') . ' (' . get_woocommerce_currency_symbol() . ')',
            'data_type' => 'price',
        )
    );
    ?>
</div>