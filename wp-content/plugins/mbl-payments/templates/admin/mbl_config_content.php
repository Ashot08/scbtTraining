<div id="tab-mblp" class="tab mpp-color-content">
    <div class="wpm-tab-content">
        <div class="wpm-inner-tabs" tab-id="h-tabs-7">
            <ul class="wpm-inner-tabs-nav">
                <li><a href="#mbl_inner_tab_mblp_1"><?php _e('Поля формы оплаты', 'mbl_admin') ?></a></li>
                <li><a href="#mbl_inner_tab_mblp_2"><?php _e('Письма уведомлений', 'mbl_admin') ?></a></li>
                <li><a href="#mbl_inner_tab_mblp_3"><?php _e('Активация', 'mbl_admin') ?></a></li>
                <li><a href="#mbl_inner_tab_mblp_4"><?php _e('Дизайн корзины', 'mbl_admin') ?></a></li>
                <li><a href="#mbl_inner_tab_mblp_5"><?php _e('Тексты', 'mbl_admin') ?></a></li>
                <li><a href="#mbl_inner_tab_mblp_6"><?php _e('Назад', 'mbl_admin') ?></a></li>
                <li><a href="#mbl_inner_tab_mblp_7"><?php _e('Страница оформления заказа', 'mbl_admin') ?></a></li>
                
                <?php do_action('mblp_after_settings_tab'); ?>
            </ul>
            <div id="mbl_inner_tab_mblp_1" class="wpm-tab-content">
                <div id="tabs-level-3-1-mblp"
                     tab-id="headers-tabs-fields"
                     class="tabs-level-3 headers-design-tabs wpm-inner-tabs-nav">
                    <ul>
                        <li class="ui-state-default ui-state-disabled" header-id="new_clients">
                            <a href='#header-tab-mblp-1-new-clients'><?php _e('Новые клиенты', 'mbl_admin') ?></a>
                        </li>
                        <li class="ui-state-default" header-id="existing_clients">
                            <a href='#header-tab-mblp-1-existing-clients'><?php _e('Уже существующие', 'mbl_admin') ?></a>
                        </li>
                    </ul>

                    <?php mblp_render_partial('options/fields/new_clients', 'admin', compact('main_options', 'design_options')) ?>
                    <?php mblp_render_partial('options/fields/existing_clients', 'admin', compact('main_options', 'design_options')) ?>

                    <?php wpm_render_partial('settings-save-button', 'common'); ?>
                </div>
            </div>
            <div id="mbl_inner_tab_mblp_2" class="wpm-tab-content">
                <div id="tabs-level-3-2-mblp"
                     tab-id="headers-tabs-mails"
                     class="tabs-level-3 headers-design-tabs wpm-inner-tabs-nav">
                    <ul>
                        <li class="ui-state-default ui-state-disabled" header-id="mails_admin">
                            <a href='#header-tab-mblp-2-admin'><?php _e('Администратору', 'mbl_admin') ?></a>
                        </li>
                        <li class="ui-state-default ui-state-disabled" header-id="mails_clients">
                            <a href='#header-tab-mblp-2-clients'><?php _e('Kлиентам', 'mbl_admin') ?></a>
                        </li>
                    </ul>

                    <?php mblp_render_partial('options/mails/admin', 'admin', compact('main_options', 'design_options')) ?>
                    <?php mblp_render_partial('options/mails/clients', 'admin', compact('main_options', 'design_options')) ?>

                    <?php wpm_render_partial('settings-save-button', 'common'); ?>
                </div>
            </div>
            <div id="mbl_inner_tab_mblp_3" class="wpm-tab-content">
                <?php mblp_render_partial('options/activation', 'admin', compact('main_options', 'design_options')) ?>

                <?php wpm_render_partial('settings-save-button', 'common'); ?>
            </div>
            <div id="mbl_inner_tab_mblp_4" class="wpm-tab-content">
                <div id="tabs-level-3-4-mblp"
                     tab-id="headers-tabs-cart-desing"
                     class="tabs-level-3 headers-design-tabs wpm-inner-tabs-nav">
                    <ul>
                        <li class="ui-state-default ui-state-disabled" header-id="cart_design_icon">
                            <a href='#header-tab-mblp-4-icon'><?php _e('Иконка', 'mbl_admin') ?></a>
                        </li>
                        <li class="ui-state-default ui-state-disabled" header-id="cart_design_buttons">
                            <a href='#header-tab-mblp-4-buttons'><?php _e('Кнопки', 'mbl_admin') ?></a>
                        </li>
                        <li class="ui-state-default ui-state-disabled" header-id="cart_design_product_titles">
                            <a href='#header-tab-mblp-4-product-titles'><?php _e('Заголовки товара', 'mbl_admin') ?></a>
                        </li>
                        <li class="ui-state-default ui-state-disabled" header-id="cart_design_product_content">
                            <a href='#header-tab-mblp-4-product-content'><?php _e('Контент товара', 'mbl_admin') ?></a>
                        </li>
                        <li class="ui-state-default ui-state-disabled" header-id="cart_design_upsells">
                            <a href='#header-tab-mblp-4-upsells'><?php _e('Апселы', 'mbl_admin') ?></a>
                        </li>
                    </ul>

                    <?php mblp_render_partial('options/design/icon', 'admin', compact('main_options', 'design_options')) ?>
                    <?php mblp_render_partial('options/design/buttons', 'admin', compact('main_options', 'design_options')) ?>
                    <?php mblp_render_partial('options/design/product-titles', 'admin', compact('main_options', 'design_options')) ?>
                    <?php mblp_render_partial('options/design/product-content', 'admin', compact('main_options', 'design_options')) ?>
                    <?php mblp_render_partial('options/design/upsells', 'admin', compact('main_options', 'design_options')) ?>

                    <?php wpm_render_partial('settings-save-button', 'common'); ?>
                </div>
            </div>
            <div id="mbl_inner_tab_mblp_5" class="wpm-tab-content">
                <div id="tabs-level-3-5-mblp"
                     tab-id="headers-tabs-cart-texts"
                     class="tabs-level-3 headers-design-tabs wpm-inner-tabs-nav">
                    <ul>
                        <li class="ui-state-default ui-state-disabled" header-id="cart_text_buttons">
                            <a href='#header-tab-mblp-5-buttons'><?php _e('Кнопки', 'mbl_admin') ?></a>
                        </li>
                        <li class="ui-state-default ui-state-disabled" header-id="cart_text_description">
                            <a href='#header-tab-mblp-5-description'><?php _e('Описание товара', 'mbl_admin') ?></a>
                        </li>
                        <li class="ui-state-default ui-state-disabled" header-id="cart_text_cart">
                            <a href='#header-tab-mblp-5-cart'><?php _e('Корзина', 'mbl_admin') ?></a>
                        </li>
                        <li class="ui-state-default ui-state-disabled" header-id="cart_text_upsells">
                            <a href='#header-tab-mblp-5-upsells'><?php _e('Апселы', 'mbl_admin') ?></a>
                        </li>
                        <li class="ui-state-default ui-state-disabled" header-id="cart_text_errors">
                            <a href='#header-tab-mblp-5-errors'><?php _e('Тексты ошибок', 'mbl_admin') ?></a>
                        </li>
                        <li class="ui-state-default ui-state-disabled" header-id="cart_design_offer">
                            <a href='#header-tab-mblp-4-offer'><?php _e('Оферта', 'mbl_admin') ?></a>
                        </li>
                        
                        <?php do_action('mblp_texts_tabs'); ?>
                    </ul>

                    <?php mblp_render_partial('options/texts/buttons', 'admin', compact('main_options', 'design_options')) ?>
                    <?php mblp_render_partial('options/texts/description', 'admin', compact('main_options', 'design_options')) ?>
                    <?php mblp_render_partial('options/texts/cart', 'admin', compact('main_options', 'design_options')) ?>
                    <?php mblp_render_partial('options/texts/upsells', 'admin', compact('main_options', 'design_options')) ?>
                    <?php mblp_render_partial('options/texts/errors', 'admin', compact('main_options', 'design_options')) ?>
                    <?php mblp_render_partial('options/texts/offer', 'admin', compact('main_options', 'design_options')) ?>
	
					<?php do_action('mblp_texts_content'); ?>
                    <?php wpm_render_partial('settings-save-button', 'common'); ?>
                </div>
            </div>
            <div id="mbl_inner_tab_mblp_6" class="wpm-tab-content">
                <h4><?php _e('Возвращать пользователя по кнопке "Продолжить покупки":', 'mbl_admin'); ?></h4>
                
                <div class="wpm-row">
                    <label style="margin-bottom: 5px; display: inline-block;">
                        <input type="radio"
                               name="main_options[mblp][back_redirect_page]"
                               value="homepage"
							   <?php echo MBLPAdmin::isOptionHomepage() ? ' checked' : ''; ?>
                        />
						<?php _e('Стартовая страница', 'mbl_admin'); ?>
                    </label>
                    <br>
                    <?php if( defined('MKK_VERSION') ) { ?>
                            <label>
                                <input type="radio"
                                       name="main_options[mblp][back_redirect_page]"
                                       value="shop"
                                    <?php echo wpm_option_is('mblp.back_redirect_page', 'shop', 'homepage') ? ' checked' : ''; ?>
                                />
                                <?php _e('Каталог курсов', 'mbl_admin'); ?>
                            </label>
                            <br>
                        <?php } ?>
                    
                    <label>
                        <input type="radio"
                               name="main_options[mblp][back_redirect_page]"
                               value="custom"
							   <?php echo wpm_option_is('mblp.back_redirect_page', 'custom', 'homepage') ? ' checked' : ''; ?>
                        />
						<?php _e('Пользовательский URL: ', 'mbl_admin'); ?>
                        
                        <input type="text" name="main_options[mblp][back_redirect_page_link]" value="<?php echo wpm_get_option('mblp.back_redirect_page_link', '')?>" >
                    </label>
                    <br>
                    <label>
                        <input type="radio"
                               name="main_options[mblp][back_redirect_page]"
                               value="previous"
							<?php echo wpm_option_is('mblp.back_redirect_page', 'previous', 'homepage') ? ' checked' : ''; ?>
                        />
						<?php _e('Предыдущая страница', 'mbl_admin'); ?>
                    </label>
                </div>
                
                <?php wpm_render_partial('settings-save-button', 'common'); ?>
            </div>
            <div id="mbl_inner_tab_mblp_7" class="wpm-tab-content">
                <?php wpm_render_partial('options/checkbox-row', 'admin', ['label' => __('Зафиксировать ширину страницы в размере 460px', 'mbl_admin'), 'key' => 'mblp.narrow_checkout']) ?>
                
                <?php wpm_render_partial('settings-save-button', 'common'); ?>
            </div>
            
            <?php do_action('mblp_after_settings_content'); ?>
        </div>
    </div>
</div>