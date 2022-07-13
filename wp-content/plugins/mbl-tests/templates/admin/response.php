<ul class="display-test-result test-hide-origin">
    <?php if(isset($test['test_questions'])) { ?>
        <li>
            <span class="button mbl-test-show-all">
                <i class="fa fa-caret-square-o-down"></i>
                <?php _e('Показать все', 'mbl_tests'); ?>
            </span>

            <span class="button mbl-test-hide-all">
                <i class="fa fa-caret-square-o-up"></i>
                <?php _e('Скрыть все', 'mbl_tests'); ?>
            </span>
        </li>
        <?php foreach ($test['test_questions'] as $q => $question) { ?>
            <li>
                <div class="question_header">
                    <div class="mbl-test_question-number <?php echo $question['type'] == 'single' ? 'single' : ''; ?>">
                        <span><?php echo '#'; echo $q + 1; ?></span>
                    </div>
                    <div><?php echo apply_filters('the_content', $question['text']); ?></div>
                </div>
                <ul class="mbl-test-answers-list selected">
                    <li>
                        <b><?php _e('Ответ пользователя:', 'mbl_tests'); ?></b>
                    </li>
                    <?php if($question['answers']) { ?>
                        <?php foreach ($question['answers'] as $a => $answer) { ?>
                            <?php if(($question['type'] == 'single' && $result[$q][$a]->checked == 'true') || ($question['type'] != 'single' && $result[$q][$a]->checked == 'true')) { ?>
                                <li>
                                <b><?php echo '#' . ($a + 1); ?></b>

                                <?php if ($question['type'] == 'single') { ?>
                                    <input type="radio"
                                           id="<?php echo 'answer_corect' . $q . '_' . $a ?>"
                                           value="<?php echo $a; ?>"
                                           class="mbl-test-custom-input"
                                           <?php echo $question['answers'][0]['correctly'] == $a ? 'checked' : ''; ?>
                                           readonly
                                    >
                                    <label class="mbl-test-radio green" for="<?php echo 'answer_corect' . $q . '_' . $a ?>">
                                    </label>
                                    <input type="radio"
                                           id="<?php echo 'answer_' . $q . '_' . $a ?>"
                                           value="<?php echo $a; ?>"
                                           class="mbl-test-custom-input"
                                           <?php echo $result[$q][$a]->checked == 'true' ? 'checked' : ''; ?>
                                           readonly
                                    >
                                    <label class="mbl-test-radio blue" for="<?php echo 'answer_' . $q . '_' . $a ?>">
                                    </label>
                                <?php } else { ?>
                                    <input type="checkbox"
                                           id="<?php echo 'answer_corect' . $q . '_' . $a ?>"
                                           class="mbl-test-custom-input"
                                           <?php echo $answer['correctly'] == 'true' ? 'checked' : ''; ?>
                                           readonly
                                    >
                                    <label class="mbl-test-checkbox green" for="<?php echo 'answer_corect' . $q . '_' . $a ?>">
                                    </label>
                                    <input type="checkbox"
                                           id="<?php echo 'answer_' . $q . '_' . $a ?>"
                                           class="mbl-test-custom-input"
                                           <?php echo $result[$q][$a]->checked == 'true' ? 'checked' : ''; ?>
                                           readonly
                                    >
                                    <label class="mbl-test-checkbox blue" for="<?php echo 'answer_' . $q . '_' . $a ?>">
                                    </label>
                                <?php } ?>

                                <?php if ($answer['type'] == 'custom') { ?>
                                    <i class="iconmoon icon-commenting"></i>
                                <?php } ?>

                                <label class="answer-text">
                                    <?php echo apply_filters('the_content', $answer['text']) ?>
                                </label>

                                <?php if ($answer['type'] == 'custom' && $result[$q][$a]->checked == 'true') { ?>
                                    <div class="wpm_homework_reviews" style="width: 100%">
                                        <div class="comment-item <?php echo wpm_is_admin(wpm_array_get($review, 'user_id')) || wpm_is_coach(wpm_array_get($review, 'user_id')) ? '' : 'answer'; ?>">
                                            <article class="comment">
                                                <div class="comment-meta-wrap">
                                                    <div class="comment-meta">
                                                        <span class="comment-author-name">
                                                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                                            <?php echo wpm_get_user($response->user_id, 'display_name'); ?>
                                                        </span>
                                                        <span class="date"><span class="iconmoon icon-calendar"></span> <?php echo $response->mblPage->getHomeworkResponseDate($response->user_id); ?></span>
                                                        <span class="time"><span class="iconmoon icon-clock-o"></span> <?php echo $response->mblPage->getHomeworkResponseTime($response->user_id); ?></span>
                                                    </div>
                                                </div>
                                                <div class="comment-content">
                                                    <div class="comment-text clearfix">
                                                        <?php echo apply_filters('the_content', stripslashes($result[$q][$a]->custom));?>
                                                    </div>
                                                    <?php echo UploadHandler::getHomeworkAttachmentsAdminHtml($response->post_id.'_'.$q, $response->user_id); ?>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                <?php } ?>
                            </li>

                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </ul>

                <div class="buttons-block">
                    <span class="button mbl-test-show" >
                        <i class="fa fa-caret-square-o-down"></i>
                        <?php _e('Показать', 'mbl_tests'); ?>
                    </span>

                    <span class="button mbl-test-hide" style="display: none">
                        <i class="fa fa-caret-square-o-up"></i>
                        <?php _e('Скрыть', 'mbl_tests'); ?>
                    </span>
                </div>

                <ul class="mbl-test-answers-list" style="display: none">
                    <?php if($question['answers']) { ?>
                        <li>
                            <b><?php _e('Варианты ответов:', 'mbl_tests'); ?></b>
                        </li>
                        <?php foreach ($question['answers'] as $a => $answer) { ?>

                            <li>
                                <b><?php echo '#' . ($a + 1); ?></b>

                                <?php if ($question['type'] == 'single') { ?>
                                    <input type="radio"
                                           id="<?php echo 'answer_corect' . $q . '_' . $a ?>"
                                           value="<?php echo $a; ?>"
                                           class="mbl-test-custom-input"
                                           <?php echo $question['answers'][0]['correctly'] == $a ? 'checked' : ''; ?>
                                           readonly
                                    >
                                    <label class="mbl-test-radio green" for="<?php echo 'answer_corect' . $q . '_' . $a ?>">
                                    </label>
                                    <input type="radio"
                                           id="<?php echo 'answer_' . $q . '_' . $a ?>"
                                           value="<?php echo $a; ?>"
                                           class="mbl-test-custom-input"
                                           <?php echo $result[$q][$a]->checked == 'true' ? 'checked' : ''; ?>
                                           readonly
                                    >
                                    <label class="mbl-test-radio blue" for="<?php echo 'answer_' . $q . '_' . $a ?>">
                                    </label>
                                <?php } else { ?>
                                    <input type="checkbox"
                                           id="<?php echo 'answer_corect' . $q . '_' . $a ?>"
                                           class="mbl-test-custom-input"
                                           <?php echo $answer['correctly'] == 'true' ? 'checked' : ''; ?>
                                           readonly
                                    >
                                    <label class="mbl-test-checkbox green" for="<?php echo 'answer_corect' . $q . '_' . $a ?>">
                                    </label>
                                    <input type="checkbox"
                                           id="<?php echo 'answer_' . $q . '_' . $a ?>"
                                           class="mbl-test-custom-input"
                                           <?php echo $result[$q][$a]->checked == 'true' ? 'checked' : ''; ?>
                                           readonly
                                    >
                                    <label class="mbl-test-checkbox blue" for="<?php echo 'answer_' . $q . '_' . $a ?>">
                                    </label>
                                <?php } ?>

                                <?php if ($answer['type'] == 'custom') { ?>
                                    <i class="iconmoon icon-commenting"></i>
                                <?php } ?>

                                <label class="answer-text">
                                    <?php echo apply_filters('the_content', $answer['text']) ?>
                                </label>

                                <?php if ($answer['type'] == 'custom' && $result[$q][$a]->checked == 'true') { ?>
                                    <div class="wpm_homework_reviews" style="width: 100%">
                                        <div class="comment-item <?php echo wpm_is_admin(wpm_array_get($review, 'user_id')) || wpm_is_coach(wpm_array_get($review, 'user_id')) ? '' : 'answer'; ?>">
                                            <article class="comment">
                                                <div class="comment-meta-wrap">
                                                    <div class="comment-meta">
                                                        <span class="comment-author-name">
                                                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                                            <?php echo wpm_get_user($response->user_id, 'display_name'); ?>
                                                        </span>
                                                        <span class="date"><span class="iconmoon icon-calendar"></span> <?php echo $response->mblPage->getHomeworkResponseDate($response->user_id); ?></span>
                                                        <span class="time"><span class="iconmoon icon-clock-o"></span> <?php echo $response->mblPage->getHomeworkResponseTime($response->user_id); ?></span>
                                                    </div>
                                                </div>
                                                <div class="comment-content">
                                                    <div class="comment-text clearfix">
                                                        <?php echo apply_filters('the_content', stripslashes($result[$q][$a]->custom));?>
                                                    </div>
                                                    <?php echo UploadHandler::getHomeworkAttachmentsAdminHtml($response->post_id.'_'.$q, $response->user_id); ?>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>
    <?php } ?>
</ul>
<script>
    jQuery('.mbl-test-show').on('click', function () {
        jQuery(this).closest('li').find('.mbl-test-answers-list').show();
        jQuery(this).closest('li').find('.mbl-test-answers-list.selected').hide();
        jQuery(this).hide();
        jQuery(this).closest('li').find('.mbl-test-hide').show();
    });

    jQuery('.mbl-test-hide').on('click', function () {
        jQuery(this).closest('li').find('.mbl-test-answers-list:not(.selected)').hide();
        jQuery(this).closest('li').find('.mbl-test-answers-list.selected').show();
        jQuery(this).hide();
        jQuery(this).closest('li').find('.mbl-test-show').show();
    });

    jQuery('.mbl-test-show-all').on('click', function () {
        jQuery('.mbl-test-show').trigger('click');
    });

    jQuery('.mbl-test-hide-all').on('click', function () {
        jQuery('.mbl-test-hide').trigger('click');
    });
</script>