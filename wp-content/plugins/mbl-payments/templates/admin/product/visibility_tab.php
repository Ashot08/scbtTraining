<?php /** @var WC_Product_MBL $product_object */ ?>
<?php $product_meta = is_callable(array($product_object, 'get_mblp_meta')) ? $product_object->get_mblp_meta('edit') : [] ?>
<div id='mbl_key_visibility_options' class='panel woocommerce_options_panel'>
    <div class='options_group'>
        <?php
            woocommerce_wp_select(
                array(
                    'id' => '_mbl_key_visibility_level_action',
                    'value' => is_callable(array($product_object, 'get_mbl_key_visibility_level_action')) ? $product_object->get_mbl_key_visibility_level_action('edit') : 'hide',
                    'label' => '',
                    'options' => $options,
                    'desc_tip' => false,
                    'wrapper_class' => 'form-row',
                )
            );
        ?>
        <div class="wpm-inner-tab-content">
            <?php wpm_hierarchical_category_tree(0, $product_meta, '', '_mblp_meta[exclude_levels]'); ?>
            <label class="mblp_hide_for_not_registered">
                <input type="checkbox"
                       name="_mblp_meta[hide_for_not_registered]"
                    <?php echo wpm_array_get($product_meta, 'hide_for_not_registered')=='on' ? 'checked' : ''; ?>>
                <?php _e('Не отображать для незарегистрированных пользователей.', 'mbl_admin') ?></label>
        </div>

    </div>
</div>