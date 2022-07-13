<?php

class MBLPCart
{
    /**
     * MBLPCart constructor.
     */
    public function __construct()
    {
        $this->_setHooks();
    }

    private function _setHooks()
    {
        add_filter('woocommerce_add_to_cart_sold_individually_found_in_cart', '__return_false', 100);
        add_action('woocommerce_after_cart_item_quantity_update', array($this, 'restrictCartQuantityUpdate'), 10, 4);

        add_filter('woocommerce_coupons_enabled', '__return_false', 100);
    }

    public function restrictCartQuantityUpdate($cart_item_key, $quantity, $old_quantity, $wcCart)
    {
        $wcCart->cart_contents[ $cart_item_key ]['quantity'] = 1;
    }
}