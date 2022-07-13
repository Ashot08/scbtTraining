jQuery(function ($) {
    'use strict';

    //---------------
    $('[data-toggle="tooltip"]').tooltip();

    $(document).on('click', '.close-dropdown-panel', function () {
        $('body').click();

        return false;
    });
    //---------------
    $('.search-toggle-button').toggleSearchPanel();

    //-----

    $('.toggle-category-description-button').toggleCategoryDescription();

    $('.mobile-menu-button').toggleMobileMenu();
    $('.panel-toggler').toggleMenuItemPanel();

    //-----
    $(document).on('click', '.user-profile-button', function () {
        var $button = $('.mobile-menu-button');
        if ($button.hasClass('active')) {
            $button.click();
        }
    });


    //-----
    $('.info-row button.edit').editUserInfoRow();

    $('.pass-row button.edit').editUserPassword();

    //------ refresh comments

    $('.refresh-comments').toggleCommentsRefresh();
    //-------

    $('.status-toggle-wrap').toggleLessonStatus();

    //--------------

    $('.toggle-key-cats').toggleKeyCategories();

    $(document).on('click', '#ask-dropdown', function () {
        var $holder = $(this).closest('.dropdown');

        $holder.toggleClass('open');
        $holder.find('[aria-labelledby="ask-dropdown"]').toggle();

        if ($holder.hasClass('open')) {
            $(document).trigger('mbl.login_backdrop.show');
        } else {
            $(document).trigger('mbl.login_backdrop.hide');
        }

        return false;
    });

    $(document).on('click', '.mbl-dropdown-menu .close-dropdown-panel', function (e) {
        closeAskDropdown(e);

        return false;
    });
    $(document).on('click', 'body', function (e) {
        closeAskDropdown(e);
    });
    $(window).on("orientationchange", function () {
        mblRecaptchaLoadCallback()
    });

    $('[data-mbl-release-date]').each(function () {
        var $this = $(this),
            ts = $this.data('mbl-release-date'),
            date;

        date = new Date(parseInt(ts) * 1000);

        $this.countdown({
            until    : date,
            compact  : true,
            layout   : $this.html(),
            onExpiry : function () {
                setTimeout(function () {
                    location.reload();
                }, 2000)
            }
        });
    });

    function closeAskDropdown(e) {
        var $holder = $('#ask-dropdown').closest('.dropdown.open');
        var isDorpdown = $(e.target).closest('.dropdown.open').length;
        var isModal = $(e.target).closest('.modal').length;

        if ($holder.length && !isDorpdown && !isModal) {
            $holder.removeClass('open');
            $holder.find('[aria-labelledby="ask-dropdown"]').hide();
        }

        $(document).trigger('mbl.login_backdrop.hide');
    }

    $(document).on('mbl.login_backdrop.show', function () {
        $('#mbl_login_backdrop').show();
        $('body').css('overflow', 'hidden');
    });
    $(document).on('mbl.login_backdrop.hide', function () {
        $('#mbl_login_backdrop').hide();
        $('body').css('overflow', 'visible');
    });

    $('[data-login-dropdown], [data-register-dropdown], [data-dropdown-backdrop]')
        .on('shown.bs.dropdown', function () {
            $(document).trigger('mbl.login_backdrop.show');
        }).on('hidden.bs.dropdown', function () {
        $(document).trigger('mbl.login_backdrop.hide');
    });
    
    $('[data-mbl-lesson-tasks]')
        .on('shown.bs.tab', function() {
            $(document).trigger('mbl.hide.comments');
        })
        .on('hidden.bs.tab', function() {
            $(document).trigger('mbl.show.comments');
        });
    
    $(document).on('mbl.hide.comments', function () {
        $('.wpm-comments-wrap').addClass('hidden');
    });
    
    $(document).on('mbl.show.comments', function () {
        $('.wpm-comments-wrap.hidden').removeClass('hidden');
    });
})

//-------

;(function ($) {

    //----- toggle lesson status

    $.fn.toggleLessonStatus = function () {
        var toggler,
            icon,
            label,
            $this = $(this);

        $this.on('change', function (e) {

            e.preventDefault();

            toggler = $(this);
            icon = toggler.find('.iconmoon');
            label = toggler.find('.toggle-label');

            var passed = !icon.hasClass('icon-toggle-on');
            if (passed) {
                icon.removeClass('icon-toggle-off').addClass('icon-toggle-on');
                label.text(dictionary.lessons.passed);
                changeProgressValue($this.data('passed'));
            } else {
                icon.removeClass('icon-toggle-on').addClass('icon-toggle-off');
                label.text(dictionary.lessons.not_passed);
                changeProgressValue($this.data('not-passed'));
            }
            $.post(ajaxurl, {action : 'wpm_ajax_pass_material', passed : passed | 0, post_id : toggler.data('id')});
        });

        function changeProgressValue(value) {
            $('.progress-bar').attr('aria-valuenow', value).css({width : value + '%'});
            $('.progress-count').text(value + '%');
        }
    };


    //----- toggle search panel

    $.fn.toggleSearchPanel = function (options) {
        var params = $.fn.getSearchParams(options);
        params.search_input.on('focusout', function () {

            setTimeout(function () {
                $.fn.closeSearchPanel();
                params.search_input.removeClass('focus');
            }, 200);
        });

        $(this).off('click');

        $(this).on('click', function (e) {
            if (params.search_toggle_button.hasClass('active')) {
                $.fn.closeSearchPanel();
            } else {
                if (params.search_input.hasClass('focus')) return;
                $.fn.openSearchPanel();
                params.search_input.removeClass('focus');
            }
        });
    };

    $.fn.getSearchParams = function (options) {
        var searchToggleButton = $('.search-toggle-button');
        var defaults = {
            'search_toggle_button' : searchToggleButton,
            'search_toggle_icon'   : searchToggleButton.children('.iconmoon'),
            'search_input'         : $('#search-input'),
            'search_panel'         : $('.search-hint-form')
        };
        return $.extend({}, defaults, options)
    };

    $.fn.openSearchPanel = function (options) {
        var params = $.fn.getSearchParams(options);

        function open() {
            params.search_panel.addClass('active');
            params.search_toggle_button.addClass('active');
            params.search_toggle_icon.removeClass('icon-search').addClass('icon-close');
            params.search_input.addClass('focus').focus();
        }

        open();
    };

    $.fn.closeSearchPanel = function (options) {
        var params = $.fn.getSearchParams(options);

        function close() {
            params.search_panel.removeClass('active');
            params.search_toggle_button.removeClass('active');
            params.search_toggle_icon.removeClass('icon-close').addClass('icon-search');
        }

        close();
    };


    $.fn.toggleCategoryDescription = function () {
        var category_content_wrap = $('.page-description-content'),
            category_content = category_content_wrap.find('.content'),
            button_text = '',
            toggle_content_button = $('.toggle-category-description-button');

        $(this).on('click', function () {
            button_text = $(this).find('.text');
            if ($(this).hasClass('active')) {
                toggle_content_button.removeClass('active');
                category_content_wrap.removeClass('visible');
                category_content.slideUp();
                toggle_content_button.find('.iconmoon').removeClass('icon-close').addClass('icon-angle-down');
            } else {
                toggle_content_button.addClass('active');
                category_content_wrap.addClass('visible');
                category_content.slideDown();
                toggle_content_button.find('.iconmoon').removeClass('icon-angle-down').addClass('icon-close');
            }
        });
    };

    $.fn.toggleKeyCategories = function () {
        var key_row,
            cat_row,
            toggle_button,
            toggle_button_arrow;

        $(this).on('click', function () {
            get_elements($(this));

            function get_elements(element) {
                key_row = element.parent().parent().parent('.key-row');
                cat_row = key_row.next('.row-key-categories');
                toggle_button = key_row.find('.toggle-key-cats');
                toggle_button_arrow = toggle_button.find('.iconmoon');
            }

            function open() {
                toggle_button.addClass('active');
                key_row.addClass('active');
                cat_row.addClass('active');
                toggle_button_arrow.removeClass('icon-angle-down').addClass('icon-angle-up');
            }

            function close() {
                toggle_button.removeClass('active');
                cat_row.removeClass('active');
                key_row.removeClass('active');
                toggle_button_arrow.addClass('icon-angle-down').removeClass('icon-angle-up');
            }

            if (cat_row.hasClass('active')) {
                close();
            } else {
                open();
            }
        });
    };

    //---------------

    $.fn.toggleMobileMenu = function () {
        var mobile_menu_button = $(this),
            mobile_menu = $('.mobile-menu-row'),
            body = $('body');

        $(this).on('click', function () {
            if ($(this).hasClass('active')) {
                mobile_menu_button.removeClass('active');
                mobile_menu.removeClass('visible');
                body.removeClass('mobile-menu-in');
            } else {
                mobile_menu_button.addClass('active');
                mobile_menu.addClass('visible');
                body.addClass('mobile-menu-in');
            }

        });
    };

    //----- refresh comments

    $.fn.toggleCommentsRefresh = function () {
        var refresh_comments_button = $(this),
            refresh_text = $(this).find('.text');

        $(this).on('click', function (e) {
            e.preventDefault();
            if ($(this).hasClass('active')) {
                refresh_comments_button.removeClass('active');
                refresh_text.text(dictionary.update);
            } else {
                refresh_comments_button.addClass('active');
                refresh_text.text(dictionary.loading);
            }
        });
    };

    //---------------

    $.fn.toggleMenuItemPanel = function () {
        var menu_items = $(this),
            menu_item,
            menu_item_panel;

        menu_items.on('click', function () {
            var mobileMenu = $('.mobile-menu');
            menu_item = $(this);
            menu_item_panel = menu_item.next('.slide-down-wrap');

            if (menu_item.hasClass('active')) {
                mobileMenu.find('a.active').removeClass('active');
                mobileMenu.find('div.visible').removeClass('visible').slideUp('fast');
                menu_item.removeClass('active');
                menu_item_panel.removeClass('visible').slideUp('fast');
            } else {
                mobileMenu.find('a.active').removeClass('active');
                mobileMenu.find('div.visible').removeClass('visible').slideUp('fast');
                menu_item.addClass('active');
                menu_item_panel.addClass('visible').slideDown('fast');
            }
        });
    };

    //-----

    $.fn.editUserInfoRow = function () {
        var info_row,
            edit_button,
            cancel_button,
            save_button,
            info_editable_field;

        $(this).on('click', function () {

            get_elements($(this));

            function get_elements(element) {
                info_row = element.parent().parent();
                edit_button = info_row.find('.edit');
                cancel_button = info_row.find('.cancel');
                save_button = info_row.find('.save');
                info_editable_field = info_row.find('.info-value');
            }

            function close() {
                edit_button.removeClass('hide');
                info_row.removeClass('active');
                cancel_button.addClass('hide');
                save_button.addClass('hide');
                info_editable_field.removeClass('active').attr('disabled', 'disabled');
            }

            function open() {
                edit_button.addClass('hide');
                info_row.addClass('active');
                cancel_button.removeClass('hide');
                save_button.removeClass('hide');
                info_editable_field.addClass('active').removeAttr('disabled').focus();
            }

            if (info_row.hasClass('active')) {
                close();
            } else {
                open();
            }

            cancel_button.on('click', function () {
                get_elements($(this));
                close();
            });
            save_button.on('click', function () {
                get_elements($(this));
                close();
            });
        });
    };

    //-----

    //-----

    $.fn.editUserPassword = function () {
        var info_row,
            edit_button,
            cancel_button,
            save_button,
            hide_button,
            user_password_field;

        $(this).on('click', function () {
            get_elements($(this));

            function get_elements(element) {
                info_row = element.parent().parent();
                edit_button = info_row.find('.edit');
                cancel_button = info_row.find('.cancel');
                save_button = info_row.find('.save');
                hide_button = info_row.find('.hide-pass');
                user_password_field = info_row.find('.user-password');
            }

            function close() {
                edit_button.removeClass('hide');
                info_row.removeClass('active');
                cancel_button.addClass('hide');
                save_button.addClass('hide');
                user_password_field.removeClass('active').attr('disabled', 'disabled');
            }

            function open() {
                edit_button.addClass('hide');
                info_row.addClass('active');
                cancel_button.removeClass('hide');
                save_button.removeClass('hide');
                user_password_field.addClass('active').removeAttr('disabled').focus();
            }

            hide_button.on('click', function () {
                if (user_password_field.attr('type') == 'password') {
                    user_password_field.attr('type', 'text');
                    hide_button.text(dictionary.hide);
                } else {
                    user_password_field.attr('type', 'password');
                    hide_button.text(dictionary.show);
                }
            });

            if (info_row.hasClass('active')) {
                close();
            } else {
                open();
            }

            cancel_button.on('click', function () {
                get_elements($(this));
                close();
            });
            save_button.on('click', function () {
                get_elements($(this));
                close();
            });
        });
    };

    //--------


})(jQuery, window, document);

function mblRecaptchaLoadCallback() {
    var $elements = jQuery('.g-recaptcha');

    if (typeof grecaptcha === 'undefined') {
        return;
    }

    $elements.each(function () {
        var $elem = jQuery(this),
            $submit = $elem.closest('form').find('[type="submit"]'),
            id;

        $submit.prop('disabled', true);

        if (!$elem.children().length) {
            id = grecaptcha.render($elem[0], {
                sitekey  : $elem.data('sitekey'),
                size     : (jQuery(window).width() < 768 || $elem.data('is-mobile') ? 'compact' : 'normal'),
                callback : function () {
                    $submit.prop('disabled', false);
                }
            });

            $elem.data('widget-id', id);
        } else {
            grecaptcha.reset($elem.data('widget-id'));
        }
    });
}

function uploadSummernoteImageFront(image, editor) {
    var editorId = editor[0].getAttribute('id');
    if (image && typeof image !== undefined) {
        if (image['size'] > wp_max_uload_size) {
            alert('Файл не должен быть больше ' + bytesToSize(wp_max_uload_size));
            return false;
        }
        if (image['type'].indexOf('image') == -1) {
            alert('Загружаемый файл должен быть изображением!');
            return false;
        }
        var fd = new FormData();
        fd.append('action', 'uploadSummernoteFile');
        fd.append('file', image);
        fd.append('file_type', 'image');

        jQuery.ajax({
            type        : 'POST',
            url         : ajaxurl,
            data        : fd,
            contentType : false,
            processData : false,
            xhr         : function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        jQuery('#' + editorId + '-upload-image-progress-bar-wrap').fadeIn();
                        jQuery('#' + editorId + '-upload-image-progress-bar-wrap .progress-bar').css('width', percentComplete + '%').attr('aria-valuenow', percentComplete);
                    }
                }, false);
                return xhr;
            },
            beforeSend  : function (xhr) {
                jQuery('body').on('click', '#' + editorId + '-upload-image-progress-bar-wrap .cancel-upload', function (e) {
                    e.preventDefault();
                    xhr.abort();
                    jQuery('#' + editorId + '-upload-image-progress-bar-wrap').fadeOut(200, "linear", function () {
                        jQuery('#' + editorId + '-upload-image-progress-bar-wrap .progress-bar').removeAttr('style aria-valuenow');
                    });
                });
            },
            success     : function (response) {
                if (response.success) {
                    setTimeout(function () {
                        jQuery('#' + editorId + '-upload-image-progress-bar-wrap').fadeOut(200, "linear", function () {
                            jQuery('#' + editorId + '-upload-image-progress-bar-wrap .progress-bar').removeAttr('style aria-valuenow');
                        });
                    }, 500);
                    var image = jQuery('<img>').attr('src', response.data).addClass('summerNoteImgMargin');
                    jQuery('#' + editorId).summernote("insertNode", image[0]);
                } else {
                    alert(response.data);
                }
            },
            error       : function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.status, textStatus, errorThrown);
            }
        });
    }
}
