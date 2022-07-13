<?php

class MBLI3Admin
{
    /**
     * MBLI3Admin constructor.
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
        add_action('mbl_options_items_after', [$this, 'optionTitle'], 40);
        add_action('mbl_options_content_after', [$this, 'optionContent'], 40);

        add_action('admin_notices', [$this, 'mblSecondaryMenu'], 1);
    }

    public function optionTitle()
    {
        mbli3_render_partial('options/menu_option_title', 'admin');
    }

    public function optionContent()
    {
        mbli3_render_partial('options/menu_option_content', 'admin');
    }

    public function backgroundOptions($designOptions)
    {
        mbli3_render_partial('options/background', 'admin', compact('designOptions'));
    }

    private function _addScripts()
    {
        add_action('admin_enqueue_scripts', [$this, 'addAdminScripts']);
        add_action('admin_enqueue_scripts', [$this, 'addAdminStyles']);
    }

    public function addAdminScripts()
    {
        wp_register_script('mbli3_admin', plugins_url('/mbl-navpanel/assets/js/mbli3_admin.js'), ['jquery'], MBLI3_VERSION);

        if (is_admin()) {
            wp_enqueue_script('mbli3_admin');
        }
    }

    public function addAdminStyles()
    {
        wp_register_style('mbli3_admin_style', plugins_url('/mbl-navpanel/assets/css/admin.css'), [], MBLI3_VERSION);

        if (is_admin()) {
            wp_enqueue_style('mbli3_admin_style');
        }
    }

    public function mblSecondaryMenu()
    {
        if (wpm_is_admin_wpm_page() && wpm_is_interface_2_0() && wpm_is_admin() && wpm_get_immediate_option('mbli3_design.secondary_menu') == 'on') {
            mbli3_render_partial('secondary_menu', 'admin');
        }
    }
}