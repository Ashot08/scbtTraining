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

if ( has_nav_menu( 'top' ) ) {
    wp_nav_menu( array(
        'theme_location'  => 'top',
        'menu_id'         => 'top-menu',
        'menu_class'      => 'menu',
        'container_class' => 'top-menu',
    ) );
}
