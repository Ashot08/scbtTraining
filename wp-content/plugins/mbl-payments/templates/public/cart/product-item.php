<?php /** @var WC_Product_MBL $_product */ ?>
<?php $type = is_callable(array($_product, 'get_mbl_preview_type')) ? $_product->get_mbl_preview_type() : 'folder-with-files'; ?>
<?php $showPriceBlock = apply_filters('mblp_show_price_block', !wpm_option_is('mblp_design.product_content.disable_price', 'on') || !wpm_option_is('mblp_design.product_titles.disable_price', 'on'), $_product, $cart_item_key)?>
<?php $showDurationBlock = !wpm_option_is('mblp_design.product_content.disable_time', 'on') || !wpm_option_is('mblp_design.product_titles.disable_time', 'on') ?>
<input type="hidden" name="cart[<?php echo $cart_item_key; ?>][qty]" value="1" />
<div class="row">
    <div class="col-xs-12">
        <div class="lesson-tabs bordered-tabs white-tabs tabs-count-1">
            <div class="tab-content">
                <?php
                    echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                        '<a href="%s" class="remove-cart-item" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="iconmoon icon-close"></i></a>',
                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                        __( 'Remove this item', 'woocommerce' ),
                        esc_attr( $product_id ),
                        esc_attr( $_product->get_sku() )
                    ), $cart_item_key );
                ?>
                <div class="row">
                    <div class="col-sm-6">
                        <?php mblp_render_partial('cart/preview/' . $type, 'public',  compact('_product', 'cart_item_key', 'cart_item')) ?>
                    </div>
                    <div class="col-sm-6">
                        <?php if ($showPriceBlock || $showDurationBlock) : ?>
                            <div class="row cart-row">
                                <?php if ($showDurationBlock) : ?>
                                    <div class="col-xs-6">
                                            <div class="cart-th-value cart-th-time">
                                                <?php if (!wpm_option_is('mblp_design.product_titles.disable_time', 'on')) : ?>
                                                    <?php echo wpm_get_option('mblp_texts.cart_time'); ?>
                                                <?php else: ?>
                                                    &nbsp;
                                                <?php endif; ?>
                                            </div>
                                        <div class="cart-td-value cart-td-time">
                                            <?php if (!wpm_option_is('mblp_design.product_content.disable_time', 'on')) : ?>
                                                <?php echo is_callable(array($_product, 'getAccessTimeText')) ? $_product->getAccessTimeText() : ''; ?>
                                            <?php else: ?>
                                                &nbsp;
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($showPriceBlock) : ?>
                                    <div class="col-xs-6">
                                        <div class="cart-th-value cart-th-price">
                                            <?php if (!wpm_option_is('mblp_design.product_titles.disable_price', 'on')) : ?>
                                                <?php echo wpm_get_option('mblp_texts.cart_price'); ?>
                                            <?php else : ?>
                                                &nbsp;
                                            <?php endif; ?>
                                        </div>
                                        <div class="cart-td-value cart-td-price">
                                            <?php if (!wpm_option_is('mblp_design.product_content.disable_price', 'on')) : ?>
                                                <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
                                            <?php else : ?>
                                                &nbsp;
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!wpm_option_is('mblp_design.product_content.disable_desc', 'on') || !wpm_option_is('mblp_design.product_titles.disable_desc', 'on')) : ?>
                            <div class="row cart-row">
                                <div class="col-xs-12">
                                    <div class="cart-th-value cart-th-desc">
                                        <?php if (!wpm_option_is('mblp_design.product_titles.disable_desc', 'on')) : ?>
                                            <?php echo wpm_get_option('mblp_texts.cart_desc'); ?>
                                        <?php else : ?>
                                            &nbsp;
                                        <?php endif; ?>
                                    </div>
                                    <div class="cart-td-value cart-td-desc">
                                        <?php if (!wpm_option_is('mblp_design.product_content.disable_desc', 'on')) : ?>
                                            <?php echo $_product->get_description(); ?>
                                        <?php else : ?>
                                            &nbsp;
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
