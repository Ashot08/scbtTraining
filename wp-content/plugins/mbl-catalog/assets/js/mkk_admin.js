jQuery(function ($) {
    //hide show fields in course catalog tab
    $('#mbl_key_course_catalog .trigger-select').on('change', function () {
        if( this.value !== '1'){
            $(this).closest('.options_group').find('.option-1').hide();
            $(this).closest('.options_group').find('.option-0').show();
        } else {
            $(this).closest('.options_group').find('.option-0').hide();
            $(this).closest('.options_group').find('.option-1').show();
        }
    }).trigger('change');
});