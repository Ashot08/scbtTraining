<?php

class MBLPCore
{
    private static $_defaultOptions = [
        'mblp_design' => [
            'cart'            => [
                'color'         => '868686',
                'hover_color'   => '2E2E2E',
                'active_color'  => '2E2E2E',
                'numbers_bg'    => 'DD3D31',
                'numbers_color' => 'FFFFFF',
            ],
            'buttons'         => [
                'order_btn_color'        => 'FFFFFF',
                'order_btn_hover_color'  => 'FFFFFF',
                'order_btn_active_color' => 'FFFFFF',
                'order_btn_bg'           => 'A0B0A1',
                'order_btn_hover_bg'     => 'ADBEAD',
                'order_btn_active_bg'    => '8E9F8F',
                'order_total_disable'    => 'off',
                'order_total_color'      => '868686',
                'order_total_sum_color'  => '4A4A4A',
                'back_btn_disable'       => 'off',
                'back_btn_color'         => 'FFFFFF',
                'back_btn_hover_color'   => 'FFFFFF',
                'back_btn_active_color'  => 'FFFFFF',
                'back_btn_bg'            => 'C28D8D',
                'back_btn_hover_bg'      => 'A17575',
                'back_btn_active_bg'     => '864747',
            ],
            'product_titles'  => [
                'disable_desc'  => 'off',
                'desc_color'    => '868686',
                'disable_time'  => 'off',
                'time_color'    => '868686',
                'disable_price' => 'off',
                'price_color'   => '868686',
            ],
            'product_content' => [
                'disable_title' => 'off',
                'title_color'   => 'FFFFFF',
                'disable_desc'  => 'off',
                'desc_color'    => '000000',
                'disable_time'  => 'off',
                'time_color'    => '000000',
                'disable_price' => 'off',
                'price_color'   => '000000',
                'delete_bg'     => 'e1e1e1',
                'delete_color'  => '444',
            ],
            'upsells'         => [
                'header_color'       => '868686',
                'titles_color'       => '444',
                'button_bg'          => 'A0B0A1',
                'button_color'       => 'FFFFFF',
                'button_hover_bg'    => 'ADBEAD',
                'button_hover_color' => 'FFFFFF',
            ],
        ],
        'mblp'        => [
            'auto_activation' => 'on',
            'redirect_page'   => 'activation',
        ],
        'mblp_texts'  => [
            'cart_order'       => 'Перейти к оплате',
            'checkout_order'   => 'К оплате',
            'cart_back'        => 'Продолжить покупки',
            'cart_desc'        => 'Описание',
            'cart_time'        => 'Доступ',
            'unlimited_access' => 'неограничен',
            'cart_price'       => 'Цена',
            'cart'             => 'Корзина',
            'cart_empty'       => 'В корзине нет товаров',
            'checkout'         => 'Оформление заказа',
            'order_comment'    => 'Комментарий к заказу',
            'upsells'          => 'Дополнительные предложения',
            'error_time_limit' => 'Превышено время ожидания от сервера. Обратитесь, пожалуйста к администратору.',
        ],
        'letters'     => [
            'mblp' => [
                'admin'          => [
                    'title'   => 'Новая продажа [order_number] - От: [user_email]',
                    'content' => '<strong>Информация о товаре</strong>

Товар: [product_name]
Цена товара: [product_price]

<strong>Детали платежа</strong>

Дата: [payment_date]
Время: [payment_time]
Способ оплаты: [payment_type]

<strong>Данные клиента</strong>

Имя: [user_name]
Фамилия: [user_surname]
E-mail: [user_email]
Телефон: [user_phone]
Комментарий к заказу: [user_comment]',
                ],
                'clients'        => [
                    'title'   => 'Оплата товара [product_name] прошла успешно! Спасибо!',
                    'content' => 'Здравствуйте, [user_name]!
Благодарим за оплату!

<strong>Информация о товаре</strong>

Товар: [product_name]
Цена товара: [product_price]
Номер заказа: [order_number]

<strong>Доступ к материалам</strong>

Ссылка с доступом к оплаченным материалам:
[start_page]

Если активация доступа не произошла автоматически, перейдите по ссылке:
[user_key_link]',
                ],
                'client_product' => [
                    'title'   => 'Оплата товара [product_name] прошла успешно! Спасибо!',
                    'content' => 'Здравствуйте, [user_name]!
Благодарим за оплату!

<strong>Информация о товаре</strong>

Товар: [product_name]
Цена товара: [product_price]
Номер заказа: [order_number]

<strong>Доступ к материалам</strong>

Ссылка с доступом к оплаченным материалам:
[start_page]

Если активация доступа не произошла автоматически, перейдите по ссылке:
[user_key_link]',
                ],
            ],
        ],
    ];

    public function __construct()
    {
        if ($this->_pluginEnabled()) {
            $this->_run();
        } elseif (is_admin()) {
            add_action('admin_notices', [$this, 'notActiveNotice']);
        }
    }

    public function notActiveNotice()
    {
        $class = 'notice notice-error';
        $message = __('МОДУЛЬ ПРИЕМА ПЛАТЕЖЕЙ не активирован!', 'mbl_admin');

        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
    }

    private function _pluginEnabled()
    {
        return class_exists('woocommerce')
               && defined('WP_MEMBERSHIP_VERSION')
               && !version_compare(get_option('wpm_version'), '2.2.3', '<')
               && $this->_pluginKeyActive();
    }

    private function _pluginKeyActive()
    {
        return (bool)count(wpm_array_filter(wpm_array_pluck(wpm_array_get(wpm_get_key_data(), 'keys.active', []), 'type'), 'payments'));
    }

    private function _run()
    {
        new MBLPAdmin();
        new MBLPPublic();
        new MBLPMail();
        new MBLPProduct();
        new MBLPOrder();
        new MBLPUser();
        new MBLPCart();
        new MBLPCheckout();
    }

    public static function install()
    {
        defined('WP_MEMBERSHIP_VERSION') || exit;

        self::_setDefaultOptions();
    }

    private static function _setDefaultOptions()
    {
        foreach (self::$_defaultOptions as $key => $value) {
            self::_setDefaultOption($key, $value);
        }
    }

    private static function _setDefaultOption($key, $value)
    {
        if (is_array($value)) {
            foreach ($value as $_key => $_value) {
                self::_setDefaultOption($key . '.' . $_key, $_value);
            }
        } elseif (wpm_get_option($key) === null) {
            mblp_update_option($key, $value);
        }
    }

    public static function uninstall()
    {

    }
}