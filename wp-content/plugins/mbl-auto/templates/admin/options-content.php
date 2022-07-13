<?php /** @var string $statsAccessAll */ ?>
<?php /** @var string $disableOthersStatsAccessAll */ ?>
<div id="tab-mpt-options" class="tab mpt-color-content">
    <div class="wpm-tab-content" id="mbla_coach_stats">
        <div class="mbla-autotraining-config-row mbla-bold" id="mbla_coach_access_stats">
			<?php wpm_render_partial('fields/checkbox', 'admin', array('label' => __('Разрешить просмотр статистики ДЗ всем Тренерам', 'mbl_admin'), 'name' => 'main_options[mbla][stats_access_all]', 'value'=>$statsAccessAll )) ?>
        </div>
        <div class="mbla-autotraining-config-row  <?php echo $statsAccessAll === 'off' ? 'wpma_disabled_field' : ''; ?>">
			<?php wpm_render_partial('fields/checkbox', 'admin', array('label' => __('Запретить всем Тренерам просмотр статистики других тренеров', 'mbl_admin'), 'name' => 'main_options[mbla][other_access_all]', 'value'=>$disableOthersStatsAccessAll)) ?>
        </div>
		<?php wpm_render_partial('settings-save-button', 'common'); ?>
    </div>
</div>

<style>
    .mbla-autotraining-config-row .wpm-row {
        width: 100%;
    }
</style>