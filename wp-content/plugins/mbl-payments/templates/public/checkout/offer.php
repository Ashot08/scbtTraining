<div class="offer-checkbox">
    <label>
        <input type="checkbox" class="" id="offer_checkbox_input"/>
        &nbsp;<?php _e('Принимаю', 'mbl'); ?>
        <a class="link"
           data-toggle="modal"
           data-target="#wpmp_user_offer"><?php echo wpm_get_option('mblp_texts.offer_name', __('Оферта', 'mbl')); ?></a>
    </label>
</div>

<script type="text/javascript">
    jQuery(function ($) {
        if (!$('#offer_checkbox_input').prop('checked')) {
            $('#place_order').prop('disabled', true);
        }

        $('#offer_checkbox_input').off('change').on('change', function () {
            var $this = $(this);
            $(document).trigger('mblp.place_order.change', $this.prop('checked'));
        });

        $('#wpm_user_offer_reject').off('click').on('click', function () {
            $('#wpmp_user_offer').modal('hide');
            $('#offer_checkbox_input').prop('checked', false);
            $(document).trigger('mblp.place_order.change', false);

            return false;
        });
        
        $('#wpm_user_offer_accept').off('click').on('click', function () {
            $('#wpmp_user_offer').modal('hide');
            $('#offer_checkbox_input').prop('checked', true);
            $(document).trigger('mblp.place_order.change', true);

            return false;
        });
    });
</script>
