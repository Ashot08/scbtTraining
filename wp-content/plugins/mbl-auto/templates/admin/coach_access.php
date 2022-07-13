<?php /** @var WP_Term[] $autotrainings */ ?>
<?php /** @var WP_User $user */ ?>
<?php /** @var string $accessAll */ ?>
<?php /** @var string $levelsAccessAll */ ?>
<?php /** @var string $statsAccess */ ?>
<?php /** @var string $disableOthersStatsAccess */ ?>
<?php /** @var array $access */ ?>
<?php /** @var array $levelsAccess */ ?>
<table id="mbla_coach_access_holder">
    <tr id="mbla_coach_access">
        <th><label><?php _e('Проверка заданий', 'mbl'); ?></label></th>
        <td>
            <div class="mbla-settings-color">
                <div class="mbla-autotraining-config-row mbla-bold" id="mbla_coach_access_all">
                    <?php wpm_render_partial('fields/checkbox', 'admin', array('label' => __('Все автотренинги', 'mbl_admin'), 'name' => (MBLAAdmin::COACH_ACCESS_META . '_all[is_enabled]'), 'value' => ($accessAll === 'off' ? 'off' : 'on'))) ?>
                    <?php if (defined('MBL_TESTS_VERSION')) { ?>
                        <select id="mbla_coach_access_all_type" data-mbla-select-icons name="<?php echo MBLAAdmin::COACH_ACCESS_META . '_all[type]' ?>" <?php echo $accessAll === 'off' ? 'disabled' : ''?>>
                            <option value="all" <?php echo $accessAll == 'all'? 'selected' : '' ?>><?php _e('Все типы заданий', 'mbl'); ?></option>
                            <option data-icon="icon-list-alt" value="test" <?php echo $accessAll == 'test'? 'selected' : '' ?>><?php _e('Тесты', 'mbl'); ?></option>
                            <option data-icon="icon-question-circle" value="question" <?php echo $accessAll == 'question'? 'selected' : '' ?>><?php _e('Вопросы', 'mbl'); ?></option>
                        </select>
                    <?php } ?>
                    <span class="mbla_coach_access_level_holder">
                        <select class="mbla_coach_access_level" data-mbla-select-2 name="<?php echo MBLAAdmin::COACH_ACCESS_META . '_all[level]' ?>">
                            <option value="all" <?php echo $levelsAccessAll == 'all' ? 'selected' : ''; ?>><?php _e('Все уровни доступа', 'mbl_admin'); ?></option>
                            <?php foreach ($levels AS $level) : ?>
                                <option value="<?php echo $level->term_id; ?>" <?php echo $levelsAccessAll == $level->term_id ? 'selected' : ''; ?>><?php echo $level->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </span>
                </div>
                <?php foreach ($autotrainings as $autotraining) : ?>
                    <div class="mbla-autotraining-config-row  <?php echo $accessAll !== 'off' ? 'wpma_disabled_field' : ''; ?>">
                    <?php wpm_render_partial('fields/checkbox', 'admin', array('label' => $autotraining->name, 'name' => (MBLAAdmin::COACH_ACCESS_META . '['.$autotraining->term_id.'][is_enabled]'), 'value' => (isset($access[$autotraining->term_id]) ? 'on' : 'off'))) ?>
                    <?php if (defined('MBL_TESTS_VERSION')) { ?>
                        <select data-mbla-select-icons name="<?php echo MBLAAdmin::COACH_ACCESS_META . '['.$autotraining->term_id.'][type]' ?>">
                            <option value="all" <?php echo wpm_array_get($access, $autotraining->term_id) == 'all'? 'selected' : '' ?>><?php _e('Все типы заданий', 'mbl'); ?></option>
                            <option data-icon="icon-list-alt" value="test" <?php echo wpm_array_get($access, $autotraining->term_id) == 'test'? 'selected' : '' ?>><?php _e('Тесты', 'mbl'); ?></option>
                            <option data-icon="icon-question-circle" value="question" <?php echo wpm_array_get($access, $autotraining->term_id) == 'question'? 'selected' : '' ?>><?php _e('Вопросы', 'mbl'); ?></option>
                        </select>
                    <?php } ?>
                    <span class="mbla_coach_access_level_holder">
                        <select class="mbla_coach_access_level" data-mbla-select-2 name="<?php echo MBLAAdmin::COACH_ACCESS_META . '['.$autotraining->term_id.'][level]' ?>">
                            <option value="all" <?php echo wpm_array_get($levelsAccess, $autotraining->term_id) == 'all'? 'selected' : '' ?>><?php _e('Все уровни доступа', 'mbl_admin'); ?></option>
                            <?php foreach ($levels AS $level) : ?>
                                <option value="<?php echo $level->term_id; ?>" <?php echo wpm_array_get($levelsAccess, $autotraining->term_id) == $level->term_id? 'selected' : '' ?>><?php echo $level->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </span>
                    </div>
                <?php endforeach; ?>
            </div>
        </td>
    </tr>
    <tr id="mbla_coach_stats">
        <th><label><?php _e('Статистика ДЗ', 'mbl'); ?></label></th>
        <td>
            <dl class="mbla-settings-color">
                <div class="mbla-autotraining-config-row mbla-bold" id="mbla_coach_access_stats">
                    <?php wpm_render_partial('fields/checkbox', 'admin', array('label' => __('Разрешить просмотр статистики ДЗ', 'mbl_admin'), 'name' => (MBLAAdmin::COACH_ACCESS_META . '_stats'), 'value' => $statsAccess)) ?>
                </div>
                <div class="mbla-autotraining-config-row  <?php echo $statsAccess === 'off' ? 'wpma_disabled_field' : ''; ?>">
                    <?php wpm_render_partial('fields/checkbox', 'admin', array('label' => __('Запретить просмотр статистики других тренеров', 'mbl_admin'), 'name' => (MBLAAdmin::COACH_ACCESS_META . '_stats_other_disable'), 'value' => $disableOthersStatsAccess)) ?>
                </div>
            </dl>
        </td>
    </tr>
</table>
