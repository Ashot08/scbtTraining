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

$access = ['5.166.80.28'];
$ip =  $_SERVER['REMOTE_ADDR'];

if(!in_array($ip, $access)){
   echo '<pre>';
   print_r($ip);
   print_r(' На сайте ведутся работы, зайдите позже');
   echo '</pre>';
   wp_die();
}




?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
    <?php $wpshop_core->the_option( 'code_head' ) ?>
    <script type='text/javascript'>
        /* <![CDATA[ */
        var ajaxUrl = {"url":`https://${window.location.hostname}/wp-admin/admin-ajax.php`};
        /* ]]> */
    </script>
    <?php

//    $user_info = get_userdata(get_current_user_id());
//    if(!$user_info->caps["customer_company"]):?>
<!---->
<!--    --><?php //endif; ?>


<!--    --><?php //if(!is_user_logged_in() && is_page(154)): ?>
<!--        <script>-->
<!--            window.location.href = '/';-->
<!--        </script>-->
<!--    --><?php //endif; ?>


</head>

<body <?php body_class(); ?>>





<div class="scbt__course_structure_sidebar">
    <div class="scbt__course_structure_toggle scbt__course_structure_close">
        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
            <path fill="currentColor" d="M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2C6.47,2 2,6.47 2,12C2,17.53 6.47,22 12,22C17.53,22 22,17.53 22,12C22,6.47 17.53,2 12,2M14.59,8L12,10.59L9.41,8L8,9.41L10.59,12L8,14.59L9.41,16L12,13.41L14.59,16L16,14.59L13.41,12L16,9.41L14.59,8Z" />
        </svg>
    </div>



    <?php $categorySlug = get_query_var('wpm-category', null); ?>
    <?php $category = $categorySlug ? get_term_by('slug', $categorySlug, 'wpm-category') : null; ?>
    <?php $category = $category ? new MBLCategory($category) : null; ?>
    <?php if($category): ?>
        <?php $category = $category->getWpCategory()->term_id;?>
    <?php endif; ?>


        <?php



        //$lesson_id = get_queried_object()->ID;
        $lesson_term_id = $category;

        $user_info = get_userdata(get_current_user_id());
        $is_company = false;
        if (is_user_logged_in() && isset($user_info->caps["customer_company"])) {
            $is_company = true;
        }

        if($lesson_term_id){
            $term_id = null;
            if($lesson_term_id){
                $term_id = $lesson_term_id; // ID дочернего термина
            }

            while( $parent_id = wp_get_term_taxonomy_parent_id( $term_id, 'wpm-category' ) ){
                $term_id = $parent_id;
            }

            $parent_name = get_term($term_id)->name;


            $model = new \Models\Program();
            $courseModel = new \Models\Course();

            $courses_enrolled = [];
            if($is_company){
                $programs_enrolled = $model->getProgramsByDirectorId(get_current_user_id());
                foreach ($programs_enrolled as $program) {
                    $program_courses = $courseModel->getCoursesByProgramId($program->id);
                    if(is_array($program_courses)){
                        foreach ($program_courses as $course){
                            $courses_enrolled[] = $course->course_id;
                        }
                    }
                }
            }else{
                $programs_enrolled = $model->getProgramsByStudentId(get_current_user_id());
                foreach ($programs_enrolled as $program) {
                    $program_courses = $courseModel->getCoursesByProgramId($program->program_id);
                    if(is_array($program_courses)){
                        foreach ($program_courses as $course){
                            $courses_enrolled[] = $course->course_id;
                        }
                    }
                }
            }


            $current_cat_id = get_queried_object()->term_id;
            if(!$current_cat_id){
                $post_terms = wp_get_post_terms( get_queried_object()->ID, 'wpm-category');
                $current_cat_children = get_term_children( $category, 'wpm-category' );
                $current_cat_children = $current_cat_children ? $current_cat_children : [];
                if(!$current_cat_children){
                    $current_cat_children[] = $category;
                }
                foreach ($post_terms as $term){
                    if( in_array($term->term_id, $current_cat_children) ){
                        $current_cat_id = $term->term_id;
                    }
                }
            }


            $args = [
                'taxonomy'      => [ 'wpm-category' ], // название таксономии с WP 4.5
    //            'orderby'       => 'id',
                'order'         => 'ASC',
                'hide_empty'    => true,
                'hierarchical'  => true,
                'child_of'      => $term_id,
            ];
            $terms = get_terms('wpm-category', $args);

            $categoryHierarchy = array();
            sort_terms_hierarchically($terms, $categoryHierarchy, $term_id );
            ?>
    <?php
        }

        echo '<h3>';
        echo $parent_name;
        echo '</h3>';
        renderCourseStructure($categoryHierarchy, $courses_enrolled, $current_cat_id);
    ?>



    <?php

    function renderCourseStructure($terms, $terms_ids, $current_cat_id){
        if($terms):?>

            <ul>
                <?php foreach ($terms as $term): ?>
                    <?php
                    $is_open = in_array($term->term_id, $terms_ids);
                    $is_current = $term->term_id === $current_cat_id;
                    $has_children = $term->children;
                    ?>
                
                    <li class="<?php echo $is_open ? 'cd__list_item_open' : 'cd__list_item_not_open'; ?>
                       <?php echo $has_children ? 'cd__list_has_children' : 'cd__list_has_not_children';?>
                       <?php echo $is_current ? 'cd__list_current_cat' : '';?>
                    ">

                        <?php if($is_open): ?>

                            <div class="cd__program_hierarchy_list_item_wrapper">
                                <a href="<?= get_term_link($term->term_id); ?>">
                                    <span><?= $term->name ?></span>
                                </a>
                            </div>

                        <?php else: ?>

                            <div class="cd__program_hierarchy_list_item_wrapper">
                                <span><?= $term->name ?></span>
                                <svg style="width:14px;height:14px" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M12,17C10.89,17 10,16.1 10,15C10,13.89 10.89,13 12,13A2,2 0 0,1 14,15A2,2 0 0,1 12,17M18,20V10H6V20H18M18,8A2,2 0 0,1 20,10V20A2,2 0 0,1 18,22H6C4.89,22 4,21.1 4,20V10C4,8.89 4.89,8 6,8H7V6A5,5 0 0,1 12,1A5,5 0 0,1 17,6V8H18M12,3A3,3 0 0,0 9,6V8H15V6A3,3 0 0,0 12,3Z" />
                                </svg>
                            </div>

                        <?php endif; ?>
                        <?php if($has_children): ?>
                            <?php renderCourseStructure($term->children, $terms_ids, $current_cat_id) ?>
                        <?php endif; ?>
                    </li>
                <?php endforeach;?>
            </ul>

        <?php endif;
    }

    ?>


</div>

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


