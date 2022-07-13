<style>
.mt-question_number_color {
  color: #<?php echo wpm_get_option('mt_design.question_number_color', '4a4a4a'); ?>;
}
.mt-question_text_color {
  color: #<?php echo wpm_get_option('mt_design.question_text_color', '4a4a4a'); ?>;
}
.mt-text_variants_color {
  color: #<?php echo wpm_get_option('mt_design.text_variants_color', '4a4a4a'); ?>;
}
.mt-answer_number_color {
  color: #<?php echo wpm_get_option('mt_design.answer_number_color', '4a4a4a'); ?>;
}

.mbl-test .mbl-test-questions-list .mbl-test-answers-list > li .mbl-test-radio,
.mbl-test .mbl-test-questions-list .mbl-test-answers-list > li .mbl-test-checkbox {
  color: #<?php echo wpm_get_option('mt_design.checkbox_color', '3d84e6'); ?>;
  border-color: #<?php echo wpm_get_option('mt_design.checkbox_color', '3d84e6'); ?>;
}
.mbl-test .mbl-test-questions-list .mbl-test-answers-list > li .mbl-test-custom-input[type=radio]:checked + label::before{
  background-color:#<?php echo wpm_get_option('mt_design.checkbox_color', '3d84e6'); ?>;
}

.mt-answer_text_color {
  color: #<?php echo wpm_get_option('mt_design.answer_text_color', '4a4a4a'); ?>;
}

.mt-you_answer_icon_color {
    color: #<?php echo wpm_get_option('mt_design.you_answer_icon_color', '4a4a4a'); ?>;
}

.mt-you_answer_text_color {
    color: #<?php echo wpm_get_option('mt_design.you_answer_text_color', '4a4a4a'); ?>;
}

.mbl-test .mbl-test-questions-list > li:not(:last-child) {
    border-color: #<?php echo wpm_get_option('mt_design.line_color', 'e3e3e3'); ?>;
}

.content-wrap .question-answer-row .title .iconmoon.mt-test_desc_icon_color {
    color: #<?php echo wpm_get_option('mt_design.test_desc_icon_color', '000'); ?>;
}

.content-wrap .question-answer-row .title.mt-test_desc_text_color {
    color: #<?php echo wpm_get_option('mt_design.test_desc_text_color', '000'); ?>;
}

</style>