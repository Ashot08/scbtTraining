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
?>

<?php do_action( THEME_SLUG . '_before_footer' ) ?>

<?php
$classes = [];

if ( $wpshop_core->get_option('footer_sticky_disable') ) $classes[] = 'site-footer-container--disable-sticky';
if ( $wpshop_core->get_option('footer_widgets_equal_width') ) $classes[] = 'site-footer-container--equal-width';
?>

<div class="site-footer-container <?php echo implode(' ', $classes) ?>">

    <?php get_template_part( 'template-parts/navigation/footer' ) ?>

    <footer id="colophon" class="site-footer site-footer--style-gray <?php $wpshop_core->the_option( 'footer_width' ) ?>">
        <div class="site-footer-inner <?php $wpshop_core->the_option( 'footer_inner_width' ) ?>">

            <?php get_template_part( 'template-parts/footer/widgets' ) ?>

            <?php get_template_part( 'template-parts/footer/bottom' ) ?>

        </div>
    </footer><!--.site-footer-->
</div>

<?php do_action( THEME_SLUG . '_after_footer' ) ?>