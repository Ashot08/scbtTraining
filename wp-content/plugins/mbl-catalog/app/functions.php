<?php
	
	function mkk_render_partial($view, $domain = 'public', $variables = array(), $return = false)
	{
		$result = MKKView::getPartial($view, $domain, $variables);
		
		if ($return) {
			return $result;
		} else {
			echo $result;
		}
	}