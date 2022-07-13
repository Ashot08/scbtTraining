<dd class="mbl-test_homework-type" id="mbl-test-homework-type-selector">
    <label for="homework_type_question">
        <input type="radio" name="page_meta[homework_type]" id="homework_type_question" value="question" checked>
        <?php _e('Вопрос', 'mbl_tests'); ?>
        <i class="fa fa-question-circle"></i>
    </label>

    <label for="homework_type_tests" id="mbl-test-label">
        <input type="radio" name="page_meta[homework_type]" id="homework_type_tests" value="test" <?php echo $type=='test' ? 'checked' : ''; ?>>
        <?php _e('Тест', 'mbl_tests'); ?>
        <i class="fa fa-list-alt"></i>
    </label>
</dd>

