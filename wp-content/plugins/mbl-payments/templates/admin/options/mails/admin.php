<div id="header-tab-mblp-2-admin">
    <div class="wpm-control-row wpm-inner-tab-content">
        <div class="wpm-row">
            <label>
                <?php _e('Email для уведомлений', 'mbl_admin') ?><br>
                <input type="text"
                       name="main_options[letters][mblp][admin][email]"
                       value="<?php echo wpm_get_option('letters.mblp.admin.email') ?>"
                       class="large-text">
            </label>
        </div>
        <div class="wpm-row">
            <label>
                <?php _e('Тема письма', 'mbl_admin') ?><br>
                <input type="text"
                       name="main_options[letters][mblp][admin][title]"
                       value="<?php echo wpm_get_option('letters.mblp.admin.title') ?>"
                       class="large-text">
            </label>
        </div>
        <div class="wpm-control-row">
            <?php
            wp_editor(stripslashes(wpm_get_option('letters.mblp.admin.content')), 'mblp_letter_admin', array('textarea_name' => 'main_options[letters][mblp][admin][content]', 'editor_height' => 300));
            ?>
        </div>

        <?php mblp_render_partial('options/mails/helper', 'admin') ?>
    </div>
</div>