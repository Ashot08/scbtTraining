<script type="text/javascript">
    if(typeof woocommerce_params === 'undefined') {
        var woocommerce_params = <?php echo json_encode(array('ajax_url' => WC()->ajax_url(), 'wc_ajax_url' => WC_AJAX::get_endpoint( '%%endpoint%%' ),)); ?>;
    }
</script>