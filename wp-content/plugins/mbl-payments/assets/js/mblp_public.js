function mblp_loader($elem, action, replace) {
    var tpl = '<div class="loader-ellipse" loader>' +
        '<span class="loader-ellipse__dot"></span>' +
        '<span class="loader-ellipse__dot"></span>' +
        '<span class="loader-ellipse__dot"></span>' +
        '<span class="loader-ellipse__dot"></span>' +
        '</div>';

    action = action || 'start';
    replace = replace || true;

    if (action === 'start') {
        $elem[replace ? 'html' : 'append'](tpl)
    } else if (action === 'stop') {
        $elem.find('[loader]').remove();
    }
}

jQuery(function ($) {
    mblp_check_order_status();


    function mblp_check_order_status() {
        var $statusLoader = $('#mblp-status-loader'),
            interval,
            timeout;

        if ($statusLoader.length) {
            interval = setInterval(function () {
                $.ajax({
                    type     : 'POST',
                    dataType : 'json',
                    url      : ajaxurl,
                    data     : {
                        action   : "mblp_check_order_status",
                        order_id : $statusLoader.data('id')
                    },
                    success  : function (data) {
                        if (data.success && data.status !== undefined) {
                            if (data.status === 'completed' && data.link !== undefined) {
                                clearTimeout(timeout);
                                clearInterval(interval);
                                location.href = data.link;
                            }
                        } else if (data.message !== undefined) {
                            clearInterval(interval);
                            clearTimeout(timeout);
                            $statusLoader.html(data.message);
                        }
                    },
                    error    : function (errorThrown) {
                        clearInterval(interval);
                        clearTimeout(timeout);
                        $statusLoader.remove();
                        $('#mblp-status-loader-error').show();
                    }
                });
            }, 2000);
            timeout = setTimeout(function () {
                clearInterval(interval);
                $statusLoader.remove();
                $('#mblp-status-loader-error').show();
            }, 20000);
        }
    }

    $(document).on('mblp.place_order.change', function (e, enable) {
        var $orderReview = $('#order_review');
        var $userAgreementInput = $orderReview.find('.user_agreement_input:visible');
        
        if(enable && !$userAgreementInput.length || $userAgreementInput.prop('checked')) {
            $orderReview.find('.cart-proceed-button').prop('disabled', false);
            $('.mbl-access-sc-checkout').removeClass('mbl-access-locked');
        }
        
        if(!enable) {
            $orderReview.find('.cart-proceed-button').prop('disabled', true);
            $('.mbl-access-sc-checkout').addClass('mbl-access-locked');
        }
    });
});
