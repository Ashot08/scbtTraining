<?php

class MBLPCheckout
{
    /**
     * Caches customer object.
     *
     * @var WC_Customer
     */
    private $logged_in_customer = null;

    private $_fields = [
        'surname'    => [
            'protected'    => false,
            'required'     => true,
            'label'        => 'Фамилия',
            'map'          => 'billing_last_name',
            'autocomplete' => 'family-name',
            'icon'         => 'user',
        ],
        'name'       => [
            'protected'    => false,
            'required'     => true,
            'label'        => 'Имя',
            'map'          => 'billing_first_name',
            'autocomplete' => 'given-name',
            'icon'         => 'user',
        ],
        'patronymic' => [
            'protected'    => false,
            'required'     => true,
            'label'        => 'Отчество',
            'map'          => 'patronymic',
            'autocomplete' => 'surname',
            'icon'         => 'user',
        ],
        'email'      => [
            'protected'             => true,
            'required'              => false,
            'type'                  => 'email',
            'label'                 => 'Email',
            'map'                   => 'billing_email',
            'readonly_for_existing' => true,
            'icon'                  => 'email',
        ],
        'phone'      => [
            'protected'    => false,
            'required'     => true,
            'label'        => 'Телефон',
            'map'          => 'billing_phone',
            'autocomplete' => 'tel',
            'icon'         => 'phone',
        ],
        'login'      => [
            'protected'         => true,
            'required'          => false,
            'hide_for_existing' => true,
            'label'             => 'Желаемый логин',
            'map'               => 'account_username',
            'autocomplete'      => 'username',
            'icon'              => 'user',
        ],
        'pass'       => [
            'protected'         => true,
            'required'          => false,
            'hide_for_existing' => true,
            'type'              => 'password',
            'label'             => 'Желаемый пароль',
            'map'               => 'account_password',
            'icon'              => 'lock',
            'custom_attributes' => [
                'autocomplete' => 'new-password'
            ]
        ],
        'comment'    => [
            'protected' => false,
            'required'  => false,
            'type'      => 'textarea',
            'label'     => 'Комментарий к заказу',
            'map'       => 'order_comments',
            'icon'      => 'comment',
        ],
    ];

    private $_fieldSets = [
        'billing'  => ['surname', 'name', 'patronymic'],
        'contacts' => ['email', 'phone'],
        'account'  => ['login', 'pass'],
        'order'    => ['comment'],
    ];

    private $_requiredFields = ['email', 'login', 'pass'];

    public function __construct()
    {
        $this->_setHooks();
    }

    private function _setHooks()
    {
        add_filter('woocommerce_checkout_fields', [$this, 'modifyCheckoutFields']);
        add_filter('woocommerce_checkout_registration_enabled', [$this, 'registrationEnabled']);
        add_filter('woocommerce_checkout_registration_required', '__return_true');
        add_filter('woocommerce_checkout_must_be_logged_in_message', [$this, 'mustBeLoggedInMessage']);
        add_filter('default_checkout_patronymic', [$this, 'defaultPatronymic']);

        add_action('wp_ajax_mblp_check_order_status', [$this, 'ajaxCheckOrderStatus']);
        add_action('wp_ajax_nopriv_mblp_check_order_status', [$this, 'ajaxCheckOrderStatus']);

        add_action('woocommerce_cancelled_order', [$this, 'redirectToCart']);

        add_action( 'woocommerce_review_order_before_submit', array($this, 'addOfferCheckBox') );
        add_action( 'wpm_footer', array($this, 'addOfferModal') );
    }

    public function modifyCheckoutFields($fields)
    {
        $newFields = [];
        $i = 0;
        $userType = is_user_logged_in() ? 'existing' : 'new';
        
        $isLogin = isset($_POST['try_to_login']);

        $customer_object = false;

        if (is_user_logged_in()) {
            // Load customer object, but keep it cached to avoid reloading it multiple times.
            if (is_null($this->logged_in_customer)) {
                $this->logged_in_customer = new WC_Customer(get_current_user_id());
            }
            $customer_object = $this->logged_in_customer;
        }

        if (!$customer_object) {
            $customer_object = WC()->customer;
        }

        foreach ($this->_fieldSets as $fieldSetKey => $fieldSet) {
            $newFields[$fieldSetKey] = [];

            foreach ($fieldSet as $fieldName) {
                $fieldConfig = $this->_fields[$fieldName];
                $addField = !wpm_array_get($fieldConfig, "hide_for_{$userType}")
                            && (
								(wpm_option_is("mblp.{$userType}_clients.{$fieldName}", 'on') && !$isLogin)
                                || in_array($fieldName, $this->_requiredFields)
                            );

                if ($addField) {
                    $field = [
                        'label'             => $fieldName == 'comment' ? wpm_get_option('mblp_texts.order_comment', __('Комментарий к заказу', 'mbl_admin')) : __($fieldConfig['label'], 'mbl'),
                        'required'          => $fieldConfig['required'],
                        'priority'          => (++ $i * 10),
                        'custom_attributes' => array_merge(['icon' => $fieldConfig['icon']], wpm_array_get($fieldConfig, 'custom_attributes', [])),
                    ];

                    if (isset($fieldConfig['autocomplete'])) {
                        $field['autocomplete'] = $fieldConfig['autocomplete'];
                    }

                    $value = null;

                    if (wpm_array_get($fieldConfig, 'readonly_for_' . $userType)) {
                        $input = $fieldConfig['map'];

                        if (is_callable([$customer_object, "get_$input"])) {
                            $value = $customer_object->{"get_$input"}();
                        } elseif ($customer_object->meta_exists($input)) {
                            $value = $customer_object->get_meta($input, true);
                        }

                        if ($value && '' !== $value) {
                            $field['custom_attributes']['readonly'] = 'readonly';
                        }
                    }

                    if (wpm_array_get($fieldConfig, 'type')) {
                        $field['type'] = wpm_array_get($fieldConfig, 'type');
                    }


                    $newFields[$fieldSetKey][$fieldConfig['map']] = $field;
                }
            }
        }

        return $newFields;
    }

    public function defaultPatronymic($value)
    {
        $val = '';

        if (is_user_logged_in()) {
            $user = wp_get_current_user();

            $val = $user && $user->surname ? $user->surname : '';
        }

        return $val;
    }

    public function registrationEnabled($enabled)
    {
        return !wpm_is_users_overflow();
    }

    public function mustBeLoggedInMessage($message)
    {
        return __('Регистрация временно недоступна', 'mbl');
    }

    public static function formField($key, $args, $value = null)
    {
        $defaults = [
            'type'              => 'text',
            'label'             => '',
            'description'       => '',
            'placeholder'       => '',
            'maxlength'         => false,
            'required'          => false,
            'autocomplete'      => false,
            'id'                => $key,
            'class'             => [],
            'label_class'       => [],
            'input_class'       => [],
            'return'            => false,
            'options'           => [],
            'custom_attributes' => [],
            'validate'          => [],
            'default'           => '',
            'autofocus'         => '',
            'priority'          => '',
            'icon'              => 'user'
        ];

        $args = wp_parse_args($args, $defaults);
        $args = apply_filters('woocommerce_form_field_args', $args, $key, $value);

        $args['icon'] = wpm_array_get($args, 'custom_attributes.icon', 'user');

        unset($args['custom_attributes']['icon']);


        if ($args['required']) {
            $args['class'][] = 'validate-required';
            $required = '&nbsp;<abbr class="required" title="' . esc_attr__('required', 'woocommerce') . '">*</abbr>';
        } else {
            $required = '&nbsp;<span class="optional">(' . esc_html__('optional', 'woocommerce') . ')</span>';
        }

        if (is_string($args['label_class'])) {
            $args['label_class'] = [$args['label_class']];
        }

        if (is_null($value)) {
            $value = $args['default'];
        }

        // Custom attribute handling.
        $custom_attributes = [];
        $args['custom_attributes'] = array_filter((array)$args['custom_attributes'], 'strlen');

        if ($args['maxlength']) {
            $args['custom_attributes']['maxlength'] = absint($args['maxlength']);
        }

        if (!empty($args['autocomplete'])) {
            $args['custom_attributes']['autocomplete'] = $args['autocomplete'];
        }

        if (true === $args['autofocus']) {
            $args['custom_attributes']['autofocus'] = 'autofocus';
        }

        if ($args['description']) {
            $args['custom_attributes']['aria-describedby'] = $args['id'] . '-description';
        }

        if (!empty($args['custom_attributes']) && is_array($args['custom_attributes'])) {
            foreach ($args['custom_attributes'] as $attribute => $attribute_value) {
                $custom_attributes[] = esc_attr($attribute) . '="' . esc_attr($attribute_value) . '"';
            }
        }

        if (!empty($args['validate'])) {
            foreach ($args['validate'] as $validate) {
                $args['class'][] = 'validate-' . $validate;
            }
        }

        $field = '';

        switch ($args['type']) {
            case 'textarea':
                $field = sprintf(
                    '<div class="form-group form-icon form-icon-%s"><textarea name="%s" id="%s" class="form-control" placeholder="%s" %s %s %s %s>%s</textarea></div>',
                    esc_attr($args['icon']),
                    esc_attr($key),
                    esc_attr($args['id']),
                    esc_attr($args['label']),
                    (empty($args['custom_attributes']['rows']) ? ' rows="6"' : ''),
                    (empty($args['custom_attributes']['cols']) ? ' cols="5"' : ''),
                    esc_attr($args['required'] ? 'required' : ''),
                    implode(' ', $custom_attributes),
                    esc_textarea($value)
                );

                break;
            case 'checkbox':
                $field = '<label class="checkbox ' . implode(' ', $args['label_class']) . '" ' . implode(' ', $custom_attributes) . '>
						<input type="' . esc_attr($args['type']) . '" class="input-checkbox ' . esc_attr(implode(' ', $args['input_class'])) . '" name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" value="1" ' . checked($value, 1, false) . ' /> ' . $args['label'] . $required . '</label>';

                break;
            case 'text':
            case 'password':
            case 'datetime':
            case 'datetime-local':
            case 'date':
            case 'month':
            case 'time':
            case 'week':
            case 'number':
            case 'email':
            case 'url':
            case 'tel':
                $field = sprintf(
                    '<div class="form-group form-icon form-icon-%s"><input type="%s" name="%s" id="%s" value="%s" class="form-control" placeholder="%s" %s %s></div>',
                    esc_attr($args['icon']),
                    esc_attr($args['type']),
                    esc_attr($key),
                    esc_attr($args['id']),
                    esc_attr($value),
                    esc_attr($args['label']),
                    esc_attr($args['required'] ? 'required' : ''),
                    implode(' ', $custom_attributes)
                );

                break;
            case 'select':
                $field = '';
                $options = '';

                if (!empty($args['options'])) {
                    foreach ($args['options'] as $option_key => $option_text) {
                        if ('' === $option_key) {
                            // If we have a blank option, select2 needs a placeholder.
                            if (empty($args['placeholder'])) {
                                $args['placeholder'] = $option_text ? $option_text : __('Choose an option', 'woocommerce');
                            }
                            $custom_attributes[] = 'data-allow_clear="true"';
                        }
                        $options .= '<option value="' . esc_attr($option_key) . '" ' . selected($value, $option_key, false) . '>' . esc_attr($option_text) . '</option>';
                    }

                    $field .= '<select name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" class="select ' . esc_attr(implode(' ', $args['input_class'])) . '" ' . implode(' ', $custom_attributes) . ' data-placeholder="' . esc_attr($args['placeholder']) . '">
							' . $options . '
						</select>';
                }

                break;
            case 'radio':
                if (!empty($args['options'])) {
                    foreach ($args['options'] as $option_key => $option_text) {
                        $field .= '<input type="radio" class="input-radio ' . esc_attr(implode(' ', $args['input_class'])) . '" value="' . esc_attr($option_key) . '" name="' . esc_attr($key) . '" ' . implode(' ', $custom_attributes) . ' id="' . esc_attr($args['id']) . '_' . esc_attr($option_key) . '"' . checked($value, $option_key, false) . ' />';
                        $field .= '<label for="' . esc_attr($args['id']) . '_' . esc_attr($option_key) . '" class="radio ' . implode(' ', $args['label_class']) . '">' . $option_text . '</label>';
                    }
                }

                break;
        }

        /**
         * Filter by type.
         */
        $field = apply_filters('woocommerce_form_field_' . $args['type'], $field, $key, $args, $value);

        /**
         * General filter on form fields.
         *
         * @since 3.4.0
         */
        $field = apply_filters('woocommerce_form_field', $field, $key, $args, $value);

        return $field;
    }

    public function ajaxCheckOrderStatus()
    {
        $result = [
            'success' => true,
            'status'  => 'processing',
        ];

        $orderId = absint(wpm_array_get($_POST, 'order_id'));

        if (!$orderId) {
            $this->_renderErrorOrderStatus();
        }

        $order = wc_get_order($orderId);

        if (!$order || $order->get_user_id() != get_current_user_id()) {
            $this->_renderErrorOrderStatus();
        }

        if ($order->status == 'failed') {
            $this->_renderErrorOrderStatus();
        } elseif ($order->status == 'cancelled') {
            $result['status'] = 'completed';
            $result['link'] = wc_get_cart_url();
        } elseif ($order->status == 'completed') {
            $result['status'] = 'completed';
            $result['link'] = $this->_getOrderRedirectLink($order);
        }

        echo json_encode($result);
        die();
    }

    private function _getOrderRedirectLink($order)
    {
        if (count($order->get_items()) > 0) {
            foreach ($order->get_items() as $item) {
                if ($item->is_type('line_item')) {
                    $product = $item->get_product();

                    if (!$product || (!($product instanceof WC_Product_MBL) && !($product instanceof WC_Product_IPR))) {
                        continue;
                    }

                    if ($product->get_mbl_redirect() == 'main') {
                        $link = wpm_get_start_url();
                    } elseif ($product->get_mbl_redirect() == 'custom') {
                        $link = $product->get_mbl_redirect_url();
                    } else {
                        $link = wpm_activation_link();
                    }

                    return $link;
                }
            }
        }

        return wpm_activation_link();
    }

    private function _renderErrorOrderStatus($message = null)
    {
        if ($message === null) {
            $message = __('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce');
        }

        echo json_encode([
            'success' => false,
            'message' => mblp_render_partial('notices/error', 'public', ['messages' => [$message]]),
        ]);
        die();
    }

    public function redirectToCart($orderId)
    {
        wp_safe_redirect(wc_get_cart_url());
        exit;
    }

    public function addOfferCheckBox()
    {
        if (wpm_option_is('mblp.offer', 'on')) {
            mblp_render_partial('checkout/offer');
        }
    }

    public function addOfferModal()
    {
        if (wpm_option_is('mblp.offer', 'on')) {
            mblp_render_partial('checkout/offer-modal');
        }
    }

}