<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>
<section class="clearfix mblp-row">
    <div class="container">
        <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
            <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) : ?>
                <?php $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key ); ?>
                <?php $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key ); ?>

                <?php if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) : ?>
                    <div class="mblp-product-cart-item">
                        <?php mblp_render_partial('cart/product-item', 'public', compact('_product', 'product_id', 'cart_item_key', 'cart_item')) ?>
                        <?php mblp_render_partial('cart/upsells', 'public', compact('_product', 'product_id', 'cart_item_key', 'cart_item')) ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

            <?php do_action( 'woocommerce_cart_contents' ); ?>
            <?php do_action( 'woocommerce_after_cart_contents' ); ?>
            <?php do_action( 'woocommerce_cart_actions' ); ?>
            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

            <?php do_action( 'woocommerce_after_cart_table' ); ?>
        </form>

        <div class="cart-collaterals">
            <?php
                /**
                 * Cart collaterals hook.
                 *
                 * @hooked woocommerce_cross_sell_display
                 * @hooked woocommerce_cart_totals - 10
                 */
                do_action( 'woocommerce_cart_collaterals' );
            ?>
        </div>

<?php do_action( 'woocommerce_after_cart' ); ?>
    </div>
</section>
