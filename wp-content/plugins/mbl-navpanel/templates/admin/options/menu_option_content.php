<div id="tab-mbl-nav" class="tab mpn-color-content">
    <div class="wpm-tab-content">
        <div class="wpm-inner-tabs">
            <ul class="wpm-inner-tabs-nav">
                <li><a href="#navpanel_options_tab_1">Общие</a></li>
                <li><a class="telegram_tab" href="#navpanel_options_tab_2">Telegram</a></li>

                <?php do_action('mbl_navpanel_options_tabs'); ?>
            </ul>
            <div id="navpanel_options_tab_1" class="wpm-tab-content">
                <div class="wpm-control-row">
                    <label><input type="checkbox"
                                  name="main_options[mbli3_design][secondary_menu]" <?php echo wpm_get_option('mbli3_design.secondary_menu') == 'on' ? 'checked' : ''; ?> >
                        &nbsp;<?php _e('Включить', 'mbl_admin') ?>
                    </label><br>
                </div>

                <h3><?php _e('Фон', 'mbl_admin') ?></h3>

                <div class="wpm-control-row">
                    <label><?php _e('Цвет фона', 'mbl_admin') ?><br>
                        <input type="text" name="main_options[mbli3_design][background_color]"
                               class="color"
                               value="<?php echo wpm_get_option('mbli3_design.background_color'); ?>">
                    </label>
                </div>
                <div class="wpm-control-row">
                    <label><?php _e('Фоновое изображение', 'mbl_admin') ?><br>
                        <input type="text" id="wpm_mbli3_background"
                               name="main_options[mbli3_design][background_image][url]"
                               value="<?php echo wpm_get_option('mbli3_design.background_image.url'); ?>"
                               class="wide"></label>

                    <div class="wpm-control-row upload-image-row">
                        <p>
                            <button type="button" class="wpm-media-upload-button button"
                                    data-id="mbli3_background"><?php _e('Загрузить', 'mbl_admin') ?></button>
                            &nbsp;&nbsp; <a id="delete-wpm-mbli3_background"
                                            class="wpm-delete-media-button button submit-delete"
                                            data-id="mbli3_background"><?php _e('Удалить', 'mbl_admin') ?></a>
                        </p>
                    </div>
                    <div class="wpm-background-preview-wrap">
                        <div class="wpm-background-preview-box preview-box">
                            <img
                                    src="<?php echo wpm_remove_protocol(wpm_get_option('mbli3_design.background_image.url')); ?>"
                                    title="" alt=""
                                    id="wpm-mbli3_background-preview">
                        </div>
                    </div>
                </div>
                <div class="wpm-control-row">
                    <label><?php _e('Выравнивание изображения', 'mbl_admin') ?></label><br>
					<?php
						$background_position = array(
							'left top' => __('сверху слева', 'mbl_admin'),
							'right top' => __('сверху справа', 'mbl_admin'),
							'center top' => __('сверху по центру', 'mbl_admin'),
							'left bottom' => __('снизу слева', 'mbl_admin'),
							'right bottom' => __('снизу справа', 'mbl_admin'),
							'center bottom' => __('снизу по центру', 'mbl_admin')
						);
						$html = '';
						foreach ($background_position as $key => $value) {
							if (wpm_get_option('mbli3_design.background_image.position') == $key)
								$html .= "<option value='$key' selected>$value</option>";
							else
								$html .= "<option value='$key'>$value</option>";
						}
						$html = '<select name="main_options[mbli3_design][background_image][position]">' . $html . '</select>';
						echo $html;
					?>
                </div>
                <div class="wpm-control-row">
                    <label><?php _e('Повторение изображения', 'mbl_admin') ?></label><br>
					<?php
						$background_repeat = array(
							'no-repeat' => __('не повторять', 'mbl_admin'),
							'repeat' => __('повторять', 'mbl_admin'),
							'repeat-x' => __('повторять по горизонтали', 'mbl_admin'),
							'repeat-y' => __('повторять по вертикали', 'mbl_admin')
						);
						$html = '';
						foreach ($background_repeat as $key => $value) {
							if (wpm_get_option('mbli3_design.background_image.repeat') == $key)
								$html .= "<option value='$key' selected>$value</option>";
							else
								$html .= "<option value='$key'>$value</option>";
						}
						$html = '<select name="main_options[mbli3_design][background_image][repeat]">' . $html . '</select>';
						echo $html;
					?>
                </div>
                <br/>

                <div class="wpm-control-row">
                    <label><input type="checkbox"
                                  name="main_options[mbli3_design][background-attachment-fixed]" <?php echo wpm_get_option('mbli3_design.background-attachment-fixed') == 'on' ? 'checked' : ''; ?> >
                        &nbsp;<?php _e('Зафиксировать фон', 'mbl_admin') ?>
                    </label><br>
                </div>

                <br>

                <hr>

                <h3><?php _e('Закрытие панели', 'mbl_admin') ?></h3>

				<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет крестика', 'mbl_admin'), 'key' => 'mbli3_design.close_link.color', 'default' => '868686', 'main' => true)) ?>
				<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет крестика при наведении', 'mbl_admin'), 'key' => 'mbli3_design.close_link.color_hover', 'default' => '2e2e2e', 'main' => true)) ?>
				<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет крестика при клике', 'mbl_admin'), 'key' => 'mbli3_design.close_link.color_active', 'default' => '2e2e2e', 'main' => true)) ?>

                <br>

                <hr>

                <h3><?php _e('Заголовок рубрики', 'mbl_admin') ?></h3>

				<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет', 'mbl_admin'), 'key' => 'mbli3_design.term_header_color', 'default' => '000000', 'main' => true)) ?>
                <div class="wpm-control-row">
					<?php _e('Размер заголовка', 'mbl_admin') ?> &nbsp;
                    <select
                            name="main_options[mbli3_design][term_header_size]">
						<?php
							for ($i = 14; $i < 26; $i++) {
								if ($i != wpm_get_option('mbli3_design.term_header_size', '20')) {
									echo '<option value="' . $i . '">' . $i . 'px</option>';
								} else {
									echo '<option selected value="' . $i . '">' . $i . 'px</option>';
								}
							}
						?>
                    </select>
                </div>

                <br>

                <hr>

                <h3><?php _e('Пункт меню', 'mbl_admin') ?></h3>

                <div class="wpm-row">
                    <label>
						<?php _e('Название', 'mbl_admin') ?><br>
                        <input type="text"
                               name="main_options[mbli3_texts][menu_name]"
                               value="<?php echo wpm_get_option('mbli3_texts.menu_name', __('Меню', 'mbl_admin')); ?>">
                    </label>
                </div>

                <br>

				<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет иконки', 'mbl_admin'), 'key' => 'mbli3_design.menu.color', 'default' => '', 'main' => true)) ?>
				<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет иконки при наведении', 'mbl_admin'), 'key' => 'mbli3_design.menu.color_hover', 'default' => '', 'main' => true)) ?>
				<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет иконки при клике', 'mbl_admin'), 'key' => 'mbli3_design.menu.color_active', 'default' => '', 'main' => true)) ?>

                <br>

				<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста', 'mbl_admin'), 'key' => 'mbli3_design.menu_text.color', 'default' => '', 'main' => true)) ?>
				<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста при наведении', 'mbl_admin'), 'key' => 'mbli3_design.menu_text.color_hover', 'default' => '', 'main' => true)) ?>
				<?php wpm_render_partial('options/color-row', 'admin', array('label' => __('Цвет текста при клике', 'mbl_admin'), 'key' => 'mbli3_design.menu_text.color_active', 'default' => '', 'main' => true)) ?>

                <div class="wpm-row">
                    <label>
                        <input type="hidden" name="main_options[mbli3][hide_main]" value="off">
                        <input
                                type="checkbox"
                                name="main_options[mbli3][hide_main]"
                                value="on"
							<?php echo wpm_option_is('mbli3.hide_main', 'on') ? 'checked' : ''; ?>
                        ><?php _e('Скрыть ссылку на главную страницу', 'mbl_admin') ?><br>
                    </label>
                </div>

				<?php wpm_render_partial('settings-save-button', 'common'); ?>
            </div>

            <div id="navpanel_options_tab_2" class="wpm-tab-content">
                <div class="telegram_settings">
                    <div class="row">
                        <div class="col-1">
							<?php wpm_render_partial('fields/checkbox', 'admin', array('label' => __('Включить пункт меню', 'mbl_admin'), 'name' => 'main_options[mbli3_telegram][enable_telegram]', 'value' => wpm_get_option('mbli3_telegram.enable_telegram') )) ?>
                        </div>
                        <div class="col-2">
							<?php wpm_render_partial('fields/checkbox', 'admin', array('label' => __('Не отображать для незарегистрированых пользователей', 'mbl_admin'), 'name' => 'main_options[mbli3_telegram][display_telegram_for_unregistered]', 'value' => wpm_get_option('mbli3_telegram.display_telegram_for_unregistered') )) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1">
							<?php wpm_render_partial('options/text-row', 'admin', array('label' => __('Название пункта меню', 'mbl_admin'), 'key' => 'mbli3_telegram.menu_name')) ?>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div>
                        <div class="row">
                            <div class="col-1">
                                <?php wpm_render_partial('fields/checkbox', 'admin', array('label' => __('[Войти в Telegram] DESKTOP', 'mbl_admin'), 'name' => 'main_options[mbli3_telegram][enable_telegram_login]', 'value' => wpm_get_option('mbli3_telegram.enable_telegram_login') )) ?>
                            </div>
                            <div class="col-2">
                                <?php wpm_render_partial('fields/checkbox', 'admin', array('label' => __('Не отображать для незарегистрированых пользователей', 'mbl_admin'), 'name' => 'main_options[mbli3_telegram][telegram_login_for_unregistered]', 'value' => wpm_get_option('mbli3_telegram.telegram_login_for_unregistered') )) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <input type="text"
                                       name="main_options[mbli3_telegram][telegram_login_code]"
                                       value='<?php echo stripslashes(wpm_get_option('mbli3_telegram.telegram_login_code')); ?>'
                                       placeholder="<?php _e('Код', 'mbl_admin'); ?>"
                                       style="width: 100%;"
                                />
                            </div>
                            <div class="col-2" style="padding: 0 5px">
                                <input type="text"
                                       name="main_options[mbli3_telegram][telegram_exclude_url_1]"
                                       value='<?php echo wpm_get_option('mbli3_telegram.telegram_exclude_url_1'); ?>'
                                       placeholder="<?php _e('URL для исключения', 'mbl_admin'); ?>"
                                       style="width: 100%; margin-bottom: 5px"
                                       class="telegram_url_trim"
                                />
                                <input type="text"
                                       name="main_options[mbli3_telegram][telegram_exclude_url_2]"
                                       value='<?php echo wpm_get_option('mbli3_telegram.telegram_exclude_url_2'); ?>'
                                       placeholder="<?php _e('URL для исключения', 'mbl_admin'); ?>"
                                       style="width: 100%; margin-bottom: 5px"
                                       class="telegram_url_trim"
                                />
                                <input type="text"
                                       name="main_options[mbli3_telegram][telegram_exclude_url_3]"
                                       value='<?php echo wpm_get_option('mbli3_telegram.telegram_exclude_url_3'); ?>'
                                       placeholder="<?php _e('URL для исключения', 'mbl_admin'); ?>"
                                       style="width: 100%;"
                                       class="telegram_url_trim"
                                />
                            </div>
                        </div>
                        <br>
                        <hr>
                        <br>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-1">
                                <?php wpm_render_partial('fields/checkbox', 'admin', array('label' => __('[Войти в Telegram] MOBILE', 'mbl_admin'), 'name' => 'main_options[mbli3_telegram_mobile][enable_telegram_login]', 'value' => wpm_get_option('mbli3_telegram_mobile.enable_telegram_login') )) ?>
                            </div>
                            <div class="col-2">
                                <?php wpm_render_partial('fields/checkbox', 'admin', array('label' => __('Не отображать для незарегистрированых пользователей', 'mbl_admin'), 'name' => 'main_options[mbli3_telegram_mobile][telegram_login_for_unregistered]', 'value' => wpm_get_option('mbli3_telegram_mobile.telegram_login_for_unregistered') )) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <input type="text"
                                       name="main_options[mbli3_telegram_mobile][telegram_login_code]"
                                       value='<?php echo stripslashes(wpm_get_option('mbli3_telegram_mobile.telegram_login_code')); ?>'
                                       placeholder="<?php _e('Код', 'mbl_admin'); ?>"
                                       style="width: 100%;"
                                />
                            </div>
                            <div class="col-2" style="padding: 0 5px">
                                <input type="text"
                                       name="main_options[mbli3_telegram_mobile][telegram_exclude_url_1]"
                                       value='<?php echo wpm_get_option('mbli3_telegram_mobile.telegram_exclude_url_1'); ?>'
                                       placeholder="<?php _e('URL для исключения', 'mbl_admin'); ?>"
                                       style="width: 100%; margin-bottom: 5px"
                                       class="telegram_url_trim"
                                />
                                <input type="text"
                                       name="main_options[mbli3_telegram_mobile][telegram_exclude_url_2]"
                                       value='<?php echo wpm_get_option('mbli3_telegram_mobile.telegram_exclude_url_2'); ?>'
                                       placeholder="<?php _e('URL для исключения', 'mbl_admin'); ?>"
                                       style="width: 100%; margin-bottom: 5px"
                                       class="telegram_url_trim"
                                />
                                <input type="text"
                                       name="main_options[mbli3_telegram_mobile][telegram_exclude_url_3]"
                                       value='<?php echo wpm_get_option('mbli3_telegram_mobile.telegram_exclude_url_3'); ?>'
                                       placeholder="<?php _e('URL для исключения', 'mbl_admin'); ?>"
                                       style="width: 100%;"
                                       class="telegram_url_trim"
                                />
                            </div>
                        </div>
                        <br>
                        <hr>
                        <br>
                    </div>
                    <div class="row">
                        <div class="col-1">
							<?php wpm_render_partial('fields/checkbox', 'admin', array('label' => __('[Новости]', 'mbl_admin'), 'name' => 'main_options[mbli3_telegram][enable_telegram_news]', 'value' => wpm_get_option('mbli3_telegram.enable_telegram_news') )) ?>
                        </div>
                        <div class="col-2">
							<?php wpm_render_partial('fields/checkbox', 'admin', array('label' => __('Не отображать для незарегистрированых пользователей', 'mbl_admin'), 'name' => 'main_options[mbli3_telegram][telegram_news_for_unregistered]', 'value' => wpm_get_option('mbli3_telegram.telegram_news_for_unregistered') )) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1">
							<?php wpm_render_partial('options/text-row', 'admin', array('label' => __('Название пункта меню', 'mbl_admin'), 'key' => 'mbli3_telegram.telegram_news_name')) ?>
                        </div>
                        <div class="col-1">
                            <div class="wpm-control-row">
                                <label><?php _e('Код', 'mbl_admin'); ?>:<br>
                                    <input
                                            type="text"
                                            name="main_options[mbli3_telegram][telegram_news_code]"
                                            class="large-text"
                                            value='<?php echo stripslashes(wpm_get_option('mbli3_telegram.telegram_news_code')); ?>'
                                    >
                                </label>
                            </div>
                        </div>
                        <div class="col-1">
							<?php wpm_render_partial('options/text-row', 'admin', array('label' => __('URL', 'mbl_admin'), 'key' => 'mbli3_telegram.telegram_news_url')) ?>
                        </div>
                    </div>

                    <br>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-1">
							<?php wpm_render_partial('fields/checkbox', 'admin', array('label' => __('[Групповой чат]', 'mbl_admin'), 'name' => 'main_options[mbli3_telegram][enable_telegram_chat]', 'value' => wpm_get_option('mbli3_telegram.enable_telegram_chat') )) ?>
                        </div>
                        <div class="col-2">
							<?php wpm_render_partial('fields/checkbox', 'admin', array('label' => __('Не отображать для незарегистрированых пользователей', 'mbl_admin'), 'name' => 'main_options[mbli3_telegram][telegram_chat_for_unregistered]', 'value' => wpm_get_option('mbli3_telegram.telegram_chat_for_unregistered') )) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1">
							<?php wpm_render_partial('options/text-row', 'admin', array('label' => __('Название пункта меню', 'mbl_admin'), 'key' => 'mbli3_telegram.telegram_chat_name')) ?>
                        </div>
                        <div class="col-1">
                            <div class="wpm-control-row">
                                <label><?php _e('Код', 'mbl_admin'); ?>:<br>
                                    <input
                                            type="text"
                                            name="main_options[mbli3_telegram][telegram_chat_code]"
                                            class="large-text"
                                            value='<?php echo stripslashes(wpm_get_option('mbli3_telegram.telegram_chat_code')); ?>'
                                    >
                                </label>
                            </div>
                        </div>
                        <div class="col-1">
							<?php wpm_render_partial('options/text-row', 'admin', array('label' => __('URL', 'mbl_admin'), 'key' => 'mbli3_telegram.telegram_chat_url')) ?>
                        </div>
                    </div>

                    <br>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-1">
                            <?php wpm_render_partial('fields/checkbox', 'admin', array('label' => __('[Телеграм БОТ]', 'mbl_admin'), 'name' => 'main_options[mbli3_telegram][enable_telegram_bot]', 'value' => wpm_get_option('mbli3_telegram.enable_telegram_bot') )) ?>
                        </div>
                        <div class="col-2">
                            <?php wpm_render_partial('fields/checkbox', 'admin', array('label' => __('Не отображать для незарегистрированых пользователей', 'mbl_admin'), 'name' => 'main_options[mbli3_telegram][telegram_bot_for_unregistered]', 'value' => wpm_get_option('mbli3_telegram.telegram_bot_for_unregistered') )) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1">
							<?php wpm_render_partial('options/text-row', 'admin', array('label' => __('Название пункта меню', 'mbl_admin'), 'key' => 'mbli3_telegram.telegram_bot_name')) ?>
                        </div>
                        <div class="col-2">
                            <div class="wpm-control-row">
                                <label><?php _e('URL', 'mbl_admin'); ?>:<br>
                                    <input
                                            type="text"
                                            name="main_options[mbli3_telegram][telegram_bot_url]"
                                            class="large-text"
                                            value='<?php echo stripslashes(wpm_get_option('mbli3_telegram.telegram_bot_url')); ?>'
                                    >
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wpm-tab-footer">
                    <button type="submit" class="button button-primary wpm-save-options">Сохранить</button>
                    <span class="buttom-preloader"></span>
                </div>
            </div>

            <?php do_action('mbl_navpanel_options_tab_content'); ?>
        </div>
    </div>
</div>

<script>
    jQuery('.telegram_url_trim').on('change', function(){
        if(this.value[this.value.length-1] == '/') {
            this.value = this.value.slice(0, -1)
        }
    })
</script>
