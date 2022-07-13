<?php

class MBLI3Public
{
    private $showMenu;

    /**
     * MBLI3Public constructor.
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
        }
    }

    private function _configureTemplates()
    {
        add_filter('mbl-header-main-link', [$this, 'headerMenuLink'], 5);
        add_action('mbl-body-top', [$this, 'menu']);

        add_action('mbl-body-top', [$this, 'renderTelegramPanels']);

        add_action('mbl-navbar-before-search', [$this, 'renderTelegramMenu']);
        add_action('mbl-mobile-menu-bottom', [$this, 'renderTelegramMobileMenu']);
    }

    private function _showMenu()
    {
        global $post, $wp_query;

        if (!isset($this->showMenu)) {

            $main_options = get_option('wpm_main_options');
            $start_page = $main_options['home_id'];

            if ($post instanceof WP_Post) {
                $postId = $post->ID;
                $postType = $post->post_type;
            } else {
                $postId = null;
                $postType = null;
            }

            $isCategory = is_tax('wpm-category')
                          || (
                              isset($wp_query->query['wpm-category'])
                              && wpm_array_get($wp_query->query_vars, 'taxonomy') == 'wpm-category'
                              && $wp_query->queried_object instanceof WP_Term
                          );

            $this->showMenu = $postType == 'wpm-page'
                              && is_single()
                              && $postId != wpm_get_option('schedule_id')
                              && !is_search()
                              && !wpm_is_pin_code_page()
                              && !wpm_is_activation_page()
                              && !wpm_is_search_page()
                              && !((is_front_page() && $main_options['make_home_start']) || $start_page == $postId)
                              && !$isCategory
                              && wpm_get_immediate_option('mbli3_design.secondary_menu') == 'on';
        }

        return $this->showMenu;
    }

    public function headerMenuLink($tag)
    {
        if ($this->_showMenu()) {
            return mbli3_render_partial('header-menu-link', 'public', [], true)
                   . (wpm_option_is('mbli3.hide_main', 'on') ? '' : $tag);
        } else {
            return $tag;
        }
    }

    public function menu()
    {
        global $post;
        $showMenu = $this->_showMenu();


        $currentPost = $post;
        $categorySlug = get_query_var('wpm-category', null);
        $category = $categorySlug ? get_term_by('slug', $categorySlug, 'wpm-category') : null;
        $category = $category ? new MBLCategory($category, true) : null;

        if ($showMenu && $category) {
            mbli3_render_partial('menu', 'public', compact('category', 'currentPost'));
        }
    }

    private function _getTemplatePath($template)
    {
        $path = "templates/public/layouts/{$template}.php";

        return MBLI3_DIR . $path;
    }

    private function _getPartialPath($partial)
    {
        $path = "templates/public/{$partial}.php";

        return MBLI3_DIR . $path;
    }

    private function _addStyles()
    {
        add_action("wpm_head", [$this, 'addStyles'], 901);
    }

    public function addStyles()
    {
        wpm_enqueue_style('mbli3_main', plugins_url('/mbl-navpanel/assets/css/main.css?v=' . MBLI3_VERSION));
        mbli3_render_partial('partials/css');
    }

    private function _addScripts()
    {
        add_action("wpm_footer", [$this, 'addScripts'], 901);
    }

    public function addScripts()
    {
        wpm_enqueue_script('mbli3_js_main', plugins_url('/mbl-navpanel/assets/js/mbli3_public.js?v=' . MBLI3_VERSION));
    }

    private function _isEnableTelegramMenu()
    {
        return wpm_get_option('mbli3_telegram.enable_telegram') == 'on' &&
               (wpm_get_option('mbli3_telegram.display_telegram_for_unregistered') == 'off' ||
                (wpm_get_option('mbli3_telegram.display_telegram_for_unregistered') == 'on' && is_user_logged_in()));
    }

    private function _isEnableTelegramLogin()
    {
        $enabled = wpm_get_option('mbli3_telegram.enable_telegram_login') == 'on' &&
                   (wpm_get_option('mbli3_telegram.telegram_login_for_unregistered') == 'off' ||
                    (wpm_get_option('mbli3_telegram.telegram_login_for_unregistered') == 'on' && is_user_logged_in()));

        global $wp;
        $current_url = home_url($wp->request);

        if (rtrim(wpm_get_option('mbli3_telegram.telegram_exclude_url_1'), '/') == $current_url ||
            rtrim(wpm_get_option('mbli3_telegram.telegram_exclude_url_2'), '/') == $current_url ||
            rtrim(wpm_get_option('mbli3_telegram.telegram_exclude_url_3'), '/') == $current_url) {
            $enabled = false;
        }

        return $enabled;
    }

    private function _isEnabledTelegramLoginMobile()
    {
        $enabled = wpm_get_option('mbli3_telegram_mobile.enable_telegram_login') == 'on' &&
                   (wpm_get_option('mbli3_telegram_mobile.telegram_login_for_unregistered') == 'off' ||
                    (wpm_get_option('mbli3_telegram_mobile.telegram_login_for_unregistered') == 'on' && is_user_logged_in()));

        global $wp;
        $current_url = home_url($wp->request);

        if (rtrim(wpm_get_option('mbli3_telegram_mobile.telegram_exclude_url_1'), '/') == $current_url ||
            rtrim(wpm_get_option('mbli3_telegram_mobile.telegram_exclude_url_2'), '/') == $current_url ||
            rtrim(wpm_get_option('mbli3_telegram_mobile.telegram_exclude_url_3'), '/') == $current_url) {
            $enabled = false;
        }

        return $enabled;
    }

    private function _isEnableTelegramNews()
    {
        return wpm_get_option('mbli3_telegram.enable_telegram_news') == 'on' &&
               (wpm_get_option('mbli3_telegram.telegram_news_for_unregistered') == 'off' ||
                (wpm_get_option('mbli3_telegram.telegram_news_for_unregistered') == 'on' && is_user_logged_in()));
    }

    private function _isEnableTelegramChat()
    {
        return wpm_get_option('mbli3_telegram.enable_telegram_chat') == 'on' &&
               (wpm_get_option('mbli3_telegram.telegram_chat_for_unregistered') == 'off' ||
                (wpm_get_option('mbli3_telegram.telegram_chat_for_unregistered') == 'on' && is_user_logged_in()));
    }

    private function _isEnableTelegramBot()
    {
        return wpm_get_option('mbli3_telegram.enable_telegram_bot') == 'on' &&
               (wpm_get_option('mbli3_telegram.telegram_bot_for_unregistered') == 'off' ||
                (wpm_get_option('mbli3_telegram.telegram_bot_for_unregistered') == 'on' && is_user_logged_in()));
    }

    public function renderTelegramMenu($args)
    {
        $enableMenu = $this->_isEnableTelegramMenu();
        $enableTelegramLogin = $this->_isEnableTelegramLogin();
        $enableTelegramNews = $this->_isEnableTelegramNews();
        $enableTelegramChat = $this->_isEnableTelegramChat();
        $enableTelegramBot = $this->_isEnableTelegramBot();

        mbli3_render_partial('header-menu-telegram', 'public', compact('enableMenu', 'enableTelegramLogin', 'enableTelegramNews', 'enableTelegramChat', 'enableTelegramBot'));
    }

    public function renderTelegramMobileMenu()
    {
        $enableMenu = $this->_isEnableTelegramMenu();
        $enableTelegramLogin = $this->_isEnabledTelegramLoginMobile();
        $enableTelegramNews = $this->_isEnableTelegramNews();
        $enableTelegramChat = $this->_isEnableTelegramChat();
        $enableTelegramBot = $this->_isEnableTelegramBot();

        mbli3_render_partial('header-menu-telegram-mobile', 'public', compact('enableMenu', 'enableTelegramLogin', 'enableTelegramNews', 'enableTelegramChat', 'enableTelegramBot'));
    }

    public function renderTelegramPanels()
    {
        $enableTelegramNews = $this->_isEnableTelegramNews();
        $enableTelegramChat = $this->_isEnableTelegramChat();

        mbli3_render_partial('telegram-panels', 'public', compact('enableTelegramNews', 'enableTelegramChat'));
    }
}
