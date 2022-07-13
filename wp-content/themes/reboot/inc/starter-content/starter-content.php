<?php

//update_option('fresh_site', 0);

add_action( 'after_setup_theme', function () {
    add_theme_support( 'starter-content', [

        'posts' => [
//            'about',
            'contact' => [
                'post_type' => 'page',
                'post_title' => 'Обратная связь',
                'post_content' => '<p>В теме есть встроенная форма обратной связи:</p>[contactform]',
            ],
            'sitemap' => [
                'post_type' => 'page',
                'post_title' => 'Карта сайта',
                'post_content' => '[htmlsitemap]',
            ],
//            'post-1' => [
//                'post_type' => 'post',
//                'post_title' => 'Какие встроенные модули есть в нашей теме',
//                'thumbnail' => '{{featured-image-logo}}',
//            ],
//            'post-2' => [
//                'post_type' => 'post',
//                'post_title' => 'Какие встроенные модули есть в нашей теме',
//                'thumbnail' => '{{featured-image-logo}}',
//	            'post_content' => join( '', [
//		            '<p><strong>' . _x( 'Проверка', 'Theme starter content' ) . '</strong><br />',
//		            _x( '123 Main Street', 'Theme starter content' ) . '<br />' . _x( 'New York, NY 10001', 'Theme starter content' ) . '</p>',
//		            '<p><strong>' . _x( 'Hours', 'Theme starter content' ) . '</strong><br />',
//		            _x( 'Monday&mdash;Friday: 9:00AM&ndash;5:00PM', 'Theme starter content' ) . '<br />' . _x( 'Saturday &amp; Sunday: 11:00AM&ndash;3:00PM', 'Theme starter content' ) . '</p>'
//	            ] ),
//            ],
        ],

        // Add pages to primary navigation menu
        'nav_menus' => [
            'header' => [
                'name' => __( 'Primary Navigation', THEME_TEXTDOMAIN ),
                'items' => [
                    'link_home',
//                    'page_about',
                    'page_contact',
                    'page_sitemap' => array(
                        'type' => 'post_type',
                        'object' => 'post',
                        'object_id' => '{{sitemap}}',
                    ),
                ],
            ],
        ],

        // Add test widgets to footer sidebar
        'widgets' => [
            'sidebar-1' => [
                'search',
                'text_about',
            ],
        ],


//        'attachments' => [
//	        'image-espresso' => array(
//		        'post_title' => _x( 'Espresso', 'Theme starter content', 'twentyseventeen' ),
//		        'file' => 'assets/images/espresso.jpg',
//	        ),
//        ],

    ]);
} );