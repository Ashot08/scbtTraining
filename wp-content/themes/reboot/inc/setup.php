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

if ( ! function_exists( 'reboot_setup' ) ) :
    function reboot_setup() {

        // Add default posts and comments RSS feed links to head.
        if ( apply_filters( THEME_SLUG . '_allow_rss_links', false ) ) {
            add_theme_support( 'automatic-feed-links' );
        }


        // Let WordPress manage the document title.
        add_theme_support( 'title-tag' );


        // Switch default core markup to output valid HTML5.
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );


        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 870, 400 );
        $image_size_small = apply_filters( THEME_SLUG . '_image_size_small', [ 335, 220, true ] );
        $image_size_standard = apply_filters( THEME_SLUG . '_image_size_standard', [ 870, 400, true ] );
        $image_size_square = apply_filters( THEME_SLUG . '_image_size_square', [ 100, 100, true ] );
        if ( function_exists( 'add_image_size' ) ) {
            add_image_size( THEME_SLUG . '_small', $image_size_small[0], $image_size_small[1], $image_size_small[2] );
            add_image_size( THEME_SLUG . '_standard', $image_size_standard[0], $image_size_standard[1], $image_size_standard[2] );
            add_image_size( THEME_SLUG . '_square', $image_size_square[0], $image_size_square[1], $image_size_square[2] );
        }


        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'top' => esc_html__( 'Top menu', THEME_TEXTDOMAIN ),
            'header' => esc_html__( 'Header menu', THEME_TEXTDOMAIN ),
            'footer' => esc_html__( 'Footer menu', THEME_TEXTDOMAIN ),
        ) );


        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );


        // Add support for Block Styles.
        add_theme_support( 'wp-block-styles' );


        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );


        // Add support for editor styles.
        //add_theme_support( 'editor-styles' );


        // Enqueue editor styles.
        //add_editor_style( 'style-editor.css' );


        // Add custom editor font sizes.
        add_theme_support(
            'editor-font-sizes',
            array(
                array(
                    'name'      => __( 'Small', THEME_TEXTDOMAIN ),
                    'shortName' => __( 'S', THEME_TEXTDOMAIN ),
                    'size'      => 19.5,
                    'slug'      => 'small',
                ),
                array(
                    'name'      => __( 'Normal', THEME_TEXTDOMAIN ),
                    'shortName' => __( 'M', THEME_TEXTDOMAIN ),
                    'size'      => 22,
                    'slug'      => 'normal',
                ),
                array(
                    'name'      => __( 'Large', THEME_TEXTDOMAIN ),
                    'shortName' => __( 'L', THEME_TEXTDOMAIN ),
                    'size'      => 36.5,
                    'slug'      => 'large',
                ),
                array(
                    'name'      => __( 'Huge', THEME_TEXTDOMAIN ),
                    'shortName' => __( 'XL', THEME_TEXTDOMAIN ),
                    'size'      => 49.5,
                    'slug'      => 'huge',
                ),
            )
        );
    }
endif;
add_action( 'after_setup_theme', 'reboot_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function reboot_content_width() {
    // This variable is intended to be overruled from themes.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'reboot_content_width', 730 );
}
add_action( 'after_setup_theme', 'reboot_content_width', 0 );



/**
 * Register widget area.
 */
function reboot_widgets_init() {
    global $wpshop_core;

    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', THEME_TEXTDOMAIN ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', THEME_TEXTDOMAIN ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-header">',
        'after_title'   => '</div>',
    ) );

    $footer_widgets = $wpshop_core->get_option( 'footer_widgets' );
    if ( $footer_widgets > 5 ) $footer_widgets = 5;
    if ( $footer_widgets > 0 ) {
        for ( $n = 1; $n <= $footer_widgets; $n++ ) {

            register_sidebar( array(
                'name'          => esc_html__( 'Footer', THEME_TEXTDOMAIN ) . ' ' . $n,
                'id'            => 'footer-widget-'. $n,
                'description'   => esc_html__( 'Add widgets here.', THEME_TEXTDOMAIN ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<div class="widget-header">',
                'after_title'   => '</div>',
            ) );

        }
    }
}
add_action( 'widgets_init', 'reboot_widgets_init' );



/**
 * Body background link
 */
global $wpshop_core;

$wpshop_body_bg_link    = $wpshop_core->get_option( 'body_bg_link' );
$wpshop_body_bg_link_js = $wpshop_core->get_option( 'body_bg_link_js' );

if ( ! empty( $wpshop_body_bg_link ) ) {
    add_action( 'reboot_after_body', function() {
        global $wpshop_body_bg_link;
        global $wpshop_body_bg_link_js;

        echo '<div style="position:fixed; overflow:hidden; top:0px; left:0px; width:100%; height:100%;">';

        if ( $wpshop_body_bg_link_js ) {
            echo '<span class="js-link" data-href="' . base64_encode( $wpshop_body_bg_link ) . '" data-target="_blank" style="display:block; height:100%; width:100%;"></span>';
        } else {
            echo '<a href="' . $wpshop_body_bg_link . '" target="_blank" style="display:block; height:100%; width:100%;"></a>';
        }

        echo '</div>';

    } );
}



/**
 * Fixed menu
 */
global $wpshop_core;

$wpshop_navigation_main_fixed = $wpshop_core->get_option( 'header_menu_fixed' );
if ( $wpshop_navigation_main_fixed == 'yes' ) {
    add_action( 'wp_head', 'fixed_menu_script' );
}
function fixed_menu_script() {
    echo "<script>var fixed_main_menu = 'yes';</script>";
}



/**
 * Breadcrumbs home text
 */
global $wpshop_core;

$breadcrumbs_home_text = $wpshop_core->get_option( 'breadcrumbs_home_text' );
if ( ! empty( $breadcrumbs_home_text ) && $breadcrumbs_home_text != 'Home' ) {
    add_filter( 'wpshop_breadcrumbs_home_text', 'wpshop_breadcrumbs_home_text_change' );
}
function wpshop_breadcrumbs_home_text_change() {
    global $wpshop_core;
    $breadcrumbs_home_text = $wpshop_core->get_option( 'breadcrumbs_home_text' );
    return $breadcrumbs_home_text;
}



/**
 * Breadcrumbs single link
 */
$breadcrumbs_single_link = $wpshop_core->get_option( 'breadcrumbs_single_link' );
if ( $breadcrumbs_single_link ) {
    add_filter( 'wpshop_breadcrumb_single_link', '__return_true' );
}



/**
 * TOC
 */
global $wpshop_core;

$toc_noindex = $wpshop_core->get_option( 'toc_noindex' );
if ( $toc_noindex ) {
    add_filter( 'wpshop_toc_noindex', '__return_true' );
}

$toc_open = $wpshop_core->get_option( 'toc_open' );
if ( ! $toc_open ) {
    add_filter( 'wpshop_toc_open', '__return_false' );
}

$toc_display = $wpshop_core->get_option( 'toc_display' );
$toc_display_pages = $wpshop_core->get_option( 'toc_display_pages' );

if ( $toc_display ) {
    add_filter( 'wpshop_toc_in_single', '__return_true' );
} else {
    add_filter( 'wpshop_toc_in_single', '__return_false' );
}
if ( $toc_display_pages ) {
    add_filter( 'wpshop_toc_in_page', '__return_true' );
} else {
    add_filter( 'wpshop_toc_in_page', '__return_false' );
}

$toc_place = $wpshop_core->get_option( 'toc_place' );
if ( $toc_place ) {
    add_filter( 'wpshop_toc_place', '__return_false' );
}

$toc_title = $wpshop_core->get_option( 'toc_title' );
if ( ! empty( $toc_title ) && $toc_title != 'Contents' ) {
    add_filter( 'wpshop_toc_header', 'wpshop_wpshop_toc_header_change' );
}
function wpshop_wpshop_toc_header_change() {
    global $wpshop_core;
    $toc_title = $wpshop_core->get_option( 'toc_title' );
    return $toc_title;
}



if ( $toc_display || $toc_display_pages ) {
    $wpshop_table_of_contents->init();
}



/**
 * Comments form title
 */
$comments_form_title = $wpshop_core->get_option( 'comments_form_title' );
if ( ! empty( $comments_form_title ) && $comments_form_title != 'Add a comment' ) {
    add_filter( 'reboot_comments_form_title', 'comments_form_title_change' );
}
function comments_form_title_change() {
    global $wpshop_core;
    $comments_form_title = $wpshop_core->get_option( 'comments_form_title' );
    return $comments_form_title;
}



/**
 * Show comment time
 */
$comments_time = $wpshop_core->get_option( 'comments_time' );
if ( ! $comments_time ) {
    add_filter( 'reboot_comments_show_time', '__return_false' );
}



/**
 * Author social title
 */
$author_social_title = $wpshop_core->get_option( 'author_social_title' );
if ( ! empty( $author_social_title ) && $author_social_title != 'Author profiles' ) {
    add_filter( 'reboot_author_social_title', 'author_social_title_change' );
}
function author_social_title_change() {
    global $wpshop_core;
    $author_social_title = $wpshop_core->get_option( 'author_social_title' );
    return $author_social_title;
}



/**
 * Show title author social
 */
$author_social_title_show = $wpshop_core->get_option( 'author_social_title_show' );
if ( ! $author_social_title_show ) {
    add_filter( 'reboot_author_social_title_show', '__return_false' );
}



/**
 * Exclude category in sitemap
 */
add_filter( 'wpshop_sitemap_category_exclude', function() {
    global $wpshop_core;
    $sitemap_category_exclude = $wpshop_core->get_option( 'sitemap_category_exclude' );

    if ( ! empty( $sitemap_category_exclude ) ) {
        $sitemap_category_exclude_id = explode( ',', $sitemap_category_exclude );

        if ( is_array( $sitemap_category_exclude_id ) ) {
            $sitemap_category_exclude = array_map( 'trim', $sitemap_category_exclude_id );
        } else {
            $sitemap_category_exclude = array( $sitemap_category_exclude );
        }
    }

    return $sitemap_category_exclude;
} );



/**
 * Exclude posts in sitemap
 */
add_filter( 'wpshop_sitemap_posts_exclude', function() {
    global $wpshop_core;
    $sitemap_posts_exclude = $wpshop_core->get_option( 'sitemap_posts_exclude' );

    if ( ! empty( $sitemap_posts_exclude ) ) {
        $sitemap_posts_exclude_id = explode( ',', $sitemap_posts_exclude );

        if ( is_array( $sitemap_posts_exclude_id ) ) {
            $sitemap_posts_exclude = array_map( 'trim', $sitemap_posts_exclude_id );
        } else {
            $sitemap_posts_exclude = array( $sitemap_posts_exclude );
        }
    }

    return $sitemap_posts_exclude;
} );



/**
 * Show pages in sitemap
 */
$sitemap_pages_show = $wpshop_core->get_option( 'sitemap_pages_show' );
if ( ! $sitemap_pages_show ) {
    add_filter( 'wpshop_sitemap_show_pages', '__return_false' );
}



/**
 * Exclude pages in sitemap
 */
add_filter( 'wpshop_sitemap_pages_exclude', function() {
    global $wpshop_core;
    $sitemap_pages_exclude = $wpshop_core->get_option( 'sitemap_pages_exclude' );

    if ( ! empty( $sitemap_pages_exclude ) ) {
        $sitemap_pages_exclude_id = explode( ',', $sitemap_pages_exclude );

        if ( is_array( $sitemap_pages_exclude_id ) ) {
            $sitemap_pages_exclude = array_map( 'trim', $sitemap_pages_exclude_id );
        } else {
            $sitemap_pages_exclude = array( $sitemap_pages_exclude );
        }
    }

    return $sitemap_pages_exclude;
} );



/**
 * Views counter
 */
$wpshop_views_counter->init();



/**
 * Content on full width
 */
$content_full_width = $wpshop_core->get_option( 'content_full_width' );
if ( $content_full_width ) {
    add_filter( 'reboot_site_content_classes', '__return_false' );
}



/**
 * Social buttons title
 */
$social_share_title = $wpshop_core->get_option( 'social_share_title' );
if ( ! empty( $social_share_title ) && $social_share_title != 'Share to friends' ) {
    add_filter( 'reboot_social_share_title', 'social_share_title_change' );
}
function social_share_title_change() {
    global $wpshop_core;
    $social_share_title = $wpshop_core->get_option( 'social_share_title' );
    return $social_share_title;
}



/**
 * Show title social buttons in posts
 */
$single_social_share_title_show = $wpshop_core->get_option( 'single_social_share_title_show' );
if ( $single_social_share_title_show ) {
    add_filter( 'reboot_single_social_share_title_show', '__return_true' );
}



/**
 * Show title social buttons on pages
 */
$page_social_share_title_show = $wpshop_core->get_option( 'page_social_share_title_show' );
if ( ! $page_social_share_title_show ) {
    add_filter( 'reboot_page_social_share_title_show', '__return_false' );
}



/**
 * Rating title in posts
 */
$single_rating_title = $wpshop_core->get_option( 'single_rating_title' );
if ( ! empty( $single_rating_title ) && $single_rating_title != 'Rate article' ) {
    add_filter( 'reboot_single_rating_title', 'single_rating_title_change' );
}
function single_rating_title_change() {
    global $wpshop_core;
    $single_rating_title = $wpshop_core->get_option( 'single_rating_title' );
    return $single_rating_title;
}



/**
 * Rating title on pages
 */
$page_rating_title = $wpshop_core->get_option( 'page_rating_title' );
if ( ! empty( $page_rating_title ) && $page_rating_title != 'Rating' ) {
    add_filter( 'reboot_page_rating_title', 'page_rating_title_change' );
}
function page_rating_title_change() {
    global $wpshop_core;
    $page_rating_title = $wpshop_core->get_option( 'page_rating_title' );
    return $page_rating_title;
}



/**
 * Rating text
 */
$rating_text_show = $wpshop_core->get_option( 'rating_text_show' );
if ( $rating_text_show ) {
    add_filter( 'reboot_rating_text_show', '__return_true' );
}



/**
 * Related posts title
 */
$related_posts_title = $wpshop_core->get_option( 'related_posts_title' );
if ( ! empty( $related_posts_title ) && $related_posts_title != 'You may also like' ) {
    add_filter( 'reboot_related_title', 'related_posts_title_change' );
}
function related_posts_title_change() {
    global $wpshop_core;
    $related_posts_title = $wpshop_core->get_option( 'related_posts_title' );
    return $related_posts_title;
}



/**
 * Enable advertising on pages
 */
$advertising_page_display = $wpshop_core->get_option( 'advertising_page_display' );
if ( $advertising_page_display ) {
    add_filter( 'wpshop_advertising_single', '__return_false' );
}



/**
 * Microdata publisher telephone
 */
$microdata_publisher_telephone = $wpshop_core->get_option( 'microdata_publisher_telephone' );
if ( ! empty( $microdata_publisher_telephone ) ) {
    add_filter( 'wpshop_microdata_publisher_telephone', 'microdata_publisher_telephone_change' );
}
function microdata_publisher_telephone_change() {
    global $wpshop_core;
    $microdata_publisher_telephone = $wpshop_core->get_option( 'microdata_publisher_telephone' );
    return $microdata_publisher_telephone;
}



/**
 * Microdata publisher address
 */
$microdata_publisher_address = $wpshop_core->get_option( 'microdata_publisher_address' );
if ( ! empty( $microdata_publisher_address ) ) {
    add_filter( 'wpshop_microdata_publisher_address', 'microdata_publisher_address_change' );
}
function microdata_publisher_address_change() {
    global $wpshop_core;
    $microdata_publisher_address = $wpshop_core->get_option( 'microdata_publisher_address' );
    return $microdata_publisher_address;
}
