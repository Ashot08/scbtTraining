<?php /** @var WC_Product_MBL $product_object */ ?>
<div id='mbl_key_preview_type' class='panel woocommerce_options_panel'>
    <div class='options_group'>
        <?php
            woocommerce_wp_radio(
                array(
                    'id' => '_mbl_preview_type',
                    'value' => is_callable(array($product_object, 'get_mbl_preview_type')) ? $product_object->get_mbl_preview_type('edit') : 'folder-with-files',
                    'label' => __('Дизайн', 'mbl_admin'),
                    'options' => $options,
                    'desc_tip' => false,
                    'wrapper_class' => 'form-row',
                )
            );
        ?>
    </div>
</div>