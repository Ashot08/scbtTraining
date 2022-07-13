<div id="header-tab-mblp-4-offer" class="wpm-tab-content">
    <div class="wpm-control-row wpm-inner-tab-content">
        <div class="wpm-row">
            <label>
                <input type="checkbox"
                       name="main_options[mblp][offer]"
                    <?php echo wpm_option_is('mblp.offer', 'on') ? ' checked' : ''; ?> >
                <?php _e('Оплата товара', 'mbl_admin') ?>
                <input type="text"
                       name="main_options[mblp_texts][offer_name]"
                       class="regular-text"
                       value="<?php echo wpm_get_option('mblp_texts.offer_name', __('Оферта', 'mbl_admin')); ?>"
                >
            </label>
        </div>
    
        <div class="wpm-row">
            <label>
                <?php _e('Название', 'mbl_admin') ?>:
                <input type="text"
                       name="main_options[mblp_texts][offer_title]"
                       class="large-text"
                       value="<?php echo wpm_get_option('mblp_texts.offer_title', __('Оферта', 'mbl_admin')); ?>"
                >
            </label>
        </div>
    
        <div class="wpm-control-row">
            <?php wp_editor(stripslashes(wpm_get_option('mblp_texts.offer_text')), 'wpm_user_offer_text', array('textarea_name' => 'main_options[mblp_texts][offer_text]', 'editor_height' => 300)); ?>
        </div>
    </div>
</div>