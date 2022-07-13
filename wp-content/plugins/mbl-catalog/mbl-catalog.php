<?php
/*

Plugin Name: MEMBERLUX CATALOG
Plugin URI: http://memberlux.ru
Description: МОДУЛЬ КАТАЛОГА КУРСОВ
Version: 0.2.0
Author: Виктор Левчук
Author URI: http://blog.pluginex.ru/author/vic_levchuk/

*/
/**
 *  If no Wordpress, go home
 */

if (!defined('ABSPATH')) { exit; }

define('MKK_VERSION', '0.2.0');
define('MKK_DIR', plugin_dir_path(__FILE__));

include_once('app/app.php');

function mkk_activate()
{
    MKKCore::install();
}

function mkk_deactivate()
{
    MKKCore::uninstall();
}

register_activation_hook(__FILE__, 'mkk_activate');
register_deactivation_hook(__FILE__, 'mkk_deactivate');

//Updater
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/MEMBERLUX/mbl-catalog/',
	__FILE__,
	'mbl-catalog'
);
$myUpdateChecker->setAuthentication('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');
