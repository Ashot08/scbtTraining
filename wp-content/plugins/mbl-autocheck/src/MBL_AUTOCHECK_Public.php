<?php
	
	class MBL_AUTOCHECK_Public
	{
		public function __construct()
		{
			$this->_setHooks();
			//$this->_addScripts();
		}
		
		private function _setHooks()
		{
			add_action('wpm_footer', [$this, 'testResultModalWindow']);
			add_action('intervention_test-edit_script', [$this, 'modify_script']);
		}
		
		public function testResultModalWindow()
		{
			include_once(MBL_AUTOCHECK_DIR . '/templates/front/test-modal.php');
		}
		
		public function modify_script()
		{
			echo 'putTestResultsToModal(data.results)';
		}
		
	}
