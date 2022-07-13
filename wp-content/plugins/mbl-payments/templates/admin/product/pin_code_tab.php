<?php /** @var WC_Product_MBL $product_object */ ?>
<div id='mbl_key_pin_code_options' class='panel woocommerce_options_panel'>
    <div class='options_group'>
        <?php
            woocommerce_wp_select(
                array(
                    'id' => '_mbl_key_pin_code_level_id',
                    'value' => is_callable(array($product_object, 'get_mbl_key_pin_code_level_id')) ? $product_object->get_mbl_key_pin_code_level_id('edit') : '',
                    'label' => __('Уровень доступа', 'mbl_admin'),
                    'options' => $options,
                    'desc_tip' => false,
                    'wrapper_class' => 'form-row',
                )
            );
        ?>
       <p class="form-field">
           <?php
           wpm_render_partial('term-keys-period',
               'admin',
               [
                   'durationName'     => '_mbl_key_pin_code_duration',
                   'durationId'       => 'duration-manual',
                   'duration'         => (is_callable([$product_object, 'get_mbl_key_pin_code_duration']) ? $product_object->get_mbl_key_pin_code_duration('edit') : '12'),
                   'unitsName'        => '_mbl_key_pin_code_units',
                   'unitsId'          => 'units-manual',
                   'units'            => (is_callable([$product_object, 'get_mbl_key_pin_code_units']) ? $product_object->get_mbl_key_pin_code_units('edit') : ''),
                   'isUnlimitedName'  => '_mbl_key_pin_code_is_unlimited',
                   'isUnlimitedValue' => (is_callable([$product_object, 'get_mbl_key_pin_code_is_unlimited']) ? $product_object->get_mbl_key_pin_code_is_unlimited('edit') : 'off'),
               ])
           ?>
        </p>

        <?php
        woocommerce_wp_textarea_input(array(
                'id' => '_ipr_codes',
                'value' => is_callable(array($product_object, 'get_ipr_codes_string')) ? $product_object->get_ipr_codes_string() : '',
                'label' => __('Коды доступа', 'mbl_admin'),
                'desc_tip' => false,
                'description' => __('Вставьте список кодов доступа (каждый в отдельной строке)', 'mbl_admin'),
                'class' => 'full',
                'rows' => 10,
                'wrapper_class' => ('form-row show_if_' . MBLPProduct::IPR_PRODUCT_TYPE)
        ));

        ?>
    </div>
</div>