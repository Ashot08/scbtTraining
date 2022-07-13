jQuery(function ($) {
    var $productTypeSelect = $('select#product-type'),
        mblProductType = 'mbl_key',
        iprProductType = 'ipr_key';
    mblp_show_and_hide_panels();
    initClipBoard();

    $productTypeSelect.change(function () {
        mblp_show_and_hide_panels();
    });

    function mblp_show_and_hide_panels () {
        setTimeout(function () {
            var product_type = $productTypeSelect.val();

            if (product_type === mblProductType || product_type === iprProductType) {
                $('#crosssell_ids').parent().hide();
                $('.show_if_downloadable').hide();
            } else {
                $('#crosssell_ids').parent().show();
            }

            $('.hide_if_' + product_type).hide();
        }, 0);
    }

    function initClipBoard () {
        var clipboard = new Clipboard('[data-clipboard-target]');

        clipboard.on('success', function (e) {
            var $button = $(e.trigger),
                $res;

            if($button.length && $button.data('clipboard-result')) {
                $res = $('<span />', {'class' : 'mblp-clip-res'}).text($button.data('clipboard-result'));
                $res.insertAfter($button);

                setTimeout(function() {
                    $res.fadeOut(function() {
                        $res.remove();
                    });
                }, 2000);
            }
            e.clearSelection();
        });
    }

    $(document).on('change', '#_mbl_redirect', function () {
        if($(this).val() === 'custom') {
            $('#mbl_redirect_url').fadeIn();
        } else {
            $('#mbl_redirect_url').fadeOut();
        }
    });
});