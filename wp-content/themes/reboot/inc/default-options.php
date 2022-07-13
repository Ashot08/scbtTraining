<?php
/**
 * ****************************************************************************
 *
 *   НЕ РЕДАКТИРУЙТЕ ЭТОТ ФАЙЛ
 *   DON'T EDIT THIS FILE
 *
 *   Используйте хук {THEME_SLUG}_options_defaults
 *   Use hook {THEME_SLUG}_options_defaults
 *
 * *****************************************************************************
 *
 * @package reboot
 */

$default_options = apply_filters( THEME_SLUG . '_options_defaults', [

    // layout  >  header
    'header_width'                        => 'full',
    'header_inner_width'                  => 'fixed',
    'header_padding_top'                  => 0,
    'header_padding_bottom'               => 0,

    // layout  >  header menu
    'header_menu_width'                   => 'fixed',
    'header_menu_inner_width'             => 'full',
    'header_menu_fixed'                   => false,

    // layout  >  footer menu
    'footer_menu_width'                   => 'fixed',
    'footer_menu_inner_width'             => 'full',
    'footer_menu_mob'                     => false,

    // layout  >  footer
    'footer_width'                        => 'full',
    'footer_inner_width'                  => 'fixed',


    // blocks  >  header
    'logotype_image'                      => '',
    'logotype_max_width'                  => 1000,
    'logotype_max_height'                 => 100,
    'header_hide_title'                   => false,
    'header_hide_description'             => false,
    'header_hide_social'                  => false,
    'header_hide_search'                  => false,
    'header_html_block_1'                 => '',
    'header_html_block_2'                 => '',
    'header_block_order'                  => 'site_branding,header_html_block_1,top_menu,header_html_block_2,header_search',

    // blocks  >  footer
    'footer_widgets'                      => 0,
    'footer_copyright'                    => '© %year% ' . get_bloginfo( 'name' ),
    'footer_counters'                     => '',
    'footer_sticky_disable'               => false,
    'footer_widgets_equal_width'          => false,

    // blocks  >  home
    'structure_home_posts'                => 'standard',
    'structure_home_sidebar'              => 'right',
    'structure_home_h1'                   => '',
    'structure_home_text'                 => '',
    'structure_home_position'             => 'bottom',

    // blocks  >  single
    'structure_single_sidebar'            => 'right',
    'structure_single_hide'               => 'social_top,date_modified,author_box',
    'structure_single_related'            => 8,

    // blocks  >  page
    'structure_page_sidebar'              => 'right',
    'structure_page_hide'                 => 'social_top,rating',
    'structure_page_related'              => 0,

    // blocks  >  archive
    'structure_archive_posts'             => 'standard',
    'structure_archive_sidebar'           => 'right',
    'structure_archive_description_show'  => true,
    'structure_archive_subcategories'     => 'yes',
    'structure_archive_description'       => 'top',

    // blocks  >  comments
    'comments_form_title'                 => __( 'Add a comment', THEME_TEXTDOMAIN ),
    'comments_text_before_submit'         => '',
    'comments_date'                       => true,
    'comments_time'                       => true,
    'comments_output'                     => false,

    // blocks  >  sidebar
	'sidebar_fixed'                       => true,
    'sidebar_mob'                         => false,


    // modules  >  slider
    'slider_width'                        => 'fixed',
    'slider_autoplay'                     => 2500,
    'slider_type'                         => 'one',
    'slider_count'                        => 0,
    'slider_order_post'                   => 'new',
    'slider_post_in'                      => '',
    'slider_category_in'                  => '',
    'slider_show_category'                => true,
    'slider_show_title'                   => true,
    'slider_show_excerpt'                 => true,
    'slider_show_on_paged'                => false,
    'slider_mob_disable'                  => false,

    // modules  >  toc
    'toc_display'                         => true,
    'toc_display_pages'                   => false,
    'toc_noindex'                         => false,
    'toc_open'                            => true,
    'toc_place'                           => false,
    'toc_title'                           => __( 'Contents', THEME_TEXTDOMAIN ),

    // modules  >  lightbox
    'lightbox_display'                    => true,

    // modules  >  breadcrumbs
    'breadcrumbs_display'                 => true,
    'breadcrumbs_home_text'               => __( 'Home', THEME_TEXTDOMAIN ),
    'breadcrumbs_archive'                 => true,
    'breadcrumbs_single_link'             => false,

    // modules  >  author block
    'author_link'                         => false,
    'author_link_target'                  => false,
    'author_social_enable'                => false,
    'author_social_title'                 => __( 'Author profiles', THEME_TEXTDOMAIN ),
    'author_social_title_show'            => true,
    'author_social_js'                    => true,

    // modules  >  contact form
    'contact_form_text_before_submit'     => '',

    // modules  >  social profiles
    'social_facebook'                     => '',
    'social_vkontakte'                    => '',
    'social_twitter'                      => '',
    'social_odnoklassniki'                => '',
    'social_telegram'                     => '',
    'social_youtube'                      => '',
    'social_instagram'                    => '',
    'social_linkedin'                     => '',
    'social_whatsapp'                     => '',
    'social_viber'                        => '',
    'social_pinterest'                    => '',
    'social_yandexzen'                    => '',
    'structure_social_js'                 => true,

    // modules  >  share buttons
    'share_buttons'                       => 'vkontakte,facebook,telegram,odnoklassniki,twitter,sms,whatsapp',
    'share_buttons_counters'              => false,
    'share_buttons_label'                 => false,

    // modules  >  sitemap
    'sitemap_category_exclude'            => '',
    'sitemap_posts_exclude'               => '',
    'sitemap_pages_show'                  => true,
    'sitemap_pages_exclude'               => '',

    // modules  >  related posts
    'related_posts_title'                 => __( 'You may also like', THEME_TEXTDOMAIN ),
    'related_post_taxonomy_order'         => 'categories',
    'related_posts_exclude'               => '',
    'related_posts_category_exclude'      => '',

    // modules  >  scroll to top
    'arrow_display'                       => true,
    'arrow_mob_display'                   => false,
    'arrow_bg'                            => '#ffffff',
    'arrow_color'                         => '#305cf7',
    'arrow_width'                         => '60',
    'arrow_height'                        => '50',
    'arrow_icon'                          => '\fe3f',

    // modules > views counter
    'wpshop_views_counter_enable'         => true,
    'wpshop_views_counter_to_count'       => '0',
    'wpshop_views_counter_exclude_bots'   => '1',


    // post card  >  grid
    'post_card_grid_order'                => 'thumbnail,category,title,meta,excerpt',
    'post_card_grid_order_meta'           => 'comments_number,views',
    'post_card_grid_excerpt_length'       => 50,
    'post_card_grid_animation_type'       => 'fadeinup',
    'post_card_grid_round_thumbnail'      => false,

    // post card  >  small
    'post_card_small_order'               => 'thumbnail,category,title,meta,excerpt',
    'post_card_small_order_meta'          => 'comments_number,views',
    'post_card_small_excerpt_length'      => 30,
    'post_card_small_animation_type'      => 'fadeinup',
    'post_card_small_round_thumbnail'     => false,

    // post card  >  vertical
    'post_card_vertical_order'            => 'thumbnail,category,title,meta,excerpt',
    'post_card_vertical_order_meta'       => 'comments_number,views',
    'post_card_vertical_excerpt_length'   => 50,
    'post_card_vertical_animation_type'   => 'fadeinup',
    'post_card_vertical_round_thumbnail'  => false,

    // post card  >  horizontal
    'post_card_horizontal_order'           => 'thumbnail,category,title,meta,excerpt',
    'post_card_horizontal_order_meta'      => 'comments_number,views',
    'post_card_horizontal_excerpt_length'  => 100,
    'post_card_horizontal_animation_type'  => 'fadeinup',
    'post_card_horizontal_round_thumbnail' => false,

    // post card  >  standard
    'post_card_standard_order'            => 'thumbnail,category,title,meta,excerpt',
    'post_card_standard_order_meta'       => 'date,comments_number,views',
    'post_card_standard_excerpt_length'   => 150,
    'post_card_standard_animation_type'   => 'no',
    'post_card_standard_round_thumbnail'  => false,

    // post card  >  related
    'post_card_related_order'             => 'thumbnail,title,excerpt,meta',
    'post_card_related_order_meta'        => 'comments_number,views',
    'post_card_related_excerpt_length'    => 50,
    'post_card_related_round_thumbnail'   => false,


    // codes
    'code_head'                           => '',
    'code_body'                           => '',
    'code_after_content'                  => '',


    // colors and background  >  general
	'colors_body_bg'                      => '#ffffff',
    'colors_body'                         => '#111111',
    'colors_main'                         => '#4d3bfe',
    'colors_link'                         => '#111111',
    'colors_link_hover'                   => '#4d3bfe',
	'colors_content_bg'                   => '#ffffff',
	'body_bg'                             => '',
	'body_bg_repeat'                      => 'no-repeat',
	'body_bg_position'                    => 'center center',
	'body_bg_size'                        => 'auto',
	'body_bg_scroll'                      => true,
	'body_bg_link'                        => '',
	'body_bg_link_js'                     => true,

	// colors and background  >  header
    'colors_header_bg'                    => '#ffffff',
    'colors_header'                       => '#111111',
    'colors_header_site_title'            => '#111111',
    'colors_header_site_description'      => '#111111',
    'header_bg'                           => '',
    'header_bg_repeat'                    => 'no-repeat',
    'header_bg_position'                  => 'center center',
	'header_bg_mob'                       => false,

	// colors and background  >  menu
    'colors_menu_bg'                      => '#ffffff',
    'colors_menu'                         => '#111111',

    // colors and background  >  footer
    'colors_footer_bg'                    => '#26252d',
    'colors_footer'                       => '#ffffff',


    // typography  >  general
    'typography_body'                     => json_encode( [
        'font-family'                     => 'montserrat',
        'font-size'                       => '16',
        'font-style'                      => '',
        'line-height'                     => '1.5',
        'unit'                            => 'px'
    ] ),

    // typography  >  header
    'typography_site_title'               => json_encode( [
        'font-family'                     => 'montserrat',
        'font-size'                       => '32',
        'font-style'                      => '',
        'line-height'                     => '1.5',
        'unit'                            => 'px'
    ] ),
    'typography_site_description'         => json_encode( [
        'font-family'                     => 'montserrat',
        'font-size'                       => '13',
        'font-style'                      => '',
        'line-height'                     => '1.3',
        'unit'                            => 'px'
    ] ),

    // typography  >  menu
    'typography_menu_links'               => json_encode( [
        'font-family'                     => 'montserrat',
        'font-size'                       => '16',
        'font-style'                      => '',
        'line-height'                     => '1.5',
        'unit'                            => 'px'
    ] ),

    // typography  >  headers
    'typography_header_h1'                => json_encode( [
        'font-family'                     => 'montserrat',
        'font-size'                       => '2.4',
        'font-style'                      => '',
        'line-height'                     => '1.5',
        'unit'                            => 'em'
    ] ),

    'typography_header_h2'                => json_encode( [
        'font-family'                     => 'montserrat',
        'font-size'                       => '1.9',
        'font-style'                      => '',
        'line-height'                     => '1.2',
        'unit'                            => 'em'
    ] ),

    'typography_header_h3'                => json_encode( [
        'font-family'                     => 'montserrat',
        'font-size'                       => '1.6',
        'font-style'                      => '',
        'line-height'                     => '1.3',
        'unit'                            => 'em'
    ] ),

    'typography_header_h4'                => json_encode( [
        'font-family'                     => 'montserrat',
        'font-size'                       => '1.25',
        'font-style'                      => '',
        'line-height'                     => '1.4',
        'unit'                            => 'em'
    ] ),

    'typography_header_h5'                => json_encode( [
        'font-family'                     => 'montserrat',
        'font-size'                       => '1',
        'font-style'                      => '',
        'line-height'                     => '1.5',
        'unit'                            => 'em'
    ] ),

    'typography_header_h6'                => json_encode( [
        'font-family'                     => 'montserrat',
        'font-size'                       => '.75',
        'font-style'                      => '',
        'line-height'                     => '2',
        'unit'                            => 'em'
    ] ),


    // home constructor
    'display_constructor_static_page'     => false,


    // tweak
    'content_full_width'                  => false,
    'social_share_title'                  => __( 'Share to friends', THEME_TEXTDOMAIN ),
    'single_social_share_title_show'      => false,
    'page_social_share_title_show'        => true,
    'single_rating_title'                 => __( 'Rate article', THEME_TEXTDOMAIN ),
    'page_rating_title'                   => __( 'Rating', THEME_TEXTDOMAIN ),
    'rating_text_show'                    => false,
    'advertising_page_display'            => false,
    'microdata_publisher_telephone'       => '',
    'microdata_publisher_address'         => '',


	// partner program
	'wpshop_partner_enable'               => false,
	'wpshop_partner_prefix'               => __( 'Powered by theme', THEME_TEXTDOMAIN ),
	'wpshop_partner_postfix'              => '',

] );


/**
 * Set default options
 */
global $wpshop_core;
$wpshop_core->set_default_options( $default_options );
