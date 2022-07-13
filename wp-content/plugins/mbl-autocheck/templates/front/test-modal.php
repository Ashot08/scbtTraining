<div class="modal fade in" id="mbl-test-results-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" style="transform: translate(0, calc(50vh - 100%));">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
					<span class="sr-only">закрыть</span>
				</button>
				<h4 class="modal-title" id="registration_label">
          <?php echo wpm_get_option('autocheck.modal_header'); ?>
        </h4>
			</div>
			<div class="modal-body">
  		  <?php echo wpm_get_option('autocheck.modal_text'); ?>
      
<!--				<p>-->
<!--					--><?php //_e('Вы ответили верно на', 'mbl'); ?>
<!--					<span id="test_result_right_answers"></span>-->
<!--					--><?php //_e('из', 'mbl'); ?>
<!--					<span id="test_result_total_questions"></span>-->
<!--					--><?php //_e('вопросов.', 'mbl'); ?>
<!--					--><?php //_e('Для прохождения теста нужно', 'mbl'); ?>
<!--					<span id="test_result_need_answers"></span>-->
<!--					--><?php //_e('верных ответов.', 'mbl'); ?>
<!--				</p>-->
   
			</div>
<!--			<div class="modal-footer empty">-->
<!--			-->
<!--			</div>-->
		</div>
	</div>
</div>

<script>
	function putTestResultsToModal(results) {
	  if (results.right_answers < results.need_answers) {
        //$('#test_result_right_answers').text(results.right_answers);
        //$('#test_result_need_answers').text(results.need_answers);
        //$('#test_result_total_questions').text(results.total_questions);

        $('#mbl-test-results-modal')
        .modal({show: true})
        .on('hide.bs.modal', function (e) {
          window.location.reload();
        })
	  } else {
        window.location.reload();
	  }
	}
</script>
