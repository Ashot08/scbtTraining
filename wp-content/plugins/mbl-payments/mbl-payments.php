<?php
/*

Plugin Name: MEMBERLUX PAYMENTS
Plugin URI: http://memberlux.ru
Description: МОДУЛЬ ПРИЕМА ПЛАТЕЖЕЙ
Version: 0.5.9.9.6
Author: Виктор Левчук
Author URI: http://blog.pluginex.ru/author/vic_levchuk/

*/
/**
 *  If no Wordpress, go home
 */

if (!defined('ABSPATH')) { exit; }

define('MBLP_VERSION', '0.5.9.9.6');
define('MBLP_DIR', plugin_dir_path(__FILE__));

include_once('app/app.php');

function mblp_activate()
{
    MBLPCore::install();
}

function mblp_deactivate()
{
    MBLPCore::uninstall();
}

register_activation_hook(__FILE__, 'mblp_activate');
register_deactivation_hook(__FILE__, 'mblp_deactivate');

//Updater
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/MEMBERLUX/mbl-payments/',
	__FILE__,
	'mbl-payments'
);
$myUpdateChecker->setAuthentication('7b65d01cb5b3d10c8c6fa2b3dd9a4622e7d5000c');
