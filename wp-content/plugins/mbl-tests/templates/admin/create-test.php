<dt id="mbl-test-create" class="<?php echo $type != 'test'? 'hidden':''; ?> ">
    <br />
    <span style="display: block; margin-bottom: 10px"><?php _e('Описание теста:','mbl_test');?></span>
    <?php wpm_editor_admin($test['test_description'], 'page_meta_test_description', array(), false, 'page_meta[test][test_description]'); ?>

    <div id="mbl-test-create-app"></div>
  
    <?php do_action('mbl-test_after-test-create'); ?>
</dt>
