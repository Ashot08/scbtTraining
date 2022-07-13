<?php
/**
 * ****************************************************************************
 *
 *   НЕ РЕДАКТИРУЙТЕ ЭТОТ ФАЙЛ
 *   DON'T EDIT THIS FILE
 *
 * *****************************************************************************
 *
 * @package reboot
 */

$original_theme = $theme = wp_get_theme();
if ( $theme->parent() ) {
    $theme = $theme->parent();
}
define( 'THEME_VERSION', $theme->get( 'Version' ) );
define( 'THEME_ORIGINAL_VERSION', $original_theme->get( 'Version' ) );
define( 'THEME_TEXTDOMAIN', $theme->get( 'TextDomain' ) );
define( 'THEME_NAME', 'reboot' );
define( 'THEME_TITLE', 'Reboot' );
define( 'THEME_SLUG', 'reboot' );
define( 'THEME_API_URL', 'https://wpshop.ru/api.php' );
define( 'THEME_UPDATE_URL', 'https://api.wpgenerator.ru/wp-update-server/' );
