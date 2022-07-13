<script>
    jQuery(function ($) {

        $('.wpm-inner-accordion').accordion({
            heightStyle : 'content'
        });

        // Upload media file ====================================
        var wpm_file_frame;
        var image_id = '';
        $(document).on('click', '.wpm-media-upload-button', function (event) {
            image_id = $(this).attr('data-id');

            event.preventDefault();

            // If the media frame already exists, reopen it.
            if (wpm_file_frame) {
                wpm_file_frame.open();
                return;
            }

            // Create the media frame.
            wpm_file_frame = wp.media.frames.downloadable_file = wp.media({
                title    : '<?php _e('Выберите файл', 'wpm'); ?>',
                button   : {
                    text : '<?php _e('Использовать изображение', 'wpm'); ?>'
                },
                multiple : false
            });

            // When an image is selected, run a callback.
            wpm_file_frame.on('select', function () {
                var attachment = wpm_file_frame.state().get('selection').first().toJSON();
                // console.log(attachment);
                $('input#wpm_' + image_id).val(attachment.url);
                if($('input#wpm_' + image_id + '_original').length) {
                    $('input#wpm_' + image_id + '_original').val(attachment.url);
                }
                $('#wpm-' + image_id + '-preview').attr('src', attachment.url).show();
                $('#delete-wpm-' + image_id).show();


            });
            // Finally, open the modal.
            wpm_file_frame.open();
        });
        $(document).on('click', '.wpm-delete-media-button', function () {
            image_id = $(this).attr('data-id');
            $('input#wpm_' + image_id).val('');
            if($('input#wpm_' + image_id + '_original').length) {
                $('input#wpm_' + image_id + '_original').val('');
            }
            $('#delete-wpm-' + image_id).hide();
            $('#wpm-' + image_id + '-preview').hide();
        });

        //--------
        $('.reset-options').click(function () {
            var notification = $(this).next('.message');
            notification.html('');
            var do_reset = confirm("<?php _e('Вы действительно хотите сбросить настройки?'); ?>");
            if (do_reset) {
                $.ajax({
                    type    : 'POST',
                    url     : ajaxurl,
                    data    : {
                        action      : "wpm_reset_options_to_default_action",
                        option_type : $(this).attr('data-type')
                    },
                    success : function (data) {
                        if (!data.error) {
                            notification.html(data.message);
                            setTimeout(function () {
                                location.reload()
                            }, 1000);
                        } else {
                            notification.html('Настройки не сброшены');
                        }

                    }
                });
            }
        });

        $(document).on('click', '#wpm_text_protection_chbx', function () {
            $('.wpm-protection-exceptions').fadeToggle('fast');
        });

    });
</script>
<div class="wrap wpm-options-page">
    <div id="icon-options-general" class="icon32"></div>
    <div class="wpm-admin-page-header">
        <h2>Настройки</h2>
    </div>
    <?php
    $default_design_options = get_option('wpm_design_options_default');
    ?>
    <form name="wpm-settings-form" method="post" action="">
        <div class="options-wrap wpm-ui-wrap">
            <div id="wpm-options-tabs" tab-id="vertical-menu-1" class="wpm-tabs wpm-tabs-vertical">
                <ul class="tabs-nav">
                    <li><a href="#tab-9">Общие</a></li>
                    <li><a href="#tab-1">Стартовая</a></li>
                    <li><a href="#tab-2">Логотип, favicon</a></li>
                    <li><a href="#tab-3">Дизайн</a></li>
                    <li><a href="#tab-6">Письма</a></li>
                    <li><a href="#tab-7">Аудио</a></li>
                    <li><a href="#tab-10">Страница входа</a></li>
                    <li><a href="#tab-11">Автоподписки</a></li>
                    <li><a href="#tab-12">Защита</a></li>
                    <li><a href="#tab-13">Регистрация</a></li>
                    <li><a href="#tab-14">Массовые операции</a></li>
                </ul>
                <div id="tab-9" class="tab">
                    <div class="wpm-tab-content">

                        <div class="wpm-inner-tabs" tab-id="h-tabs-1">
                            <ul class="wpm-inner-tabs-nav">
                                <li>
                                    <a href="#wpm_inner_tab_9_8"><?php _e('Версия интерфейса', 'wpm'); ?></a>
                                </li>
                                <li>
                                    <a href="#wpm_inner_tab_9_1"><?php _e('Снять блокировку', 'wpm'); ?></a>
                                </li>
                                <li>
                                    <a href="#wpm_inner_tab_9_2"><?php _e('Количество материалов', 'wpm'); ?></a>
                                </li>
                                <li>
                                    <a href="#wpm_inner_tab_9_3"><?php _e('Задать вопрос', 'wpm'); ?></a>
                                </li>
                                <li>
                                    <a href="#wpm_inner_tab_9_4"><?php _e('Домашние задания', 'wpm'); ?></a>
                                </li>
                                <li>
                                    <a href="#wpm_inner_tab_9_5"><?php _e('Комментарии', 'wpm'); ?></a>
                                </li>
                                <li>
                                    <a href="#wpm_inner_tab_9_6"><?php _e('Дата', 'wpm'); ?></a>
                                </li>
                            </ul>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_9_8">
                                <?php wpm_render_partial('settings-interface', 'common'); ?>
                            </div>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_9_1">
                                <div class="wpm-row">
                                    <label><input type="checkbox"
                                                  name="main_options[main][opened]"<?php if ($main_options['main']['opened'] == true) echo 'checked'; ?> >Снять
                                        блокировку<br>
                                    </label>

                                    <p>
                                        <label><input type="checkbox"
                                                      name="main_options[main][hide_ask_for_not_registered]"
                                                <?php echo (array_key_exists('hide_ask_for_not_registered', $main_options['main']) && $main_options['main']['hide_ask_for_not_registered'] == 'on') ? ' checked' : ''; ?>>
                                            Не отображать "Задать вопрос" для незарегистрированных
                                            пользователей</label>
                                    </p>
                                </div>

                                <?php wpm_render_partial('settings-save-button', 'common'); ?>
                            </div>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_9_2">
                                <div class="wpm-row">
                                    <label>Сколько материалов отображать на одной странице?<br>
                                        <input type="number" name="main_options[main][posts_per_page]"
                                               value="<?php echo $main_options['main']['posts_per_page']; ?>"
                                               size="3"
                                               maxlength="3">
                                    </label>

                                    <div class="wpm-help-wrap">
                                        <p>(-1) показать все материалы на одной странице</p>
                                    </div>
                                </div>

                                <?php wpm_render_partial('settings-save-button', 'common'); ?>
                            </div>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_9_3">
                                <div class="wpm-row">
                                    <label>
                                        <?php if (array_key_exists('hide_ask', $main_options['main']) && $main_options['main']['hide_ask'] == 'hide') { ?>
                                            <input type="checkbox" name="main_options[main][hide_ask]" value="hide"
                                                   checked="checked">
                                            <?php
                                        } else { ?>
                                            <input type="checkbox" name="main_options[main][hide_ask]" value="hide">
                                        <?php } ?>

                                        Не отображать</label>
                                </div>
                                <div class="wpm-row">
                                    <?php if (empty($main_options['main']['ask_email'])) $main_options['main']['ask_email'] = get_option('admin_email'); ?>
                                    <label>Емейл для получения вопросов от пользователя.<br>
                                        <input type="text" name="main_options[main][ask_email]"
                                               value="<?php echo $main_options['main']['ask_email']; ?>">
                                    </label>
                                </div>

                                <?php wpm_render_partial('settings-save-button', 'common'); ?>
                            </div>

                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_9_4">
                                <div class="wpm-row">
                                    <dl>
                                        <dt><?php _e('Выберите порядок сортировки комментариев к домашним заданиям:', 'wpm'); ?></dt>
                                        <dd>
                                            <label for="comments_order_asc">
                                                <input type="radio" name="main_options[main][comments_order]"
                                                       id="comments_order_asc"
                                                       value="asc" <?php echo ($main_options['main']['comments_order'] == 'asc' || !$main_options['main']['comments_order']) ? 'checked' : ''; ?> />
                                                <?php _e('От более ранних к более поздним', 'wpm'); ?>
                                            </label>
                                        </dd>
                                        <dd>
                                            <label for="comments_order_desc">
                                                <input type="radio" name="main_options[main][comments_order]"
                                                       id="comments_order_desc"
                                                       value="desc" <?php echo $main_options['main']['comments_order'] == 'desc' ? 'checked' : ''; ?> />
                                                <?php _e('От более поздних до более ранних', 'wpm'); ?>
                                            </label>
                                        </dd>
                                    </dl>
                                </div>

                                <?php wpm_render_partial('settings-save-button', 'common'); ?>
                            </div>

                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_9_5">
                                <div class="wpm-row">
                                    <div class="wpm-control-row">
                                        <p><b>Тип комментариев:</b></p>
                                    </div>
                                    <label>
                                        <input type="radio"
                                               class="wpm_comments_mode"
                                               name="main_options[main][comments_mode]"
                                               value="standard" <?php if (!wpm_option_is('main.comments_mode', 'cackle')) echo 'checked'; ?>> <?php _e('Стандартные', 'wpm'); ?>
                                    </label><br/><br/>
                                    <label>
                                        <input type="radio"
                                               class="wpm_comments_mode"
                                               name="main_options[main][comments_mode]"
                                               value="cackle" <?php if (wpm_option_is('main.comments_mode', 'cackle')) echo 'checked'; ?>> <?php _e('Cackle', 'wpm'); ?>
                                    </label>
                                </div>
                                <div class="wpm-row wpm-comment-cackle-row" <?php if (!wpm_option_is('main.comments_mode', 'cackle')) echo 'style="display:none;"'; ?>>
                                    <div class="wpm-control-row">
                                        <p><b>ID сайта Cackle:</b></p>
                                    </div>

                                    <input type="text"
                                               name="main_options[main][cackle_id]"
                                               id="cackle_id"
                                               value="<?php echo wpm_get_option('main.cackle_id'); ?>"/>

                                    <br>
                                    <br>
                                    <label>
                                        <input type="checkbox"
                                               name="main_options[main][cackle_auto_update]"
                                            <?php echo wpm_option_is('main.cackle_auto_update', 'on') ? ' checked' : ''; ?> >
                                        Автообновление комментариев<br/>
                                    </label>

                                </div>
                                <div class="wpm-row wpm-comment-images-row" <?php if (wpm_option_is('main.comments_mode', 'cackle')) echo 'style="display:none;"'; ?>>
                                    <div class="wpm-control-row">
                                        <p><b>Загрузка изображений:</b></p>
                                    </div>

                                    <?php $attachments_mode = array_key_exists('attachments_mode', $main_options['main']) ? $main_options['main']['attachments_mode'] : 'allowed_to_all'; ?>

                                    <label>
                                        <input type="radio"
                                               name="main_options[main][attachments_mode]"
                                               value="allowed_to_all" <?php if ($attachments_mode == 'allowed_to_all') echo 'checked'; ?>> <?php _e('Доступна всем', 'wpm'); ?>
                                    </label><br/><br/>
                                    <label>
                                        <input type="radio"
                                               name="main_options[main][attachments_mode]"
                                               value="allowed_to_admin" <?php if ($attachments_mode == 'allowed_to_admin') echo 'checked'; ?>> <?php _e('Доступна только администратору', 'wpm'); ?>
                                    </label><br/><br/>
                                    <label>
                                        <input type="radio"
                                               name="main_options[main][attachments_mode]"
                                               value="disabled" <?php if ($attachments_mode == 'disabled') echo 'checked'; ?>> <?php _e('Не доступна', 'wpm'); ?>
                                    </label>

                                </div>

                                <div class="wpm-row">
                                    <div class="wpm-control-row">
                                        <p><b>Видимость комментариев:</b></p>
                                    </div>

                                    <?php $visibility = array_key_exists('visibility', $main_options['main']) ? $main_options['main']['visibility'] : 'to_all'; ?>

                                    <label>
                                        <input type="radio"
                                               name="main_options[main][visibility]"
                                               value="to_all" <?php if ($visibility == 'to_all') echo 'checked'; ?>> <?php _e('Показывать всем', 'wpm'); ?>
                                    </label><br/><br/>
                                    <label>
                                        <input type="radio"
                                               name="main_options[main][visibility]"
                                               value="to_registered" <?php if ($visibility == 'to_registered') echo 'checked'; ?>> <?php _e('Только зарегистрированным пользователям', 'wpm'); ?>
                                    </label>
                                </div>

                                <?php wpm_render_partial('settings-save-button', 'common'); ?>
                            </div>

                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_9_6">
                                <div class="wpm-row">
                                    <label>
                                        <input type="checkbox"
                                               name="main_options[main][date_is_hidden]"
                                            <?php echo (array_key_exists('date_is_hidden', $main_options['main']) && $main_options['main']['date_is_hidden'] == 'on') ? ' checked' : ''; ?> >
                                        Скрыть даты материалов<br/>
                                    </label>
                                </div>

                                <?php wpm_render_partial('settings-save-button', 'common'); ?>
                            </div>
                            <!--<div class="wpm-inner-tab-content" id="wpm_inner_tab_9_7">
                <div class="wpm-row">
                    <label>
                        <input type="checkbox"
                               name="main_options[main][disable_ajax]"
                            <?php echo (array_key_exists('disable_ajax', $main_options['main']) && $main_options['main']['disable_ajax'] == 'on') ? ' checked' : ''; ?> >
                        Отключить AJAX на страницах рубрик<br />
                    </label>
                </div>

                <div class="wpm-tab-footer">
                    <button type="submit"
                            class="button button-primary wpm-save-options"><?php _e('Сохранить', 'wpm'); ?></button>
                </div>
            </div>-->
                        </div>


                    </div>
                </div>
                <div id="tab-1" class="tab">
                    <div class="wpm-tab-content">
                        Стартовая страница:
                        <?php
                        $start_page = '';
                        $args = array(
                            'post_type' => 'wpm-page',
                            'nopaging' => true
                        );
                        $wpm_pages = new WP_Query($args);
                        $plain_levels = get_terms('wpm-levels', array());
                        $wpm_pages_select = '';
                        if ($wpm_pages->have_posts()): while ($wpm_pages->have_posts()): $wpm_pages->the_post();

                            $selected = '';
                            if ($main_options['home_id'] == get_the_ID()) {
                                $selected = 'selected';
                                $start_page = get_permalink();
                            }
                            $wpm_pages_select .= '<option value="' . get_the_ID() . '" ' . $selected . '>' . get_the_title() . '</option>';
                        endwhile;
                            $wpm_pages_select = '<select name="main_options[home_id]">' . $wpm_pages_select . '</select>';
                        endif;
                        echo $wpm_pages_select;
                        ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <label>
                            <?php
                            if ($main_options['make_home_start']) {
                                ?>
                                <input type="checkbox" name="main_options[make_home_start]" checked>
                            <?php } else { ?>
                                <input type="checkbox" name="main_options[make_home_start]">
                            <?php } ?>
                            <?php _e('Сделать главной страницей сайта', 'wpm'); ?>
                        </label>
                        <br>

                        <div class="wpm-row">
                            <label>
                                <?php _e('Стартовая страница', 'wpm'); ?>
                            </label><br>

                            <div class="code">
                                <?php echo utf8_encode($start_page); ?>
                            </div>
                            <label>
                                <?php _e('Страница входа пользователя', 'wpm'); ?>
                            </label><br>

                            <div class="code">
                                <?php echo utf8_encode($start_page); ?>#login
                            </div>
                            <label>
                                <?php _e('Страница регистрации пользователя', 'wpm'); ?>
                            </label><br>

                            <div class="code">
                                <?php echo utf8_encode($start_page); ?>#registration
                            </div>
                            <label>
                                <?php _e('Раздача пин-кодов', 'wpm'); ?>
                            </label><br>

                            <div class="code">
                                <?php //echo wpm_get_pin_code_page_url(); ?>
                                <div class="wpm-row">
                                    <label class="pin-code-label">
                                        <input type="hidden" name="main_options[pincode_page][generate]" value="off"/>
                                        <input type="checkbox"
                                               name="main_options[pincode_page][generate]"
                                            <?php echo wpm_option_is('pincode_page.generate', 'on') ? 'checked' : ''; ?>>
                                        <?php _e('Включить генерацию', 'wpm'); ?>
                                    </label>
                                </div>

                                <div class="wpm-row">
                                    <label class="pin-code-label">
                                        <?php _e('Название ссылки', 'wpm'); ?><br>
                                        <input type="text"
                                               name="main_options[pincode_page][link_name]"
                                               value="<?php echo wpm_get_option('pincode_page.link_name', __('Генерировать', 'wpm')); ?>">
                                    </label>
                                </div>

                                <div class="code">
                                    <label>
                                        <?php _e('Выберите уровень доступа', 'wpm'); ?>
                                    </label>

                                    <div>
                                        <select id="send_term_key_lvl" name="main_options[pincode_page][lvl]"
                                                onchange="changeLinkedList(this, '#send_term_key')">
                                            <option value=""></option>
                                            <?php foreach ($plain_levels AS $level) : ?>
                                                <option
                                                    value="<?php echo $level->term_id; ?>"
                                                    <?php echo wpm_is_pin_code_page_lvl($level->term_id) ? 'selected="selected"' : '' ?>
                                                ><?php echo $level->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <br/>
                                    <label>
                                        <?php _e('Выберите код доступа', 'wpm'); ?>
                                    </label>

                                    <div>
                                        <select id="send_term_key" name="main_options[pincode_page][term_key]">
                                            <option value=""></option>
                                        </select>
                                        <select id="send_term_key_src" name="term_key_src" style="display: none">
                                            <option value=""></option>
                                            <?php echo wpm_get_term_keys_options_for_pin_code_page($plain_levels); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            function changeLinkedList(main, linked) {
                                var $ = jQuery,
                                    val = $(main).val(),
                                    linkedSrc,
                                    options;

                                linked = $(linked);

                                if (linked.length) {
                                    linkedSrc = $('#' + linked.attr('id') + '_src');
                                    options = linkedSrc.find('option');

                                    if (val != '') {
                                        linked.prop('disabled', false);
                                        if (linked.data('empty') == '1') {
                                            linked.html('<option value=""></option>');
                                        } else {
                                            linked.html('');
                                        }
                                        options
                                            .filter(function () {
                                                return $(this).data('main') == val;
                                            })
                                            .clone()
                                            .appendTo(linked);
                                    } else {
                                        linked.prop('disabled', true);
                                    }
                                }
                            }

                            jQuery(function () {
                                changeLinkedList('#send_term_key_lvl', '#send_term_key');
                            });
                        </script>
                        <div class="wpm-row">
                            Расписание:
                            <?php
                            $schedule_page = '';
                            $args = array(
                                'post_type' => 'wpm-page',
                                'nopaging' => true
                            );
                            $wpm_pages = new WP_Query($args);
                            $wpm_pages_select = '';
                            if ($main_options['schedule_id'] == 'no') {
                                $wpm_pages_select .= '<option value="no" selected>' . __("-- Не задано --", "wpm") . '</option>';
                            } else {
                                $wpm_pages_select .= '<option value="no">' . __("-- Не задано --", "wpm") . '</option>';
                            }
                            if ($wpm_pages->have_posts()): while ($wpm_pages->have_posts()): $wpm_pages->the_post();
                                $selected = '';
                                if ($main_options['schedule_id'] == get_the_ID()) {
                                    $selected = 'selected';
                                    $schedule_page = get_the_permalink();
                                }
                                $wpm_pages_select .= '<option value="' . get_the_ID() . '" ' . $selected . '>' . get_the_title() . '</option>';
                            endwhile;
                                $wpm_pages_select = '<select name="main_options[schedule_id]">' . $wpm_pages_select . '</select>';
                            endif;
                            echo $wpm_pages_select;
                            ?>
                        </div>

                        <div class="wpm-row">
                            <label>
                                <input type="hidden" name="main_options[hide_schedule]" value="off"/>
                                <input type="checkbox"
                                       name="main_options[hide_schedule]"
                                    <?php echo (array_key_exists('hide_schedule', $main_options) && $main_options['hide_schedule'] == 'on') ? 'checked' : ''; ?>>
                                <?php _e('Спрятать расписание', 'wpm'); ?>
                            </label>
                        </div>

                        <div class="wpm-tab-footer">
                            <button type="submit"
                                    class="button button-primary wpm-save-options"><?php _e('Сохранить', 'wpm'); ?></button>
                            <span class="buttom-preloader"></span>
                        </div>
                    </div>
                </div>
                <div id="tab-2" class="tab">
                    <div class="wpm-tab-content">
                        <label>Логотип<br>
                            <input type="hidden" id="wpm_logo" name="main_options[logo][url]"
                                   value="<?php echo $main_options['logo']['url']; ?>"
                                   class="wide"></label>

                        <div class="wpm-control-row">
                            <p>
                                <button type="button" class="wpm-media-upload-button button"
                                        data-id="logo"><?php _e('Загрузить', 'wpm'); ?></button>
                                &nbsp;&nbsp; <a id="delete-wpm-logo"
                                                class="wpm-delete-media-button button submit-delete"
                                                data-id="logo"><?php _e('Удалить', 'wpm'); ?></a>
                            </p>
                        </div>
                        <div class="wpm-logo-preview-wrap">
                            <div class="wpm-logo-preview-box">
                                <img src="<?php echo wpm_remove_protocol($main_options['logo']['url']); ?>" title="" alt=""
                                     id="wpm-logo-preview">
                            </div>
                        </div>

                        <label>Favicon<br>
                            <input type="hidden" id="wpm_favicon" name="main_options[favicon][url]"
                                   value="<?php echo $main_options['favicon']['url']; ?>" class="wide"></label>

                        <div class="wpm-control-row">
                            <p>
                                <button type="button" class="wpm-media-upload-button button"
                                        data-id="favicon"><?php _e('Загрузить', 'wpm'); ?></button>
                                &nbsp;&nbsp; <a id="delete-wpm-favicon"
                                                class="wpm-delete-media-button button submit-delete"
                                                data-id="favicon"><?php _e('Удалить', 'wpm'); ?></a>
                            </p>
                        </div>
                        <div class="wpm-favicon-preview-wrap">
                            <div class="wpm-favicon-preview-box">
                                <img src="<?php echo $main_options['favicon']['url']; ?>" title="" alt=""
                                     id="wpm-favicon-preview">
                            </div>
                        </div>

                        <div class="wpm-tab-footer">
                            <button type="submit"
                                    class="button button-primary wpm-save-options"><?php _e('Сохранить', 'wpm'); ?></button>
                            <span class="buttom-preloader"></span>
                        </div>

                    </div>
                </div>
                <div id="tab-3" class="tab">
                    <div class="wpm-tab-content">

                        <div class="wpm-inner-tabs" tab-id="h-tabs-2">
                            <ul class="wpm-inner-tabs-nav">
                                <li><a href="#wpm_inner_tab_3_1"><?php _e('Фон', 'wpm'); ?></a></li>
                                <li><a href="#wpm_inner_tab_3_2"><?php _e('Материалы', 'wpm'); ?></a></li>
                                <li><a href="#wpm_inner_tab_3_10"><?php _e('Шапка материала', 'wpm'); ?></a></li>
                                <li><a href="#wpm_inner_tab_3_3"><?php _e('Меню', 'wpm'); ?></a></li>
                                <li><a href="#wpm_inner_tab_3_4"><?php _e('Кнопки', 'wpm'); ?></a></li>
                                <li><a href="#wpm_inner_tab_3_5"><?php _e('Прелоадер', 'wpm'); ?></a></li>
                                <li><a href="#wpm_inner_tab_3_6"><?php _e('Шапка', 'wpm'); ?></a></li>
                                <li><a href="#wpm_inner_tab_3_7"><?php _e('Подвал', 'wpm'); ?></a></li>
                                <li><a href="#wpm_inner_tab_3_9"><?php _e('Скрипты', 'wpm'); ?></a></li>
                                <li><a href="#wpm_inner_tab_3_8"><?php _e('Знач. по умолчанию', 'wpm'); ?></a></li>
                            </ul>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_3_1">
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет фона', 'wpm'); ?><br>
                                        <input type="text" name="design_options[main][background_color]"
                                               class="color"
                                               value="<?php echo $design_options['main']['background_color']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Фоновое изображение', 'wpm'); ?><br>
                                        <input type="text" id="wpm_background"
                                               name="design_options[main][background_image][url]"
                                               value="<?php echo $design_options['main']['background_image']['url']; ?>"
                                               class="wide"></label>

                                    <div class="wpm-control-row upload-image-row">
                                        <p>
                                            <button type="button" class="wpm-media-upload-button button"
                                                    data-id="background"><?php _e('Загрузить', 'wpm'); ?></button>
                                            &nbsp;&nbsp; <a id="delete-wpm-background"
                                                            class="wpm-delete-media-button button submit-delete"
                                                            data-id="background"><?php _e('Удалить', 'wpm'); ?></a>
                                        </p>
                                    </div>
                                    <div class="wpm-background-preview-wrap">
                                        <div class="wpm-background-preview-box preview-box">
                                            <img
                                                src="<?php echo wpm_remove_protocol($design_options['main']['background_image']['url']); ?>"
                                                title="" alt=""
                                                id="wpm-background-preview">
                                        </div>
                                    </div>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Выравнивание изображения', 'wpm'); ?></label><br>
                                    <?php
                                    $background_position = array(
                                        'left top' => 'сверху слева',
                                        'right top' => 'сверху справа',
                                        'center top' => 'сверху по центру',
                                        'left bottom' => 'снизу слева',
                                        'right bottom' => 'снизу справа',
                                        'center bottom' => 'снизу по центру'
                                    );
                                    $html = '';
                                    foreach ($background_position as $key => $value) {
                                        if ($design_options['main']['background_image']['position'] == $key)
                                            $html .= "<option value='$key' selected>$value</option>";
                                        else
                                            $html .= "<option value='$key'>$value</option>";
                                    }
                                    $html = '<select name="design_options[main][background_image][position]">' . $html . '</select>';
                                    echo $html;
                                    ?>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Повторение изображения', 'wpm'); ?></label><br>
                                    <?php
                                    $background_repeat = array(
                                        'no-repeat' => 'не повторять',
                                        'repeat' => 'повторять',
                                        'repeat-x' => 'повторять по горизонтали',
                                        'repeat-y' => 'повторять по вертикали'
                                    );
                                    $html = '';
                                    foreach ($background_repeat as $key => $value) {
                                        if ($design_options['main']['background_image']['repeat'] == $key)
                                            $html .= "<option value='$key' selected>$value</option>";
                                        else
                                            $html .= "<option value='$key'>$value</option>";
                                    }
                                    $html = '<select name="design_options[main][background_image][repeat]">' . $html . '</select>';
                                    echo $html;
                                    ?>
                                </div>
                                <br/>

                                <div class="wpm-control-row">
                                    <label><input type="checkbox"
                                                  name="design_options[main][background-attachment-fixed]" <?php echo $design_options['main']['background-attachment-fixed'] == 'on' ? 'checked' : ''; ?> >
                                        &nbsp;<?php _e('Зафиксировать фон', 'wpm'); ?>
                                    </label><br>
                                </div>

                                <div class="wpm-control-row"><br>
                                    <label><?php _e('Закругление углов', 'wpm'); ?></label><br>
                                    <?php $border_radius = array_key_exists('border-radius', $design_options['main']) ? $design_options['main']['border-radius'] : 5; ?>
                                    <input type="text" name="design_options[main][border-radius]"
                                           id="wpm-border-radius" value="<?php echo $border_radius; ?>"/><span
                                        class="sublabel">px</span>

                                    <div id="wpm-border-radius-slider"></div>
                                    <script type="text/javascript">
                                        jQuery(function ($) {
                                            $("#wpm-border-radius-slider").slider({
                                                value:<?php echo $border_radius; ?>,
                                                min: 0,
                                                max: 30,
                                                step: 1,
                                                slide: function (event, ui) {
                                                    $("#wpm-border-radius").val(ui.value);
                                                }
                                            });
                                        });
                                    </script>

                                </div>

                            </div>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_3_2">
                                <div class="wpm-control-row">
                                    <label>
                                        <input type="checkbox"
                                                  name="design_options[page][show_all]"
                                            <?php if ($design_options['page']['show_all'] == true) echo 'checked'; ?>>
                                        <?php _e('Отображать все уроки автотренингов', 'wpm'); ?>
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет фона', 'wpm'); ?><br>
                                        <input type="text" name="design_options[page][background_color]"
                                               class="color"
                                               value="<?php echo $design_options['page']['background_color']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет рамки', 'wpm'); ?><br>
                                        <input type="text" name="design_options[page][border][color]" class="color"
                                               value="<?php echo $design_options['page']['border']['color']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет текста', 'wpm'); ?><br>
                                        <input type="text" name="design_options[page][text_color]" class="color"
                                               value="<?php echo $design_options['page']['text_color']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет ссылки', 'wpm'); ?><br>
                                        <input type="text" name="design_options[page][link_color]" class="color"
                                               value="<?php echo $design_options['page']['link_color']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет ссылки (при наведении)', 'wpm'); ?><br>
                                        <input type="text" name="design_options[page][link_color_hover]" class="color"
                                               value="<?php echo $design_options['page']['link_color_hover']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет фона шапки', 'wpm'); ?><br>
                                        <input type="text" name="design_options[page][header][background_color]"
                                               class="color"
                                               value="<?php echo $design_options['page']['header']['background_color']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет текста шапки', 'wpm'); ?><br>
                                        <input type="text" name="design_options[page][header][text_color]"
                                               class="color"
                                               value="<?php echo $design_options['page']['header']['text_color']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет фона четной строки таблицы', 'wpm'); ?><br>
                                        <input type="text" name="design_options[page][row][odd][background_color]"
                                               class="color"
                                               value="<?php echo $design_options['page']['row']['odd']['background_color']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет фона четной строки таблицы (при наведении)', 'wpm'); ?>
                                        <br>
                                        <input type="text"
                                               name="design_options[page][row][odd][background_color_hover]"
                                               class="color"
                                               value="<?php echo $design_options['page']['row']['odd']['background_color_hover']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет текста четной строки таблицы', 'wpm'); ?><br>
                                        <input type="text" name="design_options[page][row][odd][text_color]"
                                               class="color"
                                               value="<?php echo $design_options['page']['row']['odd']['text_color']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет текста четной строки таблицы (при наведении)', 'wpm'); ?>
                                        <br>
                                        <input type="text" name="design_options[page][row][odd][text_color_hover]"
                                               class="color"
                                               value="<?php echo $design_options['page']['row']['odd']['text_color_hover']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет фона нечетной строки таблицы', 'wpm'); ?><br>
                                        <input type="text" name="design_options[page][row][even][background_color]"
                                               class="color"
                                               value="<?php echo $design_options['page']['row']['even']['background_color']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет фона нечетной строки таблицы (при наведении)', 'wpm'); ?>
                                        <br>
                                        <input type="text"
                                               name="design_options[page][row][even][background_color_hover]"
                                               class="color"
                                               value="<?php echo $design_options['page']['row']['even']['background_color_hover']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет текста нечетной строки таблицы', 'wpm'); ?><br>
                                        <input type="text" name="design_options[page][row][even][text_color]"
                                               class="color"
                                               value="<?php echo $design_options['page']['row']['even']['text_color']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет текста нечетной строки таблицы (при наведении)', 'wpm'); ?>
                                        <br>
                                        <input type="text" name="design_options[page][row][even][text_color_hover]"
                                               class="color"
                                               value="<?php echo $design_options['page']['row']['even']['text_color_hover']; ?>">
                                    </label>
                                </div>
                            </div>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_3_10">
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет фона', 'wpm'); ?><br>
                                        <input type="text" name="design_options[single][header][background_color]"
                                               class="color"
                                               value="<?php echo $design_options['single']['header']['background_color']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет рамки', 'wpm'); ?><br>
                                        <input type="text" name="design_options[single][header][border_color]"
                                               class="color"
                                               value="<?php echo $design_options['single']['header']['border_color']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет заголовка', 'wpm'); ?><br>
                                        <input type="text" name="design_options[single][header][title_text_color]"
                                               class="color"
                                               value="<?php echo $design_options['single']['header']['title_text_color']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет Описания', 'wpm'); ?><br>
                                        <input type="text" name="design_options[single][header][desc_text_color]"
                                               class="color"
                                               value="<?php echo $design_options['single']['header']['desc_text_color']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет меток', 'wpm'); ?><br>
                                        <input type="text" name="design_options[single][header][label_color]"
                                               class="color"
                                               value="<?php echo $design_options['single']['header']['label_color']; ?>">
                                    </label>
                                </div>

                            </div>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_3_3">

                                <div class="wpm-control-row">
                                    <label><input type="checkbox"
                                                  name="design_options[menu][bold]" <?php echo $design_options['menu']['bold'] == 'on' ? 'checked' : ''; ?> >
                                        &nbsp;<?php _e('Сделать меню жирным (bold)', 'wpm'); ?>
                                    </label><br>
                                </div>

                                <div class="wpm-control-row">
                                    <label><input type="checkbox"
                                                  name="design_options[menu][submenu_bold]" <?php echo $design_options['menu']['submenu_bold'] == 'on' ? 'checked' : ''; ?> >
                                        &nbsp;<?php _e('Сделать подменю жирным (bold)', 'wpm'); ?>
                                    </label><br>
                                </div>
                                <div class="wpm-control-row">
                                    <label><input type="checkbox"
                                                  name="design_options[menu][current_bold]" <?php echo $design_options['menu']['current_bold'] == 'on' ? 'checked' : ''; ?> >
                                        &nbsp;<?php _e('Сделать активный пункт меню или подменю жирным (bold)', 'wpm'); ?>
                                    </label><br>
                                </div>
                                <div class="wpm-control-row">
                                    <?php _e('Размер шрифта', 'wpm'); ?> &nbsp; <select
                                        name="design_options[menu][font_size]">
                                        <?php
                                        for ($i = 14; $i < 26; $i++) {
                                            if ($i != $design_options['menu']['font_size']) {
                                                echo '<option value="' . $i . '">' . $i . 'px</option>';
                                            } else {
                                                echo '<option selected value="' . $i . '">' . $i . 'px</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет фона', 'wpm'); ?><br>
                                        <input type="text" name="design_options[menu][background_color]"
                                               class="color"
                                               value="<?php echo $design_options['menu']['background_color']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет рамки', 'wpm'); ?><br>
                                        <input type="text" name="design_options[menu][border][color]" class="color"
                                               value="<?php echo $design_options['menu']['border']['color']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет ссылки', 'wpm'); ?><br>
                                        <input type="text" name="design_options[menu][a][normal_color]"
                                               class="color"
                                               value="<?php echo $design_options['menu']['a']['normal_color']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет ссылки при наведении', 'wpm'); ?><br>
                                        <input type="text" name="design_options[menu][a][active_color]"
                                               class="color"
                                               value="<?php echo $design_options['menu']['a']['active_color']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет активной ссылки', 'wpm'); ?><br>
                                        <input type="text" name="design_options[menu][a][selected_link_color]"
                                               class="color"
                                               value="<?php echo array_key_exists('selected_link_color', $design_options['menu']['a']) ? $design_options['menu']['a']['selected_link_color'] : $design_options['menu']['a']['active_color']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет ссылки подменю', 'wpm'); ?><br>
                                        <input type="text" name="design_options[menu][a_submenu][normal_color]"
                                               class="color"
                                               value="<?php echo $design_options['menu']['a_submenu']['normal_color']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет ссылки подменю, при наведении', 'wpm'); ?><br>
                                        <input type="text" name="design_options[menu][a_submenu][active_color]"
                                               class="color"
                                               value="<?php echo $design_options['menu']['a_submenu']['active_color']; ?>">
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет активной ссылки подменю', 'wpm'); ?><br>
                                        <input type="text"
                                               name="design_options[menu][a_submenu][selected_link_color]"
                                               class="color"
                                               value="<?php echo array_key_exists('selected_link_color', $design_options['menu']['a_submenu']) ? $design_options['menu']['a_submenu']['selected_link_color'] : $design_options['menu']['a_submenu']['normal_color']; ?>">
                                    </label>
                                </div>
                            </div>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_3_4">
                                <?php wpm_render_partial('button-settings', 'common', compact('design_options')); ?>
                            </div>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_3_5">
                                <div class="wpm-control-row">
                                    <label><?php _e('Цвет', 'wpm'); ?><br>
                                        <input type="text" name="design_options[preloader][color_1]" class="color"
                                               value="<?php echo $design_options['preloader']['color_1']; ?>">
                                    </label>
                                </div>
                            </div>

                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_3_6">
                                <div class="wpm-control-row">
                                    <label>
                                        <input type="checkbox"
                                               name="main_options[header][visible]" <?php if ($main_options['header']['visible'] == 'on') echo 'checked'; ?>><?php _e('Включить шапки для страниц', 'wpm'); ?>
                                    </label>

                                    <input type="hidden" id="wpm-design-headers-priority"
                                           name="main_options[headers][priority]"
                                           value="<?php echo $main_options['headers']['priority']; ?>">
                                </div>
                                <br>

                                <div class="wpm-control-row">
                                    <select id="users-level-for-header"
                                            class="users-level"><?php echo wpm_get_levels_select(); ?></select>
                                    <a class="button button-primary page-header-add" data-action="add">Добавить
                                        шапку для уровня доступа</a>
                                </div>
                                <br>

                                <div id="tabs-level-3" tab-id="headers-tabs"
                                     class="tabs-level-3 headers-design-tabs wpm-inner-tabs-nav">

                                    <?php
                                    $page_headers = explode(',', $main_options['headers']['priority']);

                                    if (!empty($page_headers)) {
                                        echo '<ul>';
                                        foreach ($page_headers as $item) {
                                            $wpm_term = get_term($item, 'wpm-levels');
                                            if ($item == 'default') { ?>
                                                <li class="ui-state-default ui-state-disabled" header-id="default">
                                                    <a href='#header-tab-default'>По умолчанию</a></li>
                                            <?php } elseif ($item == 'pincodes') { ?>
                                                <li class="ui-state-default ui-state-disabled" header-id="pincodes">
                                                    <a href='#header-tab-pincodes'>Страница "пин-кодов"</a></li>
                                            <?php } else { ?>
                                                <li class="ui-state-default" header-id="<?php echo $item; ?>"><a
                                                        href='#header-tab-<?php echo $item; ?>'><?php echo $wpm_term->name; ?></a>
                                                </li>
                                            <?php } ?>
                                        <?php }
                                        echo '</ul>';

                                        foreach ($page_headers as $item) {
                                            if ($item == 'default') { ?>
                                                <div id="header-tab-default">
                                                    <div class="wpm-control-row" class="wpm-inner-tab-content">
                                                        <?php wp_editor(stripslashes($main_options['headers']['headers']['default']['content']), 'wpm_header_default', array('textarea_name' => 'main_options[headers][headers][default][content]', 'editor_height' => 300)); ?>
                                                    </div>
                                                </div>
                                            <?php } elseif ($item == 'pincodes') { ?>
                                                <div id="header-tab-pincodes">
                                                    <div class="wpm-control-row" class="wpm-inner-tab-content">
                                                        <p><label>
                                                                <?php
                                                                if ($main_options['headers']['headers']['pincodes']['disabled'] == 'disabled') { ?>
                                                                    <input type="checkbox" value="disabled"
                                                                           name="main_options[headers][headers][pincodes][disabled]"
                                                                           checked>
                                                                <?php } else { ?>
                                                                    <input type="checkbox" value="disabled"
                                                                           name="main_options[headers][headers][pincodes][disabled]">
                                                                <?php } ?>Временно отключить эту шапку
                                                            </label>
                                                        </p>
                                                        <?php wp_editor(stripslashes($main_options['headers']['headers']['pincodes']['content']), 'wpm_header_pincodes', array('textarea_name' => 'main_options[headers][headers][pincodes][content]', 'editor_height' => 300)); ?>
                                                    </div>
                                                </div>
                                                <?php
                                            } else { ?>
                                                <div id="header-tab-<?php echo $item; ?>"
                                                     class="wpm-inner-tab-content">
                                                    <div class="wpm-control-row">
                                                        <p><label>
                                                                <?php
                                                                if ($main_options['headers']['headers'][$item]['disabled'] == 'disabled') { ?>
                                                                    <input type="checkbox" value="disabled"
                                                                           name="main_options[headers][headers][<?php echo $item; ?>][disabled]"
                                                                           checked>
                                                                <?php } else { ?>
                                                                    <input type="checkbox" value="disabled"
                                                                           name="main_options[headers][headers][<?php echo $item; ?>][disabled]">
                                                                <?php } ?> Временно отключить эту шапку
                                                            </label>
                                                            <span class="trash"><a class="page-header-remove"
                                                                                   header-id="<?php echo $item; ?>">Удалить
                                                                    шапку</a></span>
                                                        </p>
                                                        <?php
                                                        $editor_name = 'main_options[headers][headers][' . $item . '][content]';
                                                        wp_editor(stripslashes($main_options['headers']['headers'][$item]['content']), 'wpm_header_' . $item, array('textarea_name' => $editor_name, 'editor_height' => 300)); ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php }

                                    } ?>
                                </div>
                            </div>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_3_7">
                                <div class="wpm-control-row">
                                    <label><input type="checkbox"
                                                  name="main_options[footer][visible]" <?php if ($main_options['footer']['visible'] == 'on') echo 'checked'; ?>><?php _e('Отображать подвал', 'wpm'); ?>
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <?php wp_editor($main_options['footer']['content'], 'wpm_footer', array('textarea_name' => 'main_options[footer][content]', 'editor_height' => 300)); ?>
                                </div>
                            </div>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_3_9">
                                <div class="wpm-control-row">
                                    <p>&lt;head&gt; <span class="text_green">ваш код</span> &lt;/head&gt;</p>
                                    <label>
                                        <textarea name="main_options[header_scripts]" class="wpm-wide code-style"
                                                  placeholder="Ваш код"
                                                  rows="20"><?php echo stripslashes($main_options['header_scripts']); ?></textarea>
                                    </label>
                                </div>
                            </div>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_3_8">
                                <h3>Дизайн</h3>

                                <div class="wpm-row restore-options">
                                    <button type="button" class="button button-primary reset-options"
                                            data-type="design"><?php _e('Восстановить значения по умолчанию', 'wpm'); ?></button>
                                    <span class="message"></span>
                                </div>
                                <h3>Все настройки</h3>

                                <div class="wpm-row restore-options">
                                    <button type="button" class="button button-primary reset-options"
                                            data-type="all"><?php _e('Восстановить значения по умолчанию', 'wpm'); ?></button>
                                    <span class="message"></span>
                                </div>

                                <h3>Кпопки</h3>

                                <div class="wpm-row restore-options">
                                    <button type="button" class="button button-primary reset-options"
                                            data-type="buttons"><?php _e('Восстановить значения по умолчанию', 'wpm'); ?></button>
                                    <span class="message"></span>
                                </div>
                            </div>


                            <div class="wpm-tab-footer">
                                <button type="submit"
                                        class="button button-primary wpm-save-options"><?php _e('Сохранить', 'wpm'); ?></button>
                            </div>
                        </div>

                    </div>
                </div>

                <div id="tab-6" class="tab">
                    <div class="wpm-tab-content">
                        <div class="wpm-inner-tabs" tab-id="h-tabs-3">
                            <ul class="wpm-inner-tabs-nav">
                                <li>
                                    <a href="#wpm_inner_tab_6_1"><?php _e('Письмо при регистрации пользователя', 'wpm'); ?></a>
                                </li>
                                <li>
                                    <a href="#wpm_inner_tab_6_2"><?php _e('Уведомление о новом комментарии', 'wpm'); ?></a>
                                </li>
                                <li>
                                    <a href="#wpm_inner_tab_6_3"><?php _e('Автотренинги', 'wpm'); ?></a>
                                </li>
                            </ul>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_6_1">
                                <div class="wpm-row">
                                    <?php $mandrill_is_on = (array_key_exists('mandrill_is_on', $main_options['letters']) && $main_options['letters']['mandrill_is_on'] == 'on'); ?>
                                    <?php $ses_is_on = (array_key_exists('ses_is_on', $main_options['letters']) && $main_options['letters']['ses_is_on'] == 'on') ?>
                                    <?php
                                    $ses_hosts = array(
                                        'EU (Ireland)'          => 'email.eu-west-1.amazonaws.com',
                                        'US East (N. Virginia)' => 'email.us-east-1.amazonaws.com',
                                        'US West (Oregon)'      => 'email.us-west-2.amazonaws.com',
                                    );
                                    ?>

                                    <label>
                                        <input type="radio"
                                               name="main_options[letters][type]"
                                               value="mandrill"
                                               class="letter_options"
                                               id="mandrill_is_on" <?php echo $mandrill_is_on ? 'checked' : ''; ?>><?php _e('Отправлять письма через Mandrill', 'wpm'); ?>
                                    </label>
                                    <div id="mandrill_api_key_label"
                                           class="<?php echo $mandrill_is_on ? '' : 'invisible'; ?> letter_options_label">
                                        <?php _e('Укажите Mandrill API key ', 'wpm'); ?> &nbsp; <input type="text"
                                                                                                       name="main_options[letters][mandrill_api_key]"
                                                                                                       id="mandrill_api_key"
                                                                                                       class="large-text"
                                                                                                       value="<?php echo $main_options['letters']['mandrill_api_key']; ?>"/>
                                    </div>
                                    <br/>
                                    <label>
                                        <input type="radio"
                                               name="main_options[letters][type]"
                                               value="ses"
                                               class="letter_options"
                                               id="ses_is_on" <?php echo $ses_is_on ? 'checked' : ''; ?>><?php _e('Отправлять письма через Amazon SES', 'wpm'); ?>
                                    </label>
                                    <div id="ses_api_key_label"
                                           class="<?php echo $ses_is_on ? '' : 'invisible'; ?> letter_options_label">
                                        <?php _e('Укажите Amazon SES Access Key ID', 'wpm'); ?> &nbsp;
                                        <input type="text"
                                               name="main_options[letters][ses_access_key]"
                                               id="ses_access_key"
                                               class="large-text"
                                               value="<?php echo $main_options['letters']['ses_access_key']; ?>"/>
                                        <br><br/>
                                        <?php _e('Укажите Amazon SES Secret Access Key', 'wpm'); ?> &nbsp;
                                        <input type="text"
                                               name="main_options[letters][ses_secret_key]"
                                               id="ses_secret_key"
                                               class="large-text"
                                               value="<?php echo $main_options['letters']['ses_secret_key']; ?>"/>
                                        <br><br/>
                                        <?php _e('Укажите верифицированный email', 'wpm'); ?> &nbsp;
                                        <input type="text"
                                               name="main_options[letters][ses_email]"
                                               id="ses_email"
                                               class="large-text"
                                               value="<?php echo $main_options['letters']['ses_email']; ?>"/>
                                        <br><br/>
                                        <?php _e('Укажите регион', 'wpm'); ?> &nbsp;
                                        <select id="ses_host"
                                                name="main_options[letters][ses_host]"
                                                class="users-level">
                                            <?php foreach ($ses_hosts AS $host_name => $ses_host) : ?>
                                                <option value="<?php echo $ses_host; ?>"
                                                    <?php echo $main_options['letters']['ses_host'] == $ses_host ? 'selected="selected"' : '' ?>
                                                ><?php echo $host_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <br/>
                                        <br/>
                                        <div>
                                            <button type="button" class="button" id="test_ses"><?php _e('Отправить тестовое письмо', 'wpm'); ?></button>
                                            <div id="test_ses_response"></div>
                                        </div>
                                    </div>
                                    <br/>
                                    <label>
                                        <input type="radio"
                                               name="main_options[letters][type]"
                                               value="wp"
                                               class="letter_options"
                                               id="wpmail_is_on" <?php echo !$ses_is_on && !$mandrill_is_on ? 'checked' : ''; ?>><?php _e('Отправлять письма через Wordpress', 'wpm'); ?>
                                    </label>
                                </div>

                                <div class="wpm-row">
                                    <label>
                                        Заголовок письма<br>
                                        <input type="text" name="main_options[letters][registration][title]"
                                               value="<?php echo $main_options['letters']['registration']['title'] ?>"
                                               class="large-text">
                                    </label>

                                </div>
                                <div class="wpm-control-row">
                                    <?php
                                    wp_editor(stripslashes($main_options['letters']['registration']['content']), 'wpm_letter_registration', array('textarea_name' => 'main_options[letters][registration][content]', 'editor_height' => 300));
                                    ?>
                                </div>
                                <div class="wpm-help-wrap">
                                    <p>
                                        <span class="code-string">[user_name]</span> - имя пользователя <br>
                                        <span class="code-string">[user_login]</span> - логин пользователя <br>
                                        <span class="code-string">[user_pass]</span> - пароль пользователя <br>
                                        <span class="code-string">[start_page]</span> - страница входа <br>
                                    </p>
                                </div>

                                <?php wpm_render_partial('settings-save-button', 'common'); ?>
                            </div>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_6_2">
                                <div class="wpm-row">
                                    <label>
                                        Заголовок письма<br>
                                        <input type="text" name="main_options[letters][comment_subscription][title]"
                                               value="<?php echo wpm_get_option('letters.comment_subscription.title') ?>"
                                               class="large-text">
                                    </label>

                                </div>
                                <div class="wpm-control-row">
                                    <?php
                                    wp_editor(stripslashes(wpm_get_option('letters.comment_subscription.content')), 'wpm_letter_comment_subscription', array('textarea_name' => 'main_options[letters][comment_subscription][content]', 'editor_height' => 300));
                                    ?>
                                </div>
                                <div class="wpm-help-wrap">
                                    <p>
                                        <span class="code-string">[user_name]</span> - имя пользователя <br>
                                        <span class="code-string">[page_link]</span> - ссылка на страницу <br>
                                        <span class="code-string">[page_title]</span> - название страницы <br>
                                    </p>
                                </div>

                                <?php wpm_render_partial('settings-save-button', 'common'); ?>
                            </div>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_6_3">
                                <div>
                                    <h3><?php _e('Уведомление администратора об ответе на домашнее задание', 'wpm'); ?></h3>
                                    <div class="wpm-row">
                                        <label>
                                            Заголовок письма<br>
                                            <input type="text" name="main_options[letters][response_admin][title]"
                                                   value="<?php echo wpm_get_option('letters.response_admin.title') ?>"
                                                   class="large-text">
                                        </label>

                                    </div>
                                    <div class="wpm-control-row">
                                        <?php wp_editor(stripslashes(wpm_get_option('letters.response_admin.content')), 'wpm_letter_response_admin', array('textarea_name' => 'main_options[letters][response_admin][content]', 'editor_height' => 250));?>
                                    </div>
                                    <div class="wpm-help-wrap">
                                        <p>
                                            <span class="code-string">[material_name]</span> - название материала <br>
                                            <span class="code-string">[user_name]</span> - имя пользователя <br>
                                            <span class="code-string">[user_email]</span> - email пользователя <br>
                                            <span class="code-string">[user_response]</span> - текст ответа <br>
                                            <span class="code-string">[admin_url]</span> - ссылка на панель управления <br>
                                        </p>
                                    </div>
                                </div>
                                <br><br>
                                <div>
                                    <h3><?php _e('Уведомление пользователя о статусе домашнего задания', 'wpm'); ?></h3>
                                    <div class="wpm-row">
                                        <label>
                                            Заголовок письма<br>
                                            <input type="text" name="main_options[letters][response_status][title]"
                                                   value="<?php echo wpm_get_option('letters.response_status.title') ?>"
                                                   class="large-text">
                                        </label>

                                    </div>
                                    <div class="wpm-control-row">
                                        <?php wp_editor(stripslashes(wpm_get_option('letters.response_status.content')), 'wpm_letter_response_status', array('textarea_name' => 'main_options[letters][response_status][content]', 'editor_height' => 250));?>
                                    </div>
                                    <div class="wpm-help-wrap">
                                        <p>
                                            <span class="code-string">[material_name]</span> - название материала <br>
                                            <span class="code-string">[status]</span> - статус <br>
                                            <span class="code-string">[material_url]</span> - ссылка на материал <br>
                                        </p>
                                    </div>
                                </div>
                                <br><br>
                                <div>
                                    <h3><?php _e('Уведомление пользователя о комментарии к ответу на домашнее задание', 'wpm'); ?></h3>
                                    <div class="wpm-row">
                                        <label>
                                            Заголовок письма<br>
                                            <input type="text" name="main_options[letters][response_review][title]"
                                                   value="<?php echo wpm_get_option('letters.response_review.title') ?>"
                                                   class="large-text">
                                        </label>

                                    </div>
                                    <div class="wpm-control-row">
                                        <?php wp_editor(stripslashes(wpm_get_option('letters.response_review.content')), 'wpm_letter_response_review', array('textarea_name' => 'main_options[letters][response_review][content]', 'editor_height' => 250));?>
                                    </div>
                                    <div class="wpm-help-wrap">
                                        <p>
                                            <span class="code-string">[material_name]</span> - название материала <br>
                                            <span class="code-string">[user_response]</span> - текст ответа <br>
                                            <span class="code-string">[response_review]</span> - текст комментария <br>
                                            <span class="code-string">[material_url]</span> - ссылка на материал <br>
                                        </p>
                                    </div>
                                </div>

                                <?php wpm_render_partial('settings-save-button', 'common'); ?>
                            </div>
                        </div>

                    </div>
                </div>
                <div id="tab-7" class="tab">
                    <div class="wpm-tab-content">
                        <div class="wpm-control-row">
                            <h3>Аудио-плеер</h3>
                        </div>
                        <div class="wpm-control-row wpm-audio-settings">
                            <label>
                                <input type="radio"
                                       name="main_options[audio][player]"
                                       data-radio-toggle="wpm_audio"
                                       value="mediaelement"
                                       <?php echo !wpm_option_is('audio.player', 'wavesurfer') ? 'checked' : ''; ?>
                                ><?php _e('Mediaelement Player', 'wpm'); ?>
                            </label>
                            <div data-radio-toggle-holder="wpm_audio"
                                 <?php echo wpm_option_is('audio.player', 'wavesurfer') ? 'style="display:none;"' : ''; ?>
                                 data-value="mediaelement"
                                 class="mediaelement-preview">
                            </div>
                            <br>
                            <br>
                            <label>
                                <input type="radio"
                                       name="main_options[audio][player]"
                                       data-radio-toggle="wpm_audio"
                                       value="wavesurfer"
                                       <?php echo wpm_option_is('audio.player', 'wavesurfer') ? 'checked' : ''; ?>
                                ><?php _e('Wave Surfer Player', 'wpm'); ?>
                            </label>
                            <div data-radio-toggle-holder="wpm_audio"
                                 <?php echo !wpm_option_is('audio.player', 'wavesurfer') ? 'style="display:none;"' : ''; ?>
                                 data-value="wavesurfer">
                                 <div class="wavesurfer-preview"></div>

                                <div class="wpm-help-wrap">
                                    <p>Аудио файлы должны быть загружены на ваш сайт (например в Медиафайлы)</p>
                                </div>
                            </div>
                        </div>

                        <div class="wpm-tab-footer">
                            <button type="submit"
                                    class="button button-primary wpm-save-options"><?php _e('Сохранить', 'wpm'); ?></button>
                        </div>
                    </div>
                </div>

                <div id="tab-10" class="tab">
                    <div class="wpm-tab-content">
                        <div class="wpm-control-row">
                            <p>Контент для отображения на странице входа в систему.</p>
                        </div>
                        <div class="wpm-control-row">
                            <label><input type="checkbox"
                                          name="main_options[login_content][visible]" <?php if ($main_options['login_content']['visible'] == 'on') echo 'checked'; ?>><?php _e('Отображать', 'wpm'); ?>
                            </label>
                            &nbsp;&nbsp;&nbsp;
                            <label><input type="radio"
                                          name="main_options[login_content][position]"
                                          value="top" <?php if ($main_options['login_content']['position'] == 'top') echo 'checked'; ?>><?php _e('Вверху', 'wpm'); ?>
                            </label>
                            &nbsp;
                            <label><input type="radio"
                                          name="main_options[login_content][position]"
                                          value="bottom" <?php if ($main_options['login_content']['position'] == 'bottom') echo 'checked'; ?>><?php _e('Внизу', 'wpm'); ?>
                            </label>
                        </div>
                        <div class="wpm-control-row">
                            <?php wp_editor($main_options['login_content']['content'], 'wpm_login_content', array('textarea_name' => 'main_options[login_content][content]', 'editor_height' => 300)); ?>
                        </div>

                        <div class="wpm-tab-footer">
                            <button type="submit"
                                    class="button button-primary wpm-save-options"><?php _e('Сохранить', 'wpm'); ?></button>
                        </div>
                    </div>
                </div>
                <div id="tab-11" class="tab">
                    <div class="wpm-tab-content">
                        <div class="wpm-inner-tabs" tab-id="h-tabs-4">
                            <ul class="wpm-inner-tabs-nav">
                                <li><a href="#wpm_inner_tab_11_1"><?php _e('JustClick', 'wpm'); ?></a></li>
                                <?php /*
                                    <li><a href="#wpm_inner_tab_11_2"><?php _e('SmartResponder', 'wpm'); ?></a></li>
                                    <li><a href="#wpm_inner_tab_11_3"><?php _e('GetResponce', 'wpm'); ?></a></li>
                                    <li><a href="#wpm_inner_tab_11_4"><?php _e('UniSender', 'wpm'); ?></a></li>
                                    <li><a href="#wpm_inner_tab_11_5"><?php _e('Настройки', 'wpm'); ?></a></li>
                                */ ?>
                            </ul>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_11_1">
                                <div>
                                    <p>
                                        <label>
                                            <?php if ($main_options['auto_subscriptions']['justclick']['active'] == 'on') { ?>
                                                <input type="checkbox"
                                                       name="main_options[auto_subscriptions][justclick][active]"
                                                       checked="">
                                            <?php } else { ?>
                                                <input type="checkbox"
                                                       name="main_options[auto_subscriptions][justclick][active]">
                                            <?php } ?>
                                            <?php _e('Включить', 'wpm'); ?></label>
                                    </p>

                                    <p>
                                        <label>
                                            <input type="checkbox"
                                                   name="main_options[auto_subscriptions][justclick][auto_disable]"
                                                <?php echo autoDisable('justclick', $main_options) ? ' checked' : ''; ?>/>
                                            <?php _e('По истечению срока действия пин-кода удалить пользователя из рассылки', 'wpm'); ?></label>
                                    </p>

                                    <div class="letter_options_label">
                                        <p>
                                            <label><?php _e('Логин', 'wpm'); ?><br>
                                                <input type="text"
                                                       name="main_options[auto_subscriptions][justclick][user_id]"
                                                       value="<?php echo $main_options['auto_subscriptions']['justclick']['user_id']; ?>">
                                            </label>
                                        </p>

                                        <p>
                                            <label>Секретный ключ для подписи<br>
                                                <input type="text"
                                                       name="main_options[auto_subscriptions][justclick][user_rps_key]"
                                                       value="<?php echo $main_options['auto_subscriptions']['justclick']['user_rps_key']; ?>">
                                            </label>
                                        </p>
                                    </div>

                                    <?php if (MBLSubscription::direct('justclick', 'credentialsFilled')) : ?>
                                        <div>
                                            <div id="justclick_groups"><div class="wpm-inline-loader"></div></div>
                                        </div>

                                        <p>
                                            <label><?php _e('Адрес после подтверждения (не обязательно)', 'wpm'); ?><br>
                                                <input type="text"
                                                       name="main_options[auto_subscriptions][justclick][doneurl2]"
                                                       value="<?php echo $main_options['auto_subscriptions']['justclick']['doneurl2']; ?>">
                                            </label>
                                        </p>
                                    <?php endif; ?>
                                </div>
                                <?php wpm_render_partial('settings-save-button', 'common'); ?>
                            </div>
                            <?php /*
                                <div class="wpm-inner-tab-content" id="wpm_inner_tab_11_2">
                                    <div>
                                        <p>
                                            <label>
                                                <?php if ($main_options['auto_subscriptions']['smartresponder']['active'] == 'on') { ?>
                                                    <input type="checkbox"
                                                           name="main_options[auto_subscriptions][smartresponder][active]"
                                                           checked="">
                                                <?php } else { ?>
                                                    <input type="checkbox"
                                                           name="main_options[auto_subscriptions][smartresponder][active]">
                                                <?php } ?>
                                                Включить</label>
                                        </p>

                                        <p>
                                            <label>
                                                <input type="checkbox"
                                                       name="main_options[auto_subscriptions][smartresponder][auto_disable]"
                                                    <?php echo autoDisable('smartresponder', $main_options) ? ' checked' : ''; ?>/>
                                                По истечению срока действия пин-кода удалить пользователя из
                                                рассылки</label>
                                        </p>

                                        <p>
                                            <label>Ваш API-ключ<br>
                                                <input type="text"
                                                       name="main_options[auto_subscriptions][smartresponder][api_key]"
                                                       value="<?php echo $main_options['auto_subscriptions']['smartresponder']['api_key']; ?>">
                                            </label>
                                        </p>

                                        <p>

                                            <label>ID рассылки<br>
                                                <input type="text"
                                                       name="main_options[auto_subscriptions][smartresponder][delivery_id]"
                                                       value="<?php echo $main_options['auto_subscriptions']['smartresponder']['delivery_id']; ?>">
                                            </label>
                                        </p>

                                        <p>
                                            <label>ID трека<br>
                                                <input type="text"
                                                       name="main_options[auto_subscriptions][smartresponder][track_id]"
                                                       value="<?php echo $main_options['auto_subscriptions']['smartresponder']['track_id']; ?>">
                                            </label>
                                        </p>

                                        <p>
                                            <label>ID группы<br>
                                                <input type="text"
                                                       name="main_options[auto_subscriptions][smartresponder][group_id]"
                                                       value="<?php echo $main_options['auto_subscriptions']['smartresponder']['group_id']; ?>">
                                            </label>
                                        </p>
                                    </div>
                                    <div class="wpm-tab-footer">
                                        <button type="submit"
                                                class="button button-primary wpm-save-options"><?php _e('Сохранить', 'wpm'); ?></button>
                                    </div>
                                </div>
                                <div class="wpm-inner-tab-content" id="wpm_inner_tab_11_3">
                                    <div>
                                        <p>
                                            <label>
                                                <?php if ($main_options['auto_subscriptions']['getresponse']['active'] == 'on') { ?>
                                                    <input type="checkbox"
                                                           name="main_options[auto_subscriptions][getresponse][active]"
                                                           checked="">
                                                <?php } else { ?>
                                                    <input type="checkbox"
                                                           name="main_options[auto_subscriptions][getresponse][active]">
                                                <?php } ?>
                                                Включить</label>
                                        </p>

                                        <p>
                                            <label>
                                                <input type="checkbox"
                                                       name="main_options[auto_subscriptions][getresponse][auto_disable]"
                                                    <?php echo autoDisable('getresponse', $main_options) ? ' checked' : ''; ?>/>
                                                По истечению срока действия пин-кода удалить пользователя из
                                                рассылки</label>
                                        </p>

                                        <p>
                                            <label>API ключ: &nbsp;&nbsp;<span class="help"><br><a target="_blank"
                                                                                                   href="https://app.getresponse.com/account.html#api">https://app.getresponse.com/account.html#api</a></span><br>
                                                <input type="text" style="margin-top: 8px"
                                                       name="main_options[auto_subscriptions][getresponse][api_key]"
                                                       value="<?php echo $main_options['auto_subscriptions']['getresponse']['api_key']; ?>">
                                            </label>
                                        </p>

                                        <p>
                                            <label>Токен кампании:<br><span class="help"><a target="_blank"
                                                                                            href="https://app.getresponse.com/campaign_list.html">https://app.getresponse.com/campaign_list.html</a></span><br>
                                                <input type="text" style="margin-top: 8px"
                                                       name="main_options[auto_subscriptions][getresponse][campaign_token]"
                                                       value="<?php echo $main_options['auto_subscriptions']['getresponse']['campaign_token']; ?>">
                                            </label>
                                        </p>
                                    </div>
                                    <div class="wpm-tab-footer">
                                        <button type="submit"
                                                class="button button-primary wpm-save-options"><?php _e('Сохранить', 'wpm'); ?></button>
                                    </div>
                                </div>
                                <div class="wpm-inner-tab-content" id="wpm_inner_tab_11_4">
                                    <div>
                                        <p>
                                            <label>
                                                <?php if ($main_options['auto_subscriptions']['unisender']['active'] == 'on') { ?>
                                                    <input type="checkbox"
                                                           name="main_options[auto_subscriptions][unisender][active]"
                                                           checked="">
                                                <?php } else { ?>
                                                    <input type="checkbox"
                                                           name="main_options[auto_subscriptions][unisender][active]">
                                                <?php } ?>
                                                Включить</label>
                                        </p>

                                        <p>
                                            <label>
                                                <input type="checkbox"
                                                       name="main_options[auto_subscriptions][unisender][auto_disable]"
                                                    <?php echo autoDisable('unisender', $main_options) ? ' checked' : ''; ?>/>
                                                По истечению срока действия пин-кода удалить пользователя из
                                                рассылки</label>
                                        </p>

                                        <p>
                                            <label>API ключ:<br>
                                                <input type="text"
                                                       name="main_options[auto_subscriptions][unisender][api_key]"
                                                       value="<?php echo $main_options['auto_subscriptions']['unisender']['api_key']; ?>">
                                            </label>
                                        </p>

                                        <p>
                                            <label>Списки<br>
                                                <input type="text"
                                                       name="main_options[auto_subscriptions][unisender][lists]"
                                                       value="<?php echo $main_options['auto_subscriptions']['unisender']['lists']; ?>">
                                            </label>
                                        </p>

                                        <p>
                                            <label>Метки<br>
                                                <input type="text"
                                                       name="main_options[auto_subscriptions][unisender][tags]"
                                                       value="<?php echo $main_options['auto_subscriptions']['unisender']['tags']; ?>">
                                            </label>
                                        </p>

                                    </div>
                                    <div class="wpm-tab-footer">
                                        <button type="submit"
                                                class="button button-primary wpm-save-options"><?php _e('Сохранить', 'wpm'); ?></button>
                                    </div>
                                </div>
                                <div class="wpm-inner-tab-content" id="wpm_inner_tab_11_5">
                                    <div class="wpm-row">
                                        <div class="wpm-control-row">
                                            <p><b>Способ проверки необходимости отключить пользователя от авто-подписки
                                                    по истечении срока действия ключа:</b></p>
                                        </div>

                                        <?php $auto_disable_mode = array_key_exists('auto_disable_mode', $main_options['main']) ? $main_options['main']['auto_disable_mode'] : 'disabled'; ?>


                                        <label>
                                            <input type="radio"
                                                   name="main_options[main][auto_disable_mode]"
                                                   value="disabled" <?php if ($auto_disable_mode == 'disabled') echo 'checked'; ?>> <?php _e('Не использовать', 'wpm'); ?>
                                        </label>
                                        <br/><br/>
                                        <label>
                                            <input type="radio"
                                                   name="main_options[main][auto_disable_mode]"
                                                   value="cron" <?php if ($auto_disable_mode == 'cron') echo 'checked'; ?>> <?php _e('Крон', 'wpm'); ?>
                                            (событие: <?php echo admin_url('/admin-ajax.php') . '?action=wpm_subscription_status_cron'; ?>
                                            )
                                        </label><br/><br/>

                                        <label>
                                            <input type="radio"
                                                   name="main_options[main][auto_disable_mode]"
                                                   value="external_service" <?php if ($auto_disable_mode == 'external_service') echo 'checked'; ?>> <?php _e('Скрипт проверки запускаемый с wppage.ru', 'wpm'); ?>
                                        </label><br/><br/>


                                    </div>

                                    <div class="wpm-tab-footer">
                                        <button type="submit"
                                                class="button button-primary wpm-save-options"><?php _e('Сохранить', 'wpm'); ?></button>
                                    </div>
                                </div>
                            */ ?>
                        </div>
                    </div>
                </div>

                <div id="tab-12" class="tab">
                    <div class="wpm-tab-content">
                        <div class="wpm-inner-tabs" tab-id="h-tabs-4">
                            <ul class="wpm-inner-tabs-nav">
                                <li>
                                    <a href="#wpm_inner_tab_12_1"><?php _e('Защита контента', 'wpm'); ?></a>
                                </li>
                                <li><a href="#wpm_inner_tab_12_2"><?php _e('Ограничения для пользователей', 'wpm'); ?></a></li>
                            </ul>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_12_1">
                                <div class="wpm-row">
                                    <label>
                                        <input type="hidden" name="main_options[protection][video_url_encoded]" value="off"/>
                                        <input type="checkbox"
                                               id="video_url_encoded"
                                               name="main_options[protection][video_url_encoded]"
                                               <?php echo wpm_option_is('protection.video_url_encoded', 'on') ? 'checked="checked"' : '' ?> >
                                        Включить шифрование ссылок .mp4
                                        <br>
                                    </label>
                                </div>
                                <div class="wpm-row">
                                    <?php $yt_protection_is_enabled = wpm_yt_protection_is_enabled(); ?>
                                    <label>
                                        <input type="hidden" name="main_options[protection][youtube_protected]" value="off"/>
                                        <input type="checkbox"
                                               id="youtube_protected"
                                               name="main_options[protection][youtube_protected]"
                                               <?php echo $yt_protection_is_enabled ? 'checked' : ''; ?> >
                                        Включить JW Player (<a href="http://www.jwplayer.com/pricing/" target="_blank">http://jwplayer.com</a>)
                                        <br>
                                    </label>
                                </div>

                                <div class="wpm-row <?php echo $yt_protection_is_enabled ? '' : 'hidden'; ?>" id="jwplayer_code_row">
                                    <label>
                                        <input type="radio"
                                               <?php echo wpm_option_is('protection.jwplayer_version', '6', '6') ? 'checked="checked"' : '' ?>
                                               value="6"
                                               class="jwplayer_version"
                                               name="main_options[protection][jwplayer_version]">
                                        JW Player 6
                                    </label>
                                    &nbsp;
                                    &nbsp;
                                    <label>
                                        <input type="radio"
                                               <?php echo wpm_option_is('protection.jwplayer_version', '7', '6') ? 'checked="checked"' : '' ?>
                                               value="7"
                                               class="jwplayer_version"
                                               name="main_options[protection][jwplayer_version]">
                                        JW Player 7
                                    </label>
                                    <br/>
                                    <br/>

                                    Введите код активации jwplayer
                                    <br/>
                                    <label>
                                        <input type="text"
                                               name="main_options[protection][jwplayer_code]"
                                               value="<?php echo wpm_get_option('protection.jwplayer_code'); ?>"
                                               class="<?php echo wpm_option_is('protection.jwplayer_version', '6', '6') ? '' : 'hidden' ?>"
                                               id="jwplayer_code">
                                        <input type="text"
                                               name="main_options[protection][jwplayer_code_7]"
                                               value="<?php echo wpm_get_option('protection.jwplayer_code_7', ''); ?>"
                                               class="<?php echo wpm_option_is('protection.jwplayer_version', '7', '6') ? '' : 'hidden' ?>"
                                               id="jwplayer_code_7">
                                    </label>
                                </div>

                                <div class="wpm-row">
                                    <label>
                                        <input type="checkbox"
                                               name="main_options[protection][right_button_disabled]" <?php echo wpm_option_is('protection.right_button_disabled', 'on') ? 'checked' : ''; ?> > <?php _e('Отключить правую кнопку мыши', 'wpm'); ?>
                                    </label>
                                </div>

                                <div class="wpm-row">
                                    <?php $text_protection_is_enabled = wpm_text_protection_is_enabled($main_options); ?>
                                    <label>
                                        <input id="wpm_text_protection_chbx" type="checkbox"
                                               name="main_options[protection][text_protected]" <?php echo $text_protection_is_enabled ? 'checked' : ''; ?> > <?php _e('Запретить копирование текста', 'wpm'); ?>
                                    </label>
                                </div>
                                <?php if ($wpm_pages->have_posts()) : ?>
                                    <div
                                        class="wpm-protection-exceptions" <?php echo $text_protection_is_enabled ? '' : 'style="display:none;"' ?>>
                                        <?php _e('Исключения', 'wpm'); ?>:
                                        <?php while ($wpm_pages->have_posts()): ?>
                                            <?php $wpm_pages->the_post(); ?>
                                            <div class="wpm-row">
                                                <label>
                                                    <?php $checked = $text_protection_is_enabled && !wpm_text_protection_is_enabled($main_options, get_the_ID()); ?>
                                                    <input type="checkbox"
                                                           name="main_options[protection][text_protected_exceptions][]"
                                                           value="<?php echo get_the_ID(); ?>" <?php echo $checked ? 'checked="checked"' : '' ?>>
                                                    <?php echo get_the_title(); ?>
                                                </label>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="wpm-row">
                                    <label>
                                        <input type="hidden" name="main_options[protection][youtube_standard_player]" value="0">
                                        <input type="checkbox"
                                               name="main_options[protection][youtube_standard_player]"
                                               value="1"
                                            <?php echo wpm_option_is('protection.youtube_standard_player', '1') ? 'checked' : ''; ?>
                                        > <?php _e('Использовать Стандартный YouTube плеер для воспроизведения видео с YouTube', 'mbl_admin') ?>
                                    </label>
                                </div>

                                <div class="wpm-row">
                                    <label>
                                        <input type="hidden" name="main_options[protection][vimeo_standard_player]" value="0">
                                        <input type="checkbox"
                                               name="main_options[protection][vimeo_standard_player]"
                                               value="1"
                                            <?php echo wpm_option_is('protection.vimeo_standard_player', '1') ? 'checked' : ''; ?>
                                        > <?php _e('Использовать Стандартный Vimeo плеер для воспроизведения видео с Vimeo', 'mbl_admin') ?>
                                    </label>
                                </div>

                                <div class="wpm-row">
                                   <p><b><?php _e('Версия плеера Plyr', 'mbl_admin') ?></b></p>
                                    <label>
                                        <input type="radio"
                                               name="main_options[protection][plyr_version]"
                                               value="2.0.11"
                                            <?php echo wpm_option_is('protection.plyr_version', '2.0.11', '2.0.11') ? 'checked' : ''; ?>
                                        > 2.0.11
                                    </label>
                                    <br>
                                    <label>
                                        <input type="radio"
                                               name="main_options[protection][plyr_version]"
                                               value="3.4.7"
                                            <?php echo wpm_option_is('protection.plyr_version', '3.4.7', '2.0.11') ? 'checked' : ''; ?>
                                        > 3.4.7
                                    </label>
                                </div>

                                <div class="wpm-row" id="mbl_youtube_protection" <?php echo wpm_option_is('protection.plyr_version', '3.4.7') ? '' : 'style="display:none;"'; ?>>
                                    <label>
                                        <input type="hidden" name="main_options[protection][youtube_hide_controls]" value="0">
                                        <input type="checkbox"
                                               name="main_options[protection][youtube_hide_controls]"
                                               value="1"
                                            <?php echo wpm_option_is('protection.youtube_hide_controls', '1') ? 'checked' : ''; ?>
                                        > <?php _e('Скрыть элементы управления YouTube', 'mbl_admin') ?>
                                    </label>
                                </div>

                                <div class="wpm-tab-footer">
                                    <button type="submit"
                                            class="button button-primary wpm-save-options"><?php _e('Сохранить', 'wpm'); ?></button>
                                    <span class="buttom-preloader"></span>
                                </div>
                            </div>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_12_2">
                                <div class="wpm-row">
                                    <label>
                                        <input id="wpm_session_protection" type="checkbox"
                                               name="main_options[protection][one_session][status]" <?php echo ($main_options['protection']['one_session']['status'] == 'on') ? 'checked' : ''; ?> > <?php _e('Запретить множественную авторизацию.', 'wpm'); ?>
                                    </label>
                                </div>
                                <div class="wpm-row">
                                    <label>
                                        <?php _e('Интервал проверки акаунтов:', 'wpm'); ?> <input id="wpm_session_protection_interval" type="number"
                                               name="main_options[protection][one_session][interval]" value="<?php echo $main_options['protection']['one_session']['interval']; ?>" > <?php _e('секунд', 'wpm'); ?>
                                    </label>
                                </div>

                                <div class="wpm-tab-footer">
                                    <button type="submit"
                                            class="button button-primary wpm-save-options"><?php _e('Сохранить', 'wpm'); ?></button>
                                    <span class="buttom-preloader"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab-13" class="tab">
                    <div class="wpm-tab-content">
                        <div class="wpm-inner-tabs" tab-id="h-tabs-5">
                            <ul class="wpm-inner-tabs-nav">
                                <li>
                                    <a href="#wpm_inner_tab_13_1"><?php _e('Настройка полей регистрационной формы', 'wpm'); ?></a>
                                </li>
                                <li><a href="#wpm_inner_tab_13_2"><?php _e('Пользовательское соглашение', 'wpm'); ?></a></li>
                            </ul>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_13_1">
                                <div class="wpm-row">
                                    <label>
                                        <input type="checkbox"
                                               name="main_options[registration_form][surname]"
                                            <?php echo wpm_reg_field_is_enabled($main_options, 'surname') ? ' checked' : ''; ?> />
                                        Фамилия
                                    </label>
                                </div>
                                <div class="wpm-row">
                                    <label>
                                        <input type="checkbox"
                                               name="main_options[registration_form][name]"
                                            <?php echo wpm_reg_field_is_enabled($main_options, 'name') ? ' checked' : ''; ?> />
                                        Имя
                                    </label>
                                </div>
                                <div class="wpm-row">
                                    <label>
                                        <input type="checkbox"
                                               name="main_options[registration_form][patronymic]"
                                            <?php echo wpm_reg_field_is_enabled($main_options, 'patronymic') ? ' checked' : ''; ?> />
                                        Отчество
                                    </label>
                                </div>
                                <div class="wpm-row wpm-row-disabled"
                                     title="Это поле нельзя убрать из регистрационной формы">
                                    <label>
                                        <input type="checkbox" disabled checked/> E-mail
                                    </label>
                                </div>
                                <div class="wpm-row">
                                    <label>
                                        <input type="checkbox"
                                               name="main_options[registration_form][phone]"
                                            <?php echo wpm_reg_field_is_enabled($main_options, 'phone') ? ' checked' : ''; ?> />
                                        Телефон
                                    </label>
                                </div>
                                <div class="wpm-row wpm-row-disabled"
                                     title="Это поле нельзя убрать из регистрационной формы">
                                    <label>
                                        <input type="checkbox" disabled checked/> Желаемый логин
                                    </label>
                                </div>
                                <div class="wpm-row wpm-row-disabled"
                                     title="Это поле нельзя убрать из регистрационной формы">
                                    <label>
                                        <input type="checkbox" disabled checked/> Желаемый пароль
                                    </label>
                                </div>
                                <div class="wpm-row wpm-row-disabled"
                                     title="Это поле нельзя убрать из регистрационной формы">
                                    <label>
                                        <input type="checkbox" disabled checked/> Код активации
                                    </label>
                                </div>
                                <div class="wpm-row">
                                    <label>
                                        <input type="checkbox"
                                               name="main_options[registration_form][custom1]"
                                            <?php echo wpm_reg_field_is_enabled($main_options, 'custom1') ? ' checked' : ''; ?> />
                                    </label>
                                    <input type="text" name="main_options[registration_form][custom1_label]"
                                           value="<?php echo $main_options['registration_form']['custom1_label'] ?>">
                                </div>
                                <div class="wpm-row">
                                    <label>
                                        <input type="checkbox"
                                               name="main_options[registration_form][custom2]"
                                            <?php echo wpm_reg_field_is_enabled($main_options, 'custom2') ? ' checked' : ''; ?> />
                                    </label>
                                    <input type="text" name="main_options[registration_form][custom2_label]"
                                           value="<?php echo $main_options['registration_form']['custom2_label'] ?>">
                                </div>
                                <div class="wpm-row">
                                    <label>
                                        <input type="checkbox"
                                               name="main_options[registration_form][custom3]"
                                            <?php echo wpm_reg_field_is_enabled($main_options, 'custom3') ? ' checked' : ''; ?> />
                                    </label>
                                    <input type="text" name="main_options[registration_form][custom3_label]"
                                           value="<?php echo $main_options['registration_form']['custom3_label'] ?>">
                                </div>

                                <div class="wpm-tab-footer">
                                    <button type="submit"
                                            class="button button-primary wpm-save-options"><?php _e('Сохранить', 'wpm'); ?></button>
                                    <span class="buttom-preloader"></span>
                                </div>
                            </div>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_13_2">
                                <div class="wpm-row">
                                    <label>
                                        <input type="checkbox"
                                               name="main_options[user_agreement][enabled_login]"
                                            <?php echo wpm_option_is('user_agreement.enabled_login', 'on') ? ' checked' : ''; ?> >
                                        <?php _e('Вход в систему', 'wpm'); ?>
                                        <input type="text"
                                               name="main_options[user_agreement][login_link_title]"
                                               class="regular-text"
                                               value="<?php echo wpm_get_option('user_agreement.login_link_title', __('Пользовательское соглашение', 'wpm')); ?>"
                                        >
                                    </label>
                                </div>
                                <div class="wpm-row">
                                    <label>
                                        <input type="checkbox"
                                               name="main_options[user_agreement][enabled_registration]"
                                            <?php echo wpm_option_is('user_agreement.enabled_registration', 'on') ? ' checked' : ''; ?> >
                                        <?php _e('Регистрация', 'wpm'); ?>
                                        <input type="text"
                                               name="main_options[user_agreement][registration_link_title]"
                                               class="regular-text"
                                               value="<?php echo wpm_get_option('user_agreement.registration_link_title', __('пользовательское соглашение', 'wpm')); ?>"
                                        >
                                    </label>
                                </div>
                                <div class="wpm-row">
                                    <label>
                                        <input type="checkbox"
                                               name="main_options[user_agreement][enabled_footer]"
                                            <?php echo wpm_option_is('user_agreement.enabled_footer', 'on') ? ' checked' : ''; ?> >
                                        <?php _e('Под блоком меню', 'wpm'); ?>
                                        <input type="text"
                                               name="main_options[user_agreement][footer_link_title]"
                                               class="regular-text"
                                               value="<?php echo wpm_get_option('user_agreement.footer_link_title', __('Пользовательское соглашение', 'wpm')); ?>"
                                        >
                                    </label>
                                </div>
                                <div class="wpm-row">
                                    <label>
                                        <?php _e('Название', 'wpm'); ?>
                                        <input type="text"
                                               name="main_options[user_agreement][title]"
                                               class="large-text"
                                               value="<?php echo wpm_get_option('user_agreement.title', __('Пользовательское соглашение', 'wpm')); ?>"
                                        >
                                    </label>
                                </div>
                                <div class="wpm-control-row">
                                    <?php wp_editor(stripslashes(wpm_get_option('user_agreement.text')), 'wpm_user_agreement_text', array('textarea_name' => 'main_options[user_agreement][text]', 'editor_height' => 300)); ?>
                                </div>
                                <div class="wpm-tab-footer">
                                    <button type="submit"
                                            class="button button-primary wpm-save-options"><?php _e('Сохранить', 'wpm'); ?></button>
                                    <span class="buttom-preloader"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab-14" class="tab">
                    <div class="wpm-tab-content">
                        <div class="wpm-inner-tabs" tab-id="h-tabs-4">
                            <ul class="wpm-inner-tabs-nav">
                                <li>
                                    <a href="#wpm_inner_tab_14_1"><?php _e('Регистрация пользователей', 'wpm'); ?></a>
                                </li>
                                <li><a href="#wpm_inner_tab_14_2"><?php _e('Добавление ключей', 'wpm'); ?></a></li>
                            </ul>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_14_1">
                                <span>Массовая регистрация пользователей и предоставление им доступа к материалам.</span>

                                <div id="bulk-import-users" class="wpm-ajax-box-wrap">
                                    <div class="wpm-ajax-overlay">
                                        <p>Выполнение данной операции может занять до 10 минут. <br> Пожалуйста не
                                            закрывайте страницу!</p>

                                        <div class="wpm-spinner">
                                            <div class="rect1"></div>
                                            <div class="rect2"></div>
                                            <div class="rect3"></div>
                                            <div class="rect4"></div>
                                            <div class="rect5"></div>
                                        </div>
                                    </div>
                                    <div class="wpm-import-new wpm-ajax-tab">
                                        <div class="wpm-row">
                                            <label>
                                                Вставьте список емейлов (через запятую или каждый емейл в отдельной
                                                строке)<br>
                                                <textarea name="import-users" id="users-emails-str"
                                                          class="wpm-wide"></textarea>
                                            </label>
                                        </div>
                                        <div class="wpm-tab-footer">
                                            <button type="button"
                                                    class="button button-primary wpm-import-users"
                                                    id="import-add"><?php _e('Импортировать', 'wpm'); ?></button>
                                            <span class="buttom-preloader"></span>
                                        </div>
                                    </div>
                                    <div class="wpm-no-emails wpm-ajax-tab">
                                        <div class="wpm-row">
                                            <div class="wpm-col">
                                                <p>Не найдено корректных емейлов.</p>
                                            </div>
                                        </div>
                                        <div class="wpm-tab-footer">
                                            <button type="button"
                                                    class="button button-primary import-new-emails"><?php _e('Ввести новые емейлы', 'wpm'); ?></button>
                                        </div>
                                    </div>
                                    <div class="wpm-import-confirm wpm-ajax-tab">
                                        <div class="wpm-row">
                                            <div class="wpm-col">
                                                <p class="wpm-emails-count"></p>
                                                <ul id="import-emails">
                                                </ul>
                                            </div>
                                            <div class="wpm-col left-border">
                                                <p>Виберите уровень доступа</p>
                                                <select id="users-level"
                                                        class="users-level"><?php echo wpm_get_levels_select(); ?></select>

                                                <p>Время действия</p>
                                                <input type="number" size="2" min="1" max="99"
                                                       id="users-level-duration" value="12" maxlength="2"
                                                       style="width: 100px">
                                                <select name="units" id="users-units">
                                                    <option value="months" selected="">месяцев</option>
                                                    <option value="days">дней</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="wpm-tab-footer">
                                            <button type="button"
                                                    class="button import-new-emails"><?php _e('Ввести новые емейлы', 'wpm'); ?></button>
                                            <button type="button"
                                                    class="button button-primary wpm-import-users"
                                                    id="import-send"><?php _e('Создать пользователей', 'wpm'); ?></button>
                                        </div>
                                    </div>
                                    <div class="wpm-import-result wpm-ajax-tab">
                                        <div class="wpm-row">
                                            <div class="wpm-ajax-import-result"></div>
                                        </div>
                                        <div class="wpm-tab-footer">
                                            <button type="button"
                                                    class="button button-primary import-new-emails"><?php _e('Ввести новые емейлы', 'wpm'); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wpm-inner-tab-content" id="wpm_inner_tab_14_2">
                                <span><?php _e('Массовое добавление ключей пользователям.', 'wpm'); ?></span>

                                <div id="bulk-addkeys-users" class="wpm-ajax-box-wrap">
                                    <div class="wpm-ajax-overlay">
                                        <p><?php _e('Выполнение данной операции может занять до 10 минут. <br> Пожалуйста не закрывайте страницу!', 'wpm'); ?></p>

                                        <div class="wpm-spinner">
                                            <div class="rect1"></div>
                                            <div class="rect2"></div>
                                            <div class="rect3"></div>
                                            <div class="rect4"></div>
                                            <div class="rect5"></div>
                                        </div>
                                    </div>
                                    <div class="wpm-import-new wpm-ajax-tab">
                                        <div class="wpm-row">
                                            <label>
                                                <?php _e('Вставьте список емейлов (через запятую или каждый емейл в отдельной строке)', 'wpm'); ?>
                                                <br>
                                                <textarea name="import-users" id="users-emails-str"
                                                          class="wpm-wide"></textarea>
                                            </label>
                                        </div>
                                        <div class="wpm-tab-footer">
                                            <button type="button"
                                                    class="button button-primary wpm-import-users"
                                                    id="import-add"><?php _e('Проверить', 'wpm'); ?></button>
                                            <span class="buttom-preloader"></span>
                                        </div>
                                    </div>
                                    <div class="wpm-no-emails wpm-ajax-tab">
                                        <div class="wpm-row">
                                            <div class="wpm-col">
                                                <div class="message">
                                                    <p><?php _e('Не найдено корректных емейлов.', 'wpm'); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wpm-tab-footer">
                                            <button type="button"
                                                    class="button button-primary import-new-emails"><?php _e('Ввести новые емейлы', 'wpm'); ?></button>
                                        </div>
                                    </div>
                                    <div class="wpm-import-confirm wpm-ajax-tab">
                                        <div class="wpm-row">
                                            <div class="wpm-col">
                                                <div class="wpm-users-check-result"></div>
                                            </div>
                                            <div class="wpm-col left-border">
                                                <p><?php _e('Виберите уровень доступа', 'wpm'); ?></p>
                                                <select
                                                    class="users-level"><?php echo wpm_get_levels_select(); ?></select>

                                                <p><?php _e('Время действия', 'wpm'); ?></p>
                                                <input type="number" size="2" min="1" max="99"
                                                       id="users-level-duration" value="12" maxlength="2"
                                                       style="width: 100px">
                                                <select name="units" id="users-units">
                                                    <option value="months"
                                                            selected=""><?php _e('месяцев', 'wpm'); ?></option>
                                                    <option value="days"><?php _e('дней', 'wpm'); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="wpm-tab-footer">
                                            <button type="button"
                                                    class="button import-new-emails"><?php _e('Ввести новые емейлы', 'wpm'); ?></button>
                                            <button type="button"
                                                    class="button button-primary wpm-import-users"
                                                    id="import-send"><?php _e('Добавить коды доступа', 'wpm'); ?></button>
                                        </div>
                                    </div>
                                    <div class="wpm-import-result wpm-ajax-tab">
                                        <div class="wpm-row">
                                            <div class="wpm-ajax-import-result"></div>
                                        </div>
                                        <div class="wpm-tab-footer">
                                            <button type="button"
                                                    class="button button-primary import-new-emails"><?php _e('Ввести новые емейлы', 'wpm'); ?></button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                    <style type="text/css">

                        #users-emails-str {
                            max-width: 500px;
                            margin: 5px 0;
                        }

                        #users-emails-str.wpm-wide {
                            height: 200px;

                        }

                        .wpm-ajax-tab {
                            display: none;
                        }

                        .wpm-ajax-tab.wpm-import-new {
                            display: block;
                        }

                        .wpm-row .wpm-col {
                            min-width: 200px;
                            min-height: 1px;
                            display: inline-block;
                            vertical-align: top;
                            padding-right: 20px;
                        }

                        .wpm-col.left-border {
                            border-left: 1px solid #dddddd;
                            padding-left: 30px;
                            padding-bottom: 30px;
                        }

                        .wpm-row .wpm-col:last-child {
                            padding-right: 0;
                        }

                        .wpm-ajax-import-result .success span {
                            color: #1abc9c;
                        }

                        .wpm-ajax-import-result .fail span {
                            color: #d61e32;
                        }

                        .wpm-ajax-box-wrap {
                            position: relative;
                            padding: 0 0 5px 2px;
                        }

                        .wpm-ajax-box-wrap #users-units {
                            margin-top: -2px;
                        }

                        .wpm-ajax-overlay {
                            display: none;
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background-color: rgba(255, 255, 255, 1);
                            z-index: 100;
                        }

                        .wpm-ajax-overlay p {
                            padding: 100px 0 0;
                            max-width: 400px;
                            text-align: center;
                        }

                        .wpm-spinner {
                            position: absolute;
                            top: 70px;
                            left: 175px;
                            width: 50px;
                            height: 30px;
                            text-align: center;
                            font-size: 10px;
                        }

                        .wpm-spinner > div {
                            background-color: #1abc9c;
                            height: 100%;
                            width: 6px;
                            display: inline-block;

                            -webkit-animation: stretchdelay 1s infinite ease-in-out;
                            animation: stretchdelay 1s infinite ease-in-out;
                        }

                        .wpm-spinner .rect2 {
                            -webkit-animation-delay: -0.9s;
                            animation-delay: -0.9s;
                        }

                        .wpm-spinner .rect3 {
                            -webkit-animation-delay: -0.8s;
                            animation-delay: -0.8s;
                        }

                        .wpm-spinner .rect4 {
                            -webkit-animation-delay: -0.7s;
                            animation-delay: -0.7s;
                        }

                        .wpm-spinner .rect5 {
                            -webkit-animation-delay: -0.6s;
                            animation-delay: -0.6s;
                        }

                        @-webkit-keyframes stretchdelay {
                            0%, 40%, 100% {
                                -webkit-transform: scaleY(0.4)
                            }
                            20% {
                                -webkit-transform: scaleY(1.0)
                            }
                        }

                        @keyframes stretchdelay {
                            0%, 40%, 100% {
                                transform: scaleY(0.4);
                                -webkit-transform: scaleY(0.4);
                            }
                            20% {
                                transform: scaleY(1.0);
                                -webkit-transform: scaleY(1.0);
                            }
                        }

                    </style>
                    <script type="text/javascript">

                        jQuery(function ($) {

                            // add new users

                            var emails = [];
                            var filtered_emails = [];
                            var import_emails = $('#bulk-import-users #import-emails');
                            $(document).on('click', '#bulk-import-users #import-add', function (e) {
                                $('#bulk-import-users .wpm-ajax-overlay').fadeIn('fast', function () {
                                    $.ajax({
                                        type: 'POST',
                                        url: ajaxurl,
                                        dataType: 'json',
                                        data: {
                                            'action': 'wpm_parse_emails_action',
                                            'emails': $('#bulk-import-users #users-emails-str').val()
                                        },
                                        success: function (data) {
                                            //console.log(data);

                                            if (data.count != 0) {
                                                $('#bulk-import-users .wpm-ajax-tab').hide();
                                                $('#bulk-import-users .wpm-import-confirm').show();

                                                $('#bulk-import-users .wpm-emails-count').html('Найдено емейлов: <b>' + data.count + '</b>');
                                                filtered_emails = data.emails;
                                                for (var i = 0; i < Object.keys(data.emails).length; i++) {
                                                    import_emails.append('<li>' + data.emails[i] + '</li>');
                                                }
                                            } else {
                                                $('#bulk-import-users .wpm-ajax-tab').hide();
                                                $('#bulk-import-users .wpm-no-emails').show();
                                            }

                                            $('#bulk-import-users .wpm-ajax-overlay').fadeOut('fast');
                                        }
                                    });
                                });
                                e.preventDefault();
                            });
                            $(document).on('click', '#bulk-import-users .import-new-emails', function () {
                                $('#bulk-import-users .wpm-ajax-overlay').fadeIn('fast', function () {
                                    $('#bulk-import-users .wpm-ajax-tab').hide();
                                    $('#bulk-import-users .wpm-import-new').show();
                                    import_emails.html('');
                                    $('#bulk-import-users #users-emails-str').val('');
                                    $('#bulk-import-users .wpm-ajax-overlay').fadeOut('fast');
                                });
                            });
                            $(document).on('click', '#bulk-import-users #import-send', function (e) {
                                $('#bulk-import-users .wpm-ajax-overlay').fadeIn('fast', function () {

                                    $('#bulk-import-users .wpm-ajax-tab').hide();
                                    $('#bulk-import-users .wpm-import-result').show();

                                    $.ajax({
                                        type: 'POST',
                                        url: ajaxurl,
                                        dataType: 'json',
                                        async: true,
                                        data: {
                                            'action': 'wpm_import_users_action',
                                            'emails': filtered_emails,
                                            'term_id': $('#bulk-import-users #users-level').val(),
                                            'duration': $('#bulk-import-users #users-level-duration').val(),
                                            'units': $('#bulk-import-users #users-units').val()

                                        },
                                        success: function (data) {
                                            //console.log(data);
                                            if (data.count_fails == 0) {
                                                var html = '<p><b>Все пользователи успешно зарегистрированы!</b></p>';
                                            }
                                            if (data.count == 0) {
                                                var html = '<p><b>Ни один пользователь не зарегистрирован!</b></p>';
                                            } else {

                                            }
                                            if (data.count != 0 && data.count_fails != 0) {
                                                var html = '<p><b>Не все пользователи зарегистрированы!</b></p>';
                                            }

                                            if (data.count != 0) {
                                                var html = html + '<p><b>Зарегистрировано: ' + data.count + '</b></p>';
                                                for (var i = 0; i < data.count; i++) {
                                                    html = html + '<p class="success">' + data.emails[i].email + ' : <span>' + data.emails[i].message + '</span></p>';
                                                }
                                            }

                                            if (data.count_fails != 0) {
                                                var html = html + '<p><b>Не зарегистрировано: ' + data.count_fails + '</b></p>';
                                                for (var i = 0; i < data.count_fails; i++) {
                                                    html = html + '<p class="fail">' + data.fails[i].email + ' : <span>' + data.fails[i].message + '</span></p>';

                                                }
                                            }

                                            $('#bulk-import-users .wpm-ajax-import-result').html(html);
                                            $('#bulk-import-users .wpm-ajax-overlay').fadeOut('fast');
                                        }
                                    });
                                });
                                e.preventDefault();
                            });

                            // add keys to users
                            var addkeys_emails = [];
                            var addkeys_filtered_emails = [];

                            $(document).on('click', '#bulk-addkeys-users #import-add', function (e) {
                                $('#bulk-addkeys-users .wpm-ajax-overlay').fadeIn('fast', function () {
                                    $.ajax({
                                        type: 'POST',
                                        url: ajaxurl,
                                        dataType: 'json',
                                        data: {
                                            'action': 'wpm_parse_emails_and_check_users_action',
                                            'emails': $('#bulk-addkeys-users #users-emails-str').val()
                                        },
                                        success: function (data) {
                                            //console.log(data);

                                            var html = '';
                                            var email_list = '';

                                            // in no emails found
                                            if (data.count_registered == 0 && data.count_not_registered == 0) {
                                                console.log('log');
                                                $('#bulk-addkeys-users .wpm-ajax-tab').hide();
                                                $('#bulk-addkeys-users .message').html('<p>Не найдено корректных емейлов.</p>');
                                                $('#bulk-addkeys-users .wpm-no-emails').show();

                                            } else {
                                                $('#bulk-addkeys-users .wpm-ajax-tab').hide();
                                                $('#bulk-addkeys-users .wpm-import-confirm').show();

                                                if (data.count_registered == 0) {
                                                    $('#bulk-addkeys-users .wpm-ajax-tab').hide();
                                                    $('#bulk-addkeys-users .message').html('<p>Нет пользователей с такими емейлами</p>');
                                                    $('#bulk-addkeys-users .wpm-no-emails').show();

                                                } else {

                                                    addkeys_filtered_emails = data.email_registered;

                                                    html = html + '<b>Зарегистрированые: ' + data.count_registered + '</b>';
                                                    email_list = '';
                                                    for (var i = 0; i < Object.keys(data.email_registered).length; i++) {
                                                        email_list = email_list + '<li>' + data.email_registered[i] + '</li>';
                                                    }
                                                    html = html + '<ul>' + email_list + '</ul>';
                                                }

                                                if (data.count_not_registered != 0) {

                                                    html = html + '<b class="red">Не зарегистрированные: ' + data.count_not_registered + '</b>';
                                                    email_list = '';
                                                    for (var i = 0; i < Object.keys(data.email_not_registered).length; i++) {
                                                        email_list = email_list + '<li>' + data.email_not_registered[i] + '</li>';
                                                    }
                                                    html = html + '<ul>' + email_list + '</ul>';

                                                }

                                            }
                                            $('#bulk-addkeys-users .wpm-users-check-result').html(html);
                                            $('#bulk-addkeys-users .wpm-ajax-overlay').fadeOut('fast');


                                        }
                                    });
                                });
                                e.preventDefault();
                            });
                            $(document).on('click', '#bulk-addkeys-users .import-new-emails', function () {
                                $('#bulk-addkeys-users .wpm-ajax-overlay').fadeIn('fast', function () {
                                    $('#bulk-addkeys-users .wpm-ajax-tab').hide();
                                    $('#bulk-addkeys-users .wpm-import-new').show();
                                    $('#bulk-addkeys-users #users-emails-str').val('');
                                    $('#bulk-addkeys-users .wpm-ajax-overlay').fadeOut('fast');
                                });
                            });
                            $(document).on('click', '#bulk-addkeys-users #import-send', function (e) {
                                $('#bulk-addkeys-users .wpm-ajax-overlay').fadeIn('fast', function () {

                                    $('#bulk-addkeys-users .wpm-ajax-tab').hide();
                                    $('#bulk-addkeys-users .wpm-import-result').show();

                                    $.ajax({
                                        type: 'POST',
                                        url: ajaxurl,
                                        dataType: 'json',
                                        async: true,
                                        data: {
                                            'action': 'wpm_bulk_add_key_to_user_action',
                                            'emails': addkeys_filtered_emails,
                                            'term_id': $('#bulk-addkeys-users .users-level').val(),
                                            'duration': $('#bulk-addkeys-users #users-level-duration').val(),
                                            'units': $('#bulk-addkeys-users #users-units').val()

                                        },
                                        success: function (data) {
                                            // console.log(data);
                                            if (data.count_fails == 0) {
                                                var html = '<p><b>Коды доступа успешно добавлены!</b></p>';
                                            }
                                            if (data.count == 0) {
                                                var html = '<p><b>Коды доступа не добавлены!</b></p>';
                                            } else {

                                            }
                                            if (data.count != 0 && data.count_fails != 0) {
                                                var html = '<p><b>Не всем пользователям добавлены коды доступа!</b></p>';
                                            }

                                            if (data.count != 0) {
                                                var html = html + '<p><b>Добавлено: ' + data.count + '</b></p>';
                                                for (var i = 0; i < data.count; i++) {
                                                    html = html + '<p class="success">' + data.emails[i].email + ' : <span>' + data.emails[i].message + '</span></p>';
                                                }
                                            }

                                            if (data.count_fails != 0) {
                                                var html = html + '<p><b>Не добавлено: ' + data.count_fails + '</b></p>';
                                                for (var i = 0; i < data.count_fails; i++) {
                                                    html = html + '<p class="fail">' + data.fails[i].email + ' : <span>' + data.fails[i].message + '</span></p>';

                                                }
                                            }

                                            $('#bulk-addkeys-users .wpm-ajax-import-result').html(html);
                                            $('#bulk-addkeys-users .wpm-ajax-overlay').fadeOut('fast');
                                        }
                                    });
                                });
                                e.preventDefault();
                            });

                            var $justclickGroups = $('#justclick_groups');
                            if($justclickGroups.length) {
                                $.post(ajaxurl, {
                                    'action': 'wpm_justclick_groups_select'
                                }, function(html) {
                                    $justclickGroups.html(html);
                                })
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </form>
</div>