<?php

class MBLAAdmin
{
    const COACH_ACCESS_META = '_mbla_coach_access';

    /**
     * MBLAAdmin constructor.
     */
    public function __construct()
    {
        $this->_setHooks();
    }

    private function _setHooks()
    {
        $this->_addMBLHooks();
        $this->_addScripts();
    }

    private function _addMBLHooks()
    {
        add_action('mbl_category_autotraining_after_shift', [$this, 'addMBLAutotrainingOptions']);
        add_action('mbl_autotraining_passed', [$this, 'addNextLevelKeyToUser'], 10, 2);
        add_action('mbl_autotraining_map_subtitle', [$this, 'addAutotrainingMapSubtitle'], 10);
        add_action('mbl_extra_profile_fields', [$this, 'coachAccess'], 10, 2);

        add_action('edit_user_profile_update', [$this, 'saveCoachAccess'], 11, 2);
        add_filter('mbl_post_coaches', [$this, 'postCoaches'], 10, 3);

        add_filter('wpm_homework_filters_wpm-category', [$this, 'filterCoachCategories'], 10);
        add_filter('wpm_homework_filters_wpm_category_ids', [$this, 'filterCoachCategoryIds'], 10);

        add_action('mbl_hw_tabs', [$this, 'homeworkStatsTab'], 10);
        add_action('mbl_hw_content', [$this, 'homeworkStats'], 10);
        add_action('mbla_hw_stats_charts', [$this, 'homeworkStatsCharts'], 10);

        add_action('wp_ajax_mbla_get_homework_stats_charts', [$this, 'homeworkStatsChartsAjax']);
        add_action('wp_ajax_mbla_stats_materials', [$this, 'statsMaterials']);

        add_action('wpm_admin_hw_list_content_row_after', [$this, 'homeworkListCoach']);
        add_action('wpm_admin_hw_list_th_after', [$this, 'homeworkListCoachLabel']);
        add_action('wpm_admin_hw_list_col_after', [$this, 'homeworkListCoachCol']);
        add_action('wpm_admin_hw_list_filters_after', [$this, 'homeworkListCoachFilter']);
        add_action('wpm_admin_hw_list_filters_after', [$this, 'homeworkListToggleFilter']);
        add_action('wpm_admin_hw_list_filters_after', [$this, 'homeworkListToggleSearch']);

        add_action('wpm_admin_hw_settings_filter', [$this, 'settingsFilter']);
        add_action('wpm_admin_hw_settings_fields', [$this, 'settingsFields']);

        add_filter('wpm_hw_colspan', [$this, 'homeworkColspan']);
        add_filter('wpm_hw_extra_styles', '__return_empty_string');

        add_filter('wpm_admin_hw_condition', [$this, 'homeworkList']);
        add_filter('wpm_admin_hw_responses', [$this, 'homeworkListOrderByCoach']);

        add_action('mbl_options_items_after', [$this, 'mbla_settings_tab'], 10);
        add_action('mbl_options_content_after', [$this, 'mbla_settings_content'], 10);
    }

    private function _addScripts()
    {
        add_action('admin_enqueue_scripts', [$this, 'addAdminScripts']);
        add_action('admin_enqueue_scripts', [$this, 'addAdminStyles']);
    }

    public function addMBLAutotrainingOptions($args)
    {
        $args['levels'] = wpm_get_all_levels();

        mbla_render_partial('mbl_autotraining_options', 'admin', $args);
    }

    public function addMBLConfigContent($args)
    {
        mbla_render_partial('mbl_config_content', 'admin', $args);
    }

    public function addNextLevelKeyToUser($termId, $userId)
    {
        $metaKey = 'mbla_add_level_processed_' . $termId;
        $processed = get_user_meta($userId, $metaKey, true) == 1;

        if (!$processed) {
            $meta = get_option("taxonomy_term_" . $termId);

            $isAutotraining = wpm_array_get($meta, 'category_type') === 'on';
            $addLevel = wpm_array_get($meta, 'add_level_after_finish') === 'on';
            $newTermId = wpm_array_get($meta, 'add_level_term_key');
            $duration = absint(wpm_array_get($meta, 'add_level_duration'));
            $units = wpm_array_get($meta, 'add_level_duration_units') === 'days' ? 'days' : 'months';
            $is_unlimited = intval(wpm_array_get($meta, 'add_level_duration_is_unlimited') == 'on');

            if ($isAutotraining && $addLevel && $newTermId && ($duration || $is_unlimited)) {
                $code = wpm_insert_one_user_key($newTermId, $duration, $units, $is_unlimited);
                wpm_add_key_to_user($userId, $code, true);
            }

            update_user_meta($userId, $metaKey, 1);
        }
    }

    /**
     * @param $category MBLCategory
     */
    public function addAutotrainingMapSubtitle($category)
    {
        $addLevel = $category->getMeta('add_level_after_finish') == 'on';
        $newTermId = $category->getMeta('add_level_term_key');
        $duration = absint($category->getMeta('add_level_duration'));
        $units = $category->getMeta('add_level_duration_units') === 'days' ? 'days' : 'months';
        $is_unlimited = intval($category->getMeta('add_level_duration_is_unlimited') == 'on');
        $unitsText = $is_unlimited
            ? __('Неограниченный доступ', 'mbl_admin')
            : sprintf(_n($units == 'months' ? '%s month' : '%s day', $units == 'months' ? '%s months' : '%s days', $duration), $duration);
        $coaches = $this->_getCategoryCoaches($category->getTermId());

        if ($category->isAutotraining()) {
            mbla_render_partial('mbl_autotraining_map_subtitle', 'admin', compact('category', 'addLevel', 'newTermId', 'duration', 'unitsText', 'coaches', 'is_unlimited'));
        }
    }

    public function addAdminScripts()
    {
        if (is_admin()) {
            wp_enqueue_script('mbla_chartjs', plugins_url('/mbl-auto/assets/chartjs/Chart.min.js'));
            wp_enqueue_script('mbla_admin', plugins_url('/mbl-auto/assets/js/mbla_admin.js'), ['jquery']);
        }
    }

    private function _getLocale()
    {
        return in_array(get_locale(), MBLTranslator::$ru_locales) ? 'ru' : 'en';
    }

    public function addAdminStyles()
    {
        if (is_admin()) {
            wp_enqueue_style('mbla_chartjs_style', plugins_url('/mbl-auto/assets/chartjs/Chart.min.css'), [], MBLA_VERSION);
            wp_enqueue_style('mbla_admin_style', plugins_url('/mbl-auto/assets/css/admin.css'), [], MBLA_VERSION);
        }
    }

    public function coachAccess($autotrainings, $user)
    {
        if (wpm_is_admin() && wpm_is_coach($user->ID) && $user->ID !== get_current_user_id()) {
            $access = $this->_getCoachAccessibleCategories($user->ID);
            $accessAll = get_user_meta($user->ID, self::COACH_ACCESS_META . '_all', true) ?: 'off';

            //Настройки для всех важнее настроек в профиле если оно включены
            $statsAccessAll = wpm_get_option('mbla.stats_access_all', 'off');
            $disableOthersStatsAccessAll = wpm_get_option('mbla.other_access_all', 'off');

            $statsAccess = get_user_meta($user->ID, self::COACH_ACCESS_META . '_stats', true) ?: 'off';
            $disableOthersStatsAccess = get_user_meta($user->ID, self::COACH_ACCESS_META . '_stats_other_disable', true) ?: 'on';

            if ($statsAccessAll == 'on') {
                $statsAccess = 'on';

                if ($disableOthersStatsAccessAll == 'on') {
                    $disableOthersStatsAccess = 'on';
                }
            }

            $levels = get_terms('wpm-levels', ['hide_empty' => 0]);
            $levelsAccess = $this->_getCoachAccessibleCategoryLevels($user->ID);
            $levelsAccessAll = get_user_meta($user->ID, self::COACH_ACCESS_META . '_all_level', true) ?: 'off';

            mbla_render_partial('coach_access', 'admin', compact('autotrainings', 'user', 'access', 'accessAll', 'statsAccess', 'disableOthersStatsAccess', 'levels', 'levelsAccess', 'levelsAccessAll'));
        }
    }

    /**
     * @param $userId
     *
     * @return array
     */
    private function _getCoachAccessibleCategories($userId)
    {
        return wpm_array_get(get_user_meta($userId, self::COACH_ACCESS_META, true), null, []);
    }

    /**
     * @param $userId
     *
     * @return array
     */
    private function _getCoachAccessibleCategoryLevels($userId)
    {
        return wpm_array_get(get_user_meta($userId, self::COACH_ACCESS_META . '_levels', true), null, []);
    }

    public function saveCoachAccess($userId)
    {
        if (!current_user_can('edit_user', $userId)) {
            return false;
        }

        if (!wpm_is_admin() || !wpm_is_coach($userId) || $userId === get_current_user_id()) {
            return false;
        }

        $categories = wpm_array_get($_POST, self::COACH_ACCESS_META, []);

        foreach ($categories as $categoryId => $options) {
            if (wpm_array_get($options, 'is_enabled', 'off') == 'on') {
                $this->_addCoachToCategory($userId, $categoryId, wpm_array_get($options, 'type', 'all'), wpm_array_get($options, 'level', 'all'));
            } else {
                $this->_deleteCoachFromCategory($userId, $categoryId);
            }
        }

        $accessAll = wpm_array_get($_POST, self::COACH_ACCESS_META . '_all.is_enabled', 'off') == 'off'
            ? 'off'
            : wpm_array_get($_POST, self::COACH_ACCESS_META . '_all.type', 'all');

        $levelAll = wpm_array_get($_POST, self::COACH_ACCESS_META . '_all.is_enabled', 'off') == 'off'
            ? 'off'
            : wpm_array_get($_POST, self::COACH_ACCESS_META . '_all.level', 'all');

        update_user_meta($userId, self::COACH_ACCESS_META . '_all', $accessAll);
        update_user_meta($userId, self::COACH_ACCESS_META . '_all_level', $levelAll);

        $statsAccess = wpm_array_get($_POST, self::COACH_ACCESS_META . '_stats', 'off');
        update_user_meta($userId, self::COACH_ACCESS_META . '_stats', $statsAccess);

        $disableOthersStatsAccess = wpm_array_get($_POST, self::COACH_ACCESS_META . '_stats_other_disable', 'on');
        update_user_meta($userId, self::COACH_ACCESS_META . '_stats_other_disable', $disableOthersStatsAccess);
    }

    private function _addCoachToCategory($userId, $categoryId, $type = 'all', $level = 'all')
    {
        $userMeta = $this->_getCoachAccessibleCategories($userId);
        $userMeta[$categoryId] = $type;
        $this->_updateCoachAccessibleCategories($userId, $userMeta);

        $levelsMeta = $this->_getCoachAccessibleCategoryLevels($userId);
        $levelsMeta[$categoryId] = $level;
        $this->_updateCoachAccessibleCategoryLevels($userId, $levelsMeta);

        $termMeta = $this->_getCategoryCoaches($categoryId);
        $termMeta[$userId] = $type;
        $this->_updateCategoryCoaches($categoryId, $termMeta);
    }

    private function _updateCoachAccessibleCategories($userId, $categories)
    {
        return update_user_meta($userId, self::COACH_ACCESS_META, $categories);
    }

    private function _updateCoachAccessibleCategoryLevels($userId, $categories)
    {
        return update_user_meta($userId, self::COACH_ACCESS_META . '_levels', $categories);
    }

    /**
     * @param $categoryId
     *
     * @return array
     */
    private function _getCategoryCoaches($categoryId)
    {
        return wpm_array_get(get_term_meta($categoryId, self::COACH_ACCESS_META, true), null, []);
    }

    private function _updateCategoryCoaches($categoryId, $coaches)
    {
        return update_term_meta($categoryId, self::COACH_ACCESS_META, $coaches);
    }

    private function _deleteCoachFromCategory($userId, $categoryId)
    {
        $userMeta = $this->_getCoachAccessibleCategories($userId);
        $levelMeta = $this->_getCoachAccessibleCategoryLevels($userId);

        if (isset($userMeta[$categoryId])) {
            unset($userMeta[$categoryId]);
        }
        if (isset($levelMeta[$categoryId])) {
            unset($levelMeta[$categoryId]);
        }

        $this->_updateCoachAccessibleCategories($userId, $userMeta);
        $this->_updateCoachAccessibleCategoryLevels($userId, $levelMeta);

        $termMeta = $this->_getCategoryCoaches($categoryId);

        if (isset($termMeta[$userId])) {
            unset($termMeta[$userId]);
        }

        $this->_updateCategoryCoaches($categoryId, $termMeta);
    }

    public function postCoaches($coaches, $postId, $response)
    {
        $page = new MBLPage(get_post($postId));
        $categoryId = wpm_get_autotraining_id_by_post($postId);

        if (!$categoryId) { // not an autotraining post
            return [];
        }

        $homeworkType = $page->getMeta('homework_type', 'question');
        $coachesAccess = $this->_getCategoryCoaches($categoryId);

        $result = [];

        foreach ($coaches as $coach) {
            if (!isset($coachesAccess[$coach->ID])) {
                continue;
            }

            if (!in_array($coachesAccess[$coach->ID], [$homeworkType, 'all'])) {
                continue;
            }
            
            if($response && !$this->_isCoachAllowedForResponse($coach->ID, $response)) {
                continue;
            }

            $result[] = $coach;
        }

        return $result;
    }

    public function filterCoachCategories($categories)
    {
        if (!wpm_is_coach()) {
            return $categories;
        }

        $accessibleCategories = $this->_getCoachAccessibleCategories(get_current_user_id());

        $result = [];

        foreach ($categories as $category) {
            if (isset($accessibleCategories[$category->term_id])) {
                $result[] = $category;
            }
        }

        return $result;
    }

    public function filterCoachCategoryIds($categoryIds)
    {
        if (!wpm_is_coach()) {
            return $categoryIds;
        }

        $accessibleCategories = $this->_getCoachAccessibleCategories(get_current_user_id());

        $result = [];

        foreach ($categoryIds as $categoryId) {
            if (isset($accessibleCategories[$categoryId])) {
                $result[] = $categoryId;
            }
        }

        return $result;
    }

    public function homeworkStatsTab()
    {
        if (!$this->_hasAccessToStats()) {
            return false;
        }

        mbla_render_partial('homework/stats_tab', 'admin');
    }

    private function _hasAccessToStats()
    {
        return wpm_is_admin() || (wpm_is_coach() && $this->_coachStatsEnabled());
    }

    private function _coachStatsEnabled($userId = null)
    {
        if ($userId === null) {
            $userId = get_current_user_id();
        }

        //Настройки для всех важнее настроек в профиле если они включены
        $statsAccessAll = wpm_get_option('mbla.stats_access_all', 'off');

        if ($statsAccessAll == 'on') {
            return true;
        }

        return get_user_meta($userId, self::COACH_ACCESS_META . '_stats', true) === 'on';
    }

    private function _hasAccessToOtherStats()
    {
        return wpm_is_admin() || (wpm_is_coach() && $this->_coachOtherStatsEnabled());
    }

    private function _coachOtherStatsEnabled($userId = null)
    {
        if ($userId === null) {
            $userId = get_current_user_id();
        }

        //Настройки для всех важнее настроек в профиле если они включены
        $statsAccessAll = wpm_get_option('mbla.stats_access_all', 'off');
        $disableOthersStatsAccessAll = wpm_get_option('mbla.other_access_all', 'off');

        if ($statsAccessAll == 'on') {
            if ($disableOthersStatsAccessAll == 'on') {
                return false;
            }
        }

        return get_user_meta($userId, self::COACH_ACCESS_META . '_stats_other_disable', true) !== 'on';
    }

    public function homeworkStats()
    {
        if (!$this->_hasAccessToStats()) {
            return false;
        }

        $categories = $this->_getHomeworkStatsCategories();

        $levels = get_terms('wpm-levels', ['hide_empty' => 0]);

        $locale = $this->_getLocale();

        $hasAccessToOtherStats = $this->_hasAccessToOtherStats();

        $users = get_users([
            'role__in' => ['coach', 'administrator'],
        ]);

        mbla_render_partial('homework/stats', 'admin', compact('categories', 'locale', 'levels', 'hasAccessToOtherStats', 'users'));
    }

    /**
     * @return array
     */
    private function _getHomeworkStatsCategories()
    {
        if (wpm_is_coach()) {
            $categoryIds = array_keys($this->_getCoachAccessibleCategories(get_current_user_id()));
            $categories = get_terms('wpm-category', ['include' => $categoryIds, 'hide_empty' => 0]);
        } else {
            $categories = get_terms('wpm-category', ['hide_empty' => 0]);
        }

        if (!is_array($categories)) {
            return [];
        }

        $categories = array_filter($categories,
            function ($category) {
                return wpm_is_autotraining($category->term_id);
            });

        return $categories;
    }

    public function statsMaterials()
    {
        $result = [];
        $isCoach = wpm_is_coach();

        add_filter('wp_query_search_exclusion_prefix',
            function ($prefix) {
                return false;
            });

        add_filter('posts_search', [$this, '__search_by_title_only'], 500, 2);

        $args = [
            's'              => wpm_array_get($_GET, 'q'),
            'post_status'    => 'publish',
            'post_type'      => 'wpm-page',
            'posts_per_page' => 50,
            'orderby'        => 'menu_order title',
            'order'          => 'ASC',
        ];

        if ($isCoach) {
            $coachAccessibleCategories = $this->_getCoachAccessibleCategories(get_current_user_id());
            $categoryIds = array_keys($coachAccessibleCategories);

            $args['tax_query'] = [
                [
                    'taxonomy' => 'wpm-category',
                    'field'    => 'term_id',
                    'terms'    => $categoryIds,
                ],
            ];
        }

        $search_results = new WP_Query($args);
        if ($search_results->have_posts()) {
            while ($search_results->have_posts()) {
                $search_results->the_post();
                $title = (mb_strlen($search_results->post->post_title) > 50) ? mb_substr($search_results->post->post_title, 0, 49) . '...' : $search_results->post->post_title;
                $result[] = [$search_results->post->ID, $title];
            }
        }

        if ($isCoach) {
            $filtered = [];

            foreach ($result as $postData) {
                $postId = $postData[0];
                $categoryId = wpm_get_autotraining_id_by_post($postId);

                if (!$categoryId) {
                    continue;
                }

                /** @var WP_Post $post */
                $page = new MBLPage(get_post($postId));
                $homeworkType = $page->getMeta('homework_type', 'question');

                if (!isset($coachAccessibleCategories[$categoryId])) {
                    continue;
                }
                if (!in_array($coachAccessibleCategories[$categoryId], [$homeworkType, 'all'])) {
                    continue;
                }

                $filtered[] = $postData;
            }

            $result = $filtered;

        }

        echo json_encode($result);
        die;
    }

    public function __search_by_title_only($search, &$wp_query)
    {
        global $wpdb;
        if (empty($search)) {
            return $search;
        }
        $q = $wp_query->query_vars;
        $n = !empty($q['exact']) ? '' : '%';
        $search =
        $searchand = '';
        foreach ((array)$q['search_terms'] as $term) {
            $term = esc_sql($wpdb->esc_like($term));
            $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
            $searchand = ' AND ';
        }
        if (!empty($search)) {
            $search = " AND ({$search}) ";
            if (!is_user_logged_in()) {
                $search .= " AND ($wpdb->posts.post_password = '') ";
            }
        }

        return $search;
    }

    public function homeworkStatsChartsAjax()
    {
        $this->homeworkStatsCharts();
        die();
    }

    public function homeworkStatsCharts()
    {
        $hasAccessToOtherStats = $this->_hasAccessToOtherStats();
        $users = $hasAccessToOtherStats ? wpm_array_get($_POST, 'users', []) : [get_current_user_id()];

        if ($hasAccessToOtherStats) {
            array_unshift($users, null);
        }

        foreach ($users as $user) {
            $this->_homeworkStatsChartsRow($user);
        }
    }

    private function _homeworkStatsChartsRow($user = null)
    {
        global $wpdb;

        $filters = [
            'wpm-category' => wpm_array_get($_POST, 'wpm-category', ''),
            'wpm-levels'   => wpm_array_get($_POST, 'wpm-levels', ''),
            'type'         => wpm_array_get($_POST, 'type', ''),
            'material'     => wpm_array_get($_POST, 'material', ''),
            'date_from'    => wpm_array_get($_POST, 'date_from', date('d.m.Y', current_time('timestamp') - 7 * 24 * 60 * 60)),
            'date_to'      => wpm_array_get($_POST, 'date_to', date('d.m.Y', current_time('timestamp'))),
        ];

        $response_table = $wpdb->prefix . "memberlux_responses";

        $condition = " `is_archived`=0 AND `version`=2";

        if ($filters['wpm-category'] !== '') {
            $condition .= $this->_homeworkStatsFilterByTermsCondition($filters['wpm-category']);
        }

        if ($filters['wpm-levels'] !== '') {
            $condition .= $this->_homeworkStatsFilterByTermsCondition($filters['wpm-levels'], 'wpm-levels');
        }

        if ($filters['type'] !== '') {
            if ($filters['type'] == 'test') {
                $metaQuery = [
                    [
                        'key'     => '_wpm_page_meta',
                        'value'   => 's:13:"homework_type";s:4:"test"',
                        'compare' => 'LIKE',
                    ],
                ];
            } else {
                $metaQuery = [
                    [
                        'key'     => '_wpm_page_meta',
                        'value'   => 's:13:"homework_type";s:4:"test"',
                        'compare' => 'NOT LIKE',
                    ],
                ];
            }

            $_postIds = get_posts([
                    'post_type'      => 'wpm-page',
                    'posts_per_page' => -1,
                    'fields'         => 'ids',
                    'meta_query'     => $metaQuery,
                ]
            );

            if (!empty($_postIds)) {
                $condition .= " AND post_id IN (" . implode(',', $_postIds) . ") ";
            } else {
                $condition .= " AND 1<>1";
            }
        }

        if ($filters['material'] !== '') {
            $condition .= sprintf(' AND post_id=%d', intval($filters['material']));
        }

        if ($filters['date_from'] !== '') {
            $dateFrom = date_create_from_format('d.m.Y', $filters['date_from']);
            $condition .= sprintf(" AND DATE(response_date) >= '%s'", $dateFrom->format('Y-m-d'));
        }

        if ($filters['date_to'] !== '') {
            $dateTo = date_create_from_format('d.m.Y', $filters['date_to']);
            $condition .= sprintf(" AND DATE(response_date) <= '%s'", $dateTo->format('Y-m-d'));
        }

        $categories = [];
        $isCoach = $user && !wpm_is_admin($user) && wpm_is_coach($user);

        if ($isCoach) {
            $categories = $this->_getCoachAccessibleCategories($user);
            $condition .= $this->_getAllowedCoachPostsCondition($user, $categories);

            $levelsAccessAll = get_user_meta($user, self::COACH_ACCESS_META . '_all_level', true) ?: 'off';

            if ($levelsAccessAll == 'off') {
                $levelCategories = $this->_getCoachAccessibleCategoryLevels($user);
                $condition .= $this->_getAllowedCoachPostsByLevelCondition($user, $levelCategories);
            } else {
                $condition .= $this->_getAllowedCoachPostsByLevelCondition($user);
            }
        }

        $responsesNb = $wpdb->get_results("SELECT COUNT(`id`) as nb, `response_status`
                                           FROM $response_table r
                                           WHERE $condition
                                           GROUP BY `response_status`",
            ARRAY_A);

        if (!is_array($responsesNb)) {
            $responsesNb = [];
        }

        $stats = [];

        foreach ($responsesNb as $data) {
            $stats[$data['response_status']] = $data['nb'];
        }

        if ($user) {
            $stats['approved'] = 0;
            $stats['rejected'] = 0;
            unset($stats['accepted']);

            $condition .= sprintf(' AND `reviewed_by`=%d', intval($user));
            $userResponsesNb = $wpdb->get_results("SELECT COUNT(`id`) as nb, `response_status`
                                           FROM $response_table
                                           WHERE ($condition) AND (`response_status` IN('approved', 'rejected'))
                                           GROUP BY `response_status`",
                ARRAY_A);

            if (!is_array($userResponsesNb)) {
                $userResponsesNb = [];
            }

            foreach ($userResponsesNb as $data) {
                $stats[$data['response_status']] = $data['nb'];
            }
        }

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

        $data = [
            'stats'  => $stats,
            'total'  => array_sum($stats),
            'colors' => array_map(function ($key) use ($colors) {
                return $colors[$key];
            },
                array_keys($stats)),
            'labels' => array_map(function ($key) use ($labels) {
                return $labels[$key];
            },
                array_keys($stats)),
        ];

        $id = $user === null ? 'all' : $user;
        $wpUser = $user === null ? null : get_user_by('ID', $user);

        $accessAll = 'all';

        if ($isCoach) {
            $accessAll = get_user_meta($user, self::COACH_ACCESS_META . '_all', true) ?: 'off';
        }

        mbla_render_partial('homework/stats_charts_row', 'admin', compact('data', 'id', 'wpUser', 'categories', 'accessAll'));
    }

    private function _homeworkStatsFilterByTermsCondition($terms, $tax = 'wpm-category', $field = 'slug')
    {
        $_postIds = get_posts([
                'post_type'      => 'wpm-page',
                'posts_per_page' => -1,
                'fields'         => 'ids',
                'tax_query'      => [
                    [
                        'taxonomy' => $tax,
                        'field'    => $field,
                        'terms'    => $terms,
                    ],
                ],
            ]
        );

        if (!empty($_postIds)) {
            $condition = " AND post_id IN (" . implode(',', $_postIds) . ") ";
        } else {
            $condition = " AND 1<>1";
        }

        return $condition;
    }

    private function _getAllowedCoachPostsCondition($user, $categories = null)
    {
        $query = [
            'post_type'      => 'wpm-page',
            'posts_per_page' => -1,
            'fields'         => 'ids',
        ];

        if (is_array($categories)) {
            $query['tax_query'] = [
                [
                    'taxonomy' => 'wpm-category',
                    'field'    => 'term_id',
                    'terms'    => array_keys($categories),
                ],
            ];
        }

        $_postIds = get_posts($query);

        $allowedPostIds = [];

        foreach ($_postIds as $_postId) {
            $meta = get_post_meta($_postId, '_wpm_page_meta', true);
            $autotrainingId = wpm_get_autotraining_id_by_post($_postId);
            $homeworkType = wpm_array_get($meta, 'homework_type', 'question');

            if (is_array($categories) && !isset($categories[$autotrainingId])) {
                continue;
            }

            $allowed = is_array($categories)
                ? in_array($categories[$autotrainingId], ['all', $homeworkType])
                : in_array(get_user_meta($user, self::COACH_ACCESS_META . '_all', true), ['all', $homeworkType]);

            if (!$allowed) {
                continue;
            }

            $allowedPostIds[] = $_postId;

        }

        $_postIds = $allowedPostIds;

        if (!empty($_postIds)) {
            $condition = " AND post_id IN (" . implode(',', $_postIds) . ") ";
        } else {
            $condition = " AND 1<>1";
        }

        return $condition;
    }

    public function _getAllowedCoachPostsByLevelCondition($coach, $categories = null)
    {
        $termKeysTable = MBLTermKeysQuery::getTable();

        if ($categories === null) {
            $levelsAccessAll = get_user_meta($coach, self::COACH_ACCESS_META . '_all_level', true) ?: 'off';

            if ($levelsAccessAll === 'all') {
                return '';
            }

            return sprintf(" AND (EXISTS (SELECT tk.id FROM `%s` tk WHERE tk.user_id=r.user_id AND tk.term_id=%d AND tk.key_type='wpm_term_keys' AND tk.is_banned=0 AND tk.status='used'))", $termKeysTable, intval($levelsAccessAll));
        }

        $conditions = [];

        foreach ($categories as $autotrainingId => $levelId) {
            $postIds = get_posts([
                'post_type'      => 'wpm-page',
                'posts_per_page' => -1,
                'fields'         => 'ids',
                'tax_query'      => [
                    [
                        'taxonomy' => 'wpm-category',
                        'field'    => 'term_id',
                        'terms'    => $autotrainingId,
                    ],
                ],
            ]);

            if ($levelId === 'all') {
                continue;
            }

            $conditions[] = sprintf("(post_id IN (" . implode(',', $postIds) . ") AND (EXISTS (SELECT tk.id FROM `%s` tk WHERE tk.user_id=r.user_id AND tk.term_id=%d AND tk.key_type='wpm_term_keys' AND tk.is_banned=0 AND tk.status='used')))", $termKeysTable, intval($levelId));
        }

        return count($conditions) ? (' AND (' . implode(' OR ', $conditions) . ')') : '';
    }

    public function homeworkListCoach($response)
    {
        if (!wpm_is_admin()) {
            return '';
        }

        $coaches = $this->_getHomeworkResponseCoachNames($response);

        mbla_render_partial('homework/list-coach', 'admin', compact('coaches'));
    }

    public function homeworkListCoachLabel()
    {
        if (!wpm_is_admin()) {
            return '';
        }

        mbla_render_partial('homework/th-coach', 'admin');
    }

    public function homeworkListCoachFilter()
    {
        if (!wpm_is_admin()) {
            return '';
        }

        $coaches = get_users([
            'role__in' => ['coach'],
        ]);

        mbla_render_partial('homework/filter-coach', 'admin', compact('coaches'));
    }

    public function homeworkListToggleFilter()
    {
        mbla_render_partial('homework/filter-toggle', 'admin');
    }

    public function homeworkListToggleSearch()
    {
        mbla_render_partial('homework/filter-search', 'admin');
    }

    public function homeworkListCoachCol()
    {
        if (!wpm_is_admin()) {
            return '';
        }

        mbla_render_partial('homework/col-coach', 'admin');
    }

    public function homeworkColspan($colspan)
    {
        return wpm_is_admin() ? ($colspan + intval(wpm_option_is('hw.enabled_fields.coach', 'on', 'on'))) : $colspan;
    }

    public function homeworkList($condition)
    {
        $user = wpm_is_admin()
            ? wpm_array_get($_POST, 'coaches', '')
            : get_current_user_id();

        if ($user !== '') {
            $isCoach = $user && !wpm_is_admin($user) && wpm_is_coach($user);

            if ($isCoach) {
                $accessAll = get_user_meta($user, self::COACH_ACCESS_META . '_all', true) ?: 'off';

                if ($accessAll == 'off') {
                    $categories = $this->_getCoachAccessibleCategories($user);
                    $condition .= $this->_getAllowedCoachPostsCondition($user, $categories);
                } else {
                    $condition .= $this->_getAllowedCoachPostsCondition($user);
                }

                $levelsAccessAll = get_user_meta($user, self::COACH_ACCESS_META . '_all_level', true) ?: 'off';

                if ($levelsAccessAll == 'off') {
                    $levelCategories = $this->_getCoachAccessibleCategoryLevels($user);
                    $condition .= $this->_getAllowedCoachPostsByLevelCondition($user, $levelCategories);
                } else {
                    $condition .= $this->_getAllowedCoachPostsByLevelCondition($user);
                }
            }
        }

        return $condition;
    }

    public function homeworkListOrderByCoach($responses)
    {
        if (!wpm_is_admin()) {
            return $responses;
        }

        $orderBy = wpm_array_get($_POST, 'order_by', 'date');
        $order = wpm_array_get($_POST, 'order', 'desc') == 'asc' ? 'ASC' : 'DESC';

        if ($orderBy === 'coach') {
            usort($responses,
                function ($a, $b) use ($orderBy, $order) {
                    $val = strcmp(implode('', $this->_getHomeworkResponseCoachNames($a)), implode('', $this->_getHomeworkResponseCoachNames($b)));

                    return $order == 'ASC' ? $val : -$val;
                });
        }

        return $responses;
    }

    /**
     * @param $response
     *
     * @return array
     */
    private function _getHomeworkResponseCoachNames($response)
    {
        $autotrainingId = $response->mblPage->getAutotraining()->getTermId();
        $categoryCoaches = $this->_getCategoryCoaches($autotrainingId);
        $_categoryCoaches = [];

        foreach ($categoryCoaches as $coachId => $v) {
            if ($this->_isCoachAllowedForResponse($coachId, $response)) {
                $_categoryCoaches[$coachId] = $v;
            }
        }

        $categoryCoaches = $_categoryCoaches;

        return array_map(function ($userId) {
            return wpm_get_user($userId, 'display_name');
        },
            array_keys($categoryCoaches));
    }

    private function _isCoachAllowedForResponse($coachId, $response)
    {
        $autotrainingId = wpm_get_autotraining_id_by_post($response->post_id);

        $levelsAccessAll = get_user_meta($coachId, self::COACH_ACCESS_META . '_all_level', true) ?: 'off';

        if ($levelsAccessAll === 'all') {
            return true;
        }

        if ($levelsAccessAll !== 'off') {
            return in_array($levelsAccessAll, wpm_get_all_user_accesible_levels($response->user_id));
        }

        $levelsAccess = $this->_getCoachAccessibleCategoryLevels($coachId);

        if (!isset($levelsAccess[$autotrainingId])) {
            return false;
        }

        if ($levelsAccess[$autotrainingId] === 'all') {
            return true;
        }


        return in_array($levelsAccess[$autotrainingId], wpm_get_all_user_accesible_levels($response->user_id));
    }


    public function settingsFilter()
    {
        mbla_render_partial('homework/settings/filter', 'admin');
    }

    public function settingsFields()
    {
        mbla_render_partial('homework/settings/fields', 'admin');
    }

    function mbla_settings_tab()
    {
        mbla_render_partial('options-tab', 'admin');
    }

    function mbla_settings_content()
    {
        $statsAccessAll = wpm_get_option('mbla.stats_access_all', 'off');
        $disableOthersStatsAccessAll = wpm_get_option('mbla.other_access_all', 'off');
        mbla_render_partial('options-content', 'admin', compact('statsAccessAll', 'disableOthersStatsAccessAll'));
    }
}
