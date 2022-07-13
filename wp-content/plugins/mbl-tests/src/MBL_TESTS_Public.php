<?php

class MBL_TESTS_Public
{
    public function __construct()
    {
        $this->_setHooks();
        $this->_addScripts();
    }

    private function _setHooks()
    {
        add_action('mbl_user_hw_before_question', [$this, 'getTest']);
        add_action('mbl_user_hw_before_response', [$this, 'editTest']);
        add_action('wp_ajax_mbl_save_test_result', [$this, 'save_test_result']); // ajax for save test result
        add_action('mbl_user_hw_after_status', [$this, 'reviewLink']);
    }

    private function _addScripts()
    {
        //add_action('admin_enqueue_scripts', [$this, 'addPublicScripts']);
        add_action("wpm_head", [$this, 'addPublicStyles'], 902);
        add_action("wpm_footer", [$this, 'addPublicScripts'], 902);
    }

    public function addPublicScripts()
    {
        //wpm_enqueue_script('mbl_test_front_script', plugins_url('/mbl-tests/assets/js/front.js?v=' . MBL_TESTS_VERSION));
    }

    public function addPublicStyles()
    {
        wpm_enqueue_style('mbl_test_front_style', plugins_url('/mbl-tests/assets/css/front.css?v=' . MBL_TESTS_VERSION));
		include_once(MBL_TESTS_DIR . '/templates/front/css.php');
    }

    public function getTest($mblPage)
    {
        $meta = $mblPage->getPostMeta();
        if (wpm_array_get($meta, 'homework_type') == 'test') {
            include_once(MBL_TESTS_DIR . '/templates/front/test.php');
        }
    }

    public function editTest($mblPage)
    {
        $meta = $mblPage->getPostMeta();

        global $wpdb;
        $response_table = $wpdb->prefix . "memberlux_responses";
        $id = $mblPage->getHomeworkResponse()['id']; //get row id

        if($id) {
            $result = $wpdb->get_row("SELECT * FROM `{$response_table}` WHERE `id`={$id}");
            $result = json_decode($result->response_test);
        } else {
            $result = null;
        }

        if (wpm_array_get($meta, 'homework_type') == 'test') {
            include_once(MBL_TESTS_DIR . '/templates/front/test-edit.php');
        }
    }

    function save_test_result()
    {
        global $wpdb;
        $response_table = $wpdb->prefix . "memberlux_responses";
        $user_id = get_current_user_id();
		$page_meta = get_post_meta($_POST['post_id'], '_wpm_page_meta', true);
		$confirmation_method = wpm_array_get($page_meta, 'confirmation_method', 'auto');
		$status = $confirmation_method == 'manually' ? 'opened' : 'accepted';
		
        $result = array(
            'message' => '',
            'error' => false,
        );

        if (!empty($_POST['post_id'])) {
            $content = json_encode($_POST['data']);
            $content = preg_replace('#&lt;script(.*?)&gt;(.*?)&lt;/script&gt;#is', '', $content);
            $args = array(
            	'response_test' => $content,
				'response_status' => apply_filters( 'check_test_result', $status, $content, $_POST['post_id'] )
				);
            $where = array(
                'user_id' => $user_id,
                'post_id' => $_POST['post_id']
            );
            $row = $wpdb->update($response_table, $args, $where);
            
            //get test results if AUTOCHECK instaled
			$result['results'] = apply_filters('get_test_results', [], $status, $content, $_POST['post_id']);
        }

        if ($row === false) {
            $result['message'] = __('Произошла ошибка!', 'mbl');
            $result['error'] = true;
        } elseif ($row === 0) {
            $result['message'] = __('Ответ не сохранен!', 'mbl');
            $result['error'] = true;
        } elseif ($row > 0) {
            $result['message'] = __('Ответ отправлен!', 'mbl');
        }

        echo json_encode($result);
        die();
    }

    function reviewLink($mblPage)
    {
        $meta = $mblPage->getPostMeta();
        if ($mblPage->hasHomeworkResponseReviews() && wpm_array_get($meta, 'homework_type') == 'test') {
            include_once(MBL_TESTS_DIR . '/templates/front/review-link.php');
        }
    }
}
