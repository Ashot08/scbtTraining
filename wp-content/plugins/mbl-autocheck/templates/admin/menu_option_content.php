<div id="tab-autocheck-options" class="tab autocheck-color-content">
	<div class="wpm-tab-content">
		<div class="wpm-control-row">
			<?php wpm_render_partial('options/text-row', 'admin', array('label' => __('Заголовок', 'mbl_admin'), 'key' => 'autocheck.modal_header')) ?>
			<div class="wpm-control-row">
				
				<label for="">
					Сообщение
					<br>
					<?php
						wp_editor(stripslashes(wpm_get_option('autocheck.modal_text')), 'autocheck_modal_text_field', array('textarea_name' => 'main_options[autocheck][modal_text]', 'editor_height' => 300));
					?>
				</label>
			</div>
		</div>
		<?php wpm_render_partial('settings-save-button', 'common'); ?>
	</div>
</div>