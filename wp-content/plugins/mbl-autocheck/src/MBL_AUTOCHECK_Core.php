<?php

class MBL_AUTOCHECK_Core
{
	private static $_defaultOptions = array(
		'autocheck'  => array(
			'modal_header' => 'Тест не пройден',
			'modal_text' => 'Пожалуйста, исправьте ответы и отправьте тест еще раз',
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
		$message = __('МОДУЛЬ АВТОПРОВЕРКИ ТЕСТОВ не активирован!', 'mbl_autocheck');
		
		if(!defined('WP_MEMBERSHIP_VERSION')) {
			$message .= ' ' . __('Не установлен плагин MEMBERLUX.', 'mbl_autocheck');
		} elseif (version_compare(WP_MEMBERSHIP_VERSION, '2.9.9.4.6', '<=')) {
			$message .= ' ' . __('Устаревшая версия MEMBERLUX.', 'mbl_autocheck');
		} elseif (!$this->_pluginKeyActive()) {
			$message .= ' ' . __('Ключ не активирован.', 'mbl_autocheck');
		}
		printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
	}
	
	private function _pluginEnabled()
	{
		return defined('WP_MEMBERSHIP_VERSION')
			&& !version_compare(WP_MEMBERSHIP_VERSION, '2.9.9.4.6', '<=')
			&& $this->_pluginKeyActive();
	}
	
	private function _pluginKeyActive()
	{
		return (bool)count(wpm_array_filter(wpm_array_pluck(wpm_array_get(wpm_get_key_data(), 'keys.active', array()), 'type'), 'autocheck'));
	}
	
	private function _run()
	{
		new MBL_AUTOCHECK_Admin();
		new MBL_AUTOCHECK_Public();
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