<?php

class MBLPAdmin
{
    /**
     * MBLPAdmin constructor.
     */
    public function __construct()
    {
        $this->_setHooks();
    }

    private function _setHooks()
    {
        $this->_addMBLConfig();
        $this->_addScripts();
    }

    private function _addMBLConfig()
    {
        add_action('mbl_options_items_after', [$this, 'addMBLConfigOption'], 50);
        add_action('mbl_options_content_after', [$this, 'addMBLConfigContent'], 50);

        add_filter('woocommerce_prevent_admin_access', '__return_false');
    }

    public function addMBLConfigOption()
    {
        mblp_render_partial('mbl_options', 'admin');
    }

    public function addMBLConfigContent($args)
    {
        mblp_render_partial('mbl_config_content', 'admin', $args);
    }

    private function _addScripts()
    {
        add_action('admin_enqueue_scripts', [$this, 'addAdminScripts']);
        add_action('admin_enqueue_scripts', [$this, 'addAdminStyles']);
    }

    public function addAdminScripts()
    {
        $screen = get_current_screen();
        $screen_id = $screen ? $screen->id : '';

        wp_register_script('wpm-bootstrap', plugins_url('/member-luxe/2_0/bootstrap/js/bootstrap.js'));
        wp_register_script('wpm-clipboardjs', plugins_url('/member-luxe/js/clipboard.min.js'));
        wp_register_script('mblp_admin', plugins_url('/mbl-payments/assets/js/mblp_admin.js'), ['jquery']);
        wp_register_script('wpm-admin-js', plugins_url('/member-luxe/js/admin/script.js'), ['jquery'], WP_MEMBERSHIP_VERSION);

        // WooCommerce admin pages.
        if (in_array($screen_id, wc_get_screen_ids())) {
            wp_enqueue_script('wpm-bootstrap');
            wp_enqueue_script('wpm-clipboardjs');
            wp_enqueue_script('wpm-admin-js', '', [], WP_MEMBERSHIP_VERSION);
            wp_enqueue_script('mblp_admin');
        }
    }

    public function addAdminStyles()
    {
        $screen = get_current_screen();
        $screen_id = $screen ? $screen->id : '';

        wp_register_style('wpm-bootstrap', plugins_url('/member-luxe/2_0/bootstrap/css/bootstrap-admin.css'));
        wp_register_style('mbl_style_fontawesome', plugins_url('/member-luxe/plugins/file-upload/css/fontawesome/css/font-awesome.min.css'), [], MBLP_VERSION);
        wp_register_style('mblp_admin_style', plugins_url('/mbl-payments/assets/css/admin.css'), [], MBLP_VERSION);

        // WooCommerce admin pages.
        if (in_array($screen_id, wc_get_screen_ids())) {
            wp_enqueue_style('wpm-bootstrap');
            wp_enqueue_style('mbl_style_fontawesome');
            wp_enqueue_style('mblp_admin_style');
        }
    }

    public function isOptionHomepage()
    {
        //return true;
        $option = wpm_get_option('mblp.back_redirect_page', 'homepage');

        return $option == 'homepage' || $option == 'shop' && !defined('MKK_VERSION');
    }
}