<?php

class MBLACore
{
    private static $_defaultOptions = array(
        'mbla_design' => array(
        ),
        'mbla'        => array(
        ),
        'mbla_texts'  => array(
        ),
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
        $message = __('МОДУЛЬ ПРОДВИНУТОГО ТРЕНЕРА не активирован!', 'mbl_admin');

        if(!defined('WP_MEMBERSHIP_VERSION')) {
            $message .= ' ' . __('Не установлен плагин MEMBERLUX.', 'mbl_admin');
        } elseif (version_compare(get_option('wpm_version'), '2.3.4', '<')) {
            $message .= ' ' . __('Устаревшая версия MEMBERLUX.', 'mbl_admin');
        } elseif (!$this->_pluginKeyActive()) {
            $message .= ' ' . __('Ключ не активирован.', 'mbl_admin');
        }
        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
    }

    private function _pluginEnabled()
    {
        return defined('WP_MEMBERSHIP_VERSION')
            && !version_compare(get_option('wpm_version'), '2.3.4', '<')
            && $this->_pluginKeyActive();
    }

    private function _pluginKeyActive()
    {
        return (bool)count(wpm_array_filter(wpm_array_pluck(wpm_array_get(wpm_get_key_data(), 'keys.active', array()), 'type'), 'auto'));
    }

    private function _run()
    {
        new MBLAAdmin();
        new MBLAPublic();
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
            mbla_update_option($key, $value);
        }
    }

    public static function uninstall()
    {

    }
}