<?php /** @var WP_User $wpUser */ ?>
<?php if ($data['total']) : ?>
    <section class="wpma-chart-section">
        <div class="wpma-stats-chart-holder">
            <canvas id="wpma-chart-<?php echo $id; ?>"></canvas>
        </div>
        <div class="wpma-stats-total">
            <span class="wpma-user-name">
                <?php if ($wpUser) : ?>
                    <i class="fa fa-user-circle-o"></i>
                    <?php echo $wpUser->display_name; ?>
                <?php else : ?>
                    <?php _e('Всего', 'mbl_admin'); ?>
                <?php endif; ?>
            </span>
            <span class="wpma-stats-value">
                <i class="fa fa-book"></i>
                <?php echo $data['total']; ?>
            </span>
        </div>
        <div class="wpma-stats-details flex-row flex-wrap">
            <div class="wpma-stats-value opened" data-mbl-tooltip title="<?php _e('Ожидающие', 'mbl_admin'); ?>">
                <i class="fa fa-clock-o"></i>
                <?php echo wpm_array_get($data, 'stats.opened', 0); ?>
                (<?php echo $data['total'] ? round(wpm_array_get($data, 'stats.opened', 0)/$data['total']*100, 1) : 0; ?>%)
            </div>
            <div class="wpma-stats-value approved" data-mbl-tooltip title="<?php _e('Одобренные вручную', 'mbl_admin'); ?>">
                <i class="fa fa-hand-pointer-o"></i>
                    <?php echo wpm_array_get($data, 'stats.approved', 0); ?>
                (<?php echo $data['total'] ? round(wpm_array_get($data, 'stats.approved', 0)/$data['total']*100, 1) : 0; ?>%)
            </div>
            <?php if (!$wpUser) : ?>
                <div class="wpma-stats-value accepted" data-mbl-tooltip title="<?php _e('Одобренные автоматически', 'mbl_admin'); ?>">
                    <i class="fa fa-cogs"></i>
                    <?php echo wpm_array_get($data, 'stats.accepted', 0); ?>
                    (<?php echo $data['total'] ? round(wpm_array_get($data, 'stats.accepted', 0)/$data['total']*100, 1) : 0; ?>%)
                </div>
            <?php endif; ?>
            <div class="wpma-stats-value rejected" data-mbl-tooltip title="<?php _e('Неправильные', 'mbl_admin'); ?>">
                <i class="fa fa-times-circle-o"></i>
                <?php echo wpm_array_get($data, 'stats.rejected', 0); ?>
                (<?php echo $data['total'] ? round(wpm_array_get($data, 'stats.rejected', 0)/$data['total']*100, 1) : 0; ?>%)
            </div>
        </div>
        <?php if ($wpUser) : ?>
            <?php mbla_render_partial('homework/user_access_row', 'admin', compact('accessAll', 'categories')) ?>
        <?php endif; ?>
    </section>
<?php else : ?>
    <section class="wpma-chart-section empty-section">
        <div class="wpma-stats-chart-holder">
            <canvas id="wpma-chart-<?php echo $id; ?>"></canvas>
        </div>
        <div class="wpma-stats-total">
            <span class="wpma-user-name">
                <?php if ($wpUser) : ?>
                    <i class="fa fa-user-circle-o"></i>
                    <?php echo $wpUser->display_name; ?>
                <?php else : ?>
                    <?php _e('Всего', 'mbl_admin'); ?>
                <?php endif; ?>
            </span>
            <span class="wpma-stats-value">
                <i class="fa fa-book"></i> 0
            </span>
        </div>
        <div class="wpma-stats-details flex-row flex-wrap">
            <div class="wpma-stats-value opened" data-mbl-tooltip title="<?php _e('Ожидающие', 'mbl_admin'); ?>">
                <i class="fa fa-clock-o"></i> 0 (0%)
            </div>
            <div class="wpma-stats-value approved" data-mbl-tooltip title="<?php _e('Одобренные вручную', 'mbl_admin'); ?>">
                <i class="fa fa-hand-pointer-o"></i> 0 (0%)
            </div>
            <?php if (!$wpUser) : ?>
                <div class="wpma-stats-value accepted" data-mbl-tooltip title="<?php _e('Одобренные автоматически', 'mbl_admin'); ?>">
                    <i class="fa fa-cogs"></i> 0 (0%)
                </div>
            <?php endif; ?>
            <div class="wpma-stats-value rejected" data-mbl-tooltip title="<?php _e('Неправильные', 'mbl_admin'); ?>">
                <i class="fa fa-times-circle-o"></i> 0 (0%)
            </div>
        </div>

        <?php if ($wpUser) : ?>
            <?php mbla_render_partial('homework/user_access_row', 'admin', compact('accessAll', 'categories')) ?>
        <?php endif; ?>
    </section>
<?php endif; ?>

<?php if ($data['total']) : ?>
    <script>
        jQuery(function ($) {
            var $chart = $('#wpma-chart-<?php echo $id; ?>');

            new Chart($chart, {
                type: 'pie',
                position : 'left',
                data: {
                    datasets: [{
                        data: <?php echo json_encode(array_values($data['stats'])); ?>,
                        backgroundColor: <?php echo json_encode($data['colors']); ?>
                    }],
                    labels: <?php echo json_encode($data['labels']); ?>
                },
                options: {
                    legend: false
                }
            })
            ;
        });
    </script>
<?php else: ?>
    <script>
        jQuery(function ($) {
            var $chart = $('#wpma-chart-<?php echo $id; ?>');

            new Chart($chart, {
                type: 'pie',
                position : 'left',
                data: {
                    datasets: [{
                        data: [1],
                        backgroundColor: ['#ccc']
                    }]
                },
                options: {
                    legend: false,
                    tooltips: {
                        enabled: false
                    }
                }
            })
            ;
        });
    </script>
<?php endif; ?>