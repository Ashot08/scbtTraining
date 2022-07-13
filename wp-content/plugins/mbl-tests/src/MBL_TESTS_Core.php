<?php

class MBL_TESTS_Core
{
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
        $message = __('МОДУЛЬ ТЕСТОВ не активирован!', 'mbl_tests');

        if(!defined('WP_MEMBERSHIP_VERSION')) {
            $message .= ' ' . __('Не установлен плагин MEMBERLUX.', 'mbl_tests');
        } elseif (version_compare(WP_MEMBERSHIP_VERSION, REQUIRED_MEMBERLUXE_VERSION, '<=')) {
            $message .= ' ' . __('Устаревшая версия MEMBERLUX.', 'mbl_tests');
        } elseif (!$this->_pluginKeyActive()) {
            $message .= ' ' . __('Ключ не активирован.', 'mbl_tests');
        }
        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
    }

    private function _pluginEnabled()
    {
        return defined('WP_MEMBERSHIP_VERSION')
            && !version_compare(WP_MEMBERSHIP_VERSION, REQUIRED_MEMBERLUXE_VERSION, '<=')
            && $this->_pluginKeyActive();
    }

    private function _pluginKeyActive()
    {
        return (bool)count(wpm_array_filter(wpm_array_pluck(wpm_array_get(wpm_get_key_data(), 'keys.active', array()), 'type'), 'tests'));
    }

    private function _run()
    {
        new MBL_TESTS_Admin();
        new MBL_TESTS_Public();
    }

    public static function install()
    {
        global $wpdb;
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $table_name = $wpdb->get_blog_prefix() . 'memberlux_responses';
        // check if table exist
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
            $row = $wpdb->get_results("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '{$table_name}' AND column_name = 'response_test'");

            //check if column exist
            if (empty($row)) {
                $wpdb->query("ALTER TABLE $table_name ADD response_test LONGTEXT");
            }
        }
    }

    public static function uninstall()
    {
    }
}