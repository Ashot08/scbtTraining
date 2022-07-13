<?php

class WC_Product_MBL extends WC_Product
{
    private static $previewTypes = [
        'folder-with-files',
        'folder-with-folders',
        'image',
    ];

    protected $extra_data = [
        'mbl_key_pin_code_level_id'       => null,
        'mbl_key_pin_code_duration'       => 12,
        'mbl_key_pin_code_units'          => 'months',
        'mbl_key_pin_code_is_unlimited'   => 0,
        'mbl_preview_type'                => 'folder-with-files',
        'mbl_key_visibility_level_action' => 'hide',
        'mbl_redirect'                    => null,
        'mbl_redirect_url'                => null,
        'mblp_is_custom_letter'           => false,
        'mblp_letter'                     => null,
        'mblp_letter_title'               => null,
        'mblp_meta'                       => [],
    ];

    public function __construct($product)
    {
        $this->product_type = MBLPProduct::MBL_PRODUCT_TYPE;
        $this->virtual = 'yes';
        $this->downloadable = 'yes';
        $this->manage_stock = 'no';

        $this->supports[] = 'ajax_add_to_cart';

        parent::__construct($product);
    }

    public function get_type()
    {
        return MBLPProduct::MBL_PRODUCT_TYPE;
    }

    public function get_mbl_redirect($context = 'view')
    {
        $val = $this->get_prop('mbl_redirect', $context);

        return $val ?: wpm_get_option('mblp.redirect_page', 'activation');
    }

    public function set_mbl_redirect($type)
    {
        $this->set_prop('mbl_redirect', $type);
    }

    public function get_mbl_redirect_url($context = 'view')
    {
        $val = $this->get_prop('mbl_redirect_url', $context);

        return $val ?: wpm_get_option('mblp.redirect_url');
    }

    public function set_mbl_redirect_url($val)
    {
        $this->set_prop('mbl_redirect_url', $val);
    }

    public function get_mblp_is_custom_letter($context = 'view')
    {
        return $this->get_prop('mblp_is_custom_letter', $context);
    }

    public function set_mblp_is_custom_letter($val)
    {
        $this->set_prop('mblp_is_custom_letter', (bool)$val);
    }

    public function get_mblp_letter($context = 'view')
    {
        $val = $this->get_prop('mblp_letter', $context);

        return $val ?: wpm_get_option('letters.mblp.client_product.content');
    }

    public function set_mblp_letter($val)
    {
        $this->set_prop('mblp_letter', $val);
    }

    public function get_mblp_letter_title($context = 'view')
    {
        $val = $this->get_prop('mblp_letter_title', $context);

        return $val ?: wpm_get_option('letters.mblp.client_product.title');
    }

    public function set_mblp_letter_title($val)
    {
        $this->set_prop('mblp_letter_title', $val);
    }
    
    public function set_mblp_meta($val)
    {
        $this->set_prop('mblp_meta', (array) $val);
    }

    public function get_mblp_meta($context = 'view')
    {
        $val = $this->get_prop('mblp_meta', $context);

        return $val ? (array) $val : [];
    }

    public function set_mbl_key_visibility_level_action($val)
    {
        $this->set_prop('mbl_key_visibility_level_action', $val == 'show_only' ? 'show_only' : 'hide');
    }

    public function get_mbl_key_visibility_level_action($context = 'view')
    {
        return $this->get_prop('mbl_key_visibility_level_action', $context);
    }

    public function get_mbl_key_pin_code_level_id($context = 'view')
    {
        return $this->get_prop('mbl_key_pin_code_level_id', $context);
    }

    public function set_mbl_key_pin_code_level_id($levelId)
    {
        $this->set_prop('mbl_key_pin_code_level_id', absint($levelId));
    }

    public function get_mbl_preview_type($context = 'view')
    {
        return $this->get_prop('mbl_preview_type', $context);
    }

    public function set_mbl_preview_type($type)
    {
        $this->set_prop('mbl_preview_type', in_array($type, self::$previewTypes) ? $type : 'folder-with-files');
    }

    public function get_mbl_key_pin_code_duration($context = 'view')
    {
        return $this->get_prop('mbl_key_pin_code_duration', $context);
    }

    public function getMBLLevelName()
    {
        return get_term_field('name', $this->get_mbl_key_pin_code_level_id(), 'wpm-levels');
    }

    public function getProductName($strict = false)
    {
        if ($strict) {
            return $this->get_short_description();
        } else {
            return $this->get_short_description() ? $this->get_short_description() : $this->get_name();
        }
    }

    public function set_mbl_key_pin_code_duration($duration)
    {
        $this->set_prop('mbl_key_pin_code_duration', absint($duration));
    }

    public function get_mbl_key_pin_code_units($context = 'view')
    {
        return $this->get_prop('mbl_key_pin_code_units', $context);
    }

    public function set_mbl_key_pin_code_is_unlimited($is_unlimited)
    {
        if (!is_integer($is_unlimited)) {
            $is_unlimited = intval($is_unlimited === 'on');
        }

        $this->set_prop('mbl_key_pin_code_is_unlimited', intval($is_unlimited));
    }

    public function get_mbl_key_pin_code_is_unlimited($context = 'view')
    {
        return $context === 'edit'
            ? ($this->get_prop('mbl_key_pin_code_is_unlimited', $context) ? 'on' : 'off')
            : $this->get_prop('mbl_key_pin_code_is_unlimited', $context);
    }

    public function getAccessTimeText()
    {
        $units = $this->get_mbl_key_pin_code_units();
        $duration = $this->get_mbl_key_pin_code_duration();

        $is_unlimited = $this->get_mbl_key_pin_code_is_unlimited();

        if ($is_unlimited) {
            return wpm_get_option('mblp_texts.unlimited_access');
        }

        return sprintf(_n($units == 'months' ? '%s month' : '%s day', $units == 'months' ? '%s months' : '%s days', $duration), $duration);
    }

    public function set_mbl_key_pin_code_units($units)
    {
        $this->set_prop('mbl_key_pin_code_units', $units === 'days' ? 'days' : 'months');
    }

    public function add_to_cart_text()
    {
        $text = $this->is_purchasable() ? __('Add to cart', 'woocommerce') : __('Read more', 'woocommerce');

        return apply_filters('woocommerce_product_add_to_cart_text', $text, $this);
    }

    public function add_to_cart_url()
    {
        $url = $this->is_purchasable() ? remove_query_arg('added-to-cart', add_query_arg('add-to-cart', $this->id)) : get_permalink($this->id);

        return apply_filters('woocommerce_product_add_to_cart_url', $url, $this);
    }

    public function get_add_to_cart_sample_url()
    {
        return remove_query_arg('added-to-cart', add_query_arg('add-to-cart', $this->id, get_permalink($this->id)));
    }

    public function is_sold_individually()
    {
        return true;
    }

    public function get_sold_individually($context = 'view')
    {
        return true;
    }

    public function get_upsell_ids($context = 'view')
    {
        $ids = parent::get_upsell_ids($context);
        $in_cart = [];

        if (WC()->cart && !WC()->cart->is_empty()) {
            foreach (WC()->cart->get_cart() as $cart_item_key => $values) {
                if ($values['quantity'] > 0) {
                    $in_cart[] = $values['product_id'];
                }
            }
        }

        $ids = array_diff($ids, $in_cart);

        return $ids;
    }


    /**
     * @param int $limit
     * @param string $orderby
     * @param string $order
     *
     * @return array|WC_Product_MBL[]
     */
    public function getUpsells($limit = -1, $orderby = 'title', $order = 'desc')
    {
        $upsells = wc_products_array_orderby(array_filter(array_map('wc_get_product', $this->get_upsell_ids()), 'wc_products_array_filter_visible'), $orderby, $order);
        $upsells = $limit > 0 ? array_slice($upsells, 0, $limit) : $upsells;

        return $upsells;
    }

    public function getAddToCartLinkAttrs($args = [])
    {
        $defaults = [
            'quantity'   => 1,
            'class'      => implode(
                ' ',
                array_filter(
                    [
                        'button',
                        'product_type_' . $this->get_type(),
                        $this->is_purchasable() && $this->is_in_stock() ? 'add_to_cart_button' : '',
                        $this->supports('ajax_add_to_cart') && $this->is_purchasable() && $this->is_in_stock() ? 'ajax_add_to_cart' : '',
                    ]
                )
            ),
            'attributes' => [
                'data-product_id'  => $this->get_id(),
                'data-product_sku' => $this->get_sku(),
                'aria-label'       => $this->add_to_cart_description(),
                'rel'              => 'nofollow',
            ],
        ];

        $args = apply_filters('woocommerce_loop_add_to_cart_args', wp_parse_args($args, $defaults), $this);

        if (isset($args['attributes']['aria-label'])) {
            $args['attributes']['aria-label'] = wp_strip_all_tags($args['attributes']['aria-label']);
        }

        return $args;
    }

    public function is_downloadable()
    {
        return true;
    }

    public function is_virtual()
    {
        return true;
    }

    public function has_access()
    {
        return MBLPProduct::hasProductAccess($this);
    }


}