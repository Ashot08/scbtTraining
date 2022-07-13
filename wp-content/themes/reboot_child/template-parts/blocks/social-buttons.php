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
global $wpshop_social;

$share_buttons = $wpshop_core->get_option( 'share_buttons' );
$share_buttons = explode(',', $share_buttons);

echo '<div class="social-buttons">';
$wpshop_social->share_buttons( $share_buttons, array( 'show_label' => false, 'show_counters' => $wpshop_core->get_option( 'share_buttons_counters' ) ) );
echo '</div>';