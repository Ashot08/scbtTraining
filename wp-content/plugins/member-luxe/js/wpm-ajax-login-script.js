/**
 * Created by Nick on 5/28/14.
 */
jQuery(function($) {


    // Perform AJAX login on form submit
    $(document).on('submit', 'form#login', function(e){
        $('form#login p.status').show().text(ajax_login_object.loadingmessage);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_login_object.ajaxurl,
            data: {
                'action': 'wpm_ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#login #username').val(),
                'password': $('form#login #password').val(),
                'security': $('form#login #security').val(),
                'remember': $('form#login [name="remember"]').val()
            },
            success: function(data){
                $('form#login p.status').text(data.message);
                if (data.loggedin == true){
                   // document.location.href = ajax_login_object.redirecturl;
                }
            }
        });
        e.preventDefault();
    });

});