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
global $class_advertising;

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
    <?php $wpshop_core->the_option( 'code_head' ) ?>
</head>

<body <?php body_class(); ?>>
<?php $wpshop_core->check_license() ?>

<?php if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} else {
    do_action( 'wp_body_open' );
} ?>

<?php do_action( THEME_SLUG . '_after_body' ) ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', THEME_TEXTDOMAIN ); ?></a>

    <div class="search-screen-overlay js-search-screen-overlay"></div>
    <div class="search-screen js-search-screen">
        <?php get_search_form() ?>
    </div>

    <?php
    if ( $wpshop_core->is_show_element( 'header' ) ) {
        get_template_part( 'template-parts/header/header' );
    } ?>

    <?php get_template_part( 'template-parts/navigation/header' ) ?>

    <?php do_action( THEME_SLUG . '_before_site_content' ) ?>

	<?php
	if ( apply_filters( THEME_SLUG . '_slider_output', is_front_page() || is_home() ) ) {
		if ( ! empty( $wpshop_core->get_option( 'slider_count' ) ) && ( ! is_paged() || ( $wpshop_core->get_option( 'slider_show_on_paged' ) && is_paged() ) ) ) {
            if ( ! wp_is_mobile() || ( wp_is_mobile() && ! $wpshop_core->get_option( 'slider_mob_disable' ) ) ) {
                if ( $wpshop_core->get_option( 'slider_width' ) == 'fixed') echo '<div class="container">';
                get_template_part( 'template-parts/slider', 'posts' );
                if ( $wpshop_core->get_option( 'slider_width' ) == 'fixed') echo '</div>';
            }
		}
	}
	?>

    <div id="content" class="site-content <?php echo apply_filters( THEME_SLUG . '_site_content_classes', 'fixed' ) ?>">

        <?php echo $class_advertising->show_ad( 'before_site_content' ) ?>

        <div class="site-content-inner">