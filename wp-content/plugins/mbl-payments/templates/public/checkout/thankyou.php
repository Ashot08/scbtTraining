<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.2.0
 *
 * @var WC_Order $order
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php if ($order && $order->has_status( 'on-hold' )) : ?>
    <?php mblp_render_partial('checkout/partials/on-hold', 'public', compact('order')) ?>
<?php elseif ($order && !$order->has_status( 'failed' )) : ?>
    <section class="clearfix mblp-row mblp-checkout-row">
        <div class="container">
            <div
                id="mblp-status-loader"
                data-id="<?php echo $order->get_id(); ?>"
            >
                <?php mblp_render_partial('partials/loader') ?>
            </div>
            <div id="mblp-status-loader-error" style="display: none;">
                <div class="woocommerce-error" role="alert">
                    <?php echo wpm_get_option('mblp_texts.error_time_limit'); ?>
                </div>
            </div>
        </div>
    </section>
<?php else : ?>
    <section class="clearfix mblp-row mblp-checkout-row">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="login-tabs bordered-tabs tabs-count-1 checkout-tab order-details-tab">
                        <div class="tab-content">
                            <div class="woocommerce-order">

                                <?php if ( $order ) : ?>

                                    <?php if ( $order->has_status( 'failed' ) ) : ?>

                                        <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

                                        <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                                            <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
                                            <?php if ( is_user_logged_in() ) : ?>
                                                <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My account', 'woocommerce' ); ?></a>
                                            <?php endif; ?>
                                        </p>

                                    <?php endif; ?>

                                    <?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>

                                <?php else : ?>
                                    <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

