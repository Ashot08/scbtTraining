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
global $wpshop_helper;
global $wpshop_template;

$post_card_type = 'related';
$post_card_thumb_size = apply_filters( THEME_SLUG . '_post_card_' . $post_card_type . '_thumbnail_size', THEME_SLUG . '_small' );
$section_options = ( isset( $section_options ) ) ? $section_options : [];


/**
 * order
 */
$post_card_order = $wpshop_core->get_option( 'post_card_' . $post_card_type . '_order' );
$post_card_order = explode( ',', $post_card_order );

$post_card_order_meta = $wpshop_core->get_option( 'post_card_' . $post_card_type . '_order_meta' );
$post_card_order_meta = explode( ',', $post_card_order_meta );


/**
 * post card class
 */
$post_card = new \Wpshop\PostCard\PostCard();
$post_card->set_order( array_merge( $post_card_order, $post_card_order_meta ) );
$post_card->set_section_options( $section_options );


/**
 * default
 */
$post_card_classes    = [ 'post-card--' . $post_card_type ];
$description_length   = (int) $wpshop_core->get_option( 'post_card_' . $post_card_type . '_excerpt_length' );


/**
 * prepare data
 */
$thumb = get_the_post_thumbnail( $post->ID, $post_card_thumb_size );
if ( empty( $thumb ) ) {
    $post_card_classes[] = 'post-card--thumbnail-no';
}
if ( ! $post_card->is_show_element( 'thumbnail' ) ) {
    $post_card_classes[] = 'post-card--thumbnail-no';
}

?>

<div class="post-card <?php echo implode( ' ', $post_card_classes ) ?>">
    <?php
    foreach ( $post_card_order as $order ) {

        if ( ! empty( $thumb ) && $order == 'thumbnail' && $post_card->is_show_element( 'thumbnail' ) ) :
            echo '<div class="post-card__thumbnail">';
            echo '<a href="' . get_the_permalink() . '">';
            echo $thumb;
            echo '</a>';
            echo '</div>';
        endif;

        //echo '<div class="post-card__body">';

            if ( $order == 'title' && $post_card->is_show_element( 'title' ) ) {
                echo '<div class="post-card__title">';
                echo '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
                echo '</div>';
            }

            if ( $order == 'excerpt' && $post_card->is_show_element( 'excerpt' ) ) {
                echo '<div class="post-card__description">';
                $excerpt = get_the_excerpt();
                if ( apply_filters( THEME_SLUG . '_post_card_' . $post_card_type . '_excerpt_strip_tags', true ) ) {
                    $excerpt = strip_tags( $excerpt );
                }
                $excerpt = $wpshop_helper->substring_by_word( $excerpt, $description_length );
                $excerpt = apply_filters( THEME_SLUG . '_post_card_' . $post_card_type . '_excerpt', $excerpt );
                echo $excerpt;
                echo '</div>';
            }

            if ( $order == 'meta' ) {
                if ( $post_card->is_show_element( 'comments_number' ) || $post_card->is_show_element( 'views' ) ) {
                    echo '<div class="post-card__meta">';

                    foreach ( $post_card_order_meta as $meta_order ) {

                        if ( $meta_order == 'comments_number' && $post_card->is_show_element( 'comments_number' ) ) {
                            echo '<span class="post-card__comments">' . get_comments_number() . '</span>';
                        }

                        if ( $meta_order == 'views' && $post_card->is_show_element( 'views' ) ) {
                            echo '<span class="post-card__views">';
                            echo $wpshop_helper->rounded_number( $wpshop_template->get_views() );
                            echo '</span>';
                        }

                    }

                    echo '</div>';
                }
            }

        //echo '</div>';

    }
    ?>

</div>
