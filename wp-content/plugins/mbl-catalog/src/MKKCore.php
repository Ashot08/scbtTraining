<?php

class MKKCore
{
    private static $_defaultOptions = array(
        'mkk_design' => array(
			'catalog'         => array(
				'menu_icon_color'          => '868686',
				'menu_text_color'          => '868686',
				'menu_icon_color_hover'    => '2E2E2E',
				'menu_text_color_hover'    => '2E2E2E',
				'menu_icon_color_click'    => '2E2E2E',
				'menu_text_color_click'    => '2E2E2E',

				'btn_add_to_cart_color'             => '9900FF',
				'btn_add_to_cart_text_color'        => 'ffffff',
				'btn_add_to_cart_hover_color'       => '664EA6',
				'btn_add_to_cart_text_hover_color'  => 'ffffff',
				'btn_add_to_cart_click_color'       => '8E7DC4',
				'btn_add_to_cart_text_click_color'  => 'ffffff',

				'btn_about_course_color'            => '2C78E4',
				'btn_about_course_text_color'       => 'ffffff',
				'btn_about_course_hover_color'      => '075394',
				'btn_about_course_text_hover_color' => 'ffffff',
				'btn_about_course_click_color'      => '6FA8DD',
				'btn_about_course_text_click_color' => 'ffffff',

				'btn_go_to_lessons_color'           => '009F10',
				'btn_go_to_lessons_text_color'      => 'ffffff',
				'btn_go_to_lessons_hover_color'     => '38751C',
				'btn_go_to_lessons_text_hover_color'=> 'ffffff',
				'btn_go_to_lessons_click_color'     => '94C47D',
				'btn_go_to_lessons_text_click_color'=> 'ffffff',

                'btn_add_to_cart_free_color'             => '9900FF',
                'btn_add_to_cart_free_text_color'        => 'ffffff',
                'btn_add_to_cart_free_hover_color'       => '664EA6',
                'btn_add_to_cart_free_text_hover_color'  => 'ffffff',
                'btn_add_to_cart_free_click_color'       => '8E7DC4',
                'btn_add_to_cart_free_text_click_color'  => 'ffffff',

			),
        ),
        'mkk'        => array(
			'btn_add_to_cart_target' => '_self',
			'btn_about_course_target'  => '_self',
			'btn_go_to_lessons_target'  => '_self',
			'show_section_name'  => 'off',
			'use_product_category'  => 'off',
			'show_in_menu'  => 'on',
        ),
        'mkk_texts'  => array(
            'btn_add_to_cart_name' => 'Добавить в корзину',
            'btn_add_to_cart_free_name' => 'Добавить в корзину',
            'btn_about_course_name' => 'Подробнее о курсе',
            'btn_go_to_lessons_name' => 'Перейти к урокам',
			'menu_name' => 'Каталог курсов'
        )
    );

    public function __construct()
    {
        if ($this->_pluginEnabled()) {
            $this->_run();
        } elseif (is_admin()) {
            add_action('admin_notices', array($this, 'notActiveNotice'));
        }
    }

    public function notActiveNotice()
    {
        $class = 'notice notice-error';
        $message = __('МОДУЛЬ КАТАЛОГА КУРСОВ не активирован!', 'mbl_admin');

        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
    }

    private function _pluginEnabled()
    {
        return class_exists('woocommerce')
            && defined('WP_MEMBERSHIP_VERSION')
            && defined('MBLP_VERSION')
            && !version_compare(get_option('wpm_version'), '2.2.9.3.5', '<=')
            && !version_compare(MBLP_VERSION, '0.5.8.5', '<')
            && $this->_pluginKeyActive();
    }

    private function _pluginKeyActive()
    {
		return (bool)count(wpm_array_filter(wpm_array_pluck(wpm_array_get(wpm_get_key_data(), 'keys.active', array()), 'type'), 'mkk'));
    }

    private function _run()
    {
        new MKKAdmin();
        new MKKPublic();
        new MKKProduct();
    }

    public static function install()
    {
        defined('WP_MEMBERSHIP_VERSION') || exit;

        self::_setDefaultOptions();
    }

    private static function _setDefaultOptions()
    {
        foreach (self::$_defaultOptions as $key => $value) {
            self::_setDefaultOption($key, $value);
        }
    }

    private static function _setDefaultOption($key, $value)
    {
        if (is_array($value)) {
            foreach ($value as $_key => $_value) {
                self::_setDefaultOption($key . '.' . $_key, $_value);
            }
        } elseif (wpm_get_option($key) === null) {
			$main_options = get_option('wpm_main_options');

			if(!isset($main_options) || !is_array($main_options)) {
				$main_options = array();
			}

			update_option('wpm_main_options', wpm_array_set($main_options, $key, $value));
        }
    }

    public static function uninstall()
    {

    }
}
