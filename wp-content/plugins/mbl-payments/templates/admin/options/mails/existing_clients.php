<div id="header-tab-mblp-2-existing-clients">
    <div class="wpm-control-row wpm-inner-tab-content">
        <div class="wpm-row">
            <label>
                <?php _e('Тема письма', 'mbl_admin') ?><br>
                <input type="text"
                       name="main_options[mblp][letters][existing_clients][title]"
                       value="<?php echo wpm_get_option('mblp.letters.existing_clients.title') ?>"
                       class="large-text">
            </label>
        </div>
        <div class="wpm-control-row">
            <?php
            wp_editor(stripslashes(wpm_get_option('mblp.letters.existing_clients.content')), 'mblp_letter_existing_clients', array('textarea_name' => '[mblp][letters][existing_clients][content]', 'editor_height' => 300));
            ?>
        </div>

        <?php mblp_render_partial('options/mails/helper', 'admin') ?>
    </div>
</div>