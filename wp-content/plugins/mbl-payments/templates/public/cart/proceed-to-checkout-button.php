<?php
	/**
	 * Proceed to checkout button
	 *
	 * Contains the markup for the proceed to checkout button on the cart.
	 *
	 * This template can be overridden by copying it to yourtheme/woocommerce/cart/proceed-to-checkout-button.php.
	 *
	 * HOWEVER, on occasion WooCommerce will need to update template files and you
	 * (the theme developer) will need to copy the new files to your theme to
	 * maintain compatibility. We try to do this as little as possible, but it does
	 * happen. When this occurs the version of the template file will be bumped and
	 * the readme will list any important changes.
	 *
	 * @see     https://docs.woocommerce.com/document/template-structure/
	 * @package WooCommerce/Templates
	 * @version 2.4.0
	 */
	
	if (!defined('ABSPATH')) {
		exit; // Exit if accessed directly.
	}
	
	$withDiscounts = defined('MBL_DISCOUNTS_VERSION');
?>

<div class="row">
	<?php if (WC()->cart->check_cart_item_stock() === true) : ?>
        <div class="col-sm-6 col-sm-push-6 cart-buttons-col <?php echo !$withDiscounts ? 'pb20' : ''; ?>">
			<?php if (apply_filters('mblp_show_order_total_block', !wpm_option_is('mblp_design.buttons.order_total_disable', 'on'))) : ?>
                <div class="mblp-cart-total">
                    <span class="mblp-cart-total-label"><?php echo wpm_get_option('mblp_texts.checkout_order'); ?></span>
					<?php do_action('payments_cart_after_total'); ?>
					<?php wc_cart_totals_order_total_html(); ?>
                </div>
			<?php endif; ?>
            <a href="<?php echo esc_url(wc_get_checkout_url()); ?>"
               class="mbr-btn btn-default btn-solid btn-green text-uppercase cart-proceed-button">
				<?php echo apply_filters('mblp_texts_cart_order', wpm_get_option('mblp_texts.cart_order')); ?>
            </a>
			<?php do_action('payments_cart_after_procees_btn'); ?>
        </div>
		<?php if (apply_filters('mblp_show_return_btn', !wpm_option_is('mblp_design.buttons.back_btn_disable', 'on'))) : ?>
            <div class="col-sm-6 col-sm-pull-6 cart-buttons-col">
				<?php do_action('payments_cart_before_return_btn'); ?>
				<?php mblp_render_partial('partials/return-button'); ?>
            </div>
		<?php else: ?>
            <div class="col-sm-6 col-sm-pull-6 cart-buttons-col without-return-btn">
				<?php do_action('payments_cart_before_return_btn'); ?>
            </div>
		<?php endif; ?>
	<?php else : ?>
        <div class="col-sm-12 cart-buttons-col">
			<?php mblp_render_partial('partials/return-button'); ?>
        </div>
	<?php endif; ?>
</div>
