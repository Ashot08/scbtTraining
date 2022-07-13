<?php

class MBLPProduct
{
    const MBL_PRODUCT_TYPE = 'mbl_key';
    const IPR_PRODUCT_TYPE = 'ipr_key';

    private static $_mblLevels = null;
    private static $_mblLevelOptions = [];

    /**
     * MBLPProduct constructor.
     */
    public function __construct()
    {
        $this->_setHooks();
    }

    private function _setHooks()
    {
        $this->_addMBLProductTypeHooks();
    }

    private function _addMBLProductTypeHooks()
    {
        add_action('init', 'mblp_add_mbl_product_type');
        add_action('init', 'mblp_add_ipr_product_type');

        add_filter('product_type_selector', [$this, 'addMBLProductTypeSelector']);
        add_filter('woocommerce_product_class', [$this, 'getMBLProductTypeClass'], 10, 2);
        add_filter('woocommerce_product_data_tabs', [$this, 'addMBLProductTypeTab']);

        add_action('woocommerce_product_data_panels', [$this, 'renderPinCodeOptionsPanel']);
        add_action('woocommerce_product_data_panels', [$this, 'renderLetterOptionsPanel']);
        add_action('woocommerce_product_data_panels', [$this, 'renderPinLinkOptionsPanel']);
        add_action('woocommerce_product_data_panels', [$this, 'renderDesignOptionsPanel']);
        add_action('woocommerce_product_data_panels', [$this, 'renderVisibilityOptionsPanel']);

        add_action('woocommerce_product_options_general_product_data', [$this, 'renderGeneralOptionsPanel'], 5);

        add_action('woocommerce_process_product_meta_' . self::MBL_PRODUCT_TYPE, [$this, 'saveProductMeta']);
        add_action('woocommerce_process_product_meta_' . self::IPR_PRODUCT_TYPE, [$this, 'saveIPRProductMeta']);

        add_action('add_meta_boxes', [$this, 'metaBoxes'], 40);

        if (!defined('MKK_VERSION')) {
            add_filter('mblp_visibility_options_panel', '__return_empty_string');
        }
    }

    public static function getRedirectOptions()
    {
        return [
            'activation' => __('Страница активации', 'mbl_admin'),
            'main'       => __('Главная страница', 'mbl_admin'),
            'custom'     => __('Произвольный URL', 'mbl_admin'),
        ];
    }

    public function addMBLProductTypeSelector($types)
    {
        $types = [
            self::MBL_PRODUCT_TYPE => __('MEMBERLUX', 'mbl_admin'),
            self::IPR_PRODUCT_TYPE => __('Infoprotector ', 'mbl_admin'),
        ];

        return $types;
    }

    public function getMBLProductTypeClass($classname, $productType)
    {
        if ($productType == self::MBL_PRODUCT_TYPE) {
            $classname = 'WC_Product_MBL';
        } elseif ($productType == self::IPR_PRODUCT_TYPE) {
            $classname = 'WC_Product_IPR';
        }

        return $classname;
    }

    public function addMBLProductTypeTab($tabs)
    {
        $showClass = sprintf('show_if_%s show_if_%s', self::MBL_PRODUCT_TYPE, self::IPR_PRODUCT_TYPE);
        $hideClass = sprintf('hide_if_%s hide_if_%s', self::MBL_PRODUCT_TYPE, self::IPR_PRODUCT_TYPE);

        $tabs['general']['label'] = __('Цена', 'mbl_admin');

        $tabs['attribute']['class'][] = $hideClass;
        $tabs['advanced']['class'][] = $hideClass;
        $tabs['shipping']['class'][] = $hideClass;

        $tabs['demo'] = [
            'label'  => __('Пин-код', 'mbl_admin'),
            'target' => (self::MBL_PRODUCT_TYPE . '_pin_code_options'),
            'class'  => $showClass,
        ];

        $tabs['cart_link'] = [
            'label'  => __('Ссылка', 'mbl_admin'),
            'target' => (self::MBL_PRODUCT_TYPE . '_cart_link_options'),
            'class'  => $showClass,
        ];

        $tabs['preview_type'] = [
            'label'  => __('Дизайн', 'mbl_admin'),
            'target' => (self::MBL_PRODUCT_TYPE . '_preview_type'),
            'class'  => $showClass,
        ];

        $tabs['letter'] = [
            'label'  => __('Письмо', 'mbl_admin'),
            'target' => (self::MBL_PRODUCT_TYPE . '_letter_options'),
            'class'  => $showClass,
        ];

        if (defined('MKK_VERSION')) {
            $tabs['visibility'] = [
                'label'  => __('Видимость товара', 'mbl_admin'),
                'target' => (self::MBL_PRODUCT_TYPE . '_visibility_options'),
                'class'  => $showClass,
            ];
        }

        return $tabs;
    }

    private function _initMBLOptions($levels, $prefix = '')
    {
        foreach ($levels as $level) {
            self::$_mblLevelOptions[$level->term_id] = $prefix . ' ' . $level->name;

            if (!empty($level->children)) {
                $this->_initMBLOptions($level->children, str_repeat('-', $level->nested_level + 1));
            }
        }
    }

    public function renderPinCodeOptionsPanel()
    {
        global $post, $thepostid, $product_object;

        $this->_initMBLLevels();
        $this->_initMBLOptions(self::$_mblLevels);
        $options = self::$_mblLevelOptions;

        mblp_render_partial('product/pin_code_tab', 'admin', compact('post', 'thepostid', 'product_object', 'options'));
    }

    public function renderLetterOptionsPanel()
    {
        global $post, $thepostid, $product_object;

        mblp_render_partial('product/letter_tab', 'admin', compact('post', 'thepostid', 'product_object'));
    }

    public function renderVisibilityOptionsPanel()
    {
        global $post, $thepostid, $product_object;

        $options = [
            'hide'      => __('Не отображать для следующих уровней доступа:', 'mbl_admin'),
            'show_only' => __('Отображать только для следующих уровней доступа:', 'mbl_admin'),
        ];

        echo apply_filters('mblp_visibility_options_panel', mblp_render_partial('product/visibility_tab', 'admin', compact('post', 'thepostid', 'product_object', 'options'), true));
    }

    public function renderPinLinkOptionsPanel()
    {
        global $post, $thepostid, $product_object;

        $options = self::getRedirectOptions();

        mblp_render_partial('product/cart_link_tab', 'admin', compact('post', 'thepostid', 'product_object', 'options'));
    }

    public function renderDesignOptionsPanel()
    {
        global $post, $thepostid, $product_object;

        $options = [
            'folder-with-files'   => __('Папка с материалами', 'mbl_admin'),
            'folder-with-folders' => __('Папка с папками', 'mbl_admin'),
            'image'               => __('Картинка', 'mbl_admin'),
        ];

        mblp_render_partial('product/design_tab', 'admin', compact('post', 'thepostid', 'product_object', 'options'));
    }

    public function renderGeneralOptionsPanel()
    {
        global $post, $thepostid, $product_object;

        mblp_render_partial('product/general_tab_data', 'admin', compact('post', 'thepostid', 'product_object'));
    }

    private function _initMBLLevels()
    {
        if (self::$_mblLevels === null) {
            self::$_mblLevels = wpm_get_all_levels();
        }
    }

    public function saveProductMeta($post_id)
    {
        $product = new WC_Product_MBL($post_id);

        $errors = $product->set_props(
            [
                'mbl_key_pin_code_level_id'       => isset($_POST['_mbl_key_pin_code_level_id']) ? wc_clean(wp_unslash($_POST['_mbl_key_pin_code_level_id'])) : null,
                'mbl_key_pin_code_duration'       => isset($_POST['_mbl_key_pin_code_duration']) ? wc_clean(wp_unslash($_POST['_mbl_key_pin_code_duration'])) : null,
                'mbl_key_pin_code_is_unlimited'   => isset($_POST['_mbl_key_pin_code_is_unlimited']) ? intval($_POST['_mbl_key_pin_code_is_unlimited'] === 'on') : null,
                'mbl_key_pin_code_units'          => isset($_POST['_mbl_key_pin_code_units']) ? wc_clean(wp_unslash($_POST['_mbl_key_pin_code_units'])) : null,
                'mbl_preview_type'                => isset($_POST['_mbl_preview_type']) ? wc_clean(wp_unslash($_POST['_mbl_preview_type'])) : null,
                'mbl_redirect'                    => isset($_POST['_mbl_redirect']) ? wc_clean(wp_unslash($_POST['_mbl_redirect'])) : null,
                'mbl_redirect_url'                => isset($_POST['_mbl_redirect_url']) ? wc_clean(wp_unslash($_POST['_mbl_redirect_url'])) : null,
                'mblp_is_custom_letter'           => isset($_POST['_mblp_is_custom_letter']) ? (bool)intval($_POST['_mblp_is_custom_letter']) : false,
                'mblp_letter'                     => isset($_POST['_mblp_letter']) ? $_POST['_mblp_letter'] : null,
                'mblp_letter_title'               => isset($_POST['_mblp_letter_title']) ? wc_clean(wp_unslash($_POST['_mblp_letter_title'])) : null,
                'mbl_key_visibility_level_action' => isset($_POST['_mbl_key_visibility_level_action']) ? wc_clean(wp_unslash($_POST['_mbl_key_visibility_level_action'])) : null,
                'mblp_meta'                       => isset($_POST['_mblp_meta']) ? wc_clean($_POST['_mblp_meta']) : [],
            ]
        );

        if (is_wp_error($errors)) {
            WC_Admin_Meta_Boxes::add_error($errors->get_error_message());
        }

        $product->save();
    }

    public function saveIPRProductMeta($post_id)
    {
        $product = new WC_Product_IPR($post_id);

        $keys = isset($_POST['_ipr_codes']) ? wc_clean(wp_unslash($_POST['_ipr_codes'])) : '';
        $keys = str_replace("\r", "", $keys);
        $keys = str_replace([" "], "\n", $keys);

        $keys = explode("\n", $keys);
        $keys = array_filter($keys);

        $errors = $product->set_props(
            [
                'mbl_key_pin_code_level_id'       => isset($_POST['_mbl_key_pin_code_level_id']) ? wc_clean(wp_unslash($_POST['_mbl_key_pin_code_level_id'])) : null,
                'mbl_key_pin_code_duration'       => isset($_POST['_mbl_key_pin_code_duration']) ? wc_clean(wp_unslash($_POST['_mbl_key_pin_code_duration'])) : null,
                'mbl_key_pin_code_is_unlimited'   => isset($_POST['_mbl_key_pin_code_is_unlimited']) ? intval($_POST['_mbl_key_pin_code_is_unlimited'] === 'on') : null,
                'mbl_key_pin_code_units'          => isset($_POST['_mbl_key_pin_code_units']) ? wc_clean(wp_unslash($_POST['_mbl_key_pin_code_units'])) : null,
                'mbl_preview_type'                => isset($_POST['_mbl_preview_type']) ? wc_clean(wp_unslash($_POST['_mbl_preview_type'])) : null,
                'mbl_redirect'                    => isset($_POST['_mbl_redirect']) ? wc_clean(wp_unslash($_POST['_mbl_redirect'])) : null,
                'mbl_redirect_url'                => isset($_POST['_mbl_redirect_url']) ? wc_clean(wp_unslash($_POST['_mbl_redirect_url'])) : null,
                'mblp_is_custom_letter'           => isset($_POST['_mblp_is_custom_letter']) ? (bool)intval($_POST['_mblp_is_custom_letter']) : false,
                'mblp_letter'                     => isset($_POST['_mblp_letter']) ? $_POST['_mblp_letter'] : null,
                'mblp_letter_title'               => isset($_POST['_mblp_letter_title']) ? wc_clean(wp_unslash($_POST['_mblp_letter_title'])) : null,
                'mbl_key_visibility_level_action' => isset($_POST['_mbl_key_visibility_level_action']) ? wc_clean(wp_unslash($_POST['_mbl_key_visibility_level_action'])) : null,
                'mblp_meta'                       => isset($_POST['_mblp_meta']) ? wc_clean($_POST['_mblp_meta']) : [],
                'ipr_codes'                       => $keys,
            ]
        );

        if (is_wp_error($errors)) {
            WC_Admin_Meta_Boxes::add_error($errors->get_error_message());
        }

        $product->save();
    }

    public function metaBoxes()
    {
        remove_meta_box('postexcerpt', 'product', 'normal');
        add_meta_box('postexcerpt',
            __('Название товара (видно пользователям)', 'mbl_admin'),
            [
                $this,
                'excerptMetaBox',
            ],
            'product',
            'normal');
    }

    public function excerptMetaBox($post)
    {
        mblp_render_partial('product/excerpt', 'admin', compact('post'));
    }

    /**
     * @param $product WC_Product
     */
    public static function hasProductAccess($product)
    {
        $current_user = wp_get_current_user();

        if (!in_array('administrator', $current_user->roles)) {
            $user_level_ids = wpm_get_all_user_accesible_levels($current_user->ID);

            $user_level_ids = ($current_user->ID && count($user_level_ids))
                ? get_terms('wpm-levels', ['fields' => 'ids', 'include' => $user_level_ids, 'hide_empty' => 0])
                : [];

            $visibility_level_action = is_callable([$product, 'get_mbl_key_visibility_level_action']) ? $product->get_mbl_key_visibility_level_action() : 'hide';
            $meta = is_callable([$product, 'get_mblp_meta']) ? $product->get_mblp_meta('edit') : [];

            $isExcludedForUnauthorized = wpm_array_get($meta, 'hide_for_not_registered') == 'on';
            
            if (!is_user_logged_in() && $isExcludedForUnauthorized) {
                return false;
            }

            $exclude_levels = wpm_array_get($meta, 'exclude_levels', []);

            if ($visibility_level_action == 'hide') {
                if (is_user_logged_in() && count($exclude_levels) && !count(array_diff($user_level_ids, $exclude_levels))) {
                    return false;
                }
            } elseif (is_user_logged_in() && !count(array_intersect($user_level_ids, $exclude_levels))) {
                return false;
            }
        }

        return true;
    }
}
