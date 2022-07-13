<?php

use Wpshop\Core\Customizer\CustomizerCSS;

function wpshop_customizer_css() {
    global $default_options;
    global $wpshop_core;

    $class_customizer_css = new CustomizerCSS( [ 'defaults' => $default_options, 'theme_slug' => THEME_SLUG ] );

    // layout  >  header
    $class_customizer_css->add(
        '.site-header',
        [ 'padding-top:%dpx', 'header_padding_top' ],
        '(min-width: 768px)'
    );

    $class_customizer_css->add(
        '.site-header',
        [ 'padding-bottom:%dpx', 'header_padding_bottom' ],
        '(min-width: 768px)'
    );


    // modules  >  scroll to top
    $class_customizer_css->add(
        '.scrolltop',
        [ 'background-color:%s', 'arrow_bg' ]
    );

    $class_customizer_css->add(
        '.scrolltop:before',
        [ 'color:%s', 'arrow_color' ]
    );

    $class_customizer_css->add(
        '.scrolltop',
        [ 'width:%dpx', 'arrow_width' ]
    );

    $class_customizer_css->add(
        '.scrolltop',
        [ 'height:%dpx', 'arrow_height' ]
    );

    $class_customizer_css->add(
        '.scrolltop:before',
        [ 'content:"%s"', 'arrow_icon' ]
    );


    // post cards  >  grid
    if ( $wpshop_core->get_option( 'post_card_grid_round_thumbnail' ) ) {
        $class_customizer_css->add(
            '.post-card--grid, .post-card--grid .post-card__thumbnail, .post-card--grid .post-card__thumbnail img, .post-card--grid .post-card__thumbnail:before',
            [ 'border-radius: 6px', '' ]
        );
    }


    // post cards  >  small
    if ( $wpshop_core->get_option( 'post_card_small_round_thumbnail' ) ) {
        $class_customizer_css->add(
            '.post-card--small .post-card__thumbnail img',
            [ 'border-radius: 6px', '' ]
        );
    }

    // post cards  >  vertical
    if ( $wpshop_core->get_option( 'post_card_vertical_round_thumbnail' ) ) {
        $class_customizer_css->add(
            '.post-card--vertical .post-card__thumbnail img, .post-card--vertical .post-card__thumbnail a:before',
            [ 'border-radius: 6px', '' ]
        );
    }


    // post cards  >  horizontal
    if ( $wpshop_core->get_option( 'post_card_horizontal_round_thumbnail' ) ) {
        $class_customizer_css->add(
            '.post-card--horizontal .post-card__thumbnail img',
            [ 'border-radius: 6px', '' ]
        );
    }


    // post cards  >  standard
    if ( $wpshop_core->get_option( 'post_card_standard_round_thumbnail' ) ) {
        $class_customizer_css->add(
            '.post-card--standard .post-card__thumbnail img, .post-card--standard .post-card__thumbnail a:before',
            [ 'border-radius: 6px', '' ]
        );
    }


    // post cards  >  related
    if ( $wpshop_core->get_option( 'post_card_related_round_thumbnail' ) ) {
        $class_customizer_css->add(
            '.post-card--related, .post-card--related .post-card__thumbnail img, .post-card--related .post-card__thumbnail a:before',
            [ 'border-radius: 6px', '' ]
        );
    }


	// colors and background  >  general
	$class_customizer_css->add(
		'body',
		[ 'color:%s', 'colors_body' ]
	);

	$class_customizer_css->add(
		'body',
		[ 'background-color:%s', 'colors_body_bg' ]
	);

    $class_customizer_css->add(
        '::selection, .card-slider__category, .card-slider-container .swiper-pagination-bullet-active, .post-card--grid .post-card__thumbnail:before, .post-card:not(.post-card--small) .post-card__thumbnail a:before, .post-card:not(.post-card--small) .post-card__category,  .post-box--high .post-box__category span, .post-box--wide .post-box__category span, .page-separator, .pagination .nav-links .page-numbers:not(.dots):not(.current):before, .btn, .btn-primary:hover, .btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle, .comment-respond .form-submit input, .page-links__item',
        [ 'background-color:%s', 'colors_main' ]
    );
    $class_customizer_css->add(
        '.entry-image--big .entry-image__body .post-card__category a, .home-text ul:not([class])>li:before, .page-content ul:not([class])>li:before, .taxonomy-description ul:not([class])>li:before, .widget-area .widget_categories ul.menu li a:before, .widget-area .widget_categories ul.menu li span:before, .widget-area .widget_categories>ul li a:before, .widget-area .widget_categories>ul li span:before, .widget-area .widget_nav_menu ul.menu li a:before, .widget-area .widget_nav_menu ul.menu li span:before, .widget-area .widget_nav_menu>ul li a:before, .widget-area .widget_nav_menu>ul li span:before, .page-links .page-numbers:not(.dots):not(.current):before, .page-links .post-page-numbers:not(.dots):not(.current):before, .pagination .nav-links .page-numbers:not(.dots):not(.current):before, .pagination .nav-links .post-page-numbers:not(.dots):not(.current):before, .entry-image--full .entry-image__body .post-card__category a, .entry-image--fullscreen .entry-image__body .post-card__category a, .entry-image--wide .entry-image__body .post-card__category a',
        [ 'background-color:%s', 'colors_main' ]
    );

    $class_customizer_css->add(
        '.comment-respond input:focus, select:focus, textarea:focus, .post-card--grid.post-card--thumbnail-no, .post-card--standard:after, .post-card--related.post-card--thumbnail-no:hover, .spoiler-box, .btn-primary, .btn-primary:hover, .btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle, .inp:focus, .entry-tag:focus, .entry-tag:hover, .search-screen .search-form .search-field:focus, .entry-content ul:not([class])>li:before, .text-content ul:not([class])>li:before, .page-content ul:not([class])>li:before, .taxonomy-description ul:not([class])>li:before, .entry-content blockquote,
        .input:focus, input[type=color]:focus, input[type=date]:focus, input[type=datetime-local]:focus, input[type=datetime]:focus, input[type=email]:focus, input[type=month]:focus, input[type=number]:focus, input[type=password]:focus, input[type=range]:focus, input[type=search]:focus, input[type=tel]:focus, input[type=text]:focus, input[type=time]:focus, input[type=url]:focus, input[type=week]:focus, select:focus, textarea:focus',
        [ 'border-color:%s !important', 'colors_main' ]
    );

    $class_customizer_css->add(
        '.post-card--small .post-card__category, .post-card__author:before, .post-card__comments:before, .post-card__date:before, .post-card__like:before, .post-card__views:before, .entry-author:before, .entry-date:before, .entry-time:before, .entry-views:before, .entry-content ol:not([class])>li:before, .text-content ol:not([class])>li:before, .entry-content blockquote:before, .spoiler-box__title:after, .search-icon:hover:before, .search-form .search-submit:hover:before, .star-rating-item.hover,
        .comment-list .bypostauthor>.comment-body .comment-author:after,
        .breadcrumb a, .breadcrumb span,
        .search-screen .search-form .search-submit:before, 
        .star-rating--score-1:not(.hover) .star-rating-item:nth-child(1),
        .star-rating--score-2:not(.hover) .star-rating-item:nth-child(1), .star-rating--score-2:not(.hover) .star-rating-item:nth-child(2),
        .star-rating--score-3:not(.hover) .star-rating-item:nth-child(1), .star-rating--score-3:not(.hover) .star-rating-item:nth-child(2), .star-rating--score-3:not(.hover) .star-rating-item:nth-child(3),
        .star-rating--score-4:not(.hover) .star-rating-item:nth-child(1), .star-rating--score-4:not(.hover) .star-rating-item:nth-child(2), .star-rating--score-4:not(.hover) .star-rating-item:nth-child(3), .star-rating--score-4:not(.hover) .star-rating-item:nth-child(4),
        .star-rating--score-5:not(.hover) .star-rating-item:nth-child(1), .star-rating--score-5:not(.hover) .star-rating-item:nth-child(2), .star-rating--score-5:not(.hover) .star-rating-item:nth-child(3), .star-rating--score-5:not(.hover) .star-rating-item:nth-child(4), .star-rating--score-5:not(.hover) .star-rating-item:nth-child(5)',
        [ 'color:%s', 'colors_main' ]
    );

    $class_customizer_css->add(
        '.entry-content a:not(.wp-block-button__link), .entry-content a:not(.wp-block-button__link):visited, .spanlink, .comment-reply-link, .pseudo-link, .widget_calendar a, .widget_recent_comments a, .child-categories ul li a',
        [ 'color:%s', 'colors_link' ]
    );

    $class_customizer_css->add(
        '.child-categories ul li a',
        [ 'border-color:%s', 'colors_link' ]
    );

    $class_customizer_css->add(
        'a:hover, a:focus, a:active, .spanlink:hover, .entry-content a:not(.wp-block-button__link):hover, .entry-content a:not(.wp-block-button__link):focus, .entry-content a:not(.wp-block-button__link):active, .top-menu ul li>span:hover, .main-navigation ul li a:hover, .main-navigation ul li span:hover, .footer-navigation ul li a:hover, .footer-navigation ul li span:hover, .comment-reply-link:hover, .pseudo-link:hover, .child-categories ul li a:hover',
        [ 'color:%s', 'colors_link_hover' ]
    );

    $class_customizer_css->add(
        '.top-menu>ul>li>a:before, .top-menu>ul>li>span:before',
        [ 'background:%s', 'colors_link_hover' ]
    );

    $class_customizer_css->add(
        '.child-categories ul li a:hover, .post-box--no-thumb a:hover',
        [ 'border-color:%s', 'colors_link_hover' ]
    );

    $class_customizer_css->add(
        '.post-box--card:hover',
        [ 'box-shadow: inset 0 0 0 1px %s', 'colors_link_hover' ]
    );

    $class_customizer_css->add(
        '.post-box--card:hover',
        [ '-webkit-box-shadow: inset 0 0 0 1px %s', 'colors_link_hover' ]
    );

    $class_customizer_css->add(
        '.site-content',
        [ 'background-color:%s', 'colors_content_bg' ]
    );

    $class_customizer_css->add(
        'body.custom-background',
        [ 'background-image: url("%s")', 'body_bg' ],
        '(min-width: 768px)'
    );

    $class_customizer_css->add(
        'body.custom-background',
        [ 'background-repeat:%s', 'body_bg_repeat' ],
        '(min-width: 768px)'
    );

    $class_customizer_css->add(
        'body.custom-background',
        [ 'background-position:%s', 'body_bg_position' ],
        '(min-width: 768px)'
    );

    $class_customizer_css->add(
        'body.custom-background',
        [ 'background-size:%s', 'body_bg_size' ],
        '(min-width: 768px)'
    );

    $wpshop_body_bg_scroll = $wpshop_core->get_option( 'body_bg_scroll' );
    if ( ! $wpshop_body_bg_scroll ) {
        $class_customizer_css->add(
            'body.custom-background',
            [ 'background-attachment: fixed', '' ],
            '(min-width: 768px)'
        );
    }


    // colors and background  >  header
    $class_customizer_css->add(
        '.site-header, .site-header a, .site-header .pseudo-link',
        [ 'color:%s', 'colors_header' ]
    );

    $class_customizer_css->add(
        '.humburger span, .top-menu>ul>li>a:before, .top-menu>ul>li>span:before',
        [ 'background:%s', 'colors_header' ]
    );

    $class_customizer_css->add(
        '.site-header',
        [ 'background-color:%s', 'colors_header_bg' ]
    );

    $class_customizer_css->add(
        '.top-menu ul li .sub-menu',
        [ 'background-color:%s', 'colors_header_bg' ],
        '(min-width: 992px)'
    );

    $class_customizer_css->add(
        '.site-title, .site-title a',
        [ 'color:%s', 'colors_header_site_title' ]
    );

    $class_customizer_css->add(
        '.site-description',
        [ 'color:%s', 'colors_header_site_description' ]
    );

    if ( $wpshop_core->get_option( 'header_bg_mob' ) == 'yes' ) {
        $class_customizer_css->add(
            '.site-header',
            [ 'background-image: url("%s")', 'header_bg' ]
        );

        $class_customizer_css->add(
            '.site-header',
            [ 'background-repeat:%s', 'header_bg_repeat' ]
        );

        $class_customizer_css->add(
            '.site-header',
            [ 'background-position:%s', 'header_bg_position' ]
        );

        $class_customizer_css->add(
            '.site-header',
            [ 'background-size: cover', '' ],
            '(max-width: 767px)'
        );
    } else {
        $class_customizer_css->add(
            '.site-header',
            [ 'background-image: url("%s")', 'header_bg' ],
            '(min-width: 768px)'
        );

        $class_customizer_css->add(
            '.site-header',
            [ 'background-repeat:%s', 'header_bg_repeat' ],
            '(min-width: 768px)'
        );

        $class_customizer_css->add(
            '.site-header',
            [ 'background-position:%s', 'header_bg_position' ],
            '(min-width: 768px)'
        );
    }


    // colors and background  >  menu
    $class_customizer_css->add(
        '.main-navigation, .footer-navigation, .footer-navigation .removed-link, .main-navigation .removed-link, .main-navigation ul li>a, .footer-navigation ul li>a',
        [ 'color:%s', 'colors_menu' ]
    );
    $class_customizer_css->add(
        '.main-navigation, .main-navigation ul li .sub-menu li, .main-navigation ul li.menu-item-has-children:before, .footer-navigation, .footer-navigation ul li .sub-menu li, .footer-navigation ul li.menu-item-has-children:before',
        [ 'background-color:%s', 'colors_menu_bg' ]
    );


    // colors and background  >  footer
    $class_customizer_css->add(
        '.site-footer, .site-footer a, .site-footer .pseudo-link',
        [ 'color:%s', 'colors_footer' ]
    );

    $class_customizer_css->add(
        '.site-footer',
        [ 'background-color:%s', 'colors_footer_bg' ]
    );


    // typography  >  general
    $class_customizer_css->add(
        'body',
        [ 'typography', 'typography_body' ]
    );


    // typography  >  header
    $class_customizer_css->add(
        '.site-title, .site-title a',
        [ 'typography', 'typography_site_title' ]
    );

    $class_customizer_css->add(
        '.site-description',
        [ 'typography', 'typography_site_description' ]
    );


    // typography  >  menu
    $class_customizer_css->add(
        '.main-navigation ul li a, .main-navigation ul li span, .footer-navigation ul li a, .footer-navigation ul li span',
        [ 'typography', 'typography_menu_links' ]
    );


    // typography > headers
    $class_customizer_css->add(
        '.h1, h1:not(.site-title)',
        [ 'typography', 'typography_header_h1' ]
    );

    $class_customizer_css->add(
        '.h2, .related-posts__header, .section-block__title, h2',
        [ 'typography', 'typography_header_h2' ]
    );

    $class_customizer_css->add(
        '.h3, h3',
        [ 'typography', 'typography_header_h3' ]
    );

    $class_customizer_css->add(
        '.h4, h4',
        [ 'typography', 'typography_header_h4' ]
    );

    $class_customizer_css->add(
        '.h5, h5',
        [ 'typography', 'typography_header_h5' ]
    );

    $class_customizer_css->add(
        '.h6, h6',
        [ 'typography', 'typography_header_h6' ]
    );


    // tweak
    $class_customizer_css->add(
        '.site-logotype',
        [ 'max-width:%dpx', 'logotype_max_width' ]
    );

    $class_customizer_css->add(
        '.site-logotype img',
        [ 'max-height:%dpx', 'logotype_max_height' ]
    );


    // tweak disable footer sticky
    if ( $wpshop_core->get_option( 'footer_sticky_disable' ) ) {
        $class_customizer_css->add(
            'body',
            [ 'margin-bottom: 0', '' ]
        );
    }


    // pattern
    $class_customizer_css->add(
        'body',
        [ 'background-image:url(' . get_bloginfo('template_url') . '/assets/images/backgrounds/%s)', 'bg_pattern' ]
    );


    // sidebar on mobile
    if ( $wpshop_core->get_option( 'sidebar_mob' ) == 'yes' ) {
        $class_customizer_css->add(
            '.widget-area',
            [ 'display: block; margin: 0 auto' ],
            '(max-width: 991px)'
        );
    }


    // footer menu on mobile
    if ( $wpshop_core->get_option( 'footer_menu_mob' ) == 'yes' ) {
        $class_customizer_css->add(
            '.footer-navigation',
            [ 'display: block', '' ],
            '(max-width: 991px)'
        );
    }


    $output = $class_customizer_css->output();
    if ( ! empty( $output ) ) {
        echo PHP_EOL . '    <style>' . $output . '</style>'.PHP_EOL;
    }

}
add_action( 'wp_head', 'wpshop_customizer_css', 10 );