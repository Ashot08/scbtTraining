<?php

//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);


wp_enqueue_script( 'transist', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.transit/0.9.12/jquery.transit.min.js' , array('jquery'));
wp_enqueue_script( 'script', plugins_url( '/courses_dashboard_2/js/script.js' ), array('jquery'));
wp_enqueue_script( 'courses_dashboard_ajax', plugins_url( '/courses_dashboard_2/ajax/ajax.js' ), array('jquery'));
wp_enqueue_script( 'treeview', plugins_url( '/courses_dashboard_2/libs/treeview/jquery.treeview.js' ), array('jquery'));


wp_enqueue_style('courses_dashboard_css', plugins_url('/courses_dashboard_2/css/style.css'));
wp_enqueue_style('treeview_css', plugins_url('/courses_dashboard_2/libs/treeview/jquery.treeview.css'));



require_once __DIR__ . '/classes/WP_Term_Image.php';
add_action( 'admin_init', '\\Kama\\WP_Term_Image::init' );

use Controllers\AccessController;

require_once __DIR__ . '/controllers/ProgramController.php';
require_once __DIR__ . '/controllers/StudentController.php';
require_once __DIR__ . '/controllers/KeyController.php';
require_once __DIR__ . '/controllers/AccessController.php';
require_once __DIR__ . '/controllers/ProfileController.php';
require_once __DIR__ . '/models/Program.php';
require_once __DIR__ . '/models/Key.php';
require_once __DIR__ . '/models/Student.php';
require_once __DIR__ . '/models/Course.php';
require_once __DIR__ . '/models/Director.php';
require_once __DIR__ . '/ajax/ajax.php';
require_once __DIR__ . '/libs/vendor/autoload.php';

// Подключаем скрипту courses_dashboard_ajax атрибут type="module"
//--------------------------------------------------------------------
add_filter('script_loader_tag', 'add_type_attribute' , 10, 3);

function add_type_attribute($tag, $handle, $src) {
    // if not your script, do nothing and return original $tag
    if ( 'courses_dashboard_ajax' !== $handle ) {
        return $tag;
    }
    // change the script tag by adding type="module" and return it.
    $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
    return $tag;
}
//--------------------------------------------------------------------


// Кастомные поля для курсов
//--------------------------------------------------------------------
add_action( 'wpm-category_add_form_fields', 'true_add_cat_fields' );

function true_add_cat_fields( $taxonomy ) {

    echo '<div style="padding: 10px;background-color: #fff;border: 1px solid #d2f3f4;">
    <h4>
        Возможность выбрать при создании Программы:
    </h4>    
    <input type="radio" checked id="cd__course_input_status_1"
     name="cd__course_input_status" value="1">
    <label for="cd__course_input_status_1">Стандартное поведение</label>

    <input type="radio" id="cd__course_input_status_2"
     name="cd__course_input_status" value="2">
    <label for="cd__course_input_status_2">Всегда выбран</label>

    <input type="radio" id="cd__course_input_status_3"
     name="cd__course_input_status" value="3">
    <label for="cd__course_input_status_3">Нет возможности выбирать (наследует от родителя)</label></div>';

    echo '<div style="padding: 10px;background-color: #fff;border: 1px solid #d2f3f4;margin: 20px 0;">
    <h4>
        Нагрузка в часах:
    </h4>    
    <input type="number" checked id="cd__course_input_hours"
     name="cd__course_input_hours" >
    <label for="cd__course_input_hours">Сколько времени требуется для прохождения курса</label>
    </div>';
}

add_action( 'wpm-category_edit_form_fields', 'true_edit_term_fields', 10, 2 );

function true_edit_term_fields( $term, $taxonomy ) {

    // сначала получаем значения этих полей
    // заголовок
    $cd__course_input_status = get_term_meta( $term->term_id, 'cd__course_input_status', true );
    $cd__course_input_status_1 = '';
    $cd__course_input_status_2 = '';
    $cd__course_input_status_3 = '';
    if($cd__course_input_status === '1') $cd__course_input_status_1 = 'checked';
    if($cd__course_input_status === '2') $cd__course_input_status_2 = 'checked';
    if($cd__course_input_status === '3') $cd__course_input_status_3 = 'checked';

    $cd__course_input_hours = get_term_meta( $term->term_id, 'cd__course_input_hours', true );

    echo '<div style="padding: 10px;background-color: #fff;border: 1px solid #d2f3f4;">
    <h4>
        Возможность выбрать при создании Программы:
    </h4>    
    <input type="radio" ' . $cd__course_input_status_1 . ' id="cd__course_input_status_1"
     name="cd__course_input_status" value="1">
    <label for="cd__course_input_status_1">Стандартное поведение</label>

    <input type="radio" ' . $cd__course_input_status_2 . ' id="cd__course_input_status_2"
     name="cd__course_input_status" value="2">
    <label for="cd__course_input_status_2">Всегда выбран</label>

    <input type="radio" ' . $cd__course_input_status_3 . ' id="cd__course_input_status_3"
     name="cd__course_input_status" value="3">
    <label for="cd__course_input_status_3">Нет возможности выбирать (наследует от родителя)</label></div>';


    echo '<div style="padding: 10px;background-color: #fff;border: 1px solid #d2f3f4;margin: 20px 0;">
    <h4>
        Нагрузка в часах:
    </h4>    
    <input type="number" checked id="cd__course" value="' .  $cd__course_input_hours . '" name="cd__course_input_hours">
    <label for="cd__course_input_hours">Сколько времени требуется для прохождения курса</label>
    </div>';
}

add_action( 'created_wpm-category', 'true_save_term_fields' );
add_action( 'edited_wpm-category', 'true_save_term_fields' );

function true_save_term_fields( $term_id ) {
    if( isset( $_POST[ 'cd__course_input_status' ] ) ) {
        update_term_meta( $term_id, 'cd__course_input_status', $_POST[ 'cd__course_input_status' ] );
    } else {
        delete_term_meta( $term_id, 'cd__course_input_status' );
    }


    if( isset( $_POST[ 'cd__course_input_hours' ] ) ) {
        update_term_meta( $term_id, 'cd__course_input_hours', $_POST[ 'cd__course_input_hours' ] );
    } else {
        delete_term_meta( $term_id, 'cd__course_input_hours' );
    }
}


//--------------------------------------------------------------------





