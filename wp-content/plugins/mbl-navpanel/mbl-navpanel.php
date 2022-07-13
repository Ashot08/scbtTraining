<?php
/*

Plugin Name: MEMBERLUX NAVIGATION PANEL
Plugin URI: http://memberlux.ru
Description: МОДУЛЬ ПАНЕЛИ НАВИГАЦИИ
Version: 0.1.5.0
Author: Виктор Левчук
Author URI: http://blog.pluginex.ru/author/vic_levchuk/

*/
/**
 *  If no Wordpress, go home
 */

if (!defined('ABSPATH')) { exit; }

define('MBLI3_VERSION', '0.1.5.0');
define('MBLI3_DIR', plugin_dir_path(__FILE__));

include_once('app/app.php');

function mbli3_activate()
{
    MBLI3Core::install();
}

function mbli3_deactivate()
{
    MBLI3Core::uninstall();
}

register_activation_hook(__FILE__, 'mbli3_activate');
register_deactivation_hook(__FILE__, 'mbli3_deactivate');

//Updater
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/MEMBERLUX/mbl-navpanel/',
	__FILE__,
	'mbl-navpanel'
);
$myUpdateChecker->setAuthentication('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');
