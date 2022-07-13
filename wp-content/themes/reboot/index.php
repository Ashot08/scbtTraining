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

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

            <?php

            if ( 'top' == $wpshop_core->get_option( 'structure_home_position' ) ) get_template_part( 'template-parts/content', 'home' );

            $home_constructor = $wpshop_core->get_option( 'home_constructor' );
            if ( ! empty( $home_constructor ) && ! $wpshop_core->get_option( 'display_constructor_static_page' ) ) $home_constructor = json_decode( $home_constructor, true );

            if ( ! empty( $home_constructor ) && is_array( $home_constructor ) ) {
	            foreach ( $home_constructor as $section ) {
	                $section_type = ( ! empty( $section['section_type'] ) ) ? $section['section_type'] : 'posts';
		            set_query_var( 'section_options', $section );
		            get_template_part( 'template-parts/sections/' . $section_type );
                }
            } else {

	            if ( have_posts() ) {

                    if ( is_home() && ! is_front_page() ) :
                        echo '<h1 class="page-title screen-reader-text">' . single_post_title( '', false ) . '</h1>';
                    endif;

                    get_template_part( 'template-parts/post-container/' . $wpshop_core->get_option( 'structure_home_posts' ) );

                    the_posts_pagination();

                } else {

                    get_template_part('template-parts/content', 'none');
                }

            }

            if ( 'bottom' == $wpshop_core->get_option( 'structure_home_position' ) ) get_template_part( 'template-parts/content', 'home' );

            ?>

		</main><!-- #main -->
	</div><!-- #primary -->

    <?php if ( in_array( $wpshop_core->get_option( 'structure_home_sidebar' ), [ 'left', 'right' ] ) ) get_sidebar(); ?>

<?php
get_footer();
