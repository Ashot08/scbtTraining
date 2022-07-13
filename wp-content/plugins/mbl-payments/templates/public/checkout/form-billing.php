<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-billing-fields">
    <?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

    <?php $billingFields = $checkout->get_checkout_fields('billing'); ?>
    <?php if (count($billingFields)) : ?>
        <div class="form-fields-group">
            <?php foreach ($billingFields as $key => $field) : ?>
                <?php echo mblp_checkout_form_field($key, $field, $checkout->get_value($key)); ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php $contactFields = $checkout->get_checkout_fields('contacts'); ?>
    <?php if (count($contactFields)) : ?>
        <div class="form-fields-group">
            <?php foreach ($contactFields as $key => $field) : ?>
                <?php echo mblp_checkout_form_field($key, $field, $checkout->get_value($key)); ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php $accountFields = $checkout->get_checkout_fields('account'); ?>
    <?php if (count($accountFields)) : ?>
        <div class="form-fields-group">
            <?php foreach ($accountFields as $key => $field) : ?>
                <?php echo mblp_checkout_form_field($key, $field, $checkout->get_value($key)); ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php $orderFields = $checkout->get_checkout_fields('order'); ?>
    <?php if (count($orderFields)) : ?>
        <div class="form-fields-group">
            <?php foreach ($orderFields as $key => $field) : ?>
                <?php echo mblp_checkout_form_field($key, $field, $checkout->get_value($key)); ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

