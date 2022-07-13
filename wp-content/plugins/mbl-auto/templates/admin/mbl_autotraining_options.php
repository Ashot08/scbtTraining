<div id="mbla_autotraining_options" class="<?php echo wpm_array_get($term_meta, 'category_type') == 'on' ? '' : 'hidden'; ?>">
    <dl>
        <dt>
            <h4>
                <label>
                    <input type="hidden" name="term_meta[add_level_after_finish]" value="off">
                    <input
                            type="checkbox"
                            name="term_meta[add_level_after_finish]"
                            value="on"
						<?php echo wpm_array_get($term_meta, 'add_level_after_finish') == 'on' ? 'checked' : ''; ?>
                    >
					<?php _e('Добавить уровень доступа после завершения автотренига','mbl_admin');?>:</label>
            </h4>
        </dt>
        <dd>
			<?php _e('Уровень доступа', 'mbl_admin') ?>
            <select name="term_meta[add_level_term_key]">
				<?php foreach ($levels AS $level) :?>
                    <option
                            value="<?php echo $level->term_id; ?>"
						<?php echo $level->term_id == wpm_array_get($term_meta, 'add_level_term_key') ? 'selected' : ''; ?>
                    ><?php echo $level->name; ?></option>
				<?php endforeach; ?>
            </select>
            <p class="form-field">
                <?php
                wpm_render_partial('term-keys-period',
                    'admin',
                    [
                        'durationName'     => 'term_meta[add_level_duration]',
                        'duration'         => wpm_array_get($term_meta, 'add_level_duration', 12),
                        'unitsName'        => 'term_meta[add_level_duration_units]',
                        'units'            => wpm_array_get($term_meta, 'add_level_duration_units', 'months'),
                        'isUnlimitedName'  => 'term_meta[add_level_duration_is_unlimited]',
                        'isUnlimitedValue' => wpm_array_get($term_meta, 'add_level_duration_is_unlimited', 'off'),
                    ])
                ?>
            </p>
        </dd>
    </dl>
</div>