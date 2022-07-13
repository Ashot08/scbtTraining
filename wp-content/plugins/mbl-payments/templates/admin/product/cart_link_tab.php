<?php /** @var WC_Product_MBL $product_object */ ?>
<?php $type = is_callable(array($product_object, 'get_mbl_redirect')) ? $product_object->get_mbl_redirect('edit') : wpm_get_option('mblp.redirect_page') ?>
<div id='mbl_key_cart_link_options' class='panel woocommerce_options_panel'>
    <div class="options_group">
        <?php
            woocommerce_wp_select(
                array(
                    'id' => '_mbl_redirect',
                    'value' => $type,
                    'label' => (__('Страница после оплаты', 'mbl_admin') . ':'),
                    'options' => $options,
                    'desc_tip' => false,
                    'wrapper_class' => 'form-row',
                )
            );
        ?>

        <p>
            <span class="wrap">
                <input type="text"
                       id="mbl_redirect_url"
                       name="_mbl_redirect_url"
                       class="short"
                       placeholder="<?php _e('Укажите URL', 'mbl_admin'); ?>"
                       style="<?php echo $type == 'custom' ? '' : 'display:none;' ?>"
                       value="<?php echo is_callable(array($product_object, 'get_mbl_redirect_url')) ? $product_object->get_mbl_redirect_url('edit') : wpm_get_option('mblp.redirect_url'); ?>">
            </span>
        </p>
    </div>
    <div class="options_group">
        <?php if (is_callable(array($product_object, 'get_add_to_cart_sample_url'))) : ?>
            <p class="form-field mblp-product-link-content">
               <label><?php _e('Страница товара', 'mbl_admin'); ?>:</label>

               <span class="wrap">
                   <a href="<?php echo $product_object->get_add_to_cart_sample_url(); ?>"
                      data-mbl-tooltip
                      title="<?php _e('Открыть страницу товара', 'mbl_admin'); ?>"
                      target="_blank">
                        <i class="fa fa-external-link" aria-hidden="true"></i>
                    </a>

                   <button type="button"
                           class="button button-primary button-large"
                           data-clipboard-target="#mblp-product-link-target"
                           data-clipboard-result="<?php _e('Скопировано', 'mbl_admin'); ?>"
                   ><?php _e('Копировать', 'mbl_admin'); ?></button>
               </span>
            </p>
            <p class="mblp-product-link-text" id="mblp-product-link-target"><?php echo $product_object->get_add_to_cart_sample_url(); ?></p>
        <?php else : ?>
            <p class="form-field">
                <span class="wrap"><?php _e('Ссылка будет доступна после создания товара', 'mbl_admin'); ?></span>
            </p>
        <?php endif; ?>
    </div>
</div>