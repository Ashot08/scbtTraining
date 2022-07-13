<?php

class MBLI3Core
{
    public function __construct()
    {
        if ($this->_pluginEnabled()) {
            $this->_run();
        } elseif (is_admin()) {
            add_action('admin_notices', [$this, 'notActiveNotice']);
        }
    }

    public function notActiveNotice()
    {
        $class = 'notice notice-error';
        $message = __('МОДУЛЬ ПАНЕЛИ НАВИГАЦИИ не активирован!', 'mbl_admin');

        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
    }

    private function _pluginEnabled()
    {
        return defined('WP_MEMBERSHIP_VERSION')
               && !version_compare(get_option('wpm_version'), '2.2.8', '<')
               && $this->_pluginKeyActive();
    }

    private function _pluginKeyActive()
    {
        return (bool)count(wpm_array_filter(wpm_array_pluck(wpm_array_get(wpm_get_key_data(), 'keys.active', []), 'type'), 'navigation'));
    }

    private function _run()
    {
        new MBLI3Admin();
        new MBLI3Public();
    }

    public static function install()
    {
        defined('WP_MEMBERSHIP_VERSION') || exit;

        self::_setDefaultOptions();
    }

    private static function _getDefaultOptions()
    {
        return [
            'mbli3_design'   => [
                'background_color'            => wpm_get_design_option('main.background_color', 'ECEEEF'),
                'background_image'            => [
                    'url'      => '',
                    'position' => 'center top',
                    'repeat'   => 'repeat',
                ],
                'background-attachment-fixed' => 'off',
                'term_header_color'           => wpm_get_design_option('term_header.color', '000000'),
                'term_header_size'            => wpm_get_design_option('term_header.font_size', '20'),
                'close_link'                  => [
                    'color'        => wpm_get_design_option('toolbar.icon_color', '868686'),
                    'color_hover'  => wpm_get_design_option('toolbar.icon_hover_color', '2e2e2e'),
                    'color_active' => wpm_get_design_option('toolbar.icon_hover_color', '2e2e2e'),
                ],
                'menu'                        => [
                    'color'        => wpm_get_design_option('toolbar.icon_color', '868686'),
                    'color_hover'  => wpm_get_design_option('toolbar.icon_hover_color', '2e2e2e'),
                    'color_active' => wpm_get_design_option('toolbar.icon_hover_color', '2e2e2e'),
                ],
                'menu_text'                   => [
                    'color'        => wpm_get_design_option('toolbar.text_color', '868686'),
                    'color_hover'  => wpm_get_design_option('toolbar.hover_color', '2e2e2e'),
                    'color_active' => wpm_get_design_option('toolbar.hover_color', '2e2e2e'),
                ],
            ],
            'mbli3'          => [
                'hide_main' => 'off',
            ],
            'mbli3_texts'    => [
                'menu_name' => __('Меню', 'mbl'),
            ],
            'mbli3_telegram' => [
                'enable_telegram'                   => 'off',
                'display_telegram_for_unregistered' => 'off',
                'menu_name'                         => 'Telegram',

                'enable_telegram_login'           => 'on',
                'telegram_login_for_unregistered' => 'off',
                'telegram_login_code'             => '',
                'telegram_exclude_url_1'          => '',
                'telegram_exclude_url_2'          => '',
                'telegram_exclude_url_3'          => '',

                'enable_telegram_news'           => 'on',
                'telegram_news_for_unregistered' => 'off',
                'telegram_news_name'             => __('Новости школы', 'mbl'),
                'telegram_news_code'             => '',
                'telegram_news_url'              => '',

                'enable_telegram_chat'           => 'on',
                'telegram_chat_for_unregistered' => 'off',
                'telegram_chat_name'             => __('Групповой чат', 'mbl'),
                'telegram_chat_code'             => '',
                'telegram_chat_url'              => '',
                'telegram_bot_for_unregistered'  => 'off',
                'telegram_bot_name'              => __('Телеграм БОТ', 'mbl'),
                'telegram_bot_url'               => '',
            ],
            'mbli3_telegram_mobile' => [
                'enable_telegram_login'           => 'on',
                'telegram_login_for_unregistered' => 'off',
                'telegram_login_code'             => '',
                'telegram_exclude_url_1'          => '',
                'telegram_exclude_url_2'          => '',
                'telegram_exclude_url_3'          => '',
            ],
        ];
    }

    private static function _setDefaultOptions()
    {
        foreach (self::_getDefaultOptions() as $key => $value) {
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
            mbli3_update_option($key, $value);
        }
    }

    public static function uninstall()
    {

    }
}
