<?php

function mblp_include_partial($view, $domain = 'public')
{
    MBLPView::includePartial($view, $domain);
}

function mblp_render_partial($view, $domain = 'public', $variables = array(), $return = false)
{
    $result = MBLPView::getPartial($view, $domain, $variables);

    if ($return) {
        return $result;
    } else {
        echo $result;
    }
}

function mblp_add_mbl_product_type()
{
    include_once(MBLP_DIR . '/src/WC_Product_MBL.php');
}

function mblp_add_ipr_product_type()
{
    include_once(MBLP_DIR . '/src/WC_Product_IPR.php');
}

function mblp_checkout_form_field($key, $args, $value = null)
{
    return MBLPCheckout::formField($key, $args, $value);
}

function mblp_remove_notices()
{
}

function mblp_update_option($key, $value)
{
    $main_options = get_option('wpm_main_options');

    if(!isset($main_options) || !is_array($main_options)) {
        $main_options = array();
    }

    update_option('wpm_main_options', wpm_array_set($main_options, $key, $value));
}

//Redefinition WooCommerce function for new incorrect user alert message
if ( ! function_exists( 'wc_create_new_customer' ) ) {
	function wc_create_new_customer($email, $username = '', $password = '', $args = array())
	{
		//echo $_POST['try_to_login'];
		//return new WP_Error('registration-error-invalid-email', __('Please provide a valid email address.', 'woocommerce'));
		
		if( isset($_POST['try_to_login']) && $_POST['try_to_login'] == 'yes') {
			return apply_filters('try_to_login_exist_user', [
				'username' => $username,
				'password' => $password
			]);
		}
		
		if (empty($email) || !is_email($email)) {
			return new WP_Error('registration-error-invalid-email', __('Please provide a valid email address.', 'woocommerce'));
		}

		if (email_exists($email)) {
			return new WP_Error('registration-error-email-exists', apply_filters('woocommerce_registration_error_email_exists', __('An account is already registered with your email address. Please log in.', 'woocommerce'), $email));
		}

		if ('yes' === get_option('woocommerce_registration_generate_username', 'yes') && empty($username)) {
			$username = wc_create_new_customer_username($email, $args);
		}

		$username = sanitize_user($username);

		if (empty($username) || !validate_username($username)) {
			return new WP_Error('registration-error-invalid-username', wpm_get_option('mblp_texts.error_login', __('Некорректный логин. Для логина разрешены только буквы латинского алфавита и цифры', 'mbl_admin')));
		}

		if (username_exists($username)) {
			return new WP_Error('registration-error-username-exists', __('An account is already registered with that username. Please choose another.', 'woocommerce'));
		}

		// Handle password creation.
		$password_generated = false;
		if ('yes' === get_option('woocommerce_registration_generate_password') && empty($password)) {
			$password = wp_generate_password();
			$password_generated = true;
		}

		if (empty($password)) {
			return new WP_Error('registration-error-missing-password', __('Please enter an account password.', 'woocommerce'));
		}

		// Use WP_Error to handle registration errors.
		$errors = new WP_Error();

		do_action('woocommerce_register_post', $username, $email, $errors);

		$errors = apply_filters('woocommerce_registration_errors', $errors, $username, $email);

		if ($errors->get_error_code()) {
			return $errors;
		}

		$new_customer_data = apply_filters(
			'woocommerce_new_customer_data',
			array_merge(
				$args,
				array(
					'user_login' => $username,
					'user_pass' => $password,
					'user_email' => $email,
					'role' => 'customer',
				)
			)
		);

		$customer_id = wp_insert_user($new_customer_data);

		if (is_wp_error($customer_id)) {
			return $customer_id;
		}

		do_action('woocommerce_created_customer', $customer_id, $new_customer_data, $password_generated);

		return $customer_id;
	}
}


