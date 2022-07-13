<?php

class MBLPOrder
{
    /**
     * MBLPProduct constructor.
     */
    public function __construct()
    {
        $this->_setHooks();
    }

    private function _setHooks()
    {
        add_action('woocommerce_order_status_completed', array($this, 'applyLevelKey'), 10, 2);
        add_action('woocommerce_order_status_processing', array($this, 'completeOrder'), 10, 2);
        add_filter('woocommerce_order_item_needs_processing', '__return_false');
        add_filter('woocommerce_order_item_name', array($this, 'orderItemName'), 10, 3);
    }

    public function orderItemName($name, $item, $isVisible)
    {
        $product = $item->get_product();

        if ($product && is_callable(array($product, 'getProductName'))) {
            return $product->getProductName();
        } else {
            return $name;
        }
    }

    /**
     * @param $orderId
     * @param WC_Order $order
     */
    public function applyLevelKey($orderId, $order)
    {
        $metaKey = 'mblp_order_processed_' . $orderId;
        $processed = get_user_meta($order->get_user_id(), $metaKey, true) == 1;

        if (!$processed) {
            if (count($order->get_items()) > 0) {
                foreach ($order->get_items() as $item) {
                    if ($item->is_type('line_item')) {
                        $product = $item->get_product();

                        if (!$product || (!($product instanceof WC_Product_MBL) && !($product instanceof WC_Product_IPR))) {
                            continue;
                        }

                        $code = null;

                        if ($product instanceof WC_Product_MBL) {
                            $code = wpm_insert_one_user_key($product->get_mbl_key_pin_code_level_id(), $product->get_mbl_key_pin_code_duration(), $product->get_mbl_key_pin_code_units(), $product->get_mbl_key_pin_code_is_unlimited());
                        } elseif ($product instanceof WC_Product_IPR) {
                            $codes = $product->get_ipr_codes();
                            $code = trim(array_shift($codes));

                            $mblKeys = array(
                                array(
                                    'key'      => $code,
                                    'status'   => 'new',
                                    'duration' => $product->get_mbl_key_pin_code_duration(),
                                    'units'    => $product->get_mbl_key_pin_code_units(),
                                    'is_unlimited' => $product->get_mbl_key_pin_code_is_unlimited(),
                                )
                            );

                            $termKeys = wpm_get_term_keys($product->get_mbl_key_pin_code_level_id());

                            if (empty($termKeys)) {
                                $termKeys = array();
                            }

                            $termKeys = array_merge($termKeys, $mblKeys);
                            wpm_set_term_keys($product->get_mbl_key_pin_code_level_id(), $termKeys);

                            $product->set_ipr_codes($codes);
                            $product->save();
                        }

                        if (wpm_option_is('mblp.auto_activation', 'on')) {
                            wpm_add_key_to_user($order->get_user_id(), $code, true);
                        }

                        do_action('mblp_send_order_product_emails', $order, $product, $code);
                    }
                }
            }

            update_user_meta($order->get_user_id(), $metaKey, 1);
        }
    }

    /**
     * @param $orderId
     * @param WC_Order $order
     */
    public function completeOrder($orderId, $order)
    {
        $order->update_status('completed');
    }
}