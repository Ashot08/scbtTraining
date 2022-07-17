jQuery(document).ready(function(){
    jQuery(document).on('click', '.cd__modal_toggler', function (){
        jQuery('.cd__modal_wrapper').slideToggle();
    })
})

jQuery(document).ready(function(){
    jQuery(document).on('click', '[data-action="cd__copy_key_to_clipboard"]', function(){
        const resultBlock = jQuery(this).parent().find('.cd__key_copy_result');
        jQuery('.cd__key_copy_result').html('');
        navigator.clipboard.writeText(jQuery(this).data('text')).then(
            function() {
                resultBlock.html('Код успешно скопирован в буфер обмена');
                /* clipboard successfully set */

            },
            function() {
                /* clipboard write failed */
                window.alert('Opps! Your browser does not support the Clipboard API')
            }
        )
    })
})

jQuery(document).on('click', '[data-action="toggle__add_new_student_form"]', function (){
    jQuery('.cd__add_new_student_form').slideToggle();
})
jQuery(document).on('click', '.cd__hidden_form_toggler', function (){
    jQuery(this).parent().find('.cd__hidden_form_box').slideToggle();
})
jQuery(document).on('change', '[data-action="cd__table_select_all"]', function (){
    const table = jQuery(this).closest('.cd__table');
    const isChecked = jQuery(this).prop('checked');
    table.find('[data-action="cd__select_item"]').prop('checked', isChecked);
    table.find('[data-action="cd__select_item"]').prop('disabled', isChecked);
});
jQuery(document).on('change', '.cd__chapters_list_item_input ', function (){
    const neighbours = jQuery(this).closest('.cd__chapters_list_items').find('.cd__chapters_list_item_input');
    //if(jQuery(this).hasClass('cd__checkbox_status_4')) return;
    let checkboxStatus = false;
    neighbours.each(function(){
        if(!jQuery(this).hasClass('cd__checkbox_status_4') && jQuery(this).prop('checked')){
            checkboxStatus = true;
        }
    })

    if(checkboxStatus){
        jQuery(this).closest('.cd__chapters_list_items').find('.cd__checkbox_status_4').prop('checked', checkboxStatus);
    }else if(jQuery(this).hasClass('cd__checkbox_status_4')){
        if(!jQuery(this).prop('checked')){
            jQuery(this).closest('.cd__chapters_list_items').find('.cd__checkbox_status_4').prop('checked', false);
        }else{
            jQuery(this).closest('.cd__chapters_list_items').find('.cd__checkbox_status_4').prop('checked', true);
        }
    }
});



