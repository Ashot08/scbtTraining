<?php

class MBLPPublic
{
    /**
     * MBLPPublic constructor.
     */
    public function __construct()
    {
        $this->_setHooks();
    }

    private function _setHooks()
    {
        if (!is_admin()) {
            $this->_configureTemplates();
            $this->_addStyles();
            $this->_addScripts();

            remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
            remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
            remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
            add_filter('woocommerce_product_related_posts_query', '__return_empty_array', 100);

            if (apply_filters('enable_mblp_redirects', true)) {
                add_action('wp', [$this, 'configureRedirects']);
            }

            add_action('mbl_after_search_hint_form', 'wc_clear_cart_after_payment');
            add_action('mbl_after_search_hint_form', [$this, 'addCartIcon']);

            add_filter('mbl_catalog_cart_item_price', [$this, 'renderFreeText'], 2, 10);
            add_filter('mbl_is_mbl_page', [$this, 'isMBLPage']);

            add_action('after_setup_theme', [$this, 'afterSetupTheme']);
            add_action('wp_enqueue_scripts', [$this, 'dequeueThemeAssetsHeader'], 100);
            add_action('wp_enqueue_scripts', [$this, 'dequeueThemeAssetsFooter'], 100);
            add_action('wpm_footer', [$this, 'addFooterCode']);
            add_action('wpm_head', [$this, 'addHeaderCode']);

            add_filter('woocommerce_order_button_html', [$this, 'addMBLClassToOrderButton'], 101);

            remove_filter('lostpassword_url', 'wc_lostpassword_url');
        }
    }

    public function afterSetupTheme()
    {
        add_theme_support('woocommerce');
    }

    private function _configureTemplates()
    {
        add_filter('wc_get_template', [$this, 'rewriteWCTemplates'], 10, 5);
        add_filter('mbl_template_include', [$this, 'addMBLTemplate'], 1000);
    }

    public function rewriteWCTemplates($template, $template_name, $args = [], $template_path = '', $default_path = '')
    {
        switch ($template_name) {
            case 'cart/cart.php':
                $template = $this->_getPartialPath('cart/cart');
                break;
            case 'cart/cart-empty.php':
                $template = $this->_getPartialPath('cart/cart-empty');
                break;
            case 'cart/cart-totals.php':
                $template = $this->_getPartialPath('cart/cart-totals');
                break;
            case 'cart/proceed-to-checkout-button.php':
                $template = $this->_getPartialPath('cart/proceed-to-checkout-button');
                break;
            case 'checkout/cart-errors.php':
                $template = $this->_getPartialPath('checkout/cart-errors');
                break;
            case 'checkout/form-billing.php':
                $template = $this->_getPartialPath('checkout/form-billing');
                break;
            case 'checkout/form-checkout.php':
                $template = $this->_getPartialPath('checkout/form-checkout');
                break;
            case 'checkout/form-login.php':
                $template = $this->_getPartialPath('checkout/form-login');
                break;
            case 'checkout/form-pay.php':
                $template = $this->_getPartialPath('checkout/form-pay');
                break;
            case 'checkout/order-receipt.php':
                $template = $this->_getPartialPath('checkout/order-receipt');
                break;
            case 'checkout/payment.php':
                $template = $this->_getPartialPath('checkout/payment');
                break;
            case 'checkout/payment-method.php':
                $template = $this->_getPartialPath('checkout/payment-method');
                break;
            case 'checkout/review-order.php':
                $template = $this->_getPartialPath('checkout/review-order');
                break;
            case 'checkout/terms.php':
                $template = $this->_getPartialPath('checkout/terms');
                break;
            case 'checkout/thankyou.php':
                $template = $this->_getPartialPath('checkout/thankyou');
                break;
            case 'single-product/related.php':
                $template = $this->_getPartialPath('single-product/related');
                break;
            case 'notices/error.php':
                $template = $this->_getPartialPath('notices/error');
                break;
            case 'notices/notice.php':
                $template = $this->_getPartialPath('notices/notice');
                break;
            case 'notices/success.php':
                $template = $this->_getPartialPath('notices/success');
                break;
        }

        return $template;
    }

    public function addMBLTemplate($template)
    {
        mblp_remove_notices();

        if (is_cart()) {
            $template = $this->_getTemplatePath('master');
        } elseif (is_checkout()) {
            $template = $this->_getTemplatePath('master');
        }

        return $template;
    }

    public function configureRedirects()
    {
        $redirect = is_product() || is_shop() || is_account_page();

        if ($redirect) {
            wpm_redirect_to_main();
        }
    }

    public function isMBLPage($result)
    {
        return $result || is_checkout() || is_cart() /*|| is_shop()*/;
    }

    private function _getTemplatePath($template)
    {
        $path = "templates/public/layouts/{$template}.php";

        return MBLP_DIR . $path;
    }

    private function _getPartialPath($partial)
    {
        $path = "templates/public/{$partial}.php";

        return MBLP_DIR . $path;
    }

    private function _addStyles()
    {
        add_action("wpm_head", [$this, 'addStyles'], 901);
    }

    public function addStyles()
    {
        wpm_enqueue_style('mblp_main', plugins_url('/mbl-payments/assets/css/main.css?v=' . MBLP_VERSION));
        mblp_render_partial('partials/css');
    }

    private function _isStripePluginActive()
    {
        include_once ABSPATH . 'wp-admin/includes/plugin.php';

        return is_plugin_active('woocommerce-gateway-stripe/woocommerce-gateway-stripe.php');
    }


    private function _addScripts()
    {
        add_action("wpm_footer", [$this, 'addScripts'], 901);
        add_action("wpm_footer", [$this, 'addFooterStyles'], 902);
    }

    public function addScripts()
    {
        wpm_enqueue_script('mblp_js_main', plugins_url('/mbl-payments/assets/js/mblp_public.js?v=' . MBLP_VERSION));

        if (is_checkout()) {
            $this->_addCheckoutScripts();
        }
    }

    private function _addWpScript($handle)
    {
        global $wp_scripts;

        $obj = isset($wp_scripts->registered[$handle]) ? $wp_scripts->registered[$handle] : null;

        if (apply_filters('mblp_add_wp_script', $obj)) {
            $this->_addScriptExtra($obj);
            wpm_enqueue_script('mblp_' . $handle, $obj->src);
        }
    }

    private function _addScriptExtra($scriptData)
    {
        $data = wpm_array_get($scriptData->extra, 'data');

        if ($data) {
            printf('<script id="mblp_%s-js-extra">%s</script>', $scriptData->handle, $data);
        }
    }

    private function _addCheckoutScripts()
    {
        $this->_addWpScript('jquery-blockui');
        $this->_addWpScript('wc-add-to-cart');
        $this->_addWpScript('selectWoo-cart');
        $this->_addWpScript('js-cookie');
        $this->_addWpScript('woocommerce');
        $this->_addWpScript('wc-country-select');
        $this->_addWpScript('wc-address-i18n');
        $this->_addWpScript('wc-checkout');
        $this->_addWpScript('wc-cart-fragments');
        $this->_addWpScript('woocommerce-tokenization-form');
        $this->_addWpScript('jquery-payment');

        if ($this->_isStripePluginActive()) {
            $this->_addWpScript('stripe');
            $this->_addWpScript('wc_stripe_payment_request');
            $this->_addWpScript('woocommerce_stripe');
        }

        wc_print_js();
    }

    private function _addWpStyle($handle)
    {
        global $wp_styles;

        $obj = isset($wp_styles->registered[$handle]) ? $wp_styles->registered[$handle] : null;

        if (apply_filters('mblp_add_wp_style', $obj)) {
            wpm_enqueue_style('mblp_' . $handle, $obj->src);
        }
    }

    public function addFooterStyles()
    {
        if (is_checkout() && $this->_isStripePluginActive()) {
            $this->_addWpStyle('stripe_styles');
        }
    }

    public function addCartIcon()
    {
        mblp_render_partial('partials/cart-icon');
    }

    public function mblHasAccess()
    {
        return true;
    }

    public function redirectToActivationPage($order)
    {
        if ($order && $order->status != 'failed') {
            wp_safe_redirect(wpm_activation_link());
            exit;
        }
    }

    public function renderFreeText($price, $product)
    {
        return empty($product->get_price())
            ? wpm_get_option('mblp_texts.cart_free_price') ? wpm_get_option('mblp_texts.cart_free_price') : $price
            : $price;
    }

    public function getBackButtonUrl()
    {
        if (MBLPAdmin::isOptionHomepage()) {
            return get_home_url();
        }

        $option = wpm_get_option('mblp.back_redirect_page', 'homepage');

        switch ($option) {
            case 'shop':
                $url = esc_url(wc_get_page_permalink('shop'));
                break;
            case 'custom':
                $url = wpm_get_option('mblp.back_redirect_page_link', '');
                break;
            case 'previous':
                $url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : get_home_url();
                break;
        }

        return $url;
    }

    public function dequeueThemeAssets($inFooter = false)
    {
        global $wp_styles;
        global $wp_scripts;

        $excludeStylesPatterns = [
            'woocommerce',
        ];

        if (is_checkout()) {
            $theme = wp_get_theme();

            $child_theme = $theme->get_stylesheet();
            $parent_theme = $theme->get_template();

            unset($wp_styles->registered['woocommerce-general']);

            foreach ($wp_scripts->queue as $value) {
                if (isset($wp_scripts->registered[$value])) {
                    $src = $wp_scripts->registered[$value]->src;

                    $isThemeFile = strpos($src, "themes/$child_theme/") !== false
                                   || strpos($src, "themes/$parent_theme/") !== false
                                   || strpos($src, "/uploads/$child_theme/") !== false
                                   || strpos($src, "/uploads/$parent_theme/") !== false;

                    if ($isThemeFile) {
                        unset($wp_scripts->registered[$value]);
                    }
                }
            }


            foreach ($wp_styles->registered as $key => $value) {
                $src = $value->src;
                if (strpos($src, "themes/$child_theme/") !== false || strpos($src, "themes/$parent_theme/") !== false) {
                    unset($wp_styles->registered[$key]);
                }

                if (strpos($src, "/uploads/$child_theme/") !== false || strpos($src, "/uploads/$parent_theme/") !== false) {
                    unset($wp_styles->registered[$key]);
                }

                foreach ($excludeStylesPatterns as $excludeStylesPattern) {
                    if (strpos($src, $excludeStylesPattern) !== false) {
                        unset($wp_styles->registered[$key]);
                    }
                }
            }
        }
    }

    public function dequeueThemeAssetsHeader()
    {
        $this->dequeueThemeAssets();
    }

    public function dequeueThemeAssetsFooter()
    {
        $this->dequeueThemeAssets(true);
    }

    public function addFooterCode()
    {
        if (apply_filters('mblp_wp_footer', is_checkout())) {
            wp_footer();
        }
    }

    public function addHeaderCode()
    {
        if (apply_filters('mblp_wp_wp_head', is_checkout())) {
            wp_head();
        }
    }

    public function addMBLClassToOrderButton($button)
    {
        $classes = 'mbr-btn btn-default btn-solid btn-green text-uppercase cart-proceed-button';

        return preg_replace_callback('/<[^>]*(type\s*=\s*\"submit\")[^>]*>/i',
            function ($m) use ($classes) {
                if (strpos($m[0], 'class') !== false) {
                    return preg_replace('/class\s*=\s*\"([^\"]*)\"/i', 'class="$1 ' . $classes . '"', $m[0]);
                } else {
                    return preg_replace('/type\s*=\s*\"submit\"/i', 'type="submit" class="' . $classes . '"', $m[0]);
                }

            },
            $button);
    }
}