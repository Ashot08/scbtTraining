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


/**
 * Theme config
 */
require get_template_directory() . '/inc/config.php';


/**
 * Enqueue styles and scripts
 */
require get_template_directory() . '/inc/enqueue.php';


/**
 * Starter content
 */
require get_template_directory() . '/inc/starter-content/starter-content.php';


/**
 * Core v120415540
 */
require get_template_directory() . '/inc/core.php';


/**
 * Default options
 */
require get_template_directory() . '/inc/default-options.php';


/**
 * after_setup_theme hooks: widgets, menus, theme_support
 */
require get_template_directory() . '/inc/setup.php';


/**
 * TinyMCE
 */
if ( is_admin() ) {
    require get_template_directory() . '/inc/tinymce.php';
}


/**
 * Comments
 */
require get_template_directory() . '/inc/comments.php';

/**
 * Metaboxes
 */
require get_template_directory() . '/inc/meta-boxes.php';

/**
 * Thumbnails
 */
require get_template_directory() . '/inc/thumbnails.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Post card
 */
require get_template_directory() . '/inc/post-card.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/**
 * WPShop Partner ID
 */
require get_template_directory() . '/inc/partner-id.php';

/**
 * Upgrade
 */
require get_template_directory() . '/inc/upgrade.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '/inc/woocommerce.php';
}
