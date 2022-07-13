<?php

class MBLAPublic
{
    /**
     * MBLAPublic constructor.
     */
    public function __construct()
    {
        $this->_setHooks();
    }

    private function _setHooks()
    {
        if (!is_admin()) {
            $this->_configureTemplates();
            $this->_addStyles();
            $this->_addScripts();
            $this->_addMBLHooks();
        }
    }

    private function _addMBLHooks()
    {
        add_action('mbl_user_profile_dropdown_before_logout', [$this, 'addHomeworkCheckLink']);
    }

    private function _configureTemplates()
    {
    }

    private function _addStyles()
    {
        add_action("wpm_head", [$this, 'addStyles'], 901);
    }

    public function addStyles()
    {
        wpm_enqueue_style('mbla_main', plugins_url('/mbl-auto/assets/css/main.css?v=' . MBLA_VERSION));
    }


    private function _addScripts()
    {
        add_action("wpm_footer", [$this, 'addScripts'], 901);
    }

    public function addScripts()
    {
        wpm_enqueue_script('mbla_js_main', plugins_url('/mbl-auto/assets/js/mbla_public.js?v=' . MBLA_VERSION));
    }

    public function addHomeworkCheckLink()
    {
        if (wpm_is_admin() || wpm_is_coach()) {
            mbla_render_partial('homework_check_link', 'public');
        }
    }
}