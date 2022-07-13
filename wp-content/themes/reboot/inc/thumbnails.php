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

function wpshop_core_thumbnails() {

	class Posts_Thumbnails extends Wpshop\Core\MetaBox {

		public function __construct() {
			$this->set_settings( array(
				'prefix'         => 'posts_thumb_',
				'post_type'      => apply_filters( THEME_SLUG . '_metabox_thumbnail_post_type', array( 'post', 'page' ) ),
				'meta_box_title' => __( 'Thumbnail settings', THEME_TEXTDOMAIN ),
				'context'        => 'side',
			) );

			parent::__construct();
		}

		public function render_fields() {
		    $field_text  = '';
            $field_text .= '<p><strong>' . __( 'Recommended sizes', THEME_TEXTDOMAIN ) . '</strong></p>';
            $field_text .= '<p>';
            $field_text .= sprintf( esc_html__( 'Standard: %s', THEME_TEXTDOMAIN ), '870x400' ) . '<br>';
            $field_text .= sprintf( esc_html__( 'Wide: %s', THEME_TEXTDOMAIN ), '1190x400' ) . '<br>';
            $field_text .= sprintf( esc_html__( 'Full width: %s', THEME_TEXTDOMAIN ), '1920x400' ) . '<br>';
            $field_text .= sprintf( esc_html__( 'Fullscreen: %s', THEME_TEXTDOMAIN ), '1920x400' ) . '<br>';
            $field_text .= '</p>';

            echo $field_text;

			$this->field_select(
				'thumbnail_type',
				__( 'Thumbnail type', THEME_TEXTDOMAIN ),
				[
					'standard'   => __( 'Standard', THEME_TEXTDOMAIN ),
					'wide'       => __( 'Wide', THEME_TEXTDOMAIN ),
					'full'       => __( 'Full', THEME_TEXTDOMAIN ),
					'fullscreen' => __( 'Fullscreen', THEME_TEXTDOMAIN ),
				]
            );
		}

	}

	new Posts_Thumbnails;

}

add_action( 'after_setup_theme', 'wpshop_core_thumbnails' );