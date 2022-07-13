<?php
/*

Plugin Name: MEMBERLUX
Plugin URI: http://memberlux.ru
Description: MEMBERLUX
Version: 992.17
Author: Виктор Левчук
Author URI: http://blog.pluginex.ru/author/vic_levchuk/

*/
/**
 *  If no Wordpress, go home
 */

if (!defined('ABSPATH')) { exit; }

add_filter('site_transient_update_plugins', function($value) {
    if( ! is_object($value) ) return $value;

    // удаляем текущий плагин из списка
    unset( $value->response[ plugin_basename(__FILE__) ] );

    return $value;
});


define('WP_MEMBERSHIP_VERSION', '2.17');
define('WP_MEMBERSHIP_DIR', plugin_dir_path(__FILE__));
define('SUMMERNOTE_UPLOADS_DIR', 'summernote_uploads');

include_once('inc/functions.php');

function wpm_activate()
{
    wpm_install();
}

register_activation_hook(__FILE__, 'wpm_activate');
register_deactivation_hook(__FILE__, 'wpm_deactivate');

//Updater
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/MEMBERLUX/member-luxe/',
	__FILE__,
	'member-luxe'
);
$myUpdateChecker->setAuthentication('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');
