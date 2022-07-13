jQuery(function ($) {
  const test =$('#mbl-test-create');

  //toggle between tst and question
  $('#mbl-test-homework-type-selector input[type="radio"]').on('change', function () {
    if ($(this).val() == 'test') {
      test.removeClass('hidden')
    } else {
      test.addClass('hidden')
    }
  });

  const btnAddSingle = $('#mbl-test-question-single-create');
  
  btnAddSingle.on('click', function () {
    
  })
});