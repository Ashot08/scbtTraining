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
global $wpshop_partner;
?>

<div class="footer-bottom">
    <div class="footer-info">
        <?php
        $footer_copyright = $wpshop_core->get_option( 'footer_copyright' );
        $footer_copyright = str_replace( '%year%', date('Y'), $footer_copyright );
        echo do_shortcode( $footer_copyright );
        ?>

	    <?php if ( 'yes' == $wpshop_core->get_option('wpshop_partner_enable') ) : ?>
            <!--noindex-->
            <div class="footer-partner">
			    <?php
			    $wpshop_partner->the_link( [
				    'prefix'     => $wpshop_core->get_option( 'wpshop_partner_prefix' ),
				    'postfix'    => $wpshop_core->get_option( 'wpshop_partner_postfix' ),
                    'partner_id' => ( defined( 'WPSHOP_PARTNER' ) ) ? WPSHOP_PARTNER : 0,
			    ] );
			    ?>
            </div>
            <!--/noindex-->
	    <?php endif; ?>
    </div>

    <?php
    $footer_counters = $wpshop_core->get_option( 'footer_counters' );
    if ( ! empty( $footer_counters ) ) echo '<div class="footer-counters">' . $footer_counters . '</div>';
    ?>
</div>