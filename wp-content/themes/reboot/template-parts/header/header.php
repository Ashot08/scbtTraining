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

$header_block_order = $wpshop_core->get_option( 'header_block_order' );
$header_block_order = explode( ',', $header_block_order );
?>

<?php do_action( THEME_SLUG . '_before_header' ) ?>

<header id="masthead" class="site-header <?php $wpshop_core->the_option( 'header_width' ) ?>" itemscope itemtype="http://schema.org/WPHeader">
    <div class="site-header-inner <?php $wpshop_core->the_option( 'header_inner_width' ) ?>">

        <div class="humburger js-humburger"><span></span><span></span><span></span></div>

        <?php foreach ( $header_block_order as $order ) {

            if ( $order == 'site_branding' ) {
                get_template_part( 'template-parts/header/site', 'branding' );
            }

            $header_html_block_1 = $wpshop_core->get_option( 'header_html_block_1' );
            if ( $order == 'header_html_block_1' && ! empty ( $header_html_block_1 ) ) { ?>
                <div class="header-html-1">
                    <?php echo do_shortcode( $header_html_block_1 ) ?>
                </div>
            <?php }

            if ( $order == 'header_social' ) {
                get_template_part( 'template-parts/blocks/social', 'links' );
            }

            if ( $order == 'top_menu' ) {
                get_template_part( 'template-parts/navigation/top' );
            }

            $header_html_block_2 = $wpshop_core->get_option( 'header_html_block_2' );
            if ( $order == 'header_html_block_2' && ! empty( $header_html_block_2 ) ) { ?>
                <div class="header-html-2">
                    <?php echo do_shortcode( $header_html_block_2 ) ?>
                </div>
            <?php }

            if ( $order == 'header_search' ) { ?>
                <div class="header-search">
                    <span class="search-icon js-search-icon"></span>
                </div>
            <?php }

        } ?>

    </div>
</header><!-- #masthead -->

<?php do_action( THEME_SLUG . '_after_header' ) ?>