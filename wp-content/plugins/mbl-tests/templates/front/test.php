<div class="mbl-test">

    <div class="mbl-test-description">
        <div class="title mt-test_desc_text_color">
            <span class="iconmoon icon-list-alt mt-test_desc_icon_color"></span><?php _e('Описание теста', 'mbl'); ?>
        </div>
        <div class="content clearfix"><?php echo apply_filters('the_content', $meta['test']['test_description']); ?></div>
    </div>

    <?php if (!$mblPage->hasHomeworkResponse()) { ?>
        <button type="button"
                class="mbr-btn btn-medium btn-solid btn-green write-message-button"
                id="mbl-test-start"
        ><?php _e('Начать', 'mbl'); ?></button>

        <div id="mbl_test_form" class="mbl-test-form" style="display: none">

            <div class="title mt-test_desc_text_color">
                <span class="iconmoon icon-list-alt mt-test_desc_icon_color"></span><?php _e('Пройдите тест', 'mbl'); ?>
            </div>

            <ul class="mbl-test-questions-list">
                <?php if(wpm_array_get($meta, 'test.test_questions')) { ?>
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
                                <?php if(wpm_array_get($question, 'answers')) { ?>
                                    <?php foreach ($question['answers'] as $a => $answer) { ?>
                                        <li>
                                            <span class="mt-answer_number_color">
                                                <?php echo '#' . ($a + 1); ?>
                                            </span>

                                            <?php if ($question['type'] == 'single') { ?>
                                                <input type="radio" id="<?php echo 'answer_' . $q . '_' . $a; ?>"
                                                       name="<?php echo 'question['.$q.']answer'; ?>" value="<?php echo $a; ?>"
                                                       class="mbl-test-custom-input"
                                                >
                                                <label class="mbl-test-radio" for="<?php echo 'answer_' . $q . '_' . $a ?>">
                                                </label>
                                            <?php } else { ?>
                                                <input type="checkbox" id="<?php echo 'answer_' . $q . '_' . $a; ?>"
                                                       name="<?php echo 'question['.$q.']answer_' . $a; ?>"
                                                       class="mbl-test-custom-input"
                                                >
                                                <label class="mbl-test-checkbox" for="<?php echo 'answer_' . $q . '_' . $a ?>">
                                                </label>
                                            <?php } ?>

                                            <?php if ($answer['type'] == 'custom') { ?>
                                                <i class="iconmoon icon-commenting test-custom-item mt-you_answer_icon_color"></i>

                                                <label class="answer-text clearfix mt-you_answer_text_color" for="<?php //echo 'answer_' . $q . '_' . $a ?>">
													<?php _e('Ваш вариант ответа', 'mbl'); ?>
                                                </label>
                                            <?php } else {?>
                                                <label class="answer-text clearfix mt-answer_text_color" for="<?php //echo 'answer_' . $q . '_' . $a ?>">
													<?php echo apply_filters('the_content', $answer['text']); ?>
                                                </label>
                                            <?php } ?>

                                            <?php if ($answer['type'] == 'custom') { ?>
                                                <?php wpm_editor('', 'custom_answer' . $q, [], false, 'custom_answer' . $q) ?>
                                                <button data-id="<?php echo '#custom_answer' . $q?>" class="mbr-btn btn-medium btn-solid btn-green mbl-tests_edit_btn">
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
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
            <div class="form-group clearfix">
                <button type="submit"
                        class="mbr-btn btn-medium btn-solid btn-green write-message-button"
                        id="test-send-btn"
                        disabled
                >
                    <div class="disable-message">
                        <?php _e('Ответьте на все вопросы', 'mbl'); ?>
                    </div>
                    <?php _e('Отправить', 'mbl'); ?>
                </button>
            </div>
        </div>
    <?php } ?>
    <div class="response-result"></div>

</div>
<?php if (!$mblPage->hasHomeworkResponse()) { ?>
    <script>
        $('#mbl-test-start').on('click', function () {
            $('#mbl-test-start ~ .mbl-test-form').show();
            $(this).hide();
        });
    </script>
<?php } ?>