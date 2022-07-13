<?php /** @var WC_Product_MBL $product_object */ ?>
<?php $value = is_callable([$product_object, 'get_mblp_is_custom_letter']) ? $product_object->get_mblp_is_custom_letter('edit') : false ?>
<div id='mbl_key_letter_options' class='panel woocommerce_options_panel'>
    <div class='options_group'>
        <p class="_mblp_is_custom_letter_field form-row">
            <input type="checkbox"
                   class="checkbox"
                   name="_mblp_is_custom_letter"
                   id="_mblp_is_custom_letter"
                   <?php echo $value ? 'checked' : ''; ?>
                   value="1">
		    <label for="_mblp_is_custom_letter"><?php _e('Отправлять письмо клиенту после успешной оплаты', 'mbl_admin'); ?></label>
        </p>


        <div class="wpm-control-row wpm-inner-tab-content">
            <p class="wpm-row form-row letter-title">
                    <?php _e('Тема письма', 'mbl_admin') ?><br>
                    <input type="text"
                           name="_mblp_letter_title"
                           value="<?php echo is_callable(array($product_object, 'get_mblp_letter_title')) ? $product_object->get_mblp_letter_title('edit') : wpm_get_option('letters.mblp.client_product.title') ?>"
                           class="large-text">
            </p>
            <div class="wpm-control-row">
                <?php wp_editor(stripslashes(is_callable([$product_object, 'get_mblp_letter']) ? $product_object->get_mblp_letter('edit') : wpm_get_option('letters.mblp.client_product.content')), '_mblp_letter', ['textarea_name' => '_mblp_letter', 'editor_height' => 300]); ?>
            </div>

            <?php mblp_render_partial('options/mails/helper', 'admin') ?>
        </div>
    </div>
</div>