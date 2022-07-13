<div id="tab-mkk-catalog" class="tab mkk-color-content">
    <div class="wpm-tab-content">

        <h3><?php _e('Общие настройки каталога курсов', 'mbl_admin'); ?></h3>

        <div class="row">

			<?php
				if ((wpm_get_option('mkk.set_as_mainpage') == 'off' && wpm_get_option('mkk.set_as_mainpage_keep_link') == 'off') && wpm_get_option('home_id') != get_option('woocommerce_shop_page_id')) { ?>
                    <input id="mkk_main_options_home_id" type="hidden" name="main_options[mkk][old_mainpage]"
                           value="<?php echo wpm_get_option('home_id'); ?>">
                <?php } else { ?>
                    <input id="mkk_main_options_home_id" type="hidden" name="main_options[mkk][old_mainpage]"
                           value="<?php echo wpm_get_option('mkk.old_mainpage'); ?>">
                <?php }; ?>

            <div id="hidden-fields"></div>

			<?php wpm_render_partial('fields/checkbox', 'admin', array('label' => __('Сделать главной страницей школы (заменить Главную в меню)', 'mbl_admin'), 'name' => 'main_options[mkk][set_as_mainpage]', 'value' => wpm_get_option('mkk.set_as_mainpage'))) ?>

			<?php wpm_render_partial('fields/checkbox', 'admin', array('label' => __('Отображать название раздела', 'mbl_admin'), 'name' => 'main_options[mkk][show_section_name]', 'value' => wpm_get_option('mkk.show_section_name'))) ?>
        </div>
		<?php wpm_render_partial('fields/checkbox', 'admin', array('label' => __('Использовать категории товаров', 'mbl_admin'), 'name' => 'main_options[mkk][use_product_category]', 'value' => wpm_get_option('mkk.use_product_category'))) ?>
        <?php wpm_render_partial('fields/checkbox', 'admin', array('label' => __('Сделать главной страницей школы (оставить Главную в меню)', 'mbl_admin'), 'name' => 'main_options[mkk][set_as_mainpage_keep_link]', 'value' => wpm_get_option('mkk.set_as_mainpage_keep_link'))) ?>

        <hr>

        <h3><?php _e('Пункт меню', 'mbl_admin'); ?></h3>

        <div class="row">

            <div class="col col-25 d-flex justify-end column">
                <div class="mb-15">
					<?php wpm_render_partial('fields/checkbox', 'admin', array('label' => __('Отображать', 'mbl_admin'), 'name' => 'main_options[mkk][show_in_menu]', 'value' => wpm_get_option('mkk.show_in_menu'))) ?>
                </div>
				<?php wpm_render_partial('options/text-row', 'admin', array('label' => __('Название пункта меню', 'mbl_admin'), 'key' => 'mkk_texts.menu_name')) ?>
            </div>

            <div class="col">

                <div class="row">

                    <div class="col col-25">
						<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет иконки:', 'mbl_admin'), 'key' => 'mkk_design.catalog.menu_icon_color', 'default' => '9900FF', 'main' => true)) ?>
						<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста', 'mbl_admin'), 'key' => 'mkk_design.catalog.menu_text_color', 'default' => '9900FF', 'main' => true)) ?>
                    </div>

                    <div class="col col-25">
						<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('При наведении:', 'mbl_admin'), 'key' => 'mkk_design.catalog.menu_icon_color_hover', 'default' => '641582', 'main' => true)) ?>
						<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('При наведении:', 'mbl_admin'), 'key' => 'mkk_design.catalog.menu_text_color_hover', 'default' => '641582', 'main' => true)) ?>
                    </div>

                    <div class="col col-25">
						<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('При клике:', 'mbl_admin'), 'key' => 'mkk_design.catalog.menu_icon_color_click', 'default' => '50066D', 'main' => true)) ?>
						<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('При клике:', 'mbl_admin'), 'key' => 'mkk_design.catalog.menu_text_color_click', 'default' => '50066D', 'main' => true)) ?>
                    </div>

                </div>
            </div>

        </div>

        <hr>

        <h3><?php _e('Кнопки', 'mbl_admin'); ?></h3>

        <div class="row">
            <div class="col col-25">
                <p class="mbla-bold"><?php _e('Добавить в корзину'); ?>:</p>
				<?php wpm_render_partial('options/text-row', 'admin', array('label' => __('Текст на кнопке', 'mbl_admin'), 'key' => 'mkk_texts.btn_add_to_cart_name')) ?>

                <div class="wpm-row">
					<?php _e('Открывать страницу:'); ?><br>
                    <div>
                        <label>
                            <input type="radio"
                                   name="main_options[mkk][btn_add_to_cart_target]"
                                   value="_self"
								<?php echo wpm_option_is('mkk.btn_add_to_cart_target', '_self', '_self') ? ' checked' : ''; ?> />
							<?php _e('В текущей вкладке', 'mbl_admin'); ?>
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="radio"
                                   name="main_options[mkk][btn_add_to_cart_target]"
                                   value="_blank"
								<?php echo wpm_option_is('mkk.btn_add_to_cart_target', '_blank', '_self') ? ' checked' : ''; ?> />
							<?php _e('В новой вкладке', 'mbl_admin'); ?>
                        </label>
                    </div>
                </div>

                <div class="mt-15">
					<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет кнопки:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_add_to_cart_color', 'default' => '9900FF', 'main' => true)) ?>
					<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_add_to_cart_text_color', 'default' => 'ffffff', 'main' => true)) ?>
                </div>

                <div class="mt-15">
					<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Кнопка при наведении:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_add_to_cart_hover_color', 'default' => '664EA6', 'main' => true)) ?>
					<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Текст при наведении:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_add_to_cart_text_hover_color', 'default' => 'ffffff', 'main' => true)) ?>
                </div>

                <div class="mt-15">
					<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Кнопка при клике:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_add_to_cart_click_color', 'default' => '8E7DC4', 'main' => true)) ?>
					<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Текст при клике:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_add_to_cart_text_click_color', 'default' => 'ffffff', 'main' => true)) ?>
                </div>

            </div>
            <div class="col col-25">
                <p class="mbla-bold"><?php _e('Подробнее о курсе'); ?>:</p>
				<?php wpm_render_partial('options/text-row', 'admin', array('label' => __('Текст на кнопке', 'mbl_admin'), 'key' => 'mkk_texts.btn_about_course_name')) ?>

                <div class="wpm-row">
					<?php _e('Открывать страницу:'); ?><br>
                    <div>
                        <label>
                            <input type="radio"
                                   name="main_options[mkk][btn_about_course_target]"
                                   value="_self"
								<?php echo wpm_option_is('mkk.btn_about_course_target', '_self', '_self') ? ' checked' : ''; ?> />
							<?php _e('В текущей вкладке', 'mbl_admin'); ?>
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="radio"
                                   name="main_options[mkk][btn_about_course_target]"
                                   value="_blank"
								<?php echo wpm_option_is('mkk.btn_about_course_target', '_blank', '_self') ? ' checked' : ''; ?> />
							<?php _e('В новой вкладке', 'mbl_admin'); ?>
                        </label>
                    </div>
                </div>

                <div class="mt-15">
					<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет кнопки:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_about_course_color', 'default' => '2C78E4', 'main' => true)) ?>
					<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_about_course_text_color', 'default' => 'ffffff', 'main' => true)) ?>
                </div>

                <div class="mt-15">
					<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Кнопка при наведении:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_about_course_hover_color', 'default' => '075394', 'main' => true)) ?>
					<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Текст при наведении:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_about_course_text_hover_color', 'default' => 'ffffff', 'main' => true)) ?>
                </div>

                <div class="mt-15">
					<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Кнопка при клике:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_about_course_click_color', 'default' => '6FA8DD', 'main' => true)) ?>
					<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Текст при клике:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_about_course_text_click_color', 'default' => 'ffffff', 'main' => true)) ?>
                </div>

            </div>
            <div class="col col-25">
                <p class="mbla-bold"><?php _e('Перейти к урокам'); ?>:</p>
				<?php wpm_render_partial('options/text-row', 'admin', array('label' => __('Текст на кнопке', 'mbl_admin'), 'key' => 'mkk_texts.btn_go_to_lessons_name')) ?>

                <div class="wpm-row">
					<?php _e('Открывать страницу:'); ?><br>
                    <div>
                        <label>
                            <input type="radio"
                                   name="main_options[mkk][btn_go_to_lessons_target]"
                                   value="_self"
								<?php echo wpm_option_is('mkk.btn_go_to_lessons_target', '_self', '_self') ? ' checked' : ''; ?> />
							<?php _e('В текущей вкладке', 'mbl_admin'); ?>
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="radio"
                                   name="main_options[mkk][btn_go_to_lessons_target]"
                                   value="_blank"
								<?php echo wpm_option_is('mkk.btn_go_to_lessons_target', '_blank', '_self') ? ' checked' : ''; ?> />
							<?php _e('В новой вкладке', 'mbl_admin'); ?>
                        </label>
                    </div>
                </div>

                <div class="mt-15">
					<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет кнопки:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_go_to_lessons_color', 'default' => '009F10', 'main' => true)) ?>
					<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_go_to_lessons_text_color', 'default' => 'ffffff', 'main' => true)) ?>
                </div>

                <div class="mt-15">
					<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Кнопка при наведении:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_go_to_lessons_hover_color', 'default' => '38751C', 'main' => true)) ?>
					<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Текст при наведении:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_go_to_lessons_text_hover_color', 'default' => 'ffffff', 'main' => true)) ?>
                </div>

                <div class="mt-15">
					<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Кнопка при клике:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_go_to_lessons_click_color', 'default' => '94C47D', 'main' => true)) ?>
					<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Текст при клике:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_go_to_lessons_text_click_color', 'default' => 'ffffff', 'main' => true)) ?>
                </div>

            </div>
            <div class="col col-25">
                <p class="mbla-bold"><?php _e('Добавить в корзину'); ?> ($0):</p>
                <?php wpm_render_partial('options/text-row', 'admin', array('label' => __('Текст на кнопке', 'mbl_admin'), 'key' => 'mkk_texts.btn_add_to_cart_free_name')) ?>

                <div class="wpm-row">
                    <?php _e('Открывать страницу:'); ?><br>
                    <div>
                        <label>
                            <input type="radio"
                                   name="main_options[mkk][btn_add_to_cart_free_target]"
                                   value="_self"
                                <?php echo wpm_option_is('mkk.btn_add_to_cart_free_target', '_self', '_self') ? ' checked' : ''; ?> />
                            <?php _e('В текущей вкладке', 'mbl_admin'); ?>
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="radio"
                                   name="main_options[mkk][btn_add_to_cart_free_target]"
                                   value="_blank"
                                <?php echo wpm_option_is('mkk.btn_add_to_cart_free_target', '_blank', '_self') ? ' checked' : ''; ?> />
                            <?php _e('В новой вкладке', 'mbl_admin'); ?>
                        </label>
                    </div>
                </div>

                <div class="mt-15">
                    <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет кнопки:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_add_to_cart_free_color', 'default' => '9900FF', 'main' => true)) ?>
                    <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_add_to_cart_free_text_color', 'default' => 'ffffff', 'main' => true)) ?>
                </div>

                <div class="mt-15">
                    <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Кнопка при наведении:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_add_to_cart_free_hover_color', 'default' => '664EA6', 'main' => true)) ?>
                    <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Текст при наведении:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_add_to_cart_free_text_hover_color', 'default' => 'ffffff', 'main' => true)) ?>
                </div>

                <div class="mt-15">
                    <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Кнопка при клике:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_add_to_cart_free_click_color', 'default' => '8E7DC4', 'main' => true)) ?>
                    <?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Текст при клике:', 'mbl_admin'), 'key' => 'mkk_design.catalog.btn_add_to_cart_free_text_click_color', 'default' => 'ffffff', 'main' => true)) ?>
                </div>

            </div>

        </div>

		<?php wpm_render_partial('settings-save-button', 'common'); ?>
    </div>
</div>

<script>

    //Change fields in mainpage
    jQuery('input[type="checkbox"][name="main_options[mkk][set_as_mainpage]"], input[type="checkbox"][name="main_options[mkk][set_as_mainpage_keep_link]"]').on('change', function () {
        var setAsMain = jQuery('input[type="checkbox"][name="main_options[mkk][set_as_mainpage]"]');
        var setAsMainKeepLink = jQuery('input[type="checkbox"][name="main_options[mkk][set_as_mainpage_keep_link]"]');

        var isChecked = setAsMain.is(':checked') || setAsMainKeepLink.is(':checked');

        if (jQuery(this).get(0) === setAsMain.get(0) && setAsMain.is(':checked')) {
            setAsMainKeepLink.prop('checked', false);
        }

        if (jQuery(this).get(0) === setAsMainKeepLink.get(0) && setAsMainKeepLink.is(':checked')) {
            setAsMain.prop('checked', false);
        }

        if (isChecked) {
            jQuery('#hidden-fields').html(
                '<input type="hidden" name="main_options[home_id]" value="<?php echo get_option('woocommerce_shop_page_id'); ?>" />'
            );
        } else {
            jQuery('#hidden-fields').html(
                '<input type="hidden" name="main_options[home_id]" value="<?php echo wpm_get_option('mkk.old_mainpage'); ?>" />'
            );
        }
    });

    jQuery('#mbl_main_options_home_id').on('change', function () {
        jQuery('#mkk_main_options_home_id').val(jQuery(this).val());
    });

</script>
