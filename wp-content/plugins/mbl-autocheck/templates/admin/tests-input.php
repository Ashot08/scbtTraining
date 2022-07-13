<?php $page_meta = get_post_meta(get_the_ID(), '_wpm_page_meta', true); ?>

<div id="right_answers_for_autocheck_row">
  <i class="fa fa-key"></i>
	<?php _e('Минимальное количество вопросов, на которые пользователь должен ответить правильно для автоматического прохождения теста', 'mbl_autocheck'); ?>:
  <input type="number"
         name="page_meta[right-answers-for-autocheck]"
         value="<?php echo isset($page_meta['right-answers-for-autocheck']) ? $page_meta['right-answers-for-autocheck'] : 0; ?>"
         style="width: 80px"
  >
</div>

<script>
  function displayAutocheckFields() {
    let field = jQuery('#right_answers_for_autocheck_row');
    if (jQuery('#confirmation_method_manually').is(':checked')) {
      field.hide();
    } else {
      field.show();
    }
  }

  jQuery('[name="page_meta[confirmation_method]"]').on('change', function () {
    displayAutocheckFields();
  });

  displayAutocheckFields();
</script>

<style>
  #right_answers_for_autocheck_row {
    margin-bottom: 20px;
    text-align: right
  }
</style>