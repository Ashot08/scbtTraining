<?php
/**
 * ****************************************************************************
 *
 *   НЕ РЕДАКТИРУЙТЕ ЭТОТ ФАЙЛ
 *   DON'T EDIT THIS FILE
 *
 *   После обновления Вы потереяете все изменения. Используйте дочернюю тему
 *   After update you will lose all changes. Use child theme
 *
 *   https://support.wpshop.ru/docs/general/child-themes/
 *
 * *****************************************************************************
 *
 * @package reboot
 */

global $wpshop_core;

$is_show_header_menu = $wpshop_core->is_show_element( 'header_menu' );

if ( has_nav_menu( 'header' ) && $is_show_header_menu ) { ?>

    <?php do_action( THEME_SLUG . '_before_main_navigation' ); ?>

    <nav id="site-navigation" class="main-navigation <?php $wpshop_core->the_option( 'header_menu_width' ) ?>" itemscope itemtype="http://schema.org/SiteNavigationElement">
        <div class="main-navigation-inner <?php $wpshop_core->the_option( 'header_menu_inner_width' ) ?>">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'header',
                'menu_id'        => 'header_menu',
            ) );
            ?>
        </div>
    </nav><!-- #site-navigation -->

    <?php do_action( THEME_SLUG . '_after_main_navigation' ); ?>

<?php } else { ?>

    <nav id="site-navigation" class="main-navigation <?php $wpshop_core->the_option( 'header_menu_width' ) ?>" style="display: none;">
        <div class="main-navigation-inner <?php $wpshop_core->the_option( 'header_menu_inner_width' ) ?>">
            <ul id="header_menu"></ul>
        </div>
    </nav>
    <div class="container header-separator"></div>

<?php } ?>

    <div class="mobile-menu-placeholder js-mobile-menu-placeholder"></div>