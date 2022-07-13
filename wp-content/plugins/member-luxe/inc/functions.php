<?php

include_once(WP_PLUGIN_DIR . '/member-luxe/inc/post-type.php'); //
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/MBLTermKeysQuery.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/user.php'); //
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/page-functions.php'); //
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/comments.php'); //
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/wpm-metabox.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/wpm-options.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/wpm-user-levels.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/page_lessons.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/shortcodes/shortcodes.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/shortcodes/video/WPMVideoShortCode.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/shortcodes/audio/WPMAudioShortCode.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/shortcodes/shortcode-settings.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/shortcodes/shortcode-settings-js.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/plugins/updater/updater.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/plugins/duplicate-post/wpm_duplicate-post.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/plugins/order-terms/order-terms.php');
//include_once(WP_PLUGIN_DIR . '/member-luxe/plugins/uppod/wpp_uppod.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/plugins/post-ordering/wpm-post-ordering.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/plugins/tinymce-description/tinymce-description.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/plugins/comment-images/comment-image.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/plugins/file-upload/file-upload.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/plugins/mandrill/mandrill.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/plugins/ses/ses.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/core-functions.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/plugins/sf-text-helper/SfTextHelper.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/view-autotraining.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/auto-training.php');

if(wpm_is_interface_2_0()) {
    include_once(WP_PLUGIN_DIR . '/member-luxe/inc/interfaces/MBLMetaInterface.php');
    include_once(WP_PLUGIN_DIR . '/member-luxe/2_0/inc/MBLShift.php');
    include_once(WP_PLUGIN_DIR . '/member-luxe/2_0/inc/MBLHomework.php');
    include_once(WP_PLUGIN_DIR . '/member-luxe/2_0/inc/AutoTrainingAccess.php');
    include_once(WP_PLUGIN_DIR . '/member-luxe/2_0/inc/AutoTrainingView.php');
    include_once(WP_PLUGIN_DIR . '/member-luxe/2_0/inc/AutoTrainingAdmin.php');
    include_once(WP_PLUGIN_DIR . '/member-luxe/2_0/inc/MBLHomeworkAdmin.php');
} else {
    include_once(WP_PLUGIN_DIR . '/member-luxe/inc/AutoTrainingView.php');
}

include_once(WP_PLUGIN_DIR . '/member-luxe/inc/MBLComment.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/MBLCache.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/MBLRedactor.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/MBLUtils.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/mailer/MBLMailer.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/mailer/MBLMail.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/plugins/video/MBLVideoStream.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/subscription/MBLSubscription.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/MBLDBUpdates.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/MBLUpdates.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/translation/translation.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/stats/stats.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/send_mails.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/term_keys.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/import_users.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/plugins/device-detector/vendor/autoload.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/MBLReCaptcha.php');
include_once(WP_PLUGIN_DIR . '/member-luxe/inc/masks.php'); //Маски

if(wpm_is_interface_2_0()) {
    include_once(WP_PLUGIN_DIR . '/member-luxe/inc/interfaces/MBLPaginationInterface.php');
    include_once(WP_PLUGIN_DIR . '/member-luxe/inc/MBLPage.php');
    include_once(WP_PLUGIN_DIR . '/member-luxe/inc/MBLSearchPage.php');
    include_once(WP_PLUGIN_DIR . '/member-luxe/inc/MBLPageCollection.php');
    include_once(WP_PLUGIN_DIR . '/member-luxe/inc/MBLCategory.php');
    include_once(WP_PLUGIN_DIR . '/member-luxe/inc/MBLCategoryCollection.php');
    include_once(WP_PLUGIN_DIR . '/member-luxe/inc/MBLSearch.php');
    include_once(WP_PLUGIN_DIR . '/member-luxe/inc/MBLActivationRow.php');
    include_once(WP_PLUGIN_DIR . '/member-luxe/inc/MBLActivation.php');
    include_once(WP_PLUGIN_DIR . '/member-luxe/inc/MBLHeader.php');
    include_once(WP_PLUGIN_DIR . '/member-luxe/inc/MBLCrop.php');

    add_action('init', 'mbl_2_0_hooks');
}

function mbl_2_0_hooks()
{
    add_action('wpm_admin_hw_list_content', ['MBLHomeworkAdmin', 'listContent']);
    add_action('wp_ajax_wpm_admin_hw_list_content', ['MBLHomeworkAdmin', 'ajaxListContent']);
    add_action('wp_ajax_mbl_stats_materials', ['MBLHomeworkAdmin', 'statsMaterials']);
    add_action('wp_ajax_wpm_hw_item_content', ['MBLHomeworkAdmin', 'itemContent']);

    mbl_update_translations_2_9_9_2_8();
}

add_action('init', 'wpm_init_session', 1);
function wpm_init_session()
{
    if (wp_installing()) {
        return;
    }

    if (wp_doing_cron()) {
        return;
    }
    
    if(is_admin() && !wp_doing_ajax()) {
        return;
    }

    if (PHP_SESSION_ACTIVE !== session_status()) {
        @session_start();

        add_action('shutdown', 'wpm_close_session', 999, 0);
    }
}

function wpm_read_session()
{
    if (wp_installing()) {
        return;
    }

    if (wp_doing_cron()) {
        return;
    }
    
    if(is_admin() && !wp_doing_ajax()) {
        return;
    }

    if (PHP_SESSION_ACTIVE !== session_status()) {
        @session_start([
            'read_and_close' => true,
        ]);
    }
}

function wpm_close_session()
{
    if (PHP_SESSION_ACTIVE === session_status()) {
        @session_write_close();
    }
}

add_action( 'admin_enqueue_scripts', 'wpm_check_migration', 100);
if (!function_exists('wpm_check_migration')):
    function wpm_check_migration()
    {
        $user = wp_get_current_user();
        if (!!get_option('wpm_has_to_update_term_keys') && is_admin() && in_array('administrator', $user->roles)) {
            wp_enqueue_style( 'wpm-migrate-term-keys', plugins_url( '/member-luxe/css/updates/wpm_migrate_term_keys.css' ));
            wp_enqueue_script( 'wpm-migrate-term-keys', plugins_url( '/member-luxe/js/updates/wpm_migrate_term_keys.js' ), array('jquery'));
        }
        
        if(is_admin() && in_array('administrator', $user->roles)) {
            MBLDBUpdates::check();
        }
    }
endif;

add_action('plugins_loaded', 'wpm_check_update');
function wpm_check_update()
{
    if (version_compare(get_option('wpm_version'), WP_MEMBERSHIP_VERSION, '<')) {
        wpm_install();
    }
}

/**
 * Install MEMBERLUX
 */

function wpm_install()
{
    flush_rewrite_rules();

    if (get_option('wpm_version') == '0.1.0') {
        wpm_migrate_keys();
    }

    if (version_compare(get_option('wpm_version'), MBLTermKeysQuery::NEW_SCHEMA_VERSION, '<')) {
        MBLTermKeysQuery::dropTable();
        update_option('wpm_has_to_update_term_keys', true);
    }

    if(!get_option('wpm_hw_stats_date')) {
        update_option('wpm_hw_stats_date', time());
    }

    wpm_register_key();


    //----------- migrate headers
    migrate_to_new_header();

    //-------------------
    wpm_install_db();
    MBLDBUpdates::update();
    MBLUpdates::update();

    MBLTranslator::updateAll();


    mbl_update_translations_2_9_9_2_8();
    update_option('wpm_version', WP_MEMBERSHIP_VERSION);

    wpm_add_role(); // add new role "customer"

    $upload_dir = wp_upload_dir();
    $wpm_folder = $upload_dir['basedir'] . '/wpm';
    if (!file_exists($wpm_folder)) {
        mkdir($wpm_folder);
    }
    add_theme_support('post-thumbnails');
    wpm_set_default_options();


    // Create start page
    $main_options = get_option('wpm_main_options');
    if (empty($main_options['home_id'])) {
        $start_page_id = wp_insert_post(array(
            'post_title'   => __('Стартовая страница', 'mbl_admin'),
            'post_name'    => 'start',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'wpm-page',
            'post_author'  => get_current_user_id()
        ));
        if (!is_wp_error($start_page_id)) {
            $main_options['home_id'] = $start_page_id;
            update_option('wpm_main_options', $main_options);
        }

    } else {
        $page_data = get_post($main_options['home_id']);
        if ($page_data->post_status != 'publish') {

            $start_page_id = wp_insert_post(array(
                'post_title'   => __('Стартовая страница', 'mbl_admin'),
                'post_name'    => 'start',
                'post_content' => '',
                'post_status'  => 'publish',
                'post_type'    => 'wpm-page',
                'post_author'  => get_current_user_id()
            ));
            if (!is_wp_error($start_page_id)) {
                $main_options['home_id'] = $start_page_id;
                update_option('wpm_main_options', $main_options);
            }

        }
    }


    if (empty($main_options['schedule_id'])) {
        $schedule_page_id = wp_insert_post(array(
            'post_title'   => __('Расписание', 'mbl_admin'),
            'post_name'    => 'schedule',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'wpm-page',
            'post_author'  => get_current_user_id()
        ));
        if (!is_wp_error($schedule_page_id)) {
            $main_options['schedule_id'] = $schedule_page_id;
            update_option('wpm_main_options', $main_options);
        }

    } else {
        $page_schedule_data = get_post($main_options['schedule_id']);
        if ($page_schedule_data->post_status != 'publish') {

            $schedule_page_id = wp_insert_post(array(
                'post_title'   => __('Расписание', 'mbl_admin'),
                'post_name'    => 'schedule',
                'post_content' => '',
                'post_status'  => 'publish',
                'post_type'    => 'wpm-page',
                'post_author'  => get_current_user_id()
            ));
            if (!is_wp_error($schedule_page_id)) {
                $main_options['schedule_id'] = $schedule_page_id;
                update_option('wpm_main_options', $main_options);
            }

        }
    }

    $main_options['interface_version'] = 2;
    update_option('wpm_main_options', $main_options);

    wp_schedule_event(time(), 'daily', 'wpm_daily_schedule_hook');
}

/**
 *
 */


function wpm_page_post_type()
{
    ///
    $labels = array(
        'name'               => __('MEMBERLUX', 'mbl_admin'),
        'singular_name'      => __('Материал', 'mbl_admin'),
        'all_items'          => __('Все материалы', 'mbl_admin'),
        'add_new'            => __('Добавить материал', 'mbl_admin'),
        'add_new_item'       => __('Добавить материал', 'mbl_admin'),
        'edit_item'          => __('Редактировать', 'mbl_admin'),
        'new_item'           => __('Новый материал', 'mbl_admin'),
        'view_item'          => __('Смотреть', 'mbl_admin'),
        'search_items'       => __('Поиск', 'mbl_admin'),
        'not_found'          => __('Ничего не найдено', 'mbl_admin'),
        'not_found_in_trash' => __('Ничего не найдено в корзине', 'mbl_admin'),
        'parent_item_colon'  => ''
    );
    $args = array(
        'labels'               => $labels,
        'public'               => true,
        'publicly_queryable'   => true,
        'show_ui'              => true,
        'query_var'            => true,
        'rewrite'              => array(
            'slug'       => 'wpm',
            'with_front' => false,
        ),
        'capability_type'      => 'post',
        'hierarchical'         => true,
        'has_archive'          => true,
        'supports'             => array(
            'title',
            'thumbnail',
            'editor',
            'page-attributes',
            'comments',
            //'excerpt',
            'revisions'
        ),
        'menu_position'        => 2,
        'show_in_menu'         => true,
        'menu_icon'            => 'dashicons-mbl',
        'register_meta_box_cb' => 'add_wpm_page_metabox'
    );
    register_post_type('wpm-page', $args);
    flush_rewrite_rules();
}


function wpm_taxonomies()
{
    $labels = array(
        'name'              => __('Рубрики материалов', 'mbl_admin'),
        'singular_name'     => __('Рубрика материалов', 'mbl_admin'),
        'search_items'      => __('Найти рубрику', 'mbl_admin'),
        'all_items'         => __('Все рубрики', 'mbl_admin'),
        'parent_item'       => __('Родительская рубрика', 'mbl_admin'),
        'parent_item_colon' => __('Родительская рубрика:', 'mbl_admin'),
        'edit_item'         => __('Редактировать рубрику', 'mbl_admin'),
        'update_item'       => __('Обновить рубрику', 'mbl_admin'),
        'add_new_item'      => __('Добавить новую рубрику', 'mbl_admin'),
        'new_item_name'     => __('Название рубрики', 'mbl_admin'),
        'menu_name'         => __('Рубрики', 'mbl_admin'),
    );
    register_taxonomy('wpm-category', 'wpm-page',
        array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_in_nav_menus' => true,
            'show_ui'           => true,
            'query_var'         => true,
            'show_admin_column' => true,
            'rewrite'           => array(
                'slug'       => 'wpm-category',
                'with_front' => false,
            ),
        ));

    flush_rewrite_rules();
}

function wpm_user_level_taxonomies()
{
    $labels = array(
        'name'              => __('Уровни доступа', 'mbl_admin'),
        'singular_name'     => __('Уровни доступа', 'mbl_admin'),
        'search_items'      => __('Найти уровень', 'mbl_admin'),
        'all_items'         => __('Все уровни', 'mbl_admin'),
        'parent_item'       => __('Родительский уровень', 'mbl_admin'),
        'parent_item_colon' => __('Родительский уровень:', 'mbl_admin'),
        'edit_item'         => __('Редактировать уровень', 'mbl_admin'),
        'update_item'       => __('Обновить уровень', 'mbl_admin'),
        'add_new_item'      => __('Добавить новый', 'mbl_admin'),
        'new_item_name'     => __('Название рубрики', 'mbl_admin'),
        'menu_name'         => __('Уровни доступа', 'mbl_admin'),
        'description'       => __('Продажа доступа', 'mbl_admin')
    );

    register_taxonomy('wpm-levels', 'wpm-page',
        array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_in_nav_menus' => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array(
                'slug'       => 'wpm-levels',
                'with_front' => false,
            ),

        ));
    flush_rewrite_rules();
}

function wpm_home_task_taxonomies()
{
    $labels = array(
        'name'          => __('Домашние задания', 'mbl_admin'),
        'singular_name' => __('Домашние задания', 'mbl_admin'),
        'search_items'  => __('Найти домашнее задание', 'mbl_admin'),
        'all_items'     => __('Все домашние задания', 'mbl_admin'),
        'edit_item'     => __('Редактировать домашнее задание', 'mbl_admin'),
        'update_item'   => __('Обновить домашнее задание', 'mbl_admin'),
        'add_new_item'  => __('Добавить домашнее задание', 'mbl_admin'),
        'new_item_name' => __('Название домашнего задания', 'mbl_admin'),
        'menu_name'     => __('Домашние задания', 'mbl_admin'),
        'description'   => __('Домашние задания', 'mbl_admin')
    );

    register_taxonomy('wpm-levels', 'wpm-page',
        array(
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_in_nav_menus' => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array(
                'slug'       => 'wpm-home-tasks',
                'with_front' => false,
            ),

        ));
    flush_rewrite_rules();
}

function wpm_view_autotraining_taxonomies()
{
    $labels = array(
        'name'          => __('Автотренинги', 'mbl_admin'),
        'singular_name' => __('Автотренинг', 'mbl_admin'),
        'search_items'  => __('Найти автотренинг', 'mbl_admin'),
        'all_items'     => __('Все автотренинги', 'mbl_admin'),
        'new_item_name' => __('Название автотренинга', 'mbl_admin'),
        'menu_name'     => __('Автотренинги', 'mbl_admin'),
    );
    register_taxonomy('wpm-view-autotraining', 'wpm-page',
        array(
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_in_nav_menus' => true,
            'show_ui'           => true,
            'query_var'         => true,
            'show_admin_column' => true,
            'rewrite'           => array(
                'slug'       => 'wpm-view-autotraining',
                'with_front' => false,
            ),
        ));

    flush_rewrite_rules();
}

/*
 *
 */
function wpm_install_db()
{
    global $wpdb;
    $response_table = $wpdb->prefix . "memberlux_responses";
    $response_review_table = $wpdb->prefix . "memberlux_response_review";
    $response_relationships_table = $wpdb->prefix . "memberlux_responses_relationships";
    $response_log_table = $wpdb->prefix . "memberlux_response_log";
    $login_log_table = $wpdb->prefix . "memberlux_login_log";

    $sql_response_table = "CREATE TABLE IF NOT EXISTS `" . $response_table . "` (
                              `id` bigint(20) NOT NULL AUTO_INCREMENT,
                              `response_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                              `approval_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                              `response_status` enum('opened','approved','rejected','accepted') NOT NULL DEFAULT 'opened',
                              `response_content` longtext NOT NULL,
                              `response_type` varchar(20) NOT NULL DEFAULT 'auto',
                              `post_id` bigint(11) NOT NULL,
                              `user_id` bigint(11) NOT NULL,
                              UNIQUE KEY `id` (`id`)
                            )
                            DEFAULT CHARACTER SET utf8
                            DEFAULT COLLATE utf8_general_ci;";

    $sql_response_review_table = "CREATE TABLE IF NOT EXISTS `" . $response_review_table . "` (
                              `id` bigint(20) NOT NULL AUTO_INCREMENT,
                              `response_id` bigint(20) NOT NULL,
                              `user_id` bigint(11) NOT NULL,
                              `review_content` longtext NOT NULL,
                              `review_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                              UNIQUE KEY `id` (`id`)
                            )
                            DEFAULT CHARACTER SET utf8
                            DEFAULT COLLATE utf8_general_ci;";


    $sql_response_relationships_table = "CREATE TABLE IF NOT EXISTS `" . $response_relationships_table . "` (
                                          `id` bigint(20) NOT NULL AUTO_INCREMENT,
                                          `response_id` bigint(20) NOT NULL,
                                          `term_taxonomy` longtext NOT NULL,
                                          `response_type` varchar(20) NOT NULL DEFAULT 'auto',
                                          `post_id` bigint(20) unsigned NOT NULL,
                                          `user_id` bigint(20) unsigned NOT NULL,
                                          UNIQUE KEY `id` (`id`),
                                          KEY `response_id` (`response_id`),
                                          KEY `post_id` (`post_id`),
                                          KEY `user_id` (`user_id`)
                                        )
                                        DEFAULT CHARACTER SET utf8
                                        DEFAULT COLLATE utf8_general_ci;";

    $sql_response_log_table = "CREATE TABLE IF NOT EXISTS `" . $response_log_table . "` (
                              `id` bigint(20) NOT NULL AUTO_INCREMENT,
                              `response_id` bigint(20) NOT NULL,
                              `event` varchar(255) NOT NULL,
                              `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                              UNIQUE KEY `id` (`id`)
                            )
                            DEFAULT CHARACTER SET utf8
                            DEFAULT COLLATE utf8_general_ci;";

    $sql_login_log_table = "CREATE TABLE IF NOT EXISTS `" . $login_log_table . "` (
                              `id` bigint(20) NOT NULL AUTO_INCREMENT,
                              `user_id` bigint(20) NOT NULL,
                              `ip` varchar(60) NOT NULL,
                              `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                              UNIQUE KEY `id` (`id`)
                            )
                            DEFAULT CHARACTER SET utf8
                            DEFAULT COLLATE utf8_general_ci;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    dbDelta($sql_response_table);
    dbDelta($sql_response_review_table);
    dbDelta($sql_response_relationships_table);
    dbDelta($sql_response_log_table);
    dbDelta($sql_login_log_table);

    add_option("memberlux_db_version", '0.1');
}


/**
 * Create user role
 */
function wpm_add_role()
{
    add_role(
        'customer',
        __('Клиент MEMBERLUX', 'mbl_admin'),
        array(
            'read'         => true, // true allows this capability
            'edit_posts'   => false,
            'delete_posts' => false, // Use false to explicitly deny
            'upload_files' => true,
            'edit_files'   => true,
            'level_2'      => true
        )
    );

    add_role(
        'coach',
        __('Тренер MEMBERLUX', 'mbl_admin'),
        array(
            'read'         => true, // true allows this capability
            'edit_posts'   => false,
            'delete_posts' => false, // Use false to explicitly deny
            'upload_files' => true,
            'edit_files'   => true,
            'level_2'      => true
        )
    );
}

function wpm_add_admin_custom_headers() {
    @header('X-XSS-Protection:0', true);
}

add_action('admin_init', 'wpm_add_admin_custom_headers');

function wpm_add_customer_caps()
{
    // gets the customer role
    $role = get_role('customer');

    $role->add_cap('upload_files');
    $role->add_cap('edit_files');
}

add_action('admin_init', 'wpm_add_customer_caps');

function wpm_add_coach_caps()
{
    // gets the coach role
    $coach_role = get_role('coach');

    if (is_object($coach_role) && method_exists($coach_role, 'add_cap')) {

        $coach_role->add_cap('upload_files');
        $coach_role->add_cap('edit_files');
        $coach_role->add_cap('review_homeworks');
    }

    $admin_role = get_role('administrator');
    $admin_role->add_cap('review_homeworks');
}

add_action('admin_init', 'wpm_add_coach_caps');

add_filter('ajax_query_attachments_args', 'wpm_show_users_own_attachments', 1, 1);
function wpm_show_users_own_attachments($query)
{
    $id = get_current_user_id();
    if (!current_user_can('manage_options'))
        $query['author'] = $id;
    return $query;
}

/**
 *
 */

function wpm_deactivate()
{
    wp_clear_scheduled_hook('wpm_hourly_event_test');
    wp_clear_scheduled_hook('wpm_hourly_event');
    wp_clear_scheduled_hook('wpm_daily_schedule_hook');
}

/**
 * Define post revisions
 */

add_filter('wp_revisions_to_keep', 'wpm_revisions', 10, 2);

function wpm_revisions($num, $post)
{
    if ('wpm-page' == $post->post_type) {
        $num = 3;
    }
    return $num;
}

/**
 *
 */

function add_wpm_page_metabox()
{
    add_meta_box('wpm_page_metabox', __('Дополнительные параметры страницы', 'mbl_admin'), 'wpm_page_extra', 'wpm-page', 'normal');

    if(wpm_is_interface_2_0()) {
        add_meta_box('wpm_page_content_types_metabox', __('Тип контента', 'mbl_admin'), 'wpm_page_content_types_metabox', 'wpm-page', 'side', 'high');
    }
}

/**
 *
 */


function wpm_admin_menu()
{
    add_submenu_page('edit.php?post_type=wpm-page', __('Автотренинги', 'mbl_admin'), __('Автотренинги', 'mbl_admin'), 'manage_options', 'wpm-view-autotraining', 'wpm_view_autotraining_page');
    add_submenu_page('edit.php?post_type=wpm-page', __('Домашние задания', 'mbl_admin'), __('Домашние задания', 'mbl_admin'), 'review_homeworks', 'wpm-autotraining', 'wpm_autotraining_page');
    add_submenu_page('edit.php?post_type=wpm-page', __('Статистика входов', 'mbl_admin'), __('Статистика входов', 'mbl_admin'), 'manage_options', 'wpm-login-stats', 'wpm_stats_admin');
    add_submenu_page('edit.php?post_type=wpm-page', __('Рассылка', 'mbl_admin'), __('Рассылка', 'mbl_admin'), 'manage_options', 'wpm-send-mails', 'wpm_send_mails_page');
    add_submenu_page('edit.php?post_type=wpm-page', __('Активация', 'mbl_admin'), __('Активация', 'mbl_admin'), 'manage_options', 'wpm-activation', 'wpm_not_active_memberluxe_page');
   // add_submenu_page('edit.php?post_type=wpm-page', __('Безопасность', 'mbl_admin'), __('Безопасность', 'mbl_admin'), 'manage_options', 'wpm-security', 'wpm_security_page');
    add_submenu_page('edit.php?post_type=wpm-page', __('Параметры', 'mbl_admin'), __('Настройки', 'mbl_admin'), 'manage_options', 'wpm-options', 'wpm_options');
//    add_submenu_page('edit.php?post_type=wpm-page', __('Обновление', 'mbl_admin'), __('Обновление', 'mbl_admin'), 'update_plugins', 'wpm-updater', 'wpm_updater');
    add_submenu_page('edit.php?post_type=wpm-page', __('Уроки', 'mbl_admin'), __('Уроки', 'mbl_admin'), 'manage_options', 'wpm-lessons', 'wpm_lessons_page');
    add_submenu_page('edit.php?post_type=wpm-page', __('Информационная панель', 'mbl_admin'), __('Информационная панель', 'mbl_admin'), 'manage_options', 'wpm-info-panel', 'wpm_info_admin');
}

/**
 * Default options
 */
add_action('wp_ajax_wpm_reset_options_to_default_action', 'wpm_reset_options_to_default'); // ajax for logged in users
function wpm_reset_options_to_default()
{
    $result = array(
        'message' => '',
        'error'   => false
    );
    $options = $_POST['option_type'];
    $default_main_options = get_option('wpm_main_options_default');
    $default_design_options = get_option('wpm_design_options_default');
    $design_options = get_option('wpm_design_options');
    if ($options == 'all') {
        update_option('wpm_main_options', $default_main_options);
        update_option('wpm_design_options', $default_design_options);
        $result['message'] = 'Настройки сброшены';
    }
    if ($options == 'design') {
        update_option('wpm_design_options', $default_design_options);
        $result['message'] = 'Настройки дизайна сброшены';
    }
    if ($options == 'buttons') {
        $buttons = array('buttons' => wpm_get_default_button_options());
        update_option('wpm_design_options', array_replace_recursive($design_options, $buttons));
        $result['message'] = 'Настройки кнопок сброшены';
    }

    echo json_encode($result);
    die();
}

function wpm_set_default_options()
{

    $default_main_options = array(
        'make_home_start'    => false,
        'home_id'            => '',
        'start_page'         => array(
            'make_home_start'         => false,
            'page_on_front'           => '',
            'page_for_posts'          => '',
            'page_on_front_original'  => '',
            'page_for_posts_original' => ''
        ),
        'protection'         => array(
            'youtube_protected'     => 'on',
            'video_url_encoded'     => 'off',
            'jwplayer_code'         => '',
            'text_protected'        => 'off',
            'right_button_disabled' => 'off',
            'one_session'           => array(
                'status'   => 'off',
                'interval' => '60'
            )
        ),
        'registration_form'  => array(
            'name'       => 'on',
            'surname'    => 'on',
            'patronymic' => 'on',
            'phone'      => 'on',
            'custom1'      => 'off',
            'custom2'      => 'off',
            'custom3'      => 'off',
            'custom4'      => 'off',
            'custom5'      => 'off',
            'custom6'      => 'off',
            'custom1textarea'      => 'off',
        ),
        'header_scripts' => '',
        'schedule_id'        => '',
        'hide_schedule'      => 'off',
        'main'               => array(
            'posts_per_page' => '20',
            'opened'         => false
        ),
        'favicon'            => array(
            'url' => plugins_url('/member-luxe/i/wpm_favicon.png'),
        ),
        'logo'               => array(
            'url'     => plugins_url('/member-luxe/i/wpm_logo.png'),
            'width'   => '',
            'height'  => '',
            'visible' => 'visible'
        ),
        'login_content'      => array(
            'content'  => '',
            'visible'  => 'hidden',
            'position' => 'top'
        ),
        'header'             => array(
            'content' => '',
            'visible' => 'hidden'
        ),
        'footer'             => array(
            'content' => '',
            'visible' => 'hidden'
        ),
        'letters'            => array(
            'mandrill_is_on'        => 'off',
            'mandrill_api_key'      => '',
            'registration'          => array(
                'enabled' => 'on',
                'title'   => 'Спасибо за регистрацию!',
                'content' => 'Здравствуйте [user_name]!

Ваши данные для входа:

Страница входа: [start_page]
Логин: [user_login]
Пароль: [user_pass]

Приятной работы!'
            ),
            'response_review'          => array(
                'enabled' => 'on',
                'title'   => 'Комментарий к ответу на домашнее задание',
                'content' => 'Материал: 
[material_name]

Ваш ответ: 
[user_response]

Комментарий к вашему ответу:
[response_review]

Перейти на страницу материала: [material_url]'
            ),
            'response_review_admin'          => array(
                'enabled' => 'on',
                'title'   => 'Новый комментарий к домашнему заданию',
                'content' => '<b>Материал:</b>
[material_name]

<b>Клиент:</b> 
[user_name], [user_email]

<b>Текст ответа:</b>
[user_response]

<b>Автор комментария:</b>
[author]

<b>Комментарий:</b>
[response_review]

<b>Перейти в панель управления:</b>
[admin_url]'
            ),
            'response_status'          => array(
                'enabled' => 'on',
                'title'   => 'Домашнее задание просмотрено тренером',
                'content' => 'Материал: 
[material_name]

Оценка: 
[status]

Перейти на страницу материала: [material_url]'
            ),
            'response_admin'          => array(
                'enabled' => 'on',
                'title'   => 'Новый ответ на домашнее задание',
                'content' => 'Материал: 
[material_name]

Клиент: 
[user_name], [user_email]

Текст ответа:
[user_response]

Перейти в панель управления: [admin_url]'
            ),
            'comment_subscription'          => array(
                'enabled' => 'on',
                'title'   => 'Ответ на Ваш комментарий',
                'content' => 'Здравствуйте [user_name]!

На Ваш комментарий на странице "[page_title]" ([page_link]) был опубликован ответ.'
            ),
            'new_material_access'          => array(
                'enabled' => 'on',
                'title'   => 'Новый урок уже доступен',
                'content' => 'Вам открыт доступ к новому уроку:
[material_name]

Ссылка на урок:
[material_url]'
            ),
            'coach_response'          => array(
                'enabled' => 'on',
                'title'   => 'Новый ответ на домашнее задание',
                'content' => 'Материал: 
[material_name]

Клиент: 
[user_name], [user_email]

Текст ответа:
[user_response]

Перейти в панель управления: [admin_url]'
            ),
            'coach_review'          => array(
                'enabled' => 'on',
                'title'   => 'Новый комментарий к домашнему заданию',
                'content' => '<b>Материал:</b>
[material_name]

<b>Клиент:</b> 
[user_name], [user_email]

<b>Текст ответа:</b>
[user_response]

<b>Автор комментария:</b>
[author]

<b>Комментарий:</b>
[response_review]

<b>Перейти в панель управления:</b>
[admin_url]'
            ),
            'registration_to_admin' => array(
                'enabled' => 'on',
                'title'   => 'Зарегистрирован новый пользователь',
                'content' => ''
            )
        ),
        'social'             => array(
            'facebook'  => array(
                'app_id' => '',
                'admin'  => ''
            ),
            'vkontakte' => array(
                'id' => ''
            )
        ),
        'auto_subscriptions' => array(
            'justclick'      => array(
                'active'       => false,
                'user_id'      => '',
                'user_rps_key' => '',
                'rid'          => '',
                'doneurl2'     => ''
            ),
            'sendpulse'      => array(
                'active'       => false,
                'apiUserId'      => '',
                'apiSecret' => '',
                'rid'          => ''
            ),
            'autoweb'      => array(
                'active'       => false,
                'apiKeyRead'      => '',
                'apiKeyWrite' => '',
                'subdomain' => '',
                'rid'          => ''
            )
        )
    );
    $default_button_options = wpm_get_default_button_options();
    $default_design_options = array(
        'main'      => array(
            'background_color'            => 'f7f8f9',
            'background-attachment-fixed' => 'off',
            'background_image'            => array(
                'url'      => '',
                'repeat'   => 'repeat',
                'position' => 'center top'
            ),
            'height'                      => '',
            'visible'                     => 'visible',
            'hide_ask_for_not_registered' => false,
            'hide_ask'                    => false,
            'date_is_hidden'              => 'off',
            'comments_order'              => 'asc',
            'attachments_mode'            => 'allowed_to_all',
            'visibility'                  => 'to_all',
            'border-radius'               => 3
        ),
        'menu'      => array(
            'bold'             => 'off',
            'submenu_bold'     => 'off',
            'current_bold' => 'off',
            'border'           => array(
                'color' => 'd3d9df'
            ),
            'background_color' => 'ffffff',
            'a'                => array(
                'normal_color'        => '000000',
                'active_color'        => '2c8bb7',
                'selected_link_color' => '2b9973'
            ),
            'a_submenu'        => array(
                'normal_color'        => '919191',
                'active_color'        => '2c8bb7',
                'selected_link_color' => '2b9973'
            ),
            'font_size' => '14'
        ),
        'page'      => array(
            'background_color' => 'ffffff',
            'text_color' => '333',
            'link_color' => '428bca',
            'link_color_hover' => '2a6496',
            'border'           => array(
                'color' => 'd3d9df'
            ),
            'header'           => array(
                'background_color' => '2b9973',
                'text_color'       => 'ffffff'
            ),
            'row'              => array(
                'odd'  => array(
                    'background_color'       => 'f3f6f8',
                    'background_color_hover' => 'f3f6f8',
                    'text_color'             => '677c8a',
                    'text_color_hover'       => '343d43',
                ),
                'even' => array(
                    'background_color'       => 'ffffff',
                    'background_color_hover' => 'ffffff',
                    'text_color'             => '677c8a',
                    'text_color_hover'       => '343d43',
                )

            )
        ),
        'single'    => array(
            'header'           => array(
                'background_color' => 'fbfcfc',
                'border_color' => '2B9973',
                'title_text_color' => '000000',
                'desc_text_color' => '4a5363',
                'label_color' => '2b9973'
            )
        ),
        'buttons'   => $default_button_options,
        'preloader' => array(
            'color_1' => '76d6b6'
        )
    );
    update_option('wpm_main_options_default', $default_main_options);
    update_option('wpm_design_options_default', $default_design_options);

    $main_options = get_option('wpm_main_options');
    $design_options = get_option('wpm_design_options');

    if (isset($main_options) && is_array($main_options)) {
        update_option('wpm_main_options', array_replace_recursive($default_main_options, $main_options));
    }else{
        update_option('wpm_main_options', $default_main_options);
    }

    if (isset($design_options) && is_array($design_options)){
        update_option('wpm_design_options', array_replace_recursive($default_design_options, $design_options));
    }else{
        update_option('wpm_design_options', $default_design_options);
    }
}

function wpm_get_default_button_options()
{
    $default_button_options = array(
        'show'                             => array(
            'background_color'       => 'f3f6f8',
            'background_color_hover' => '2c8bb7',
            'text_color'             => '2c8bb7',
            'text_color_hover'       => 'ffffff',
            'border_color'           => '2c8bb7',
            'border_color_hover'     => '2c8bb7',
            'text'                   => 'Показать'
        ),
        'no_access'                        => array(
            'background_color'       => 'f3f6f8',
            'background_color_hover' => '677c8a',
            'text_color'             => '677c8a',
            'text_color_hover'       => 'ffffff',
            'border_color'           => '677c8a',
            'border_color_hover'     => '677c8a',
            'text'                   => 'Нет доступа'
        ),
        'back'                             => array(
            'background_color'       => 'f3f6f8',
            'background_color_hover' => '2c8bb7',
            'text_color'             => '2c8bb7',
            'text_color_hover'       => 'ffffff',
            'border_color'           => '2c8bb7',
            'border_color_hover'     => '2c8bb7',
            'text'                   => 'Вернуться к списку'
        ),
        'home_work_respond_on_page'        => array(
            'background_color'       => 'f3f6f8',
            'background_color_hover' => '2c8bb7',
            'text_color'             => '2c8bb7',
            'text_color_hover'       => 'ffffff',
            'border_color'           => '2c8bb7',
            'border_color_hover'     => '2c8bb7',
            'text'                   => 'Ответить'
        ),
        'home_work_respond_on_popup'       => array(
            'background_color'       => '2c8bb7',
            'background_color_hover' => '00608c',
            'text_color'             => 'ffffff',
            'text_color_hover'       => 'ffffff',
            'text'                   => 'Отправить'
        ),
        'home_work_edit'                   => array(
            'background_color'       => 'f3f6f8',
            'background_color_hover' => '2c8bb7',
            'text_color'             => '2c8bb7',
            'text_color_hover'       => 'ffffff',
            'border_color'           => '2c8bb7',
            'border_color_hover'     => '2c8bb7',
            'text'                   => 'Редактировать'
        ),
        'home_work_edit_on_popup'          => array(
            'background_color'       => '2c8bb7',
            'background_color_hover' => '00608c',
            'text_color'             => 'ffffff',
            'text_color_hover'       => 'ffffff',
            'text'                   => 'Отправить'
        ),
        'home_work_edit_on_popup_add_file' => array(
            'background_color'       => 'fff',
            'background_color_hover' => '2C8BB7',
            'text_color'             => '2C8BB7',
            'text_color_hover'       => 'fff',
            'border_color'           => '2C8BB7',
            'border_color_hover'     => '2C8BB7',
            'text'                   => 'Добавить файлы'
        ),
        'home_work_edit_on_popup_upload'   => array(
            'background_color'       => 'f9f9f9',
            'background_color_hover' => '2C8BB7',
            'text_color'             => '2C8BB7',
            'text_color_hover'       => 'fff',
            'border_color'           => '2C8BB7',
            'border_color_hover'     => '2C8BB7',
            'text'                   => 'Загрузить'
        ),
        'home_work_edit_on_popup_cancel'   => array(
            'background_color'       => 'f9f9f9',
            'background_color_hover' => '2C8BB7',
            'text_color'             => '2C8BB7',
            'text_color_hover'       => 'fff',
            'border_color'           => '2C8BB7',
            'border_color_hover'     => '2C8BB7',
            'text'                   => 'Отмена'
        ),
        'home_work_edit_on_popup_delete'   => array(
            'background_color'       => 'f9f9f9',
            'background_color_hover' => '2C8BB7',
            'text_color'             => '2C8BB7',
            'text_color_hover'       => 'fff',
            'border_color'           => '2C8BB7',
            'border_color_hover'     => '2C8BB7',
            'text'                   => 'Удалить'
        ),
        'refresh_comments'                 => array(
            'text_color'       => '428bca',
            'text_color_hover' => '2f71a9',
            'text'             => 'Обновить'
        ),
        'send_comment'                     => array(
            'background_color'       => 'f3f6f8',
            'background_color_hover' => '00608c',
            'text_color'             => '2c8bb7',
            'text_color_hover'       => 'ffffff',
            'border_color'           => '2c8bb7',
            'border_color_hover'     => '00608c',
            'text'                   => 'Отправить'
        ),
        'sign_in'                          => array(
            'background_color'       => '2c8bb7',
            'background_color_hover' => '00608c',
            'text_color'             => 'ffffff',
            'text_color_hover'       => 'ffffff',
            'text'                   => 'Войти'
        ),
        'register'                         => array(
            'background_color'       => '2c8bb7',
            'background_color_hover' => '00608c',
            'text_color'             => 'ffffff',
            'text_color_hover'       => 'ffffff',
            'text'                   => 'Зарегистрироваться'
        ),
        'activate_pin'                     => array(
            'background_color'       => '2c8bb7',
            'background_color_hover' => '00608c',
            'text_color'             => 'ffffff',
            'text_color_hover'       => 'ffffff',
            'text'                   => 'Добавить'
        ),
        'get_pin'                          => array(
            'background_color'       => '3f8bb9',
            'background_color_hover' => '00608c',
            'text_color'             => 'ffffff',
            'text_color_hover'       => 'ffffff',
            'text'                   => 'Получить пин-код'
        ),
        'copy_pin'                         => array(
            'background_color'       => 'ffffff',
            'background_color_hover' => '3f8bb9',
            'text_color'             => '3f8bb9',
            'text_color_hover'       => 'ffffff',
            'border_color'           => '3f8bb9',
            'border_color_hover'     => '3f8bb9',
            'text'                   => 'Скопировать пин-код'
        ),
        'register_on_pin'                  => array(
            'background_color'       => 'ffffff',
            'background_color_hover' => '3f8bb9',
            'text_color'             => '3f8bb9',
            'text_color_hover'       => 'ffffff',
            'border_color'           => '3f8bb9',
            'border_color_hover'     => '3f8bb9',
            'text'                   => 'Пройти регистрацию'
        ),
        'ask'                              => array(
            'background_color'       => '2c8bb7',
            'background_color_hover' => '00608c',
            'text_color'             => 'ffffff',
            'text_color_hover'       => 'ffffff',
            'text'                   => 'Отправить'
        ),
        'top_admin_bar'                    => array(
            'background_panel_color' => '222222',
            'background_color'       => '222222',
            'background_color_hover' => '333333',
            'text_color'             => 'ffffff',
            'text_color_hover'       => '2ea2cc'
        ),
        'welcome_tabs'                     => array(
            'text_color_login'          => '2b9973',
            'text_color_login_hover'    => '2c8bb7',
            'text_color_register'       => '2b9973',
            'text_color_register_hover' => '2c8bb7',
            'text_login'                => 'Вход',
            'text_register'             => 'Регистрация'
        )
    );

    return $default_button_options;
}

/**
 *
 */


function wpm_rewrite_init()
{
    flush_rewrite_rules();
}

/*
 *
 */

add_action("admin_head", "wpm_enqueue_admin_style_js", 9999);

function wpm_enqueue_admin_style_js()
{
    global $typenow;
    global $current_screen;

    if (is_admin()) {
        wp_enqueue_style('wpm-admin-style-all', plugins_url('/member-luxe/css/admin-style-all-pages.css'), array(), WP_MEMBERSHIP_VERSION);
        wp_enqueue_style('wpm-editor-css', includes_url('/css/editor.min.css'));
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-widget');

        $isWPMpage = $current_screen->post_type == 'wpm-page'
            || $typenow == 'wpm-page'
            || (isset($_GET['taxonomy']) && $_GET['taxonomy'] == 'wpm-levels')
            || (isset($_GET['user_id']))
            || (isset($_GET['post_type']) && $_GET['post_type'] == 'wpm-page');
        if ($isWPMpage) {
            wpm_enqueue_script('wpm-bootstrap', plugins_url('/member-luxe/2_0/bootstrap/3.3.7/js/bootstrap.js'));
            wp_enqueue_style('wpm-admin-style', plugins_url('/member-luxe/css/admin-style.css?v='.WP_MEMBERSHIP_VERSION));

            // Thickbox
            wp_enqueue_style('thickbox');
            wp_enqueue_script('thickbox');

            // jQuery ui

            wp_enqueue_style('wpm-mediaelement', plugins_url('/member-luxe/js/mediaelement/mediaelementplayer.min.css'));
            wp_enqueue_style('wpm-mediaelement-skins', plugins_url('/member-luxe/js/mediaelement/wpm-skins.css'));

            wp_enqueue_script('jquery-ui-tabs');
            if (wpm_is_interface_2_0()) {
                wp_enqueue_script('jquery-ui-button');
                wp_enqueue_script('jquery-ui-progressbar');

                wp_enqueue_style('wpm-jcrop-css', plugins_url('/member-luxe/js/jcrop/jcrop.css'));
                wp_enqueue_script('wpm-jcrop-js', plugins_url('/member-luxe/js/jcrop/jcrop.js'));
                wp_enqueue_script('wpm-jcrop-script', plugins_url('/member-luxe/js/jcrop/script.js'));

                wp_enqueue_style('wpm_select_2_style', plugins_url('/member-luxe/js/select2/css/select2.min.css'));
                wpm_enqueue_script('wpm_select_2', plugins_url('/member-luxe/js/select2/js/select2.full.min.js'));
                if (in_array(get_locale(), MBLTranslator::$ru_locales)) {
                    wpm_enqueue_script('mbla_select_2_ru', plugins_url('/member-luxe/js/select2/js/i18n/ru.js'));
                }

                wp_register_script('wpm-admin-js', plugins_url('/member-luxe/js/admin/script.js'), [], WP_MEMBERSHIP_VERSION);
                $dataToScript = array(
                    'main_options' => get_option('wpm_main_options'),
                    'wp_max_uload_size' => wp_max_upload_size(),
                    'locale' => get_locale(),
                    'add_video_tooltip' => __('Видео [beta]', 'mbl_admin'),
                    'add_video_title'  => __('Добавление видео', 'mbl_admin'),
                    'add_audio_tooltip' => __('Аудио [beta]', 'mbl_admin'),
                    'add_audio_title' => __('Добавление аудио файла', 'mbl_admin'),
                    'error_file_type' => __('Загружаемый файл должен быть изображением!', 'mbl_admin'),
                    'add_photo_tooltip' => __('Изображение', 'mbl_admin'),
                    'add_photo_title'  => __('Выберите изображение', 'mbl_admin'),
                    'add_photo_button_title'  => __('Использовать изображение', 'mbl_admin'),
                );
                wp_localize_script( 'wpm-admin-js', 'dataToScript', $dataToScript);
                wp_enqueue_script('wpm-admin-js', '', [], WP_MEMBERSHIP_VERSION);
            }
            wpm_enqueue_style('wpm-bootstrap', plugins_url('/member-luxe/2_0/bootstrap/3.3.7/css/bootstrap-admin.css'));
            wpm_enqueue_style('wpm-summernote', plugins_url('/member-luxe/js/summernote/summernote.css'));
            wpm_enqueue_style('wpm-emojionearea', plugins_url('/member-luxe/js/summernote/plugin/summernote-emoji/summernote-emoji.css'));


            wp_register_script('wpm-summernote', plugins_url('/member-luxe/js/summernote/summernote.js'));
            $summernote_locales = mbl_localize_summernote('mbl-admin');
            wp_localize_script( 'wpm-summernote', 'summernote_locales', $summernote_locales);
            wp_enqueue_script('wpm-summernote');

            //wpm_enqueue_script('wpm-summernote', plugins_url('/member-luxe/js/summernote/summernote.js'));

            wp_register_script('wpm-summernote-lang', plugins_url('/member-luxe/js/summernote/lang/summernote-ru-RU.js'));
                $summernote_locales = mbl_localize_summernote('mbl-admin');
            wp_localize_script( 'wpm-summernote-lang', 'summernote_locales', $summernote_locales);
            wp_enqueue_script('wpm-summernote-lang');
            //wpm_enqueue_script('wpm-summernote-lang', plugins_url('/member-luxe/js/summernote/lang/summernote-ru-RU.js'));

            wp_enqueue_script('summernote-emoji', plugins_url('/member-luxe/js/summernote/plugin/summernote-emoji/summernote-emoji.js'));
            wpm_enqueue_script('wpm-clipboardjs', plugins_url('/member-luxe/js/clipboard.min.js'));
            wp_enqueue_script('jquery-ui-sortable');
            wp_enqueue_script('jquery-ui-widget');
            wp_enqueue_script('jquery-ui-accordion');
            wp_enqueue_script('jquery-ui-slider');
            wp_enqueue_script('jquery-ui-datepicker');

            wp_enqueue_script('jquery-ui-datepicker-ru', plugins_url('/member-luxe/js/jquery/ui/i18n/jquery.ui.datepicker-ru.min.js'));
            wp_enqueue_script('wpm-zeroclipboard', plugins_url('/member-luxe/js/zeroclipboard/ZeroClipboard.min.js'));
            wp_enqueue_script('wpm-jquery-migrate', plugins_url('/member-luxe/js/jquery/jquery-migrate-1.4.1.min.js'));
            wp_enqueue_script('jquery-ui-timepicker', plugins_url('/member-luxe/js/time_picker/jquery.ui.timepicker.js'));
            wp_enqueue_script('js-color-picker', plugins_url('/member-luxe/js/jscolor/jscolor.js'));
            wp_enqueue_script('wpm-autosize', plugins_url('/member-luxe/js/miscellaneous/autosize.min.js'));

            wp_enqueue_script('wpm-mediaelement', plugins_url('/member-luxe/js/mediaelement/mediaelement-and-player.min.js'));

            wp_enqueue_script('jquery-ui_cookie', plugins_url('/member-luxe/js/miscellaneous/jquery.cookie.js'));
        }
        wp_enqueue_style('wpm-jquery-ui-wpm', plugins_url('/member-luxe/js/jquery/themes/wpm/jquery.ui.base.css'));
        wpm_enqueue_script('wpm-jquery-countdown-plugin', plugins_url('/member-luxe/js/countdown/jquery.plugin.min.js'));
        wpm_enqueue_script('wpm-jquery-countdown', plugins_url('/member-luxe/js/countdown/jquery.countdown.js'));
        wp_enqueue_media();
    }
}

/**
 *
 */

add_action('admin_head', 'wpm_admin_header_css');
function wpm_admin_header_css()
{
    $current_user = wp_get_current_user();
    $roles = $current_user->roles;
    if (in_array('customer', $roles)) {
        echo '<style type="text/css"> #menu-media, #wp-admin-bar-new-content{ display: none!important}</style>';
    }
    echo '<style type="text/css">  #menu-posts-wpm-page > a { background-color: #12527f!important; } </style>';

}


/**
 * @param $id
 * @param $path
 */

function wpm_enqueue_style($id, $path)
{
    echo '<link rel="stylesheet" type="text/css" media="all" id="' . $id . '-css" href="' . $path . '">' . "\n";
}

/**
 * @param $id
 * @param $path
 */
function wpm_enqueue_script($id, $path)
{
    echo '<script type="text/javascript" id="' . $id . '-js" src="' . $path . '"></script>' . "\n";
}

/**
 *
 */
add_action("wpm_head", "wpm_enqueue_styles", 900);
function wpm_enqueue_styles()
{
    echo "<!-- wpm_enqueue_styles --> \n";

    if(wpm_is_interface_2_0()) {
        wpm_enqueue_style('wpm-bootstrap', plugins_url('/member-luxe/2_0/bootstrap/css/bootstrap.css'));
        wpm_enqueue_style('wpm-app', apply_filters('mbl_style', plugins_url('/member-luxe/2_0/css/app.css?v=' . WP_MEMBERSHIP_VERSION)));
        wpm_enqueue_style('wpm-mediaelement', plugins_url('/member-luxe/js/mediaelement/mediaelementplayer.min.css'));
        wpm_enqueue_style('wpm-mediaelement-skins', plugins_url('/member-luxe/js/mediaelement/wpm-skins.css'));
        wpm_enqueue_style('wpm-owl', plugins_url('/member-luxe/js/owl.carousel/assets/owl.carousel.css'));
        wpm_enqueue_style('wpm-summernote', plugins_url('/member-luxe/js/summernote/summernote.css'));
        wpm_enqueue_style('wpm-emojionearea', plugins_url('/member-luxe/js/summernote/plugin/summernote-emoji/summernote-emoji.css'));
        wpm_enqueue_style('wpm-plyr', plugins_url('/member-luxe/js/plyr/' . wpm_plyr_version() . '/plyr.css?v=' . WP_MEMBERSHIP_VERSION));
        wpm_enqueue_style('wpm-fancybox', plugins_url('/member-luxe/2_0/fancybox/jquery.fancybox.min.css'));
    } else {
        wpm_enqueue_style('wpm-bootstrap', plugins_url('/member-luxe/templates/base/bootstrap/css/bootstrap.min.css'));
        wpm_enqueue_style('wpm-base-style', plugins_url('/member-luxe/templates/base/base-styles.css'));
        wpm_enqueue_style('wpm-protected-style', plugins_url('/member-luxe/templates/base/base-protected-page.css'));

        wpm_enqueue_style('wpm-fancybox', plugins_url('/member-luxe/js/fancybox/jquery.fancybox.css'));

        wpm_enqueue_style('wpm-mediaelement', plugins_url('/member-luxe/js/mediaelement/mediaelementplayer.min.css'));
        wpm_enqueue_style('wpm-owl', plugins_url('/member-luxe/js/owl.carousel/assets/owl.carousel.css'));

        wpm_enqueue_style('wpm-countdown', plugins_url('/member-luxe/js/countdown/jquery.countdown.css'));

        wpm_enqueue_style('wpm-mediaelement-skins', plugins_url('/member-luxe/js/mediaelement/wpm-skins.css'));
        wpm_enqueue_style('wpm-summernote', plugins_url('/member-luxe/js/summernote/summernote.css'));
        wpm_enqueue_style('wpm-emojionearea', plugins_url('/member-luxe/js/summernote/plugin/summernote-emoji/summernote-emoji.css'));
        wpm_enqueue_style('wpm-plyr', plugins_url('/member-luxe/js/plyr/' . wpm_plyr_version() . '/plyr.css?v=' . WP_MEMBERSHIP_VERSION));
    }

    echo "<!-- // wpm_enqueue_styles --> \n";
}

/**
 *
 */
add_action("wpm_head", "wpm_enqueue_scripts", 900);
function wpm_enqueue_scripts()
{
    if (wpm_is_pin_code_page()) {
        wp_redirect(get_permalink(wpm_get_option('home_id')) . '#registration');
    }

    echo "<!-- wpm_enqueue_scripts --> \n";

    if(wpm_is_interface_2_0()) {
        wpm_enqueue_script('wpm-scripts', plugins_url('/member-luxe/js/all.min.js?v=' . WP_MEMBERSHIP_VERSION));
        wpm_enqueue_script('wpm-comments-reply', includes_url('js/comment-reply.min.js'));
        wpm_enqueue_script('wpm-scripts-video', plugins_url('/member-luxe/js/video/' . wpm_plyr_version() . '/video.min.js?v=' . WP_MEMBERSHIP_VERSION));
//        wpm_enqueue_script('wpm-scripts-plyr', plugins_url('/member-luxe/js/plyr/' . wpm_plyr_version() . '/plyr.js'));
//        wpm_enqueue_script('wpm-scripts-video-full', plugins_url('/member-luxe/js/video.js'));

        if(wpm_option_is('main.enable_captcha', 'on')) {
            wpm_enqueue_script('wpm-scripts-captcha', 'https://www.google.com/recaptcha/api.js?onload=mblRecaptchaLoadCallback&render=explicit');
        }
    } else {
        wpm_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js');

        wpm_enqueue_script('jquery-form', plugins_url('/member-luxe/js/jquery/jquery.form.js'));

        wpm_enqueue_script('jquery-ui-custom', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js');
        wpm_enqueue_script('jquery-ui-core', plugins_url('/member-luxe/js/jquery/ui/jquery.ui.core.min.js'));
        wpm_enqueue_script('jquery-ui-widget', plugins_url('/member-luxe/js/jquery/ui/jquery.ui.widget.min.js'));
        wpm_enqueue_script('jquery-ui-tabs', plugins_url('/member-luxe/js/jquery/ui/jquery.ui.tabs.min.js'));
        wpm_enqueue_script('jquery-ui-sortable', plugins_url('/member-luxe/js/jquery/ui/jquery.ui.sortable.min.js'));
        wpm_enqueue_script('jquery-ui-accordion', plugins_url('/member-luxe/js/jquery/ui/jquery.ui.accordion.min.js'));
        wpm_enqueue_script('jquery-ui-slider', plugins_url('/member-luxe/js/jquery/ui/jquery.ui.slider.min.js'));
        wpm_enqueue_script('jquery-ui-datepicker', plugins_url('/member-luxe/js/jquery/ui/jquery.ui.datepicker.min.js'));

        wpm_enqueue_script('wpm-bootstrap', plugins_url("/member-luxe/templates/base/bootstrap/js/bootstrap.min.js"));
        wpm_enqueue_script('jquery-ui-cookie', plugins_url('/member-luxe/js/miscellaneous/jquery.cookies.2.2.0.min.js'));
        wpm_enqueue_script('jquery-countdown-plugin', plugins_url('/member-luxe/js/countdown/jquery.plugin.min.js'));
        wpm_enqueue_script('jquery-countdown', plugins_url('/member-luxe/js/countdown/jquery.countdown.js'));
        wpm_enqueue_script('jquery-countdown-ru', plugins_url('/member-luxe/js/countdown/jquery.countdown-ru.js'));

        wpm_enqueue_script('jquery-fancybox', plugins_url('/member-luxe/js/fancybox/jquery.fancybox.js'));

        wpm_enqueue_script('wpm-comments-replay', includes_url('js/comment-reply.min.js'));

        wpm_enqueue_script('wpm-mediaelement', plugins_url('/member-luxe/js/mediaelement/mediaelement-and-player.min.js'));
        wpm_enqueue_script('wpm-wavesurfer', plugins_url('/member-luxe/js/audio/wavesurfer.min.js'));
        wpm_enqueue_script('wpm-audio-player', plugins_url('/member-luxe/js/audio/audio.js'));


        wpm_enqueue_script('wpm-owl', plugins_url('/member-luxe/js/owl.carousel/owl.carousel.min.js'));

        wpm_enqueue_script('wpm-summernote', plugins_url('/member-luxe/js/summernote/summernote.js'));
        wpm_enqueue_script('wpm-summernote-lang', plugins_url('/member-luxe/js/summernote/lang/summernote-ru-RU.js'));

    }
    echo "<!-- // wpm_enqueue_scripts --> \n";
}

add_action("wpm_footer", "wpm_enqueue_footer_scripts", 900);
function wpm_enqueue_footer_scripts()
{
}

/**
 *
 */

function wpm_head()
{
    do_action('wpm_head');
}

function wpm_footer()
{

    do_action('wpm_footer');
}

function wpm_plyr_version()
{
    return wpm_get_option('protection.plyr_version', '3.6.7');
}


/**
 * Remove all external plugins, languages from Tinymce on wppage editing page
 */


function wpm_remove_all_tinymce_ext_plugins()
{

    if (isset($_GET['post'])) {
        $post = get_post($_GET['post']);
        $post_type = get_post_type($post);
        if ($post_type == 'wpm-page') {

            remove_all_actions('mce_external_plugins', 9999);
            remove_all_actions('mce_buttons', 9999);
            remove_all_actions('mce_external_languages', 9999);
        }
    }
}

/**
 *
 */

function wpm_tinymce_config($init)
{

    global $typenow;
    global $current_screen;

    if ($current_screen->post_type != 'wpm-page' || $typenow != 'wpm-page') return $init;

    $upload_dir = wp_upload_dir();

    /*$init['force_p_newlines'] = 'true';
    $init['remove_linebreaks'] = true;
    $init['force_br_newlines'] = false;
    $init['remove_trailing_nbsp'] = true;
    $init['verify_html'] = true;*/


    $init['remove_linebreaks'] = 'false';
    $init['wpautop'] = 'false';
    $init['apply_source_formatting'] = 'true';
    $init['paste_auto_cleanup_on_paste'] = 'true';
    $init['paste_convert_headers_to_strong'] = 'false';
    $init['paste_strip_class_attributes'] = 'all';
    $init['paste_strip_class_attributes'] = 'false';
    $init['paste_remove_spans'] = 'true';
    $init['paste_remove_styles'] = 'true';

    if (!isset($init['content_css_force'])) {
        $init['content_css'] = includes_url("css/dashicons.min.css");
        $init['content_css'] .= ', ' . includes_url("js/mediaelement/mediaelementplayer.min.css");
        $init['content_css'] .= ', ' . includes_url("js/mediaelement/wp-mediaelement.css");
        $init['content_css'] .= ', ' . plugins_url() . '/member-luxe/css/editor-style-wpm-page.css?' . time();
    } else {
        $init['content_css'] = $init['content_css_force'];
    }


    if (version_compare(get_bloginfo('version'), '3.9', '>=')) {
        $init['toolbar1'] = 'bold italic underline strikethrough | bullist numlist  | blockquote hr | alignleft aligncenter alignright | outdent indent | anchor link unlink anchor fullscreen wp_adv';
        $init['toolbar2'] = 'fontselect fontsizeselect formatselect forecolor backcolor | table pastetext removeformat | undo redo ';
        $init['toolbar3'] = '';
        $init['fontsize_formats'] = '10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 19pt 20pt 21pt 22pt 23pt 24pt 25pt 26pt 27pt 28pt 29pt 30pt 32pt 42pt 48pt 52pt';
    } else {
        $init['theme_advanced_font_sizes'] = '10pt,11pt,12pt,13pt,14pt,15pt,16pt,17pt,18pt,19pt,20pt,21pt,22pt,23pt,24pt,25pt,26pt,27pt,28pt,29pt,30pt,32pt,42pt,48pt,52pt';

    }
    // Pass $init back to WordPress
    return $init;
}


/**
 *
 */

function wpm_notify_new_version()
{

    global $wp_query;
    $wpm_latest_version = get_option('wpm_latest_version');
    $wpm_version = get_option('wpm_version');

    $html = '';

    if (isset($_GET['page']) && $_GET['page'] == 'wpm-updater') {
        return false;
    }

    if (version_compare($wpm_version, $wpm_latest_version) < 0) { // we need to update
        ?>
        <div class="wpm_notify_update updated fade wpm_message">
            <p><b>Появилась новая версия MEMBERLUX <?php echo $wpm_latest_version; ?></b> &nbsp;&nbsp;<a
                    class="button button-primary" href="edit.php?post_type=wpm_page&page=wpm-updater">Обновить</a>
            </p>
        </div>
        <script type="text/javascript">
            jQuery(function ($) {
                $('li#menu-posts-wpm_page a[href="edit.php?post_type=wpm-page&page=wpm-updater"]').addClass('new_update');
            });
        </script>
    <?php
    }
    return $html;
}


/**
 * Parse youtube url
 */


function wpm_parse_youtube_url($url)
{
    $pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
    preg_match($pattern, $url, $matches);
    return (isset($matches[1])) ? $matches[1] : false;
}

/**
 * set custom template for MEMBERLUX pages
 */

function wpm_get_template($template)
{
    global $post, $wp_query;

    $main_options = get_option('wpm_main_options');
    $start_page = apply_filters('mbl_get_main_page', $main_options['home_id']);

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


    if (wpm_is_pin_code_page()) {
        status_header(200);

        return _wpm_get_template_path('pin_code');
    }

    if (wpm_is_activation_page()) {
        status_header(200);
        $template = _wpm_get_template_path('activation');
    } elseif (wpm_is_search_page()) {
        if (!wpm_option_is('main.search_visible', 'on', 'on')) {
            return wp_redirect(get_permalink($main_options['home_id']));
        }
        status_header(200);
        $template = _wpm_get_template_path('search');
    } elseif ((is_front_page() && $main_options['make_home_start']) || $start_page == $postId) {
        $template = wpm_is_interface_2_0()
            ? _wpm_get_template_path('index')
            : _wpm_get_template_path('single');
    } elseif ($isCategory && !is_search()) {
        $template = _wpm_get_template_path('category');
    } elseif ($postType == 'wpm-page' && !is_search()) {
        $template = _wpm_get_template_path('single');
    }


    return apply_filters('mbl_template_include', $template);
}

function mbl_is_mbl_page()
{
    global $post, $wp_query;

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

    $isMBLFrontPage = (is_front_page() && wpm_get_option('make_home_start'))
                      || apply_filters('mbl_get_main_page', wpm_get_option('home_id')) == $postId;

    $result = wpm_is_pin_code_page()
              || wpm_is_activation_page()
              || wpm_is_search_page()
              || $isMBLFrontPage
              || ($isCategory && !is_search())
              || ($postType == 'wpm-page' && !is_search());

    return apply_filters('mbl_is_mbl_page', $result);
}

function wpm_is_search_page()
{
    global $wp_query;

    return wpm_is_interface_2_0() && wpm_array_get($wp_query->query, 'wpm-page') == 'search';
}

function wpm_is_activation_success_page()
{
    global $wp_query;

    return wpm_array_get($wp_query->query, 'wpm-page') == 'activation-success';
}

function wpm_is_activation_page()
{
    global $wp_query;

    return wpm_is_interface_2_0() && wpm_array_get($wp_query->query, 'wpm-page') == 'activation';
}


/**
 *
 */

function wpm_hex_to_rgb($hex)
{
    $hex = str_replace("#", "", $hex);

    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    $rgb = array($r, $g, $b);
    //return implode(",", $rgb); // returns the rgb values separated by commas
    return $rgb; // returns an array with the rgb values
}

/**
 *
 */

function wpm_sanitize_option($option)
{
    global $wpdb;

    $iso9_table = array(
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Ѓ' => 'G`',
        'Ґ' => 'G`', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Є' => 'YE',
        'Ж' => 'ZH', 'З' => 'Z', 'Ѕ' => 'Z', 'И' => 'I', 'Й' => 'J',
        'Ј' => 'J', 'І' => 'I', 'Ї' => 'YI', 'К' => 'K', 'Ќ' => 'K`',
        'Л' => 'L', 'Љ' => 'L', 'М' => 'M', 'Н' => 'N', 'Њ' => 'N`',
        'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
        'У' => 'U', 'Ў' => 'U`', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'TS',
        'Ч' => 'CH', 'Џ' => 'DH', 'Ш' => 'SH', 'Щ' => 'SHH', 'Ъ' => '``',
        'Ы' => 'Y`', 'Ь' => '`', 'Э' => 'E`', 'Ю' => 'YU', 'Я' => 'YA',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'ѓ' => 'g',
        'ґ' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'є' => 'ye',
        'ж' => 'zh', 'з' => 'z', 'ѕ' => 'z', 'и' => 'i', 'й' => 'j',
        'ј' => 'j', 'і' => 'i', 'ї' => 'yi', 'к' => 'k', 'ќ' => 'k`',
        'л' => 'l', 'љ' => 'l', 'м' => 'm', 'н' => 'n', 'њ' => 'n`',
        'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
        'у' => 'u', 'ў' => 'u`', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts',
        'ч' => 'ch', 'џ' => 'dh', 'ш' => 'sh', 'щ' => 'shh', 'ъ' => '``',
        'ы' => 'y`', 'ь' => '`', 'э' => 'e`', 'ю' => 'yu', 'я' => 'ya'
    );
    $geo2lat = array(
        'ა' => 'a', 'ბ' => 'b', 'გ' => 'g', 'დ' => 'd', 'ე' => 'e', 'ვ' => 'v',
        'ზ' => 'z', 'თ' => 'th', 'ი' => 'i', 'კ' => 'k', 'ლ' => 'l', 'მ' => 'm',
        'ნ' => 'n', 'ო' => 'o', 'პ' => 'p', 'ჟ' => 'zh', 'რ' => 'r', 'ს' => 's',
        'ტ' => 't', 'უ' => 'u', 'ფ' => 'ph', 'ქ' => 'q', 'ღ' => 'gh', 'ყ' => 'qh',
        'შ' => 'sh', 'ჩ' => 'ch', 'ც' => 'ts', 'ძ' => 'dz', 'წ' => 'ts', 'ჭ' => 'tch',
        'ხ' => 'kh', 'ჯ' => 'j', 'ჰ' => 'h'
    );
    $iso9_table = array_merge($iso9_table, $geo2lat);

    $locale = get_locale();
    switch ($locale) {
        case 'bg_BG':
            $iso9_table['Щ'] = 'SHT';
            $iso9_table['щ'] = 'sht';
            $iso9_table['Ъ'] = 'A`';
            $iso9_table['ъ'] = 'a`';
            break;
        case 'uk':
            $iso9_table['И'] = 'Y`';
            $iso9_table['и'] = 'y`';
            break;
    }


    $option = strtr($option, apply_filters('ctl_table', $iso9_table));
    if (function_exists('iconv')) {
        $option = iconv('UTF-8', 'UTF-8//TRANSLIT//IGNORE', $option);
    }
    $option = preg_replace("/[^A-Za-z0-9'_\-\.]/", '-', $option);
    $option = preg_replace('/\-+/', '-', $option);
    $option = preg_replace('/^-+/', '', $option);
    $option = preg_replace('/-+$/', '', $option);

    return $option;
}

/**
 * Get single page
 */
function wpm_ajax_get_page()
{
    $id = $_POST['id'];
    if (!empty($id)) {
        wpm_update_autotraining_data($id, true);
        wpm_get_page($id);
    } else {
        echo '<div class="no-posts"><p>' . __('Страница не найдена.', 'mbl_admin') . '</p></div>';
    }

    die();
}

add_action('wp_ajax_wpm_get_page_action', 'wpm_ajax_get_page'); // ajax for logged in users
add_action('wp_ajax_nopriv_wpm_get_page_action', 'wpm_ajax_get_page'); // ajax for logged in users

function wpm_yt_protection_is_enabled()
{
    return !wpm_is_interface_2_0() && wpm_option_is('protection.youtube_protected', 'on');
}

function wpm_text_protection_is_enabled($main_options, $post_id = null)
{
    $isEnabledAll = (
        array_key_exists('protection', $main_options)
        && array_key_exists('text_protected', $main_options['protection'])
        && $main_options['protection']['text_protected'] == 'on'
    );

    $isEnabledForPost = true;

    if ($isEnabledAll && $post_id !== null) {
        $isEnabledForPost = !isset($main_options['protection']['text_protected_exceptions'])
            || !in_array($post_id, $main_options['protection']['text_protected_exceptions']);
    }

    return $isEnabledAll && $isEnabledForPost;
}

function wpm_reg_field_is_enabled($main_options, $field)
{
    return (
        array_key_exists('registration_form', $main_options)
        && array_key_exists($field, $main_options['registration_form'])
        && $main_options['registration_form'][$field] != 'on'
    ) ? false : true;
}

function wpm_get_video_url_bak()
{
    global $wpdb;

    if (!isset($_SERVER['HTTP_RANGE']) || !isset($_SESSION["flash"])) {
        echo "Permission denied.";
        die();
    }

    //unset($_SESSION["flash"]);


    $options_table = $wpdb->prefix . "options";

    $vid = $wpdb->get_row("SELECT *
                               FROM " . $options_table . "
                               WHERE option_name='wpm_vid_" . $_GET['id'] . "'", OBJECT);

    $link = $vid->option_value;

    $dir = str_replace(DIRECTORY_SEPARATOR . 'wp-admin', '', getcwd());
    $file = str_replace(get_site_url(), $dir, $link);
    $file = str_replace(wpm_remove_protocol(get_site_url()), $dir, $file);

    if (file_exists($file) && is_readable($file)) {
        ob_clean();

        $size = filesize($file);
        $length = $size;

        $fp = @fopen($file, 'rb');

        $start = 0;
        $end = $size - 1;
        session_write_close();

        header('Content-type: video/mp4');
        header("Accept-Ranges: bytes");

        header_remove('Cache-Control');
        header_remove('Expires');
        header_remove('Pragma');
        header_remove('X-Content-Type-Options');
        header_remove('X-Frame-Options');
        header_remove('X-Powered-By');
        header_remove('X-Robots-Tag');

        if (isset($_SERVER['HTTP_RANGE'])) {

            $c_start = $start;
            $c_end = $end;

            list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
            if (strpos($range, ',') !== false) {
                header('HTTP/1.1 416 Requested Range Not Satisfiable');
                header("Content-Range: bytes $start-$end/$size");
                exit;
            }
            if ($range == '-') {
                $c_start = $size - substr($range, 1);
            } else {
                $range = explode('-', $range);
                $c_start = $range[0];
                $c_end = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $size;
            }
            $c_end = ($c_end > $end) ? $end : $c_end;
            if ($c_start > $c_end || $c_start > $size - 1 || $c_end >= $size) {
                header('HTTP/1.1 416 Requested Range Not Satisfiable');
                header("Content-Range: bytes $start-$end/$size");
                exit;
            }
            $start = $c_start;
            $end = $c_end;
            $length = $end - $start + 1;
            fseek($fp, $start);
            header('HTTP/1.1 206 Partial Content');
        }

        header("Content-Range: bytes $start-$end/$size");
        header("Content-Length: " . $length);


        $buffer = 1024 * 1024 * 8;
        while (!feof($fp) && ($p = ftell($fp)) <= $end) {

            if ($p + $buffer > $end) {
                $buffer = $end - $p + 1;
            }
            set_time_limit(0);
            echo fread($fp, $buffer);
            @ob_flush();
            flush();
        }

        fclose($fp);
        exit();
    } else {
        header("Location: $link", true, 302);
        @ob_flush();
        flush();
        exit();
    }
}

add_action('wp_ajax_wpm_get_video', 'wpm_get_video_url');
add_action('wp_ajax_nopriv_wpm_get_video', 'wpm_get_video_url');

function wpm_get_video_url()
{
    global $wpdb;

    if (!isset($_SERVER['HTTP_RANGE']) || !isset($_SESSION["flash"])) {
        echo "Permission denied.";
        die();
    }

    $options_table = $wpdb->prefix . "options";

    $vid = $wpdb->get_row("SELECT *
                               FROM " . $options_table . "
                               WHERE option_name='wpm_vid_" . $_GET['id'] . "'", OBJECT);

    $link = $vid->option_value;

    $dir = str_replace(DIRECTORY_SEPARATOR . 'wp-admin', '', getcwd());
    $file = str_replace(get_site_url(), $dir, $link);
    $file = str_replace(wpm_remove_protocol(get_site_url()), $dir, $file);

    if (file_exists($file) && is_readable($file)) {
        $stream = new MBLVideoStream($file);
        $stream->start();
    } else {
        header("Location: $link", true, 302);
        @ob_flush();
        flush();
        exit();
    }
}

function wpm_protected_video_link($video_url)
{
    global $wpdb;

    $options_table = $wpdb->prefix . "options";

    $vid = $wpdb->get_row("SELECT *
                           FROM " . $options_table . "
                           WHERE option_value='" . $video_url . "'", OBJECT);

    if (!$vid) {
        $hash = hash('ripemd160', $video_url);
        add_option('wpm_vid_' . $hash, $video_url);
    } else {
        $hash = str_replace('wpm_vid_', '', $vid->option_name);
    }

    $url = admin_url('/admin-ajax.php') . '?action=wpm_get_video&id=' . $hash . '&_=' . md5(rand(0, 1000));

    return array(
        'url'  => $url,
        'hash' => $hash
    );
}


/**
 * Add WPM to admin nav bar
 */


function wpm_admin_nav_bar($wp_admin_bar)
{
	$main_options = get_option('wpm_main_options');
	$start_page_url = get_permalink($main_options['home_id']);

    $counter = 0;
    $notifications = wpm_get_notifications();

    foreach ($notifications as $notification) {
        if (!wpm_notification_is_read($notification['id'])) {
            $counter++;
        }
    }

    $score = '';

	if ($counter) {
		$score = '<div class="wp-core-ui wp-ui-notification mbl-issue-counter"><span aria-hidden="true">' . $counter . '</span></div>';
	}

	$title = '<div class="mbl-logo svg"><span class="screen-reader-text">MEMBERLUX</span></div>';

	$wp_admin_bar->add_menu(array(
		'id'    => 'mbl-menu',
		'title' => $title . $score,
		'href'  => '#',
		'meta'  => array('tabindex' => '0'),
	));

	$wp_admin_bar->add_menu(array(
		'parent' => 'mbl-menu',
		'id'     => 'mbl-start-page',
		'title'  => 'Перейти на главную',
		'href'   => $start_page_url,
		'meta'   => array('tabindex' => '0'),
	));

	$wp_admin_bar->add_menu(array(
        'parent' => 'mbl-menu',
        'id'     => 'mbl-notifications',
        'title'  => 'Уведомления' . $score,
        'href'   => (admin_url('edit.php?post_type=wpm-page&page=wpm-info-panel') . '#notifications'),
        'meta'   => array('tabindex' => '0'),
    ));

	$offer = wpm_array_get(wpm_get_key_data(), 'offer', array());
    $gmt_offset = get_option('gmt_offset');
    $now = time() + ($gmt_offset * HOUR_IN_SECONDS);

	if(!empty($offer) && isset($offer['end_date']) && strtotime($offer['end_date']) > $now) {
        $wp_admin_bar->add_menu(array(
            'parent' => 'mbl-menu',
            'id' => 'mbl-offer',
            'title' => 'Специальное предложение',
            'href' => (admin_url('edit.php?post_type=wpm-page&page=wpm-info-panel') . '#offer'),
            'meta' => array('tabindex' => '0'),
        ));

        $timerEnd = strtotime($offer['end_date']);
        $timeUntil = date("Y, m-1, d, H, i, s", $timerEnd);
        $timerArgs = array(
            'id' => 'wpm_offer_timer',
            'title' => '',
            'href' => (admin_url('edit.php?post_type=wpm-page&page=wpm-info-panel') . '#offer'),
            'meta' => array('title' => $offer['popover']),
        );

        $wp_admin_bar->add_node($timerArgs);
        $script = <<<JS
        jQuery(function($){
            var link = $("#wp-admin-bar-wpm_offer_timer > a");
            if(link.length && link.attr('title') != '' && typeof link.tooltip !== 'undefined') {
                link.tooltip({placement:'bottom'});
            }
            link.countdown({
                until: $.countdown.UTCDate('{$gmt_offset}', new Date({$timeUntil})),
                compact: true,
                format: 'DHMS',
                layout: '{dnn}:{hnn}:{mnn}:{snn}',
                padZeroes: true
            });
        });
JS;

        echo "<script type='text/javascript'>{$script}</script>";
    }


	$user = wp_get_current_user();
	if (in_array('customer', $user->roles)) {
		$wp_admin_bar->remove_node('wp-logo');
		$wp_admin_bar->remove_node('site-name');
	}

}

/**
 * Add WPM to admin nav bar
 */

function wpm_admin_menu_customer($wp_admin_bar)
{
    $user = wp_get_current_user();
    if (in_array('customer', $user->roles)) {
        remove_menu_page('index.php');
    }

}

/**
 *
 */
add_filter('excerpt_length', 'custom_excerpt_length', 999);
function custom_excerpt_length($length)
{
    if (get_post_type() == 'wpm-page') {
        return 10;
    } else {
        return $length;
    }
}

/**/

function wpm_get_user_status($user_id)
{
    $user_status = get_user_meta($user_id, 'wpm_status', true);

    if (empty($user_status)) {
        $user_status = 'active';
    }

    return $user_status;
}

function wpm_is_blocked($user_id = null)
{
    if ($user_id === null) {
        $user_id = get_current_user_id();
    }

    return $user_id && wpm_get_user_status($user_id) == 'inactive' && !wpm_is_admin($user_id);
}

function wpm_all_categories($term_id)
{
    $term_ids = array();

    $taxonomies = array(
        'wpm-levels'
    );

    $args = array(
        'orderby'           => 'name',
        'order'             => 'ASC',
        'hide_empty'        => false,
        'exclude'           => array(),
        'exclude_tree'      => array(),
        'include'           => array(),
        'number'            => '',
        'fields'            => 'all',
        'slug'              => '',
        'parent'            => $term_id,
        'hierarchical'      => true,
        'child_of'          => 0,
        'get'               => '',
        'name__like'        => '',
        'description__like' => '',
        'pad_counts'        => false,
        'offset'            => '',
        'search'            => '',
        'cache_domain'      => 'core'
    );

    $terms = get_terms($taxonomies, $args);

    if ($terms) {
        foreach ($terms as $term) {
            if (!in_array($term->term_id, $term_ids)) {

                $term_ids[] = $term->term_id;

                $child = wpm_all_categories($term->term_id);

                if (!empty($child)) {
                    $term_ids = array_merge($term_ids, $child);
                }
            }
        }
    }


    return $term_ids;
}

function wpm_get_all_user_accesible_levels($user_id)
{
    $term_ids = array();
    $terms_min_dates = array();

    if(!$user_id) {
        return array();
    }

    $user_keys = wpm_get_user_keys_info($user_id);

    if(empty($user_keys)) {
        return array();
    }

    $now = time();

    if (!empty($user_keys)) {
        $i = 0;

        foreach ($user_keys as $index) {

            $key_status = $index['key_info']['status'];
            $key_date_start = strtotime($index['key_info']['date_start']);
            $key_date_end = strtotime($index['key_info']['date_end']);
            $is_unlimited = $index['key_info']['is_unlimited'];

            if($key_status == 'used' && (!isset($terms_min_dates[$index['term_id']]) || $key_date_start < $terms_min_dates[$index['term_id']])) {
                $terms_min_dates[$index['term_id']] = $key_date_start;
            }

            if ($key_status == 'used' && $now >= $key_date_start && ($now <= $key_date_end || $is_unlimited)) {
                if (!in_array($index['term_id'], $term_ids)) {
                    $term_ids[] = $index['term_id'];

                    $child = wpm_all_categories($index['term_id']);

                    if (!empty($child)) {
                        $term_ids = array_merge($term_ids, $child);
                    }
                }
            } elseif ($key_status == 'new') {
                $i++;
            }
        }

        foreach ($terms_min_dates as $termId => $min_date) {
            if($min_date > $now) {
                $i++;
            }
        }

        if($i) {
            wpm_fix_user_keys($user_id);
        }

    }

    return count($term_ids) ? get_terms('wpm-levels', array('fields'=>'ids', 'include' => $term_ids, 'get' => 'all')) : array();
}

function wpm_check_access($page_id = null, $accessible_levels = null)
{
    if($page_id === null) {
        $page_id = get_the_ID();
    }
    if($accessible_levels === null) {
        $accessible_levels = wpm_get_all_user_accesible_levels(get_current_user_id());
    }

    $current_user = wp_get_current_user();

    $user_status = wpm_get_user_status($current_user->ID);

    if ($user_status == 'inactive' && !in_array('administrator', $current_user->roles)) {
        return false;
    }

    $levels_list = wp_get_post_terms($page_id, 'wpm-levels', array("fields" => "ids"));

    if (empty($levels_list)) {
        return is_user_logged_in() || !wpm_is_autotraining_post($page_id);
    } else {
        $has_access = false;
    }

    if (!empty($accessible_levels)) {
        foreach ($levels_list as $level) {
            if (in_array($level, $accessible_levels)) {
                $has_access = true;
                break;
            }
        }
    }

    if (current_user_can('manage_options')) {
        $has_access = true;
    }

    return $has_access;
}

function wpm_has_direct_access($page_id) {
    $current_user = wp_get_current_user();
    $result = MBLCache::get(array('wpm_has_direct_access', $current_user->ID, $page_id), -1);

    if($result === -1) {
        $result = _wpm_check_has_direct_access($page_id);

        MBLCache::set(array('wpm_has_direct_access', $current_user->ID, $page_id), $result);
    }

    return $result;
}

function _wpm_check_has_direct_access($page_id)
{
    global $wpdb;

    $terms_table = $wpdb->prefix . "terms";
    $term_taxonomy_table = $wpdb->prefix . "term_taxonomy";

    $cat_ids = wp_get_post_terms($page_id, 'wpm-category', array("fields" => "ids"));

    if (empty($cat_ids)) {
        return false;
    }
    $cat_id = $cat_ids[0];
    $current_user = wp_get_current_user();

    $autotraining = MBLCache::get(array('_wpm_check_has_direct_access', 'autotraining', $cat_id), -1);

    if($autotraining === -1) {
        $autotraining = $wpdb->get_row("SELECT a.*, b.count, b.parent
                                        FROM " . $terms_table . " AS a
                                        JOIN " . $term_taxonomy_table . " AS b ON a.term_id = b.term_id
                                        WHERE b.taxonomy='wpm-category' AND a.term_id=" . $cat_id . ";", OBJECT);
        MBLCache::set(array('_wpm_check_has_direct_access', 'autotraining', $cat_id), $autotraining);
    }

    if ($autotraining) {
        $schedule = wpm_autotraining_schedule_option($cat_id);
    } else {
        return false;
    }

    if (!count($schedule)) {
        return false;
    }

    $i = 1;
    foreach ($schedule as $post_id => $data) {
        if ($post_id == $page_id) {
            break;
        }
        $i++;
    }

    $training_access = get_user_meta($current_user->ID, 'training_access', true);
    $training_access = (empty($training_access) && !is_array($training_access)) ? array() : $training_access;

    foreach ($training_access AS $term) {
        if ($term['term_id'] == $cat_id && $term['level'] >= $i) {
            return true;
        }
    }

    return false;
}


function wpm_get_user_access_levels_id($user_id = '')
{
    $level_ids = array();
    if (empty($user_id)) {
        return $level_ids;
    } // stop if $user_id is not set

    return wpm_array_pluck(MBLTermKeysQuery::find(
        array('user_id' => $user_id, 'is_banned' => 0, 'key_type' => 'wpm_term_keys'), array('term_id')),
        'term_id'
    );
}

function wpm_get_excluded_categories($levelId = null)
{
    $current_user = wp_get_current_user(); //get current user
    $exclude_terms = array();
    if (!in_array('administrator', $current_user->roles) || $levelId !== null) {
        $user_level_ids = $levelId !== null
            ? array($levelId)
            : wpm_get_all_user_accesible_levels($current_user->ID);

        $user_level_ids = ($current_user->ID && count($user_level_ids))
            ? get_terms('wpm-levels', array('fields'=>'ids', 'include' => $user_level_ids, 'hide_empty' => 0))
            : array();

        $terms = get_terms('wpm-category', array('hide_empty' => 0));
        foreach ($terms as $term) {
            $term_id = $term->term_id;

            $term_meta = get_option("taxonomy_term_$term_id");

            if (!isset($term_meta['visibility_level_action']) || empty($term_meta['visibility_level_action'])) {
                $term_meta['visibility_level_action'] = 'hide';
            }

            // exclude category from menu for not registered users, when option 'hide_for_not_registered' is set to 'hide'
            $isExcludedForUnauthorized = (isset($term_meta['hide_for_not_registered']) && $term_meta['hide_for_not_registered'] == 'on')
                /*|| (isset($term_meta['category_type']) && $term_meta['category_type'] == 'on')*/;


            if (!is_user_logged_in() && $isExcludedForUnauthorized) {
                array_push($exclude_terms, $term_id);
                continue;
            }

            $exclude_levels = isset($term_meta['exclude_levels'])
                ? explode(',', $term_meta['exclude_levels'])
                : array();

             if ($term_meta['visibility_level_action'] == 'hide') {
                if (is_user_logged_in() && count($exclude_levels) && !count(array_diff($user_level_ids, $exclude_levels))) {
                    array_push($exclude_terms, $term_id);
                }
            } elseif (is_user_logged_in() && count($exclude_levels) && !count(array_intersect($user_level_ids, $exclude_levels))) {
                array_push($exclude_terms, $term_id);
            }

        }
    }

    return $exclude_terms;
}

/**/
function wpm_category_list_with_ancestor_class($args) {
    $list_args = $args;
    $catlist = wp_list_categories($list_args);
    if ( is_tax($list_args['taxonomy']) ) {
        global $wp_query;
        $term = $wp_query->get_queried_object();
        $term_object = get_term_by('id', $term->term_id, $list_args['taxonomy']);

        $current_term = $term->term_id;

        $ancestors = get_ancestors($current_term, $list_args['taxonomy']);

        // how many levels more than two set hierarchical ancestor?
        // count from 1 array from 0 : 1:0=Current 2:1=Parent >2:1 all Ancestors
        if( count($ancestors) >= 2){
            $max = count($ancestors) - 1; //Array elements zero based = count - 1
            $extra_class='current-cat-ancestor';
            for ( $counter = 1; $counter <= $max; $counter ++) {
                $cat_ancestor_class = 'cat-item cat-item-'. $ancestors[$counter];
                $amended_class = $cat_ancestor_class . ' ' . $extra_class;
                $catlist = str_replace($cat_ancestor_class, $amended_class, $catlist );
            }
        }
    }
    $menu = str_replace( array( "\r", "\n", "\t" ), '', $catlist );

    echo $menu;
}

/**
 *
 */

function wpm_custom_number_of_posts($query)
{

    if (is_admin() || !$query->is_main_query())
        return;

    $main_options = get_option('wpm_main_options');
    if (!$main_options['main']['posts_per_page'] || empty($main_options['main']['posts_per_page']))
        $posts_per_page = 20;
    else
        $posts_per_page = $main_options['main']['posts_per_page'];


    if ($query->is_tax('wpm-category')) {
        $query->set('posts_per_page', $posts_per_page);
        return;
    }

}

add_action('wpm_daily_schedule_hook', 'wpm_daily_schedule');

function wpm_daily_schedule()
{
    wpm_check_subscription_expires();
}

function wpm_get_user_by_term_key($key)
{
    return MBLTermKeysQuery::getUserByTermKey($key);
}

function wpm_send_expiration_emails($term_key, $term_id)
{
    $main_options = get_option('wpm_main_options');
    $start_url = '<a href="' . get_permalink($main_options['home_id']) . '">' . get_permalink($main_options['home_id']) . '</a>';
    
    if(wpm_array_get($term_key, 'is_unlimited')) {
        return true;
    }

    $daysToExpiration = intval(floor((strtotime($term_key['date_end']) - time()) / (60 * 60 * 24)));
    $term_meta = get_option("taxonomy_term_$term_id");
    $lettersOnDays = [
        1 => intval($term_meta['letter_1_days']),
        2 => intval($term_meta['letter_2_days']),
        3 => intval($term_meta['letter_3_days']),
    ];
    $lettersOnDays = array_diff($lettersOnDays, [0]);

    if (false !== $letterKey = array_search($daysToExpiration, $lettersOnDays)) {
        $user = wpm_get_user_by_term_key($term_key['key']);

        $metaMailKey = $term_id . '_' . $letterKey . '_' . $daysToExpiration;
        $sentMails = get_user_meta($user->ID, 'wpm_sent_expiration_emails', true);

        if (!$sentMails) {
            $sentMails = [];
        }

        if (in_array($metaMailKey, (array)$sentMails)) {
            return true;
        } else {
            $sentMails[] = $metaMailKey;
            update_user_meta($user->ID, 'wpm_sent_expiration_emails', $sentMails);
        }

        $email = $user->user_email;
        $name = $user->display_name;
        $login = $user->user_login;

        $subject = $term_meta["letter_{$letterKey}_title"];
        $subject = str_replace('[user_name]', $name, $subject);
        $subject = str_replace('[user_login]', $login, $subject);
        $subject = str_replace('[start_page]', $start_url, $subject);

        $html = $term_meta["letter_{$letterKey}"];
        $html = str_replace('[user_name]', $name, $html);
        $html = str_replace('[user_login]', $login, $html);
        $html = str_replace('[start_page]', $start_url, $html);

        wpm_send_mail($email, $subject, $html);
    }
}

function wpm_check_subscription_expires()
{
    $now = time();

    $keys = MBLTermKeysQuery::find(array('status' => 'used', 'key_type' => 'wpm_term_keys'));

    foreach ($keys AS $key) {
        if($now > strtotime($key['date_end']) && !wpm_array_get($key, 'is_unlimited')) {
            $key['status'] = 'expired';
            MBLTermKeysQuery::updateKey($key);

            $userId = wpm_array_get($key, 'user_id');
            if($userId) {
                MBLSubscription::unsubscribe($userId, wpm_array_get($key, 'term_id'));
            }

        } elseif ($key['key_type'] == 'wpm_term_keys') {
            wpm_send_expiration_emails($key, $key['term_id']);
        }
    }
}

/*
 * Exclude Memberluxe pages from search results
 * */

function wpm_exclude_from_search($query)
{


    if (!is_admin() && $query->is_main_query()) {

        if ($query->is_search) {
            $query->set('post_type', array('post', 'page'));
        }
    }

    //return $query;
}

add_filter('pre_get_posts', 'wpm_exclude_from_search');

/*
 * Order materials by 'menu_order title'
 */


function wpm_custom_get_posts($query)
{
    if (!$query->queried_object || $query->queried_object->taxonomy != 'wpm-category') {
        return $query;
    }

    if (is_category() || is_archive()) {
        $query->query_vars['orderby'] = 'menu_order title';
        $query->query_vars['order'] = 'ASC';
    }

    return $query;
}

function wpm_redirect_filter()
{
    $is_single = apply_filters('mbl_redirect_is_single', is_single());

    if (!$is_single && !is_user_logged_in()) {
        auth_redirect();
    } elseif (!$is_single) {
        wp_redirect(get_permalink(apply_filters('mbl_get_main_page', wpm_get_option('home_id'))));
    } elseif ( $is_single && $_SERVER['REQUEST_URI'] == '/wpm/start/' && !strpos(get_permalink(apply_filters('mbl_get_main_page', wpm_get_option('home_id'))), '/wpm/start/')) {
	    wp_redirect(get_permalink(apply_filters('mbl_get_main_page', wpm_get_option('home_id'))));
    }
}

function wpm_redirect_to_main()
{
    wp_redirect(wpm_get_start_url());
}

/*
 *
 */
add_action('wp_ajax_send_wpm_ask_form', 'wpm_ask_form_send');
add_action('wp_ajax_nopriv_send_wpm_ask_form', 'wpm_ask_form_send');
function wpm_ask_form_send()
{
    $main_options = get_option('wpm_main_options', true);

    if (empty($main_options['main']['ask_email'])) {
        $admin_email = get_option('admin_email');
    } else {
        $admin_email = $main_options['main']['ask_email'];
    }

    if(!MBLReCaptcha::check('ask')) {
        echo 'no';
        die();
    }

    echo MBLMail::askForm($admin_email, $_POST['name'], $_POST['email'], $_POST['message'], $_POST['title']) ? 'yes' : 'no';
    die();
}

/**
 *
 */


add_action('wp_logout', 'go_home');
function go_home()
{

    $main_options = get_option('wpm_main_options', true);

    $user = wp_get_current_user();
    if (in_array('customer', $user->roles)) {
        wp_redirect(get_permalink($main_options['home_id']));
        exit();
    }
}


function wpm_is_autotraining($cat_id)
{
    $taxonomy_term = get_option("taxonomy_term_" . $cat_id);
    return $taxonomy_term && $taxonomy_term['category_type'] === 'on';
}

function wpm_is_autotraining_post($post_id)
{
    $ids = wp_get_post_terms($post_id, 'wpm-category', array("fields" => "ids"));

    foreach ($ids as $id) {
        if(wpm_is_autotraining($id)) {
            return true;
        }
    }

    return false;
}

function wpm_get_autotraining_id_by_post($post_id)
{
    $ids = wp_get_post_terms($post_id, 'wpm-category', array("fields" => "ids"));

    foreach ($ids as $id) {
        if(wpm_is_autotraining($id)) {
            return $id;
        }
    }

    return false;
}

function wpm_hide_materials($cat_id)
{
    $taxonomy_term = get_option("taxonomy_term_" . $cat_id);
    return ($taxonomy_term && array_key_exists('hide_materials', $taxonomy_term) && $taxonomy_term['hide_materials'] == 'on') ? true : false;
}

function wpm_user_cat_data($cat_id, $user_id)
{
    $user_cat_data = get_user_meta($user_id, 'cat_data_' . $cat_id . '_' . $user_id, true);

    if (!$user_cat_data) {
        $user_cat_data = array(
            'is_training_started' => false,
            'training_start_time' => 0,
            'schedule'            => false
        );

        add_user_meta($user_id, 'cat_data_' . $cat_id . '_' . $user_id, $user_cat_data, true);
    }

    return $user_cat_data;
}

function wpm_update_accessible_material_number($user_cat_data, $number, $term_id)
{
    $user_id = get_current_user_id();

    if ($number > wpm_array_get($user_cat_data, 'current_accessible_material_number')) {

        $user_cat_data['current_accessible_material_number'] = $number;

        update_user_meta($user_id, 'cat_data_' . $term_id . '_' . $user_id, $user_cat_data);
    }
}
function wpm_update_rearranged_schedules($post_id)
{
    if(wpm_is_interface_2_0()) {
        AutoTrainingAccess::clearPostCategoryMetas($post_id);
    } else {
        wpm_update_rearranged_schedules_1_0($post_id);
    }
}

function wpm_update_rearranged_schedules_1_0($post_id)
{
    $term_list = wp_get_post_terms($post_id, 'wpm-category', array("fields" => "ids"));

    if (count($term_list)) {
        foreach ($term_list as $term_id) {
            $is_autotraining = wpm_is_autotraining($term_id);

            if ($is_autotraining) {
                $all_cat_data = wpm_all_cat_data($term_id);

                if (count($all_cat_data)) {
                    foreach ($all_cat_data as $data) {

                        $user_cat_data = unserialize($data->meta_value);
                        $user_id = str_replace('cat_data_' . $term_id . '_', '', $data->meta_key);

                        if (wpm_array_get($user_cat_data, 'is_training_started', false)) {
                            $accessible_number = wpm_array_get($user_cat_data, 'current_accessible_material_number', 0);
                            $cacheKey = 'wpm_create_training_schedule_' . $term_id . '_' . $accessible_number;
                            $schedule = MBLCache::get($cacheKey);
                            if(is_null($schedule)) {
                                $schedule = wpm_create_training_schedule($term_id, $accessible_number);
                                MBLCache::set($cacheKey, $schedule);
                            }
                            $user_cat_data['schedule'] = wpm_transfer_old_schedule_values(wpm_array_get($user_cat_data, 'schedule', array()), $schedule);

                            update_user_meta($user_id, 'cat_data_' . $term_id . '_' . $user_id, $user_cat_data);

                            wpm_autotraining_schedule_option($term_id, $user_cat_data['schedule']);
                        }

                    }
                }
            }
        }
    }
}

function wpm_transfer_old_schedule_values($oldSchedule, $newSchedule)
{
    if(is_array($oldSchedule)) {
        foreach ($oldSchedule AS $postId => $data) {
            if (isset($data['opened'])) {
                $newSchedule[$postId]['opened'] = $data['opened'];
            }
        }
    }

    return $newSchedule;
}

function wpm_all_cat_data($term_id)
{
    global $wpdb;
    $cat_data_table = $wpdb->prefix . "usermeta";

    return $wpdb->get_results("SELECT *
                               FROM `" . $cat_data_table . "`
                               WHERE meta_key LIKE '%cat_data_" . $term_id . "_%'", OBJECT);
}

function wpm_update_autotraining_data($post_id, $opened = false)
{
    $term_list = wp_get_post_terms($post_id, 'wpm-category', array("fields" => "ids"));
    $user_id = get_current_user_id();

    if (count($term_list)) {
        foreach ($term_list as $term_id) {
            $is_autotraining = wpm_is_autotraining($term_id);

            if ($is_autotraining) {
                $user_cat_data = wpm_user_cat_data($term_id, $user_id);

                if ($opened && !isset($user_cat_data['schedule'][$post_id]['opened'])) {
                    $user_cat_data['schedule'][$post_id]['opened'] = time();
                }

                if (!$user_cat_data['is_training_started']) {

                    $user_cat_data['is_training_started'] = true;
                    $user_cat_data['training_start_time'] = time();

                    if (!$user_cat_data['schedule']) {
                        $user_cat_data['schedule'] = wpm_create_training_schedule($term_id);
                        $user_cat_data['current_accessible_material_number'] = 1;

                        wpm_autotraining_schedule_option($term_id, $user_cat_data['schedule']);
                    }

                }
                update_user_meta($user_id, 'cat_data_' . $term_id . '_' . $user_id, $user_cat_data);
            }
        }
    }
}

function wpm_create_training_schedule($term_id, $current_accessible_number = 0)
{
    $schedule = array();
    $release_date = 0;
    $previous_post = null;
    $is_postponed_due_to_homework = false;
    $transmitted_shift = 0;

    $posts = get_posts(array(
            'post_type'      => 'wpm-page',
            'posts_per_page' => -1,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'wpm-category',
                    'field'    => 'term_id',
                    'terms'    => $term_id
                )
            ),
            'orderby'        => 'menu_order post_date',
            'order'          => 'ASC'
        )
    );

    if (count($posts)) {
        $cnt = 1;

        foreach ($posts as $post) {

            $post_meta = get_post_meta($post->ID, '_wpm_page_meta', true);
            $is_homework = (array_key_exists('is_homework', $post_meta) && $post_meta['is_homework'] == 'on') ? true : false;
            $homework_info = array(
                'confirmation_method'  => $post_meta['confirmation_method'],
                'homework_shift_value' => $post_meta['homework_shift_value']
            );

            if ($cnt == 1 || ($current_accessible_number > 0 && $cnt <= $current_accessible_number)) {
                $schedule[$post->ID] = array(
                    'is_first'                     => true,
                    'shift'                        => 0,
                    'transmitted_shift'            => 0,
                    'is_homework'                  => $is_homework,
                    'is_postponed_due_to_homework' => $is_postponed_due_to_homework,
                    'homework_info'                => $homework_info
                );
            } else {
                $previous_page_meta = get_post_meta($previous_post->ID, '_wpm_page_meta', true);
                $is_prev_has_homework = (array_key_exists('is_homework', $previous_page_meta) && $previous_page_meta['is_homework'] == 'on') ? true : false;
                $shift_data = wpm_get_shift($post->ID, $previous_page_meta);
                $transmitted_shift = $is_prev_has_homework ? $shift_data['transmitted_shift'] : (/*$transmitted_shift +*/ $shift_data['transmitted_shift']);
                $shift = $shift_data['shift'] + $transmitted_shift;

                if ($is_prev_has_homework || ($is_postponed_due_to_homework)) {
                    $is_postponed_due_to_homework = true;
                    $schedule[$post->ID] = array(
                        'shift'                        => $shift,
                        'transmitted_shift'            => $transmitted_shift,
                        'is_homework'                  => $is_homework,
                        'is_postponed_due_to_homework' => $is_postponed_due_to_homework,
                        'homework_info'                => $homework_info
                    );
                } else {
                    $release_date = wpm_release_date($release_date, $shift);
                    $schedule[$post->ID] = array(
                        'is_first'                     => false,
                        'shift'                        => $shift,
                        'transmitted_shift'            => $shift_data['transmitted_shift'],
                        'release_date'                 => $release_date,
                        'is_homework'                  => $is_homework,
                        'is_postponed_due_to_homework' => false,
                        'homework_info'                => $homework_info
                    );
                }

            }

            $previous_post = $post;
            $cnt++;
        }
    }

    return $schedule;
}

function wpm_get_shift($post_id, $previous_page_meta)
{
    $page_meta = get_post_meta($post_id, '_wpm_page_meta', true);
    $shift_data = array(
        'shift'             => 0,
        'transmitted_shift' => 0
    );

    if ($previous_page_meta['is_homework'] == 'on' && $previous_page_meta['confirmation_method'] == 'auto_with_shift') {
        $shift_data['transmitted_shift'] = $previous_page_meta['homework_shift_value'] * 60 * 60;
    } elseif ($previous_page_meta['confirmation_method'] == 'auto_with_shift') {
        $shift_data['transmitted_shift'] = $previous_page_meta['shift_value'] * 60 * 60;
    }

    if (array_key_exists('shift_is_on', $page_meta) && $page_meta['shift_is_on'] == 'on') {
        $shift_data['shift'] += array_key_exists('shift_value', $page_meta)
            ? ($page_meta['shift_value'] * 60 * 60)
            : 0;
    }

    return $shift_data;
}

function wpm_release_date($previous_release_date = 0, $shift = 0)
{
    if (!$previous_release_date) {
        $release_date = time() + $shift;
    } else {
        $release_date = $previous_release_date + $shift;
    }

    return (!$release_date ? time() : $release_date);
}

function wpm_is_post_visible($is_autotraining, $user_cat_data, $page_meta, $cnt, $post_id, $prev_id)
{
    return (
        !$is_autotraining
        || $cnt == 1
        || !wpm_has_shift($page_meta, $user_cat_data['schedule'][$post_id])
        || wpm_is_first_autotraining_material($user_cat_data, $post_id)
        || wpm_release_date_has_come($user_cat_data, $post_id, $prev_id)
    )
        ? true : false;
}

function wpm_is_current_number_accessible($user_cat_data, $menu_order)
{
    if (array_key_exists('current_accessible_material_number', $user_cat_data)) {
        return $user_cat_data['current_accessible_material_number'] >= $menu_order;
    } else {
        return false;
    }
}

function previous_post_has_undone_homework($previous_post_id, $previous_page_meta, $is_autotraining)
{
    if ($is_autotraining && $previous_post_id) {
        $is_prev_has_homework = wpm_array_get($previous_page_meta, 'is_homework') == 'on';

        if ($is_prev_has_homework) {
            $prev_homework_info = wpm_homework_info($previous_post_id, get_current_user_id(), $previous_page_meta);

            return !$prev_homework_info['done'];
        }
    }

    return false;
}

function wpm_has_shift($page_meta, $schedule)
{
    $metaShiftExists = array_key_exists('shift_is_on', $page_meta)
        && $page_meta['shift_is_on'] == 'on'
        && intval($page_meta['shift_value']) > 0;

    return !empty($schedule)
    && ($metaShiftExists || (array_key_exists('shift', $schedule) && $schedule['shift'] > 0));
}

function wpm_is_first_autotraining_material($user_cat_data, $post_id)
{
    return $user_cat_data['is_training_started']
    && isset($user_cat_data['schedule'][$post_id])
    && isset($user_cat_data['schedule'][$post_id]['is_first'])
    && $user_cat_data['schedule'][$post_id]['is_first'];
}

function wpm_release_date_has_come($user_cat_data, $post_id, $prev_id)
{
    $opened = 0;

    if (isset($user_cat_data['schedule'][$prev_id]['opened'])) {
        $opened = intval($user_cat_data['schedule'][$prev_id]['opened']);
    }

    if(!$opened) {
        $response = wpm_response(get_current_user_id(), $prev_id);

        if($response) {
            $opened = strtotime($response->response_date);
        }
    }

    return (
        $user_cat_data['is_training_started']
        && ($opened && time() >= ($opened + intval($user_cat_data['schedule'][$post_id]['shift'])))
    );
}

function wpm_has_homework($page_meta)
{
    if(is_array($page_meta)){
        return (array_key_exists('is_homework', $page_meta) && $page_meta['is_homework'] == 'on')
            ? true : false;
    }else{
        return false;
    }

}

function wpm_is_author($user_id, $author_id)
{
    return $author_id == $user_id ? true : false;
}

function wpm_autotraining_schedule_option($term_id, $schedule = array())
{
    if (empty($schedule)) {
        $schedule = wpm_create_training_schedule($term_id);
        add_option("autotraining_schedule_" . $term_id, $schedule);
    } else {
        update_option("autotraining_schedule_" . $term_id, $schedule);
    }

    return $schedule;
}

function wpm_get_homework_title($homework_info)
{
    $title = '';

    switch ($homework_info['confirmation_method']) {
        case 'auto':
            $title = __('Автоматическое подтверждение', 'mbl_admin');
            break;
        case 'auto_with_shift':
            $days = wpm_get_days($homework_info['homework_shift_value']);
            $hours = intval(fmod($homework_info['homework_shift_value'], 24));
            $minutes = wpm_get_minutes($homework_info['homework_shift_value']);
            $shift = ($days ? ($days . __('д', 'mbl_admin') . ' ') : '') . ($hours ? ($hours . __('ч', 'mbl_admin') . ' ') : '') . ($minutes ? ($minutes . __('мин', 'mbl_admin')) : '');
            $title = __('Автоматическое подтверждение со смещением', 'mbl_admin') . ' <b>' . $shift . '</b>';
            break;
        case 'manually':
            $title = __('Ручное подтверждение', 'mbl_admin');
            break;
    }

    return $title;
}

function wpm_comments_is_visible()
{
    $main_options = get_option('wpm_main_options');

    $mode = array_key_exists('visibility', $main_options['main']) ? $main_options['main']['visibility'] : 'to_all';

    return (!is_user_logged_in() && $mode == 'to_registered') ? false : true;
}

function wpm_attachments_is_disabled()
{
    $main_options = get_option('wpm_main_options');

    $mode = array_key_exists('attachments_mode', $main_options['main']) ? $main_options['main']['attachments_mode'] : 'allowed_to_all';

    switch ($mode) {
        case 'allowed_to_all':
            return false;
            break;
        case 'allowed_to_admin':
            $current_user = wp_get_current_user();
            $roles = $current_user->roles;
            return in_array('administrator', $roles) ? false : true;
            break;
        case 'disabled':
            return true;
            break;
        default:
            return false;
    }
}

function isAutosubscriptionActive($service, $term_meta)
{
    return (
        $term_meta !== false
        && array_key_exists('auto_subscriptions', $term_meta)
        && array_key_exists($service, $term_meta['auto_subscriptions'])
        && array_key_exists('active', $term_meta['auto_subscriptions'][$service])
        && $term_meta['auto_subscriptions'][$service]['active'] == 'on'
    ) ? true : false;
}

function autoDisable($service, $term_meta)
{
    return (
        $term_meta !== false
        && array_key_exists('auto_subscriptions', $term_meta)
        && array_key_exists($service, $term_meta['auto_subscriptions'])
        && array_key_exists('auto_disable', $term_meta['auto_subscriptions'][$service])
        && $term_meta['auto_subscriptions'][$service]['auto_disable'] == 'on'
    ) ? true : false;
}

function wpm_renew_subscription_status_cron()
{
    $main_options = get_option('wpm_main_options');

    $isCronActive = !array_key_exists('auto_disable_mode', $main_options['main']) || $main_options['main']['auto_disable_mode'] == 'cron';
    if ($isCronActive && isAutosubscriptionActive('justclick', $main_options) && autoDisable('justclick', $main_options)) {
        $auto_subscription = new MemberLuxAutoSubscriptions();
        $auto_subscription->renew_subscription_status();
    }
}

add_action('wp_ajax_wpm_subscription_status_cron', 'wpm_renew_subscription_status_cron');
add_action('wp_ajax_nopriv_wpm_subscription_status_cron', 'wpm_renew_subscription_status_cron');

function wpm_hierarchical_category_tree($term_id, $term_meta, $dash = '', $name = 'term_meta[exclude_levels]')
{
    $taxonomies = [
        'wpm-levels',
    ];

    $args = [
        'orderby'           => 'name',
        'order'             => 'ASC',
        'hide_empty'        => false,
        'exclude'           => [],
        'exclude_tree'      => [],
        'include'           => [],
        'number'            => '',
        'fields'            => 'all',
        'slug'              => '',
        'parent'            => $term_id,
        'hierarchical'      => true,
        'child_of'          => 0,
        'get'               => '',
        'name__like'        => '',
        'description__like' => '',
        'pad_counts'        => false,
        'offset'            => '',
        'search'            => '',
        'cache_domain'      => 'core',
    ];

    $terms = get_terms($taxonomies, $args);
    $exclude_levels = wpm_array_get($term_meta, 'exclude_levels', '');

    if (!is_array($exclude_levels)) {

        $exclude_levels = explode(',', $exclude_levels);
    }

    if ($terms) {
        foreach ($terms as $term) {
            $next_dash = $dash;
            $checked = in_array($term->term_id, $exclude_levels) ? 'checked' : '';
            $class = $term_id ? 'wpm-levels-children' : 'wpm-levels-parent';
            echo '<ul class="' . $class . '">' .
                 '<li>' .
                 '<i>' . $dash . '</i>' .
                 '<label>' .
                 '<input type="checkbox" name="' . $name . '[]" value="' . $term->term_id . '" ' . $checked . '/>' .
                 $term->name .
                 '</label>';
            $next_dash .= '&#8212; ';
            wpm_hierarchical_category_tree($term->term_id, $term_meta, $next_dash, $name);
            echo '</li>' .
                 '</ul>';
        }
    }
}

function wpm_date_is_hidden($main_options)
{
    if(is_array($main_options['main'])){
        return (array_key_exists('date_is_hidden', $main_options['main']) && $main_options['main']['date_is_hidden'] == 'on')
            ? true : false;
    }else{
        return false;
    }

}

function wpm_user_keys($user, $is_table = false, $show_banned = true)
{
    $html = '';

    wpm_fix_user_keys($user->ID);

    $banned = MBLTermKeysQuery::find(array('user_id' => $user->ID, 'is_banned' => 1, 'key_type' => 'wpm_term_keys'));

    $banned_keys = MBLTermKeysQuery::transformKeysToInfo($banned);

    $cur_user = wp_get_current_user();

    $i = 1;
    if (!empty($banned_keys) && $show_banned) {
        foreach ($banned_keys as $index) {
            if ($index !== null) {
                $banned_key = $index['key_info']['key'];
                $date_registered = isset($index['key_info']['date_registered'])
                    ? $index['key_info']['date_registered']
                    : $index['key_info']['date_start'];
                $date_start = $index['key_info']['date_start'];
                $date_end = wpm_array_get($index, 'key_info.is_unlimited') ? __('Неограниченный доступ', 'mbl_admin') : $index['key_info']['date_end'];
                $term = get_term($index['term_id'], 'wpm-levels');

                if ($is_table) {
                    $html .= "<tr class='banned_key'>" .
                        "<td>" . $i . "</td>" .
                        "<td class='banned_key key'>" .
                        $banned_key . " <div class='additional-info'>( {$term->name} | зарегистрирован: {$date_registered} | действителен с: {$date_start} | действителен до: {$date_end} )</div>" .
                        "</td>" .
                        "</tr>";
                } else {
                    $html .= "<li class='banned_key'>{$banned_key} <div class='additional-info'>( {$term->name} | зарегистрирован: {$date_registered} | действителен с: {$date_start} | действителен до: {$date_end} )</div></li>";
                }
            }

            $i++;
        }
    }

    $user_keys = MBLTermKeysQuery::transformKeysToInfo(MBLTermKeysQuery::find(array('user_id' => $user->ID, 'is_banned' => 0, 'key_type' => 'wpm_term_keys')));



    if (!empty($user_keys)) {

        foreach ($user_keys as $index) {
            if ($index !== null) {
                $key = $index['key_info']['key'];
                $date_registered = isset($index['key_info']['date_registered'])
                    ? $index['key_info']['date_registered']
                    : $index['key_info']['date_start'];
                $date_start = $index['key_info']['date_start'];
                $date_end = wpm_array_get($index, 'key_info.is_unlimited') ? __('Неограниченный доступ', 'mbl_admin') : $index['key_info']['date_end'];
                $term = get_term($index['term_id'], 'wpm-levels');
                $delete = in_array('administrator', $cur_user->roles) ? '<i data-key="' . $key . '" class="remove-key">Удалить ключ</i>' : '';

                if ($is_table) {
                    $html .= "<tr>" .
                        "<td>" . $i . "</td>" .
                        "<td class='key'>" .
                        $key . " <div class='additional-info'>( {$term->name} | зарегистрирован: {$date_registered} | действителен с: {$date_start} | действителен до: {$date_end} )</div>" .
                        "</td>" .
                        "</tr>";
                } else {
                    $html .= "<li>$key <div class='additional-info'>( {$term->name} | зарегистрирован: {$date_registered} | действителен с: {$date_start} | действителен до: {$date_end} )</div>" . $delete . "</li>";
                }

                $i++;
            }
        }

    }

    return $html;
}

function wpm_retrieve_password_message($message, $key)
{
    if (wpm_mandrill_is_on() || wpm_ses_is_on()) {

        if (strpos($_POST['user_login'], '@')) {
            $user_data = get_user_by('email', trim($_POST['user_login']));
        } else {
            $login = trim($_POST['user_login']);
            $user_data = get_user_by('login', $login);
        }

        $user_email = $user_data->user_email;
        $user_login = $user_data->user_login;

        if (is_multisite()) {
            $blogname = $GLOBALS['current_site']->site_name;
        } else {
            $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
        }

        $title = sprintf(__('[%s] Password Reset'), $blogname);

        $title = apply_filters('retrieve_password_title', $title);

        $sitename = strtolower($_SERVER['SERVER_NAME']);
        $from_email = 'wordpress@' . $sitename;

        $retrieve_url = network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login');

        $message = __('Someone requested that the password be reset for the following account:') . "\r\n\r\n";
        $message .= network_home_url('/') . "\r\n\r\n";
        $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
        $message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
        $message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
        $message .= '<a href="' . $retrieve_url . '">' . $retrieve_url . "</a> \r\n";

        wpm_send_mail($user_email, wp_specialchars_decode($title), $message, get_bloginfo("name"), $from_email);

        return false;
    }


    return $message;
}

add_filter('retrieve_password_message', 'wpm_retrieve_password_message', 10, 3);

// migrate to new headers
function migrate_to_new_header()
{
    $main_options = get_option('wpm_main_options');
    if (empty($main_options['headers']['priority'])) {
        $main_options['headers']['priority'] = 'default,pincodes';
        $main_options['headers']['headers']['default']['content'] = $main_options['header']['content'];
        update_option('wpm_main_options', $main_options);
    }
}


// remove title from categories list

function wp_list_categories_remove_title_attributes($output)
{
    $output = preg_replace("/title=\"[\\s\\S]*?\"/", '', $output);
    return $output;
}

add_filter('wp_list_categories', 'wp_list_categories_remove_title_attributes');


function wpm_prepare_val($val)
{
    return (isset($val))? $val : '';
}

//----------

function wpm_register_set_content_type($content_type)
{
    return 'text/html';
}

function wpm_wp_mail_from($content_type) {
    return 'no-reply@' . $_SERVER['SERVER_NAME'];
}

function wpm_wp_mail_from_name($name) {
    return get_bloginfo("name");
}
//----------------


//add_filter( 'authenticate','one_session_per_user', 30, 3 );
function one_session_per_user( $user, $username, $password ) {
    $sessions = WP_Session_Tokens::get_instance( $user->ID );
    $all_sessions = $sessions->get_all();
    if ( count($all_sessions) ) {
        $user = new WP_Error('already_signed_in', __('<strong>ERROR</strong>: User already logged in.'));
    }
    return $user;
}
add_filter( 'authenticate','wpm_remove_all_user_sessions', 30, 3 );

function wpm_remove_all_user_sessions($user, $username, $password){

    $main_options = get_option('wpm_main_options');

    if(!$user || is_wp_error($user)) {
        return $user;
    }

    $roles = $user->roles;
    if (is_array($roles) && in_array('customer', $roles)) {

        // collect stats
        wpm_add_login_to_log($user->ID);

        // remove all another sessions
        if(isset($main_options['protection']['one_session']) && $main_options['protection']['one_session']['status'] == 'on'){
            // get all sessions for user with ID $user_id
            $sessions = WP_Session_Tokens::get_instance($user->ID);

            // we have got the sessions, destroy them all!
            $sessions->destroy_all();
        }
    }
    return $user;
}

// get user ip

function wpm_get_ip()
{
    // populate a local variable to avoid extra function calls.
    // NOTE: use of getenv is not as common as use of $_SERVER.
    //       because of this use of $_SERVER is recommended, but
    //       for consistency, I'll use getenv below
    $tmp = getenv("HTTP_CLIENT_IP");
    // you DON'T want the HTTP_CLIENT_ID to equal unknown. That said, I don't
    // believe it ever will (same for all below)
    if ( $tmp && !strcasecmp( $tmp, "unknown"))
        return $tmp;

    $tmp = getenv("HTTP_X_FORWARDED_FOR");
    if( $tmp && !strcasecmp( $tmp, "unknown"))
        return $tmp;

    // no sense in testing SERVER after this.
    // $_SERVER[ 'REMOTE_ADDR' ] == gentenv( 'REMOTE_ADDR' );
    $tmp = getenv("REMOTE_ADDR");
    if($tmp && !strcasecmp($tmp, "unknown"))
        return $tmp;

    return("unknown");
}


function wpm_add_login_to_log( $user_id){
    global $wpdb;

    $login_log_table = $wpdb->prefix . "memberlux_login_log";

    $args = array(
        'user_id' => $user_id,
        'ip' => $_SERVER['REMOTE_ADDR'],
        'time' => current_time('mysql')
    );

    $wpdb->insert($login_log_table, $args);

}


// check if user session not expired
    function wpm_auth_check(){
        $response = array(
            'auth' => false
        );
        $user_id = $_POST['user_id'];

        $response['auth'] = is_user_logged_in($user_id) && empty( $GLOBALS['login_grace_period'] );
        echo json_encode($response);
        die();
    }

add_action('wp_ajax_wpm_auth_check_action', 'wpm_auth_check');
add_action('wp_ajax_nopriv_wpm_auth_check_action', 'wpm_auth_check');

function wpm_add_infoprotector_key_to_url($content){
    return wpm_replace_url_plus_code($content);
}

function wpm_replace_url_plus_code($content) {
    global $post;
    $current_user = wp_get_current_user();
    if (is_user_logged_in() && is_array($current_user->roles) && in_array('customer', $current_user->roles)){

        $user = wp_get_current_user();
        $user_keys = wpm_get_user_keys_info($user->ID);
        if($user_keys){
            foreach($user_keys as $index){
                $key = $index['key_info']['key'];
                $levels_list = wp_get_post_terms($post->ID, 'wpm-levels', array("fields" => "ids"));

                if(in_array($index['term_id'], $levels_list)){
                    preg_match("/([a-zA-Z0-9]){4}-([a-zA-Z0-9]){4}-([a-zA-Z0-9]){4}/", $key, $found);

                    if($found){
                        $regex = '@infoprotector:\/\/([^\'\"\>\<\n\t\s])+@';

                        $content = preg_replace_callback( $regex, function ($match) use ($key){
                            $data = parse_url($match[0]);
                            $url = $data['scheme'].'://'.$data['host'];
                            if($data['port']){
                                $url .= ':'.$data['port'];
                            }
                            $url .= $data['path'];

                            if($data['query']){
                                $url .= '?'.$data['query'].'&ipsn='.$key;
                            }else{
                                $url .= '?ipsn='.$key;
                            }
                            if($data['fragment']){
                                $url .= '#'.$data['fragment'];
                            }
                            return $url;
                        }, $content );
                        return $content;
                    }
                }
            }
        }
    }
    return $content;
}

//TODO:: replace all occurrences with minute-based time
function wpm_minutes2hours($minutes)
{
    return round((intval($minutes) * (1 / 60)) + 0.000000001, 9);
}

function wpm_get_minutes($hours)
{
    return floor(fmod($hours, 1) * 60);
}

function wpm_get_days($hours)
{
    return floor($hours / 24);
}

function wpm_get_time_text($hours)
{
    $intDays = wpm_get_days($hours);
    $intHours = intval(fmod($hours, 24));
    $minutes = wpm_get_minutes($hours);
    $title = ($intDays ? ($intDays . 'д ') : '') . ($intHours ? ($intHours . 'ч ') : '') . ($minutes ? ($minutes . 'мин') : '');

    return trim($title);
}


/**
 * Add image size
 */
add_action('init', 'wpm_add_image_sizes');
function wpm_add_image_sizes()
{
    add_image_size('avatar-thumb', 48, 48, true); // Avatar
    add_image_size('wpm-slider', 640, 2000, false); // Image slider
}

function wpm_option_is($option, $value, $default = null)
{
    return wpm_get_option($option, $default) == $value;
}

function wpm_get_option($key = null, $default = null)
{
    return wpm_array_get(get_option('wpm_main_options'), $key, $default);
}

function wpm_get_immediate_option($key = null, $default = null)
{
    $options = wpm_array_get($_POST, 'main_options', get_option('wpm_main_options'));

    return wpm_array_get($options, $key, $default);
}

function wpm_get_design_option($key = null, $default = null)
{
    return wpm_array_get(get_option('wpm_design_options'), $key, $default);
}

function wpm_array_get($array, $key = null, $default = null)
{
    if (!is_array($array)) {
        return $default;
    }

    if($key === null) {
        return $array;
    }

    $keys = explode('.', $key);
    $value = $array;

    foreach ($keys AS $currKey) {
        if (!is_array($value) || !array_key_exists($currKey, $value)) {
            return $default;
        }

        $value = $value[$currKey];
    }

    return $value;
}

function wpm_array_set($array, $key, $value)
{
    __wpm_array_set($array, $key, $value);

    return $array;
}

function __wpm_array_set(&$array, $key, $value)
{
    if (is_null($key)) {
        return $array = $value;
    }
    $keys = explode('.', $key);
    while (count($keys) > 1) {
        $key = array_shift($keys);
        if (!isset($array[$key]) || !is_array($array[$key])) {
            $array[$key] = array();
        }
        $array =& $array[$key];
    }
    $array[array_shift($keys)] = $value;
}

function wpm_array_pluck($array, $key)
{
    $result = array();

    if (!is_array($array)) {
        return $result;
    }

    foreach ($array AS $k => $value) {
        $result[$k] = wpm_array_get($value, $key);
    }

    return $result;
}

function wpm_array_filter($array, $value)
{
    return array_intersect($array, array($value));
}

function wpm_array_clear($array, $clearValues = array('', null))
{
    $arr = array();

    if (is_array($array)) {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $arr[$key] = wpm_array_clear($value);
            } elseif (!in_array($value, $clearValues)) {
                $arr[$key] = $value;
            }
        }
        $array = $arr;
    }

    return $array;
}

function wpm_jw_player_code()
{
    $default = 'OcQXu3Cx/pgNE/bx3qqXx0piOJ0qudFU1CgBzQ==';

    return wpm_option_is('protection.jwplayer_version', '6', '6')
        ? wpm_get_option('protection.jwplayer_code', $default)
        : wpm_get_option('protection.jwplayer_code_7', $default);
}

add_action('comment_post', array('MBLComment', 'commentPosted'), 12, 2);

function wpm_add_comment_subscription() {
    if (isset($_POST['id'])) {
        MBLComment::addSubscription(intval($_POST['id']));
        echo json_encode(MBLComment::hasSubscription(intval($_POST['id'])));
    } else {
        echo json_encode(false);
    }
    die();
}

add_action('wp_ajax_wpm_add_comment_subscription', 'wpm_add_comment_subscription');
add_action('wp_ajax_nopriv_wpm_add_comment_subscription', 'wpm_add_comment_subscription');

function wpm_editor($content, $id, $options = array(), $required = false, $name = null, $empty = false)
{
    echo MBLRedactor::summernote($content, $id, $options, $required, $name, $empty);
}

function wpm_editor_admin($content, $id, $options = array(), $required = false, $name = null)
{
    echo MBLRedactor::summernoteAdmin($content, $id, $options, $required, $name);
}

function wpm_include_partial($view, $domain = 'base')
{
    include(_wpm_get_partial_path($view, $domain));
}

function wpm_render_partial($view, $domain = 'base', $variables = array(), $return = false)
{
    $result = wpm_get_partial(_wpm_get_partial_path($view, $domain), $variables);

    if($return) {
        return $result;
    } else {
        echo $result;
    }
}

function _wpm_get_partial_path($view, $domain = 'base')
{
    if(wpm_is_interface_2_0() && $domain !== 'common') {
        $path = "/member-luxe/templates/interface_2/{$domain}/parts/{$view}.php";
    } else {
        $path = "/member-luxe/templates/{$domain}/parts/{$view}.php";
    }

    return WP_PLUGIN_DIR . $path;
}

function _wpm_get_template_path($template, $domain = 'base')
{
    if(wpm_is_interface_2_0()) {
        $path = "/member-luxe/templates/interface_2/{$domain}/{$template}.php";
    } else {
        $path = "/member-luxe/templates/{$domain}/{$template}.php";
    }

    return WP_PLUGIN_DIR . $path;
}

function wpm_is_interface_2_0 ()
{
    $version = wpm_array_get($_POST, 'main_options.interface_version',  wpm_get_option('interface_version', 1));

    return $version == 2;
}

function wpm_is_admin_wpm_page()
{
    global $typenow;
    global $current_screen;

    return is_admin() &&
        (is_object($current_screen) && $current_screen->post_type === 'wpm-page'
            || $typenow === 'wpm-page'
            || (isset($_GET['taxonomy']) && $_GET['taxonomy'] == 'wpm-levels')
            || (isset($_GET['post_type']) && $_GET['post_type'] == 'wpm-page')
        );
}

function wpm_get_partial($path, $variables = array())
{
    extract($variables);

    ob_start();
    require($path);

    return ob_get_clean();
}

function wpm_remove_protocol($url)
{
    return preg_replace('/^https?\:/', '', $url);
}

function wpm_remove_protocol_from_text($text)
{
    return $text;
    //return str_replace(array('http:', 'https:'), '', $text);
}
function wpm_remove_protocol_from_comment($comment_text, $comment = null)
{
    return str_replace(array('http:', 'https:'), '', $comment_text);
}

function wpm_is_admin($user = null)
{
    global $current_user;

    if($user !== null && !$user instanceof WP_User) {
        $user = wpm_get_user($user);
    }

    $user = $user ?: $current_user;

    return in_array('administrator', $user->roles);
}

function wpm_is_coach($user = null)
{
    global $current_user;

    if($user !== null && !$user instanceof WP_User) {
        $user = wpm_get_user($user);
    }

    $user = $user ?: $current_user;

    return in_array('coach', $user->roles);
}

function wpm_user_is_active($user = null)
{
    global $current_user;

    $user = $user ?: $current_user;
    $status = wpm_get_user_status($user);

    return $status == 'active' || wpm_is_admin();
}

function wpm_material_link($category = null, $post = null)
{
    if (!$post) {
        $post = get_post();
    }

    $isCategory = $category instanceof WP_Term
        || (is_object($category) && isset($category->taxonomy) && $category->taxonomy == 'wpm-category' && isset($category->slug));

    if ($isCategory && $post) {
        if (get_option('permalink_structure') != '') {
            $link = sprintf("wpm/%s/%s/", $category->slug, get_page_uri($post));
        } else {
            $link = "?wpm-page={$post->post_name}&wpm-category={$category->slug}";
        }
        $link = home_url($link);
    } else {
        $link = get_permalink($post->ID);
    }

    return esc_url(apply_filters('the_permalink', $link, $post->ID));
}

function wpm_search_link()
{
    if(get_option('permalink_structure') != '') {
        $link = 'wpm/search';
    } else {
        $link = "?wpm-page=search";
    }

    return home_url($link);
}

function wpm_activation_link()
{
    if(get_option('permalink_structure') != '') {
        $link = 'wpm/activation';
    } else {
        $link = "?wpm-page=activation";
    }

    return home_url($link);
}

add_filter('rewrite_rules_array', 'wpm_rewrite_rules');

function wpm_rewrite_rules($rules)
{
    $newRules = array();
    if(wpm_is_interface_2_0()) {
        $startPage = get_post(wpm_get_option('home_id'));

        $newRules['wpm/'.$startPage->post_name.'/(?:page/)?(\d+)/?'] = 'index.php?wpm-page='.$startPage->post_name.'&post_type=wpm-page&name='.$startPage->post_name.'&page_nb=$matches[1]';
        $newRules['wpm/([^/]+)/(?!page/)([^/]+)/?'] = 'index.php?wpm-page=$matches[2]&wpm-category=$matches[1]';
        $newRules['wpm/search(?:/page)?/?(\d+)?/?'] = 'index.php?wpm-page=search&page_nb=$matches[1]';
        $newRules['wpm/activation/?'] = 'index.php?wpm-page=activation';
        $newRules['wpm-category/([^/]+)/page/(\d+)/?'] = 'index.php?wpm-category=$matches[1]&paged=$matches[2]';
    } else {
        $newRules['wpm/([^/]+)/([^/]+)/?'] = 'index.php?wpm-page=$matches[2]&wpm-category=$matches[1]';
    }

    return array_merge($newRules, $rules);
}


add_filter('request', 'wpm_rewrite_request');

function wpm_rewrite_request($vars)
{
    global $wpdb;

    if (wpm_array_get($vars, 'wpm-page') && !wpm_array_get($vars, 'wpm-category')) {
        $postId = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".wpm_array_get($vars, 'wpm-page')."'");
        $post = get_post($postId);
        if($post) {
            $terms = wp_get_post_terms($post->ID, 'wpm-category');
            if (count($terms)) {
                $link = wpm_material_link($terms[0], $post);
                wp_redirect($link);
            }
        }
    }

    return $vars;
}

function wpm_get_current_user($field = null)
{
    $current_user = wp_get_current_user();

    if ($field === null) {
        return $current_user;
    }

    $user = $current_user->to_array();

    return wpm_array_get($user, $field);
}

function wpm_get_user($userId, $field = null)
{
    $userObj = get_userdata($userId);

    if ($field === null || !$userObj) {
        return $userObj;
    }

    $user = $userObj->to_array();

    return wpm_array_get($user, $field);
}

function wpm_get_start_url()
{
    return get_permalink(wpm_get_option('home_id'));
}

function wpm_get_comments_args()
{
    return array(
        'walker' => null,
        'max_depth' => '',
        'style' => 'ul',
        'callback' => 'wpm_comment_template',
        'end-callback' => null,
        'type' => 'all',
        'reply_text' => __('Ответить', 'mbl'),
        'page' => '',
        'per_page' => '',
        'avatar_size' => 48,
        'reverse_top_level' => null,
        'reverse_children' => '',
        'format' => 'html5', //or xhtml if no HTML5 theme support
        'short_ping' => false, // @since 3.6,
        'echo' => true // boolean, default is true
    );
}

function wpm_get_avatar($userId = null, $size = 150, $id = null, $fullTag = true, $withGravatar = false, $isComment = false)
{
//    global $current_user;

    if (!$userId) {
        return null;
    }

    remove_filter( 'option_show_avatars', 'wpm_disable_default_avatars' );

    $args = array();

    if($id !== null) {
        $args['extra_attr'] = "id='{$id}'";
    }

    if($withGravatar) {
        $gravatar = get_avatar($userId, $size, '404', '', $args);
        $gravatarUrl =  get_avatar_url($userId, array('default' => '404'));
    }

    add_filter( 'option_show_avatars', 'wpm_disable_default_avatars' );

    $avatar = get_user_meta($userId, 'avatar', true);

    if($withGravatar) {
        return $avatar
        ? ($fullTag
            ? wp_get_attachment_image($avatar, 'thumbnail', '', array('class' => "avatar avatar-{$size} photo", 'id' => $id))
            : wpm_array_get(wp_get_attachment_image_src($avatar, 'thumbnail', ''), 0)
        )
        : ($fullTag ? $gravatar : $gravatarUrl);
    } else {
        return $avatar
        ? ($fullTag
            ? wp_get_attachment_image($avatar, 'thumbnail', '', array('class' => "avatar avatar-{$size} photo", 'id' => $id))
            : wpm_array_get(wp_get_attachment_image_src($avatar, 'thumbnail', ''), 0)
        )
        : null;
    }
}

function wpm_get_avatar_tag($userId = null, $size = 150, $isComment = false)
{
    $avatar = wpm_get_avatar($userId, $size, null, true, false, $isComment);

    if(!empty($avatar)) {
        return $avatar;
    }elseif($defaultAvatar = get_avatar($userId, $size )) {
        return $defaultAvatar;
    } else {
        $file = $isComment ? 'default-comment-avatar.svg' : 'default-profile-image.svg';
        return sprintf('<img src="%s" alt="%s">', plugins_url('/member-luxe/2_0/images/' . $file), wpm_get_user($userId, 'display_name'));
    }
}

function disable_visual_editor_embeds( $plugins ) {
    return array_diff( $plugins, array('wpview') );
}
add_filter( 'tiny_mce_plugins', 'disable_visual_editor_embeds' );

function wpm_crop()
{
    echo MBLCrop::crop();
    die();
}

add_action('wp_ajax_wpm_crop_action', 'wpm_crop');

function wpm_truncate_text($text, $length = 30, $truncate_string = '...', $truncate_lastspace = false)
{
    if ($text == '') {
        return '';
    }

    $mbstring = extension_loaded('mbstring');
    if ($mbstring) {
        $old_encoding = mb_internal_encoding();
        @mb_internal_encoding(mb_detect_encoding($text));
    }
    $strlen = ($mbstring) ? 'mb_strlen' : 'strlen';
    $substr = ($mbstring) ? 'mb_substr' : 'substr';

    if ($strlen($text) > $length) {
        $truncate_text = $substr($text, 0, $length - $strlen($truncate_string));
        if ($truncate_lastspace) {
            $truncate_text = preg_replace('/\s+?(\S+)?$/', '', $truncate_text);
        }
        $text = $truncate_text . $truncate_string;
    }

    if ($mbstring) {
        @mb_internal_encoding($old_encoding);
    }

    return $text;
}

add_filter('get_sample_permalink', 'mbl_admin_sample_permalink',10,2);

function mbl_admin_sample_permalink($permalink, $id)
{
    $post = get_post($id);

    if($post->post_type == 'wpm-page') {
        $terms = wp_get_post_terms($post->ID, 'wpm-category');
        if (count($terms)) {
            $permalink[0] = str_replace($post->post_name, '%pagename%', wpm_material_link($terms[0], $post));
        }
    }

    return $permalink;
}

add_filter('post_type_link', 'mbl_post_type_link',10,2);

function mbl_post_type_link($permalink, $post)
{
    if($post->post_type == 'wpm-page'/* && is_admin()*/) {
        $terms = wp_get_post_terms($post->ID, 'wpm-category');
        if (count($terms)) {
            return wpm_material_link($terms[0], $post);
        }
    }

    return $permalink;
}

function mbl_escape_chars($string)
{
    if (function_exists('wp_encode_emoji') && function_exists('mb_convert_encoding')) {
        $string = wp_encode_emoji($string);
    }

    return $string;
}

add_action( 'wpm-levels_add_form_fields', 'wpm_levels_admin_screen' );

function wpm_levels_admin_screen() {
    $style = ".form-field.term-slug-wrap,.form-field.term-parent-wrap{display:none;}";

    echo "<style>{$style}</style>";
}

add_action( 'wpm-category_add_form_fields', 'wpm_category_admin_screen' );

function wpm_category_admin_screen() {
    $style = ".form-field.term-slug-wrap,.form-field.term-description-wrap{display:none;}";

    echo "<style>{$style}</style>";
}

function wpm_homework_attachments_show()
{
    return wpm_option_is('homework_attachments_mode', 'allowed_to_all', 'allowed_to_all')
        || (wpm_option_is('homework_attachments_mode', 'allowed_to_admin') && wpm_is_admin());
}

function wpm_info_admin()
{
    $keyData = wpm_get_key_data();

    $notifications = array_reverse(wpm_get_notifications());
    $offer = wpm_array_get($keyData, 'offer', array());

    wpm_render_partial('admin_info_panel', 'common', compact('notifications', 'offer'));
    wpm_read_notifications();
}

add_action('template_redirect', 'mbl_disable_author_page');
function mbl_disable_author_page() {
    global $wp_query;

    if ( is_author() && !wpm_is_admin() ) {
        $wp_query->set_404();
        status_header(404);
    }
}

add_action( 'admin_bar_menu', 'mbl_remove_wp_nodes', 999 );

function mbl_remove_wp_nodes()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_node( 'new-post' );
    $wp_admin_bar->remove_node( 'new-link' );
    $wp_admin_bar->remove_node( 'new-media' );
    $wp_admin_bar->remove_node( 'new-content' );
}

function mbl_weekday($weekday_number)
{
    global $wp_locale;

    return $wp_locale->get_weekday($weekday_number);
}

function mbl_weekdays_range()
{
    return range(1, 6) + array(6 => 0);
}

function mbl_mysql_date($date)
{
    if (trim($date) == '' || substr($date, 0, 10) == '0000-00-00') {
        return null;
    }

    $timestamp = strtotime($date);

    return $timestamp && $timestamp > 0
        ? $timestamp
        : null;
}

function mbl_get_term_name($termId)
{
    $term = get_term($termId);

    return $term ? $term->name : null;
}

/**
 * Add summernote image as file
 */

add_action('wp_ajax_uploadSummernoteFile', 'mbl_upload_summernote_file');
add_action('wp_ajax_nopriv_uploadSummernoteFile', 'mbl_upload_summernote_file');

function mbl_upload_summernote_file()
{
    return MBLRedactor::saveSummernoteUploadFile();
}

function mbl_localize_summernote($interface)
{
    return MBLRedactor::summernoteLocale($interface);
}

function mbl_update_translations_2_9_9_2_8()
{
    if (version_compare(get_option('wpm_version'), '2.9.9.2.9', '<')) {
        MBLTranslator::replaceByMsgIdAndValue('Главная', 'Главная 123', 'Главная');
        MBLTranslator::replaceByMsgIdAndValue('Главная', 'Главная eeee', 'Главная');
        MBLTranslator::replaceByMsgIdAndValue('Принимаю', 'Принимаю2', 'Принимаю');
        MBLTranslator::replaceByMsgIdAndValue('Принимаю', 'Принимаю5', 'Принимаю');
        MBLTranslator::replaceByMsgIdAndValue('Email', 'Email 2', 'Email');
        MBLTranslator::replaceByMsgIdAndValue('Фамилия', 'Фамилия2', 'Фамилия');
        MBLTranslator::replaceByMsgIdAndValue('Имя', 'Имя2', 'Имя');
        MBLTranslator::replaceByMsgIdAndValue('Отчество', 'Отчество2', 'Отчество');
        MBLTranslator::replaceByMsgIdAndValue('Телефон', 'Телефон2', 'Телефон');
        MBLTranslator::replaceByMsgIdAndValue('Желаемый логин', 'Желаемый логин2', 'Желаемый логин');
        MBLTranslator::replaceByMsgIdAndValue('Желаемый пароль', 'Желаемый пароль 2', 'Желаемый пароль');

        update_option('wpm_version', WP_MEMBERSHIP_VERSION);
    }
}

/* Получить родительский термин таксономии по ID поста
******************************************************************/
function get_top_term( $taxonomy, $post_id = 0 ){

    isset( $post_id->ID ) && $post_id = $post_id->ID;
    ! $post_id            && $post_id = get_the_ID();

    $terms = get_the_terms( $post_id, $taxonomy );

    if( ! $terms || is_wp_error( $terms ) ){
        return $terms;
    }

    // только первый
    $term = array_shift( $terms );

    // найдем ТОП
    $parent_id = $term->parent;
    while( $parent_id ){
        $term = get_term_by( 'id', $parent_id, $term->taxonomy );
        $parent_id = $term->parent;
    }

    return $term;
}

/*****************************************************************/

//$key = implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 99999))), 0, 30), 7));
//
//echo '<pre>';
//print_r($key);
//echo '</pre>';

//$key = [
//    //'id' => 1,
//    'term_id' => 7,
//    'user_id' => '',
//   // 'key' => 'key' . random_int(100, 10000),
//    'key_type' => 'wpm_term_keys',
//    'status' => 'new',
//    'sent' => 0,
//    'is_banned' => 0,
//    'duration' => 12,
//    'units' => 'months',
//    'date_start' => '30-11--0001',
//    'date_end' => '30-11--0001',
//    'date_registered' => '',
//    'info' => '',
//    'is_unlimited' => 0,
//];
//print_r(MBLTermKeysQuery::insertKey($key));

