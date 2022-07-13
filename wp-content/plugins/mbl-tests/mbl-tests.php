<?php
/*

Plugin Name: MEMBERLUX TESTS
Plugin URI: http://memberlux.ru
Description: МОДУЛЬ ТЕСТОВ
Version: 0.2.6
Author: Виктор Левчук
Author URI: http://blog.pluginex.ru/author/vic_levchuk/
Text Domain: mbl_tests
Domain Path: /lang

*/

//If no Wordpress, go home
if (!defined('ABSPATH')) { exit; }


define('MBL_TESTS_VERSION', '0.2.6');
define('REQUIRED_MEMBERLUXE_VERSION', '2.7.1');
define('MBL_TESTS_DIR', plugin_dir_path(__FILE__));


include_once('app/app.php');


function mbl_tests_activate()
{
    MBL_TESTS_Core::install();
}

function mbl_tests_deactivate()
{
    MBL_TESTS_Core::uninstall();
}

register_activation_hook(__FILE__, 'mbl_tests_activate');
register_deactivation_hook(__FILE__, 'mbl_tests_deactivate');

//Updater
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/MEMBERLUX/mbl-tests/',
	__FILE__,
	'mbl-tests'
);
$myUpdateChecker->setAuthentication('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');
