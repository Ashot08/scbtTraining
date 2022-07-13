<?php
/*

Plugin Name: MEMBERLUX TESTS AUTOCHECK
Plugin URI: http://memberlux.ru
Description: МОДУЛЬ АВТОПРОВЕРКИ ТЕСТОВ
Version: 0.0.6
Author: Виктор Левчук
Author URI: http://blog.pluginex.ru/author/vic_levchuk/
Text Domain: mbl_autocheck
Domain Path: /lang

*/

//If no Wordpress, go home
if (!defined('ABSPATH')) { exit; }


define('MBL_AUTOCHECK_VERSION', '0.0.6');
define('MBL_AUTOCHECK_DIR', plugin_dir_path(__FILE__));


include_once('app/app.php');


function mbl_autocheck_activate()
{
    MBL_AUTOCHECK_Core::install();
}

function mbl_autocheck_deactivate()
{
    MBL_AUTOCHECK_Core::uninstall();
}

register_activation_hook(__FILE__, 'mbl_autocheck_activate');
register_deactivation_hook(__FILE__, 'mbl_autocheck_deactivate');

//Updater
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/MEMBERLUX/mbl-auto-check/',
	__FILE__,
	'mbl-autocheck'
);
$myUpdateChecker->setAuthentication('7b65d01cb5b3d10c8c6fa2b3dd9a4622e7d5000c');
