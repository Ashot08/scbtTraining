<input type="hidden" id="mbla_stats_date_from_input" name="date_from" value="<?php echo date('d.m.Y', current_time('timestamp') - 7*24*60*60); ?>">
<input type="hidden" id="mbla_stats_date_to_input" name="date_to" value="<?php echo date('d.m.Y', current_time('timestamp')); ?>">
<div class="select2 select2-container select2-container--default select2-container--above mbla-dates-select" dir="ltr">
    <span class="selection">
        <span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true">
            <span class="select2-selection__rendered" role="textbox" aria-readonly="true" id="mbla-dates-placeholder"><?php echo date('d.m.Y', current_time('timestamp') - 7*24*60*60); ?> - <?php echo date('d.m.Y', current_time('timestamp')); ?></span>
            <span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
        </span>
    </span>
    <div class="mbla-dates-popup panel panel-default">
        <div class="date-title"><?php _e('Дата', 'mbl_admin'); ?></div>
        <div class="flex-row flex-wrap">
            <div class="flex-col-6 pr-10">
                <div class="mbla-date-label"><?php _e('Дата начала', 'mbl_admin'); ?></div>
                <div id="mbla_stats_date_from" class="mbla-date" data-start-date="<?php echo date('d.m.Y', current_time('timestamp') - 7*24*60*60); ?>"></div>
            </div>
            <div class="flex-col-6 pr-10">
                <div class="mbla-date-label"><?php _e('Дата окончания', 'mbl_admin'); ?></div>
                <div id="mbla_stats_date_to" class="mbla-date"></div>
            </div>
        </div>
        <div class="mbla-dates-buttons">
            <a href="#" class="close mbla-date-close"><?php _e('Отмена', 'mbl_admin'); ?></a>
            <a href="#" class="mbla-date-submit button button-primary"><?php _e('Применить', 'mbl_admin'); ?></a>
        </div>
    </div>
</div>