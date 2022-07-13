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

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" itemscope itemtype="http://schema.org/WPSideBar">
    <div class="sticky-sidebar js-sticky-sidebar">

        <?php do_action( THEME_SLUG . '_sidebar_before_widgets' ); ?>

        <?php dynamic_sidebar( 'sidebar-1' ); ?>

        <?php do_action( THEME_SLUG . '_sidebar_after_widgets' ); ?>

    </div>
</aside><!-- #secondary -->
