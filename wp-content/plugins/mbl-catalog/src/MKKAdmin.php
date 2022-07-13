<?php

class MKKAdmin
{
    public function __construct()
    {
        $this->_setHooks();
    }

    private function _setHooks()
    {
        $this->_addMKKConfig();
        $this->_addScripts();
    }

    private function _addMKKConfig()
    {
        add_action('mbl_options_items_after', array($this, 'addMKKConfigOption'), 51);
        add_action('mbl_options_content_after', array($this, 'addMKKConfigContent'), 51);
        add_action('mbl_after_home_id_select', [$this, 'mblAddInputAfterHomeIdSelect']);

        add_filter( 'start_page_options_select', array($this, 'startPageOptionsSelect'), 51);
        add_filter( 'start_page_url', array($this, 'startPageUrl'), 51);
    }

    public function addMKKConfigOption()
    {
        mkk_render_partial('mkk_options', 'admin');
    }

    public function addMKKConfigContent($args)
    {
        mkk_render_partial('catalog_options', 'admin', $args);
    }

    private function _addScripts()
    {
        add_action('admin_enqueue_scripts', array($this, 'addAdminScripts'));
        add_action('admin_enqueue_scripts', array($this, 'addAdminStyles'));
    }

    public function addAdminScripts()
    {
		wp_register_script('mkk_admin', plugins_url('/mbl-catalog/assets/js/mkk_admin.js'), array('jquery'));
		wp_enqueue_script('mkk_admin');
    }

    public function addAdminStyles()
    {
		wp_enqueue_style('mkk_admin_style', plugins_url('/mbl-catalog/assets/css/admin.css'), array(), MKK_VERSION);
		wp_enqueue_style('mkk_settins_style', plugins_url('/mbl-catalog/assets/css/settings.css'), array(), MKK_VERSION);
    }

    public function startPageOptionsSelect($options)
    {
		$id = get_option( 'woocommerce_shop_page_id' );
		$is_selected = wpm_get_option('mkk.set_as_mainpage_keep_link') != 'on';

        if ( wpm_get_option('home_id') == $id ) {
            $options .= sprintf('<option value="%d" %s>%s</option>', $id, $is_selected ? 'selected' : '', get_the_title($id));
        }

        return $options;
    }

	public function startPageUrl($url)
	{
		$id = get_option( 'woocommerce_shop_page_id' );
		if ( wpm_get_option('home_id') == $id ) {
			$url = get_permalink( $id );
		}
		return $url;
	}

	public function mblAddInputAfterHomeIdSelect()
    {
        echo wpm_get_option('mkk.set_as_mainpage_keep_link') == 'on'
            ? sprintf('<input type="hidden" value="%d" name="main_options[home_id]">', wpm_get_option('home_id'))
            : '';
    }
}
