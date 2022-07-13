<?php

class MBL_TESTS_Admin
{
    public function __construct()
    {
        $this->_setHooks();
        $this->_addScripts();
    }

    private function _setHooks()
    {
        add_action('mbl_admin_hw_after', [$this, 'setHomeworkType']);
        add_action('mbl_admin_hw_test', [$this, 'testCreate']);
        add_action('mbl_admin_hw_response_first_tab_name', [$this, 'changeFirstTabName']);
        add_action('mbl_admin_hw_response_last_tab_name', [$this, 'changeLastTabName']);
        add_action('mbl_admin_hw_before_response', [$this, 'adminResponse']);
        add_action('mbl_admin_hw_before_question', [$this, 'showTestDescription']);
	
		add_action('mbl_options_items_after', [$this, 'optionTitle'], 60);
		add_action('mbl_options_content_after', [$this, 'optionContent'], 60);
    }

    private function _addScripts()
    {
        add_action('admin_enqueue_scripts', [$this, 'addAdminScripts']);
        add_action('admin_enqueue_scripts', [$this, 'addAdminStyles']);
    }

    public function addAdminScripts()
    {
        if (is_admin()) {
            wp_enqueue_script('mbl_tests_admin_script', plugins_url('/mbl-tests/assets/js/admin.js'), ['jquery'], MBL_TESTS_VERSION);
            wp_enqueue_script( 'vue', plugins_url('/mbl-tests/assets/js/vue.min.js'), [], '2.5.16' );
        }
    }

    public function addAdminStyles()
    {
        if (is_admin()) {
            wp_enqueue_style('mbl_tests_admin_style', plugins_url('/mbl-tests/assets/css/admin.css'), [], MBL_TESTS_VERSION);
        }
    }
	
	public function optionTitle()
	{
		include_once( MBL_TESTS_DIR .'/templates/admin/menu_option_title.php');
	}
	
	public function optionContent()
	{
		include_once( MBL_TESTS_DIR .'/templates/admin/menu_option_content.php');
	}

    public function setHomeworkType($type)
    {
        include_once( MBL_TESTS_DIR .'/templates/admin/create-homework-type.php');
    }

    public function testCreate($meta)
    {
        $type = wpm_array_get($meta, 'homework_type');
        $test = wpm_array_get($meta, 'test');
        $tiny_options = [
            'height'        => 200,
            'dialogsInBody' => false,
            'toolbar'       => [
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['codeview']],
            ],
        ];


        wp_enqueue_script('mbl_test_admin_tests-create', plugins_url('/mbl-tests/assets/js/tests-create.js'), [], MBL_TESTS_VERSION, true);
        wp_localize_script( 'mbl_test_admin_tests-create', 'mbl_tests',
            array(
                'test_questions'=> htmlspecialchars(json_encode($test['test_questions']), ENT_NOQUOTES),
                'tiny_options' => json_encode($tiny_options),
                'translations' => array(
                    'showQuestion' => __('Показать', 'mbl_tests'),
                    'hideQuestion' => __('Скрыть', 'mbl_tests'),
                    'editQuestion' =>  __('Редактировать', 'mbl_tests'),
                    'removeQuestion' =>  __('Удалить', 'mbl_tests'),
                    'addQuestion' => __('Добавить вопрос:', 'mbl_tests'),
                    'singleQuestion' =>  __('Один из списка', 'mbl_tests'),
                    'multipleQuestion' => __('Несколько из списка', 'mbl_tests'),
                    'answers' => __('Варианты ответов:', 'mbl_tests'),
                    'saveQuestion' => __('Сохранить', 'mbl_tests'),
                    'cancel' => __('Отмена', 'mbl_tests'),
                    'addAnswer' => __('Добавить вариант', 'mbl_tests'),
                    'youAnswer' => __('Ваш вариант', 'mbl_tests'),
                    'showAll' => __('Показать все', 'mbl_tests'),
                    'hideAll' => __('Скрыть все', 'mbl_tests'),
                    'customChoise' => __('Ваш вариант ответа', 'mbl'),
                    'removeQuestionPrompt' => __('Вы уверены?', 'mbl_tests'),
                    'removeAnswerPrompt' => __('Вы уверены?', 'mbl_tests'),
                    'done' => __('Готово', 'mbl_tests'),
                )
            )
        );

        include_once( MBL_TESTS_DIR .'/templates/admin/create-test.php');
    }

    public function changeFirstTabName($mblPage) {
        if($mblPage->getPostMeta('homework_type') == 'test') {
            echo '<i class="fa fa-exclamation-circle mbl-homework-type" aria-hidden="true"></i>';
            echo '<span class="test-hide-origin"> <span data-desktop-only>'. __('Вопросы и Ответы', 'mbl_tests') .'</span><span data-mobile-only>'. __('Ответ', 'mbl_tests') .'</span></span>';
        }
    }

    public function changeLastTabName($mblPage) {
        if($mblPage->getPostMeta('homework_type') == 'test') {
            echo '<i class="fa fa-list-alt mbl-homework-type" aria-hidden="true"></i>';
            echo '<span class="test-hide-origin"> <span data-desktop-only>'. __('Описание теста', 'mbl_tests') .'</span><span data-mobile-only>'. __('Описание', 'mbl_tests') .'</span></span>';
        }
    }

    public function adminResponse($response) {
        $mblPage = $response->mblPage;

        if($mblPage->getPostMeta('homework_type') == 'test') {
            $test = $mblPage->getPostMeta()['test'];

            //get user result
            global $wpdb;
            $response_table = $wpdb->prefix . "memberlux_responses";
            $id = $response->id; //get row id

            $result = $wpdb->get_row("SELECT * FROM $response_table WHERE id = $id");
            $result = json_decode($result->response_test);

            include_once(MBL_TESTS_DIR . '/templates/admin/response.php');
        }
    }

    public function showTestDescription($mblPage) {
        if($mblPage->getPostMeta('homework_type') == 'test') {
            echo '<div class="test-hide-origin mbl-test-content-wrap">'. apply_filters('the_content', $mblPage->getPostMeta('test.test_description'))  .'</div>';
        }
    }
}
