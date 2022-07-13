<div id='mbl_key_course_catalog' class='panel woocommerce_options_panel'>
	<div class="options_group">
        <?php woocommerce_wp_select(array(
            'id'       => 'mkk_cart_url_type' ,
            'value'    => get_post_meta ( get_the_ID() , 'mkk_cart_url_type' , true  ),
            'class'    => 'select short trigger-select',
            'label'    => __('URL кнопки Добавить в корзину', 'mbl_admin'),
            'options'  => array (  '0' => __('WooCommerce URL', 'mbl_admin'), '1' => __('Произвольный URL', 'mbl_admin')) ,
        )) ?>
        <div class="option-0">
			<?php if (is_callable(array($product_object, 'get_add_to_cart_sample_url'))) : ?>
                <p class="mblp-product-link-text"><?php echo $product_object->get_add_to_cart_sample_url(); ?></p>
			<?php else : ?>
                <p class="form-field">
                    <span class="wrap"><?php _e('Ссылка будет доступна после создания товара', 'mbl_admin'); ?></span>
                </p>
			<?php endif; ?>
        </div>
        <div class="option-1">
			<?php
                woocommerce_wp_text_input (  array (
                     'id'           => 'mkk_cart_url' ,
                     'value'        => get_post_meta ( get_the_ID ( ) , 'mkk_cart_url' , true  ),
                     'label'        => __('Укажите URL', 'mbl_admin'),
                )  ) ;
            ?>
        </div>
	</div>
 
	<div class="options_group">
		<?php woocommerce_wp_select(array(
			'id'       => 'mkk_about_url_type' ,
			'value'    => get_post_meta ( get_the_ID ( ) , 'mkk_about_url_type' , true  ),
			'class'    => 'select short trigger-select',
			'label'    => __('URL кнопки Подробнее о курсе', 'mbl_admin'),
			'options'  => array (  '0' => __('Контент продажи доступа', 'mbl_admin'), '1' => __('Произвольный URL', 'mbl_admin')) ,
		)) ?>
        <div class="option-0">
			<?php woocommerce_wp_select(array(
				'id'       => 'mkk_about_level_id' ,
				'value'    => get_post_meta ( get_the_ID ( ) , 'mkk_about_level_id' , true  ),
				'label'    => __('Выберите уровень доступа', 'mbl_admin'),
				'options'  => $levels_options,
			)) ?>
        </div>
        <div class="option-1">
			<?php
				woocommerce_wp_text_input (  array (
					'id'           => 'mkk_about_url' ,
					'value'        => get_post_meta ( get_the_ID ( ) , 'mkk_about_url' , true  ),
					'label'        => __('Укажите URL', 'mbl_admin'),
				)  ) ;
			?>
        </div>
	</div>
    
    <div class="options_group">
		<?php woocommerce_wp_select(array(
			'id'       => 'mkk_lessons_url_type' ,
			'value'    => get_post_meta ( get_the_ID ( ) , 'mkk_lessons_url_type' , true  ),
			'class'    => 'select short trigger-select',
			'label'    => __('URL кнопки Перейти к урокам', 'mbl_admin'),
			'options'  => array (  '0' => __('Список уроков рубрики', 'mbl_admin'), '1' => __('Произвольный URL', 'mbl_admin')) ,
		)) ?>
        <div class="option-0">
			<?php woocommerce_wp_select(array(
				'id'       => 'mkk_rubric_id' ,
				'value'    => get_post_meta ( get_the_ID ( ) , 'mkk_rubric_id' , true  ),
				'label'    => __('Выберите рубрику', 'mbl_admin'),
				'options'  => $categories_options,
			)) ?>
        </div>
        <div class="option-1">
			<?php
				woocommerce_wp_text_input (  array (
					'id'           => 'mkk_lessons_url' ,
					'value'        => get_post_meta ( get_the_ID ( ) , 'mkk_lessons_url' , true  ),
					'label'        => __('Укажите URL', 'mbl_admin'),
				)  ) ;
			?>
        </div>
    </div>
</div>