<?php
	
	class MBL_AUTOCHECK_Admin
	{
		public function __construct()
		{
			$this->_setHooks();
			$this->_addScripts();
		}
		
		private function _setHooks()
		{
			add_action('mbl-test_after-test-create', [$this, 'addRightAnswersField']);
			add_filter('check_test_result', [$this, 'checkResult'], 10, 3);
			add_filter('get_test_results', [$this, 'getTestResult'], 10, 4);
			
			add_filter('homework_check_icon', [$this, 'changeIcon'], 10, 2);
			
			add_action('mbl_options_items_after', [$this, 'optionTitle'], 62);
			add_action('mbl_options_content_after', [$this, 'optionContent'], 62);
		}
		
		private function _addScripts()
		{
			//add_action('admin_enqueue_scripts', [$this, 'addAdminScripts']);
			add_action('admin_enqueue_scripts', [$this, 'addAdminStyles']);
		}
		
		public function addAdminStyles()
		{
			if (is_admin()) {
				wp_enqueue_style('mbl_autocheck_admin_style', plugins_url('/mbl-autocheck/assets/css/admin.css'), [], MBL_AUTOCHECK_VERSION);
			}
		}
		
		public function addRightAnswersField()
		{
			include_once( MBL_AUTOCHECK_DIR .'/templates/admin/tests-input.php');
		}
		
		
		public function checkResult($status, $result, $post_id)
		{
			if ($status == 'opened'){
				return $status;
			}
			
			$status = 'rejected';
			
			$page_meta = get_post_meta($post_id, '_wpm_page_meta', true);
			$right_answers_for_autocheck = wpm_array_get($page_meta, 'right-answers-for-autocheck');
			$questions = wpm_array_get($page_meta, 'test.test_questions');
			
			$right_answers = $this::count_right_answers($questions, $result);
			
			if($right_answers >= $right_answers_for_autocheck ){
				$status = 'approved';
			}
			
			return $status;
		}
		
		public function getTestResult($results, $status, $result, $post_id)
		{
			if ($status == 'opened'){
				return false;
			}
			
			$page_meta = get_post_meta($post_id, '_wpm_page_meta', true);
			$right_answers_for_autocheck = wpm_array_get($page_meta, 'right-answers-for-autocheck');
			$questions = wpm_array_get($page_meta, 'test.test_questions');
			$right_answers = $this::count_right_answers($questions, $result);
			
			return array(
				'right_answers' => $right_answers,
				'need_answers' => $right_answers_for_autocheck,
				'total_questions' => count($questions)
			);
		}
		
		public function count_right_answers($questions, $result)
		{
			$result = json_decode($result);
			$right_answers = 0;
			
			foreach ($questions as $q => $question) {
				
				if ($question['type'] == 'single') {
					
					if( $result[$q][$question['answers'][0]['correctly']]->checked == 'true'){
						$right_answers++;
					}
				} else {
					$right_multiple = true;
					
					foreach ($question['answers'] as $a => $answer) {
						
						if( (isset( $answer['correctly'] ) && $result[$q][$a]->checked == 'false') || ( !isset( $answer['correctly'] ) && $result[$q][$a]->checked == 'true') ) {
							$right_multiple = false;
						}
					}
					
					if($right_multiple) {
						$right_answers++;
					}
				}
			}
			
			return $right_answers;
		}
		
		public function changeIcon($icon, $type)
		{
			if( $type == 'test' ) {
				$icon = 'fa-check';
			}
			return $icon;
		}
		
		public function optionTitle()
		{
			include_once( MBL_AUTOCHECK_DIR .'/templates/admin/menu_option_title.php');
		}
		
		public function optionContent()
		{
			include_once( MBL_AUTOCHECK_DIR .'/templates/admin/menu_option_content.php');
		}
		
	}
