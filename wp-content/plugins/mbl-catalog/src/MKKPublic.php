<?php

class MKKPublic
{
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

            add_filter('enable_mblp_redirects',
                function () {
                    return false;
                });

            add_action('wp', [$this, 'MKKconfigureRedirects']);

            add_action('mbl_after_search_hint_form', [$this, 'addShopMenu']);

            add_filter('mbl_home_id', [$this, 'customHomeId']);
            add_filter('mbl_home_title', [$this, 'mblHomeTitle']);
            add_filter('mbl_home_name', [$this, 'mblHomeTitle']);
            add_filter('mbl_home_icon_class', [$this, 'mblHomeIconClass']);

            //Показать страницы уровней доступа
            add_filter('mbl_template_include', [$this, 'mkk_get_template'], 101);
            add_filter('mkk_product_render_add_to_cart_btn', [$this, 'renderAddToCartButton'], 10, 2);

        }

        add_filter('mbl_get_main_page', [$this, 'customHomeId']);
        add_filter('mbl_home_id_field_name', [$this, 'mblHomeIdFieldNameFilter']);
        add_filter('mbl_redirect_is_single', [$this, 'mblRedirectIsSingleFilter']);
    }

    private function _configureTemplates()
    {
        add_filter('mbl_template_include', [$this, 'addMBLTemplate'], 1001);
    }

    public function addMBLTemplate($template)
    {
        $main_options = get_option('wpm_main_options');

        if (is_shop() || is_product_category()) {

            $template = $this->_getTemplatePath('shop');

            if (!is_user_logged_in() && !$main_options['main']['opened']) {
                $template = _wpm_get_template_path('category');
            }

        }

        return $template;
    }

    public function MKKconfigureRedirects()
    {
        $redirect = is_product() || is_account_page();

        if ($redirect) {
            wpm_redirect_to_main();
        }
    }

    private function _getTemplatePath($template)
    {
        $path = "templates/public/layouts/{$template}.php";

        return MKK_DIR . $path;
    }

    private function _addStyles()
    {
        add_action("wpm_head", [$this, 'addStyles'], 902);
    }

    public function addStyles()
    {
        wpm_enqueue_style('mkk_main', plugins_url('/mbl-catalog/assets/css/main.css?v=' . MKK_VERSION));
        mkk_render_partial('partials/css');
    }


    private function _addScripts()
    {
        add_action("wpm_footer", [$this, 'addScripts'], 902);
    }

    public function customHomeId($home_id)
    {
        return wpm_get_option('mkk.set_as_mainpage_keep_link') == 'on'
            ? wpm_get_option('mkk.old_mainpage')
            : $home_id;
    }

    public function mblHomeTitle($title)
    {
        return wpm_get_option('mkk.set_as_mainpage_keep_link') == 'on'
            ? wpm_get_option('mkk_texts.menu_name')
            : $title;
    }

    public function mblHomeIconClass($iconClass)
    {
        return wpm_get_option('mkk.set_as_mainpage_keep_link') == 'on'
            ? 'iconmoon icon-star'
            : $iconClass;
    }

    public function mblHomeIdFieldNameFilter($fieldName)
    {
        return wpm_get_option('mkk.set_as_mainpage_keep_link') == 'on'
            ? 'main_options[mkk][old_mainpage]'
            : $fieldName;
    }

    public function mblRedirectIsSingleFilter($is_single)
    {
        return $is_single || is_shop();
    }

    public function renderAddToCartButton($product, $href)
    {
        $free = empty($product->get_price());

        return mkk_render_partial('partials/add-to-cart-btn', 'public', compact('href', 'free'));
    }

    public function addScripts()
    {
        wpm_enqueue_script('mkk_js_main', plugins_url('/mbl-catalog/assets/js/mkk_public.js?v=' . MKK_VERSION));
    }

    public function addShopMenu()
    {
        mkk_render_partial('partials/shop-menu');
    }

    function mkk_get_template($template)
    {
        if (is_tax('wpm-levels')) {
            return MKK_DIR . "templates/public/layouts/wpm-levels.php";
        } else {
            return $template;
        }
    }
}
