<?php

class MBLPMail
{
    private static $_variables = null;

    /**
     * MBLPMail constructor.
     */
    public function __construct()
    {
        $this->_setHooks();
    }

    private function _setHooks()
    {
        add_action('mblp_send_order_product_emails', [$this, 'sendOrderProductEmails'], 10, 3);
    }

    public static function getVars($only = null)
    {
        self::initVars();

        return $only === null
            ? self::$_variables
            : array_intersect_key(self::$_variables, array_flip($only));
    }

    public static function getClientVars()
    {
        return self::getVars([
            'user_name',
            'user_surname',
            'user_patronymic',
            'user_email',
            'user_phone',
            'user_login',
            'user_password',
            'user_comment',
            'user_key',
            'user_key_link',
        ]);
    }

    public static function getOrderVars()
    {
        return self::getVars([
            'order_number',
            'product_name',
            'payment_date',
            'payment_time',
            'payment_type',
            'product_price',
            'payment_currency',
            'access_time',
            'start_page',
        ]);
    }

    public static function initVars()
    {
        if (self::$_variables === null) {
            self::$_variables = [
                'user_name'        => __('Имя пользователя', 'mbl_admin'),
                'user_surname'     => __('Фамилия пользователя', 'mbl_admin'),
                'user_patronymic'  => __('Отчество пользователя', 'mbl_admin'),
                'user_email'       => __('Email', 'mbl_admin'),
                'user_phone'       => __('Телефон', 'mbl_admin'),
                'user_login'       => __('Логин', 'mbl_admin'),
                'user_comment'     => __('Комментарий к заказу', 'mbl_admin'),
                'user_key'         => __('Пин-код', 'mbl_admin'),
                'user_key_link'    => __('Пин-код со ссылкой', 'mbl_admin'),
                'order_number'     => __('Номер заказа', 'mbl_admin'),
                'product_name'     => __('Название товара', 'mbl_admin'),
                'payment_date'     => __('Дата оплаты', 'mbl_admin'),
                'payment_time'     => __('Время оплаты', 'mbl_admin'),
                'payment_type'     => __('Способ оплаты', 'mbl_admin'),
                'product_price'    => __('Цена товара', 'mbl_admin'),
                'payment_currency' => __('Валюта оплаты', 'mbl_admin'),
                'access_time'      => __('Время доступа', 'mbl_admin'),
                'start_page'       => __('Страница входа', 'mbl_admin'),
            ];
        }
    }


    /**
     * @param WC_Order $order
     * @param WC_Product_MBL $product
     * @param $code
     *
     * @return array
     */
    public static function getReplacements($order, $product, $code)
    {
        $paymentDateTime = $order->get_date_paid();
        $paymentDate = $paymentDateTime ? $paymentDateTime->date_i18n('d.m.Y') : '';
        $paymentTime = $paymentDateTime ? $paymentDateTime->date_i18n('H:i:s') : '';

        return [
            'user_name'        => $order->get_user()->first_name,
            'user_surname'     => $order->get_user()->last_name,
            'user_patronymic'  => get_user_meta($order->get_user_id(), 'surname', true),
            'user_email'       => $order->get_billing_email(),
            'user_phone'       => $order->get_billing_phone(),
            'user_login'       => $order->get_user()->user_login,
            'user_comment'     => $order->get_customer_note(),
            'user_key'         => $code,
            'user_key_link'    => (wpm_activation_link() . (strpos(wpm_activation_link(), '?') !== false ? '&' : '?') . 'code=' . $code),
            'order_number'     => $order->get_order_number(),
            'product_name'     => $product->getProductName(),
            'payment_date'     => $paymentDate,
            'payment_time'     => $paymentTime,
            'payment_type'     => $order->get_payment_method_title(),
            'product_price'    => html_entity_decode(strip_tags($product->get_price_html())),
            'payment_currency' => $order->get_currency(),
            'access_time'      => $product->getAccessTimeText(),
            'start_page'       => wpm_get_start_url(),
        ];
    }

    /**
     * @param WC_Order $order
     * @param WC_Product_MBL $product
     * @param $code
     *
     * @return bool
     */
    public function sendOrderProductEmails($order, $product, $code)
    {
        if ((!($product instanceof WC_Product_MBL) && !($product instanceof WC_Product_IPR)) || !($order instanceof WC_Order)) {
            return false;
        }

        $result = false;

        $adminEmail = wpm_get_option('letters.mblp.admin.email', get_option('admin_email'));

        MBLMail::fromDB('mblp.admin', $adminEmail, self::getReplacements($order, $product, $code));

        $hasCustomClientMail = is_callable([$product, 'get_mblp_is_custom_letter']) ? $product->get_mblp_is_custom_letter() : false;
        $clientMailTitle = is_callable([$product, 'get_mblp_letter_title']) ? $product->get_mblp_letter_title() : '';
        $clientMailContent = is_callable([$product, 'get_mblp_letter']) ? $product->get_mblp_letter() : '';

        if ($hasCustomClientMail) {
            $options = [
                'enabled' => 'on',
                'title'   => $clientMailTitle,
                'content' => $clientMailContent
            ];
            MBLMail::fromDB($options, $order->get_billing_email(), self::getReplacements($order, $product, $code));
        } else {
            MBLMail::fromDB('mblp.clients', $order->get_billing_email(), self::getReplacements($order, $product, $code));
        }

        return $result;
    }
}