<?php if (wpm_option_is('hw.enabled_fields.coach', 'on', 'on')) : ?>
    <th>
        <?php if (wpm_option_is('hw.enabled_filters.coach', 'on', 'on')) : ?>
            <select name="coaches"  data-mbl-select-2 data-width="100%">
                <option value="" selected><?php _e('Все тренеры', 'mbl_admin'); ?></option>
                <?php foreach ($coaches AS $coach) : ?>
                    <option value="<?php echo $coach->ID; ?>"><?php echo $coach->display_name; ?></option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>
    </th>
<?php endif; ?>
