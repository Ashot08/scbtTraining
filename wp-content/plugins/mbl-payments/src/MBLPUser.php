<?php

class MBLPUser
{
    /**
     * MBLPUser constructor.
     */
    public function __construct()
    {
        $this->_setHooks();
    }

    private function _setHooks()
    {
        add_action('woocommerce_register_post', array($this, 'newCustomerData'), 20, 3);
        add_action('woocommerce_created_customer', array($this, 'newCustomerCreated'), 20, 3);
    }

    /**
     * @param $username
     * @param $email
     * @param WP_Error $errors
     * @return bool
     */
    public function newCustomerData($username, $email, $errors)
    {
        if (wpm_is_users_overflow()) {
            $errors->add(403, __('Регистрация временно недоступна', 'mbl'));
        }
    }

    public function newCustomerCreated($customerId, $data, $password)
    {
        $checkoutData = WC()->checkout()->get_posted_data();
        $mblData = array(
            'last_name'  => wpm_array_get($data, 'last_name'),
            'first_name' => wpm_array_get($data, 'first_name'),
            'patronymic' => wpm_array_get($checkoutData, 'patronymic', ''),
            'surname'    => wpm_array_get($checkoutData, 'patronymic', ''),
            'email'      => wpm_array_get($data, 'user_email'),
            'phone'      => wpm_array_get($checkoutData, 'billing_phone'),
            'login'      => wpm_array_get($data, 'user_login'),
            'pass'       => wpm_array_get($data, 'user_pass'),
        );

        wpm_register_user(array(
            'user_id' => $customerId,
            'user_data' => $mblData,
            'index' => null,
            'send_email' => true
        ));
    }
}