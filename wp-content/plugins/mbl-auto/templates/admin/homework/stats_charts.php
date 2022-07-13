<?php
$colors = [
    'opened'   => '#fa9d11',
    'approved' => '#47ad47',
    'accepted' => '#0c5bac',
    'rejected' => '#d32527',
];
$labels = [
    'opened'   => __('Ожидающие', 'mbl_admin'),
    'approved' => __('Одобренные вручную', 'mbl_admin'),
    'accepted' => __('Одобренные автоматически', 'mbl_admin'),
    'rejected' => __('Неправильные', 'mbl_admin'),
];
?>

<section class="wpma-chart-section" style="width: 150px">
    <canvas id="wpma-global-chart" width="300" height="300"></canvas>
</section>

<script>
    jQuery(function ($) {
        var $global = $('#wpma-global-chart');

        new Chart($global, {
            type: 'pie',
            data: {
                datasets: [{
                    data: <?php echo json_encode(array_values($stats)); ?>,
                    backgroundColor: <?php echo json_encode(array_map(function ($key) use ($colors) {
                        return $colors[$key];
                    }, array_keys($stats))); ?>
                }],
                labels: <?php echo json_encode(array_map(function ($key) use ($labels) {
                        return $labels[$key];
                    }, array_keys($stats))); ?>

            },
            options: {
                legend: false,
            }
        })
        ;
    });
</script>