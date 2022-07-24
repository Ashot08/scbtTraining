<?php
/**
 * Child theme of Reboot
 * https://wpshop.ru/themes/reboot
 *
 * @package Reboot
 */

/**
 * Enqueue child styles
 *
 * НЕ УДАЛЯЙТЕ ДАННЫЙ КОД
 */
add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_styles', 100);
function enqueue_child_theme_styles() {
    wp_enqueue_style( 'reboot-style-child', get_stylesheet_uri(), array( 'reboot-style' )  );
}

/**
 * НИЖЕ ВЫ МОЖЕТЕ ДОБАВИТЬ ЛЮБОЙ СВОЙ КОД
 */
//$userdata = [
//    'user_login' => 'name ' . random_int(50, 10000),
//    'user_pass'  => '123',
//    'user_email' => 'name ' . random_int(50, 10000) . '@ya.ru',
//    'role'       => 'customer',
//    'first_name' => 'Name ' . random_int(50, 10000),
//     'user_activation_key' => 'WsmF40L8pQicr4y4Yk4jo6HlOd1Rt95ZwxqIeXDb1G2Ch0avJufU3Bn6NA8KTgPz59S7EV1M',
//];
//$user_id = wp_insert_user( $userdata );

//$new_user = new MBLSubscription($user_id, 7);
//$new_user->addUser();
//wpm_add_key_to_user($user_id,'WsmF40L8pQicr4y4Yk4jo6HlOd1Rt95ZwxqIeXDb1G2Ch0avJufU3Bn6NA8KTgPz59S7EV1M');



/**
 ****User Ajax Register********************************************************************
 */
add_action('wp_ajax_new_user_registration', 'new_user_registration');
add_action('wp_ajax_nopriv_new_user_registration', 'new_user_registration');
function new_user_registration(){
    function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL)
            && preg_match('/@.+\./', $email);
    }

    // Проверим защитные поля
    //if( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'vb_new_user' ) ){
    //	die( 'Оооопс, попробуйте еще раз, но чуть позже.' );
    //}

    // Данные переданные в $_POST
    $userdata = [
        'user_login' => $_POST['userName'],
        'user_pass'  => $_POST['userPassword'],
        'user_email' => $_POST['userEmail'],
        'role'       => $_POST['userRole'],
        'first_name' => $_POST['first_name'],
        'user_snils' => $_POST['user_snils'],
    ];

    /**
     * Проверять/очищать передаваемые поля не обязательно,
     * WP сделает это сам.
     */
    $is_valid_email = isValidEmail($_POST['userEmail']);
    $accept = $_POST['accept'];

    if($accept === 'false'){
        echo '<div class="scbt__notice_error">Вы не дали согласие на обратоку персональных данных</div>';
    }elseif($is_valid_email){
        $user_id = wp_insert_user( $userdata );
        if( ! is_wp_error( $user_id ) ){

            update_user_meta($user_id, 'billing_phone', $_POST['billing_phone']);

            update_user_meta($user_id, 'user_company_name', $_POST['user_company_name']);
            update_user_meta($user_id, 'user_inn', $_POST['user_inn']);
            update_user_meta($user_id, 'user_position', $_POST['user_position']);
            update_user_meta($user_id, 'user_snils', $userdata['user_snils']);

            $creds = array();
            $creds['user_login'] = $userdata['user_login'];
            $creds['user_password'] = $userdata['user_pass'];
            $creds['remember'] = true;

            $user = wp_signon( $creds, false );

            echo '<div class="scbt__notice_success">Вы успешно зарегистрированы. <a href="/account" >Перейти в личный кабинет</a></div>';
        }
        else {
            echo '<div class="scbt__notice_error">' . $user_id->get_error_message() . '</div>';
        }
    }else{
        echo '<div class="scbt__notice_error">Поле E-mail заполнено некорректно.</div>';
    }


    // возврат


    wp_die();
}

/**
 *************************************************************************************
 */

add_shortcode( 'materials_1', 'render_materials_1_shortcode' );

function render_materials_1_shortcode(){
    get_template_part('materials_1');
}
