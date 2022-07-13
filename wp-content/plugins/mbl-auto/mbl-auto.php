<?php
/*

Plugin Name: MEMBERLUX ADVANCED TRAINER
Plugin URI: http://memberlux.ru
Description: МОДУЛЬ ПРОДВИНУТОГО ТРЕНЕРА
Version: 0.4.1.6
Author: Виктор Левчук
Author URI: http://blog.pluginex.ru/author/vic_levchuk/

*/
/**
 *  If no Wordpress, go home
 */

if (!defined('ABSPATH')) { exit; }

define('MBLA_VERSION', '0.4.1.6');
define('MBLA_DIR', plugin_dir_path(__FILE__));

include_once('app/app.php');

function mbla_activate()
{
    MBLACore::install();
}

function mbla_deactivate()
{
    MBLACore::uninstall();
}

register_activation_hook(__FILE__, 'mbla_activate');
register_deactivation_hook(__FILE__, 'mbla_deactivate');

//Updater
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/MEMBERLUX/mbl-auto/',
	__FILE__,
	'mbl-auto'
);
$myUpdateChecker->setAuthentication('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');
