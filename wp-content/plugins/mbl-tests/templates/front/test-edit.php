<div class="mbl-test">
    <?php if ($mblPage->hasHomeworkResponse()) { ?>
        <div class="form-group clearfix">
            <button id="mbl-tests_hide-show_btn" class="mbr-btn btn-medium btn-solid btn-green mbl-tests_hide-show_btn active">
                <span>
                    <i class="fa fa-caret-square-o-down"></i>
                    <?php _e('Показать тест', 'mbl'); ?>
                </span>
                <span>
                    <i class="fa fa-caret-square-o-up"></i>
                    <?php _e('Скрыть тест', 'mbl'); ?>
                </span>
            </button>
        </div>

        <div id="mbl_test_form" class="mbl-test-form">
            <ul class="mbl-test-questions-list">
                <?php foreach ($meta['test']['test_questions'] as $q => $question) { ?>
                    <li>
                        <span class="mt-question_number_color">
                            <?php _e('Вопрос #', 'mbl');
                            echo $q + 1; ?>
                        </span>

                        <div class="clearfix mt-question_text_color">
                            <?php echo apply_filters('the_content', $question['text']); ?>
                        </div>

                        <span class="mt-text_variants_color">
                            <?php _e('Варианты ответов:', 'mbl'); ?>
                        </span>

                        <ul class="mbl-test-answers-list">
                            <?php foreach ($question['answers'] as $a => $answer) { ?>
                                <li>
                                    <span class="mt-answer_number_color">
                                        <?php echo '#' . ($a + 1); ?>
                                    </span>

                                    <?php if ($question['type'] == 'single') { ?>
                                        <input
                                            type="radio"
                                            id="<?php echo 'answer_' . $q . '_' . $a; ?>"
                                            name="<?php echo 'question['.$q.']answer'; ?>"
                                            value="<?php echo $a; ?>"
                                            class="mbl-test-custom-input"
                                            <?php echo isset($result[$q][$a]) && $result[$q][$a]->checked == 'true' ? 'checked' : ''; ?>
                                            <?php echo $mblPage->isHomeworkDone() ? 'disabled' : ''; ?>
                                        >
                                        <label class="mbl-test-radio" for="<?php echo 'answer_' . $q . '_' . $a ?>">
                                        </label>
                                    <?php } else { ?>

                                        <input
                                            type="checkbox"
                                            id="<?php echo 'answer_' . $q . '_' . $a; ?>"
                                            name="<?php echo 'question['.$q.']answer_' . $a; ?>"
                                            class="mbl-test-custom-input"
                                            <?php echo isset($result[$q][$a]) && $result[$q][$a]->checked == 'true' ? 'checked' : ''; ?>
                                            <?php echo $mblPage->isHomeworkDone() ? 'disabled' : ''; ?>
                                        >
                                        <label class="mbl-test-checkbox" for="<?php echo 'answer_' . $q . '_' . $a ?>">
                                        </label>
                                    <?php } ?>

                                    <?php if ($answer['type'] == 'custom') { ?>
                                        <i class="iconmoon icon-commenting test-custom-item mt-you_answer_icon_color"></i>
  
                                        <label class="answer-text clearfix mt-you_answer_text_color" for="<?php //echo 'answer_' . $q . '_' . $a ?>">
											<?php _e('Ваш вариант ответа', 'mbl'); ?>
                                        </label>
                                    <?php } else{ ?>
                                        <label class="answer-text clearfix mt-answer_text_color" for="<?php //echo 'answer_' . $q . '_' . $a ?>">
											<?php echo apply_filters('the_content', $answer['text']); ?>
                                        </label>
                                    <?php } ?>

                                    <?php if ($answer['type'] == 'custom') { ?>
                                        <?php if ($mblPage->isHomeworkDone()) { ?>
                                            <div class="note-editor">
                                                <?php echo stripslashes_deep($result[$q][$a]->custom); ?>
                                            </div>
                                        <?php } else { ?>
                                            <?php
                                            //TODO: this fix for save quotes, but this is not good idea
                                            $answer = stripcslashes($result[$q][$a]->custom);
                                            wpm_editor($answer, 'custom_answer' . $q, [], false, 'custom_answer' . $q); ?>
                                                <button data-id="<?php echo '#custom_answer' . $q?>" class="mbr-btn btn-medium btn-solid btn-green mbl-tests_edit_btn active">
                                                    <span>
                                                        <?php _e('Готово', 'mbl'); ?>
                                                    </span>
                                                    <span>
                                                        <?php _e('Редактировать', 'mbl'); ?>
                                                    </span>
                                                </button>
                                            <?php if (wpm_homework_attachments_show()) : ?>
                                                <form class="test-attach-form"
                                                      id="<?php echo 'question-attach-form-'.$q ?>"
                                                      data-id="<?php echo $q ?>"
                                                      data-name="wpm_task_<?php echo $mblPage->getId(); ?>"
                                                      enctype="multipart/form-data"
                                                >
                                                    <div class="form-group file-upload-row">
                                                        <?php jquery_html5_file_upload_hook(); ?>
                                                    </div>
                                                </form>
                                            <?php endif; ?>
                                        <?php } ?>
                                    <?php } ?>

                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
            <?php if (!$mblPage->isHomeworkDone()) { ?>
                <div class="form-group clearfix">
                    <button type="submit"
                            class="mbr-btn btn-medium btn-solid btn-green write-message-button"
                            id="test-send-btn"
                            disabled
                    >
                        <div class="disable-message">
                            <?php _e('Измените ответы', 'mbl'); ?>
                        </div>
                        <?php _e('Отправить', 'mbl'); ?>
                    </button>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
    <div class="response-result"></div>

</div>
<script>

    if (!Array.prototype.find) {
        Array.prototype.find = function(predicate) {
            if (this == null) {
                throw new TypeError('Array.prototype.find called on null or undefined');
            }
            if (typeof predicate !== 'function') {
                throw new TypeError('predicate must be a function');
            }
            var list = Object(this);
            var length = list.length >>> 0;
            var thisArg = arguments[1];
            var value;

            for (var i = 0; i < length; i++) {
                value = list[i];
                if (predicate.call(thisArg, value, i, list)) {
                    return value;
                }
            }
            return undefined;
        };
    }

    $('#mbl_test_form').on('keyup change paste', 'input, textarea', function () {
        const button = $('#test-send-btn');
        const res = getAllAnswers();
        if (checkForAllAnswers(res)) {
            button.prop("disabled", false);
        } else {
            button.prop("disabled", true);
        }
    });

    $('#test-send-btn').on('click', function () {

        const res = getAllAnswers();
        const button = $('#test-send-btn');
        const result = $('.response-result');

        //Disable editors before sending
        $('.mbl-tests_edit_btn').each(function () {
            $(this).addClass('active');
        });
        $('#mbl_test_form textarea').each(function () {
            $(this).summernote('disable');
        });

        button.text('<?php _e('Отправка...', 'mbl'); ?>');
        button.prop('disabled', true);
        button.addClass('progress-button-active');

        $.post(
            ajaxurl,
            {
                action: 'wpm_add_response_action',
                post_id: <?php echo $mblPage->getId(); ?>,
                response_content: 'Test',
                response_type: '<?php echo $mblPage->getPostMeta('homework.checking_type'); ?>'
            },
            function (data) {
                if (data.error) {
                    result.html('<p class="alert alert-warning">' + data.message + '</p>').show();
                } else {

                    //send test results
                    $.post(
                        ajaxurl,
                        {
                            action: 'mbl_save_test_result',
                            post_id: <?php echo $mblPage->getId(); ?>,
                            data: res,
                        },
                        function (data) {
                            if (data.error) {
                                result.html('<p class="alert alert-warning">' + data.message + '</p>').show();
                            } else {
                                result.html('<p class="alert alert-success">' + data.message + '</p>').show();
                                
                                <?php if( defined('MBL_AUTOCHECK_VERSION')) {
                                    do_action('intervention_test-edit_script');
                                } else { ?>
                                    setTimeout(function() {
                                      window.location.reload();
                                    }, 1000);
                                <?php } ?>
                            }
                            button.removeClass('progress-button-active');
                            button.text('<?php _e('Отправить', 'mbl'); ?>');
                        },
                        "json"
                    );
                }
                button.removeClass('progress-button-active');
                button.text('<?php _e('Отправить', 'mbl'); ?>');
            },
            "json"
        );
    });

    function getAllAnswers() {
        let res = [];
        //make object with answers
        $('#mbl_test_form .mbl-test-questions-list > li').each(function () {
            let ans = [];

            $(this).find('.mbl-test-answers-list > li').each(function () {
                ans.push({
                    checked: $(this).find('input[type=radio], input[type=checkbox]').prop("checked"),
                    custom: $(this).find('textarea').val(),
                });
            });

            res.push(ans);
        });
        return res;
    }

    function checkForAllAnswers(res) {
        var AllHasAnswers = res.find(function (question) {
            return !question.find(function (answer) {
                return answer.checked;
            });
        });
        return !AllHasAnswers;
    }

    $('#mbl-tests_hide-show_btn').on('click', function () {
        $(this).toggleClass('active');
        if($(this).hasClass('active')) {
            $('#mbl_test_form').show()
        } else {
            $('#mbl_test_form').hide()
        }
    });

    $('.mbl-tests_edit_btn').on('click', function () {
        $(this).toggleClass('active');
        let editorID = $(this).data().id;
        $('#mbl_test_form textarea').trigger('change');
        if($(this).hasClass('active')) {
            $(editorID).summernote('disable')
        } else {
            $(editorID).summernote('enable')
        }
    });

    <?php if ($mblPage->hasHomeworkResponse()) { ?>
    $(document).ready(function() {
        $('#mbl_test_form textarea').each(function () {
            $(this).summernote('disable');
        });
    });
    <?php } ?>
</script>
