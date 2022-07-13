<?php

use Controllers\ProgramController;
use Controllers\StudentController;
use Controllers\KeyController;
use Controllers\ProfileController;
use PhpOffice\PhpWord\Element\Table;


add_action('wp_ajax_cd__get_director_programs_list', 'cd__get_director_programs_list');
add_action('wp_ajax_nopriv_cd__get_director_programs_list', 'cd__get_director_programs_list');
function cd__get_director_programs_list(){
    $director_id = $_POST['id'];
    $controller = new ProgramController();
    $controller->actionViewDirectorPrograms($director_id);
    wp_die();
}

add_action('wp_ajax_cd__get_profile', 'cd__get_profile');
add_action('wp_ajax_nopriv_cd__get_profile', 'cd__get_profile');
function cd__get_profile(){
    $controller = new ProfileController();
    $controller->actionViewProfile();
    wp_die();
}

add_action('wp_ajax_cd__get_students_control_details', 'cd__get_students_control_details');
add_action('wp_ajax_nopriv_cd__get_students_control_details', 'cd__get_students_control_details');
function cd__get_students_control_details(){
    $program_id = $_POST['id'];
    $controller = new StudentController();
    $controller->actionViewStudentsControlDetails($program_id);
    wp_die();
}


add_action('wp_ajax_cd__get_students_control_programs_list', 'cd__get_students_control_programs_list');
add_action('wp_ajax_nopriv_cd__get_students_control_programs_list', 'cd__get_students_control_programs_list');
function cd__get_students_control_programs_list(){
    $director_id = $_POST['id'];
    $controller = new StudentController();
    $controller->actionViewDirectorPrograms($director_id);
    wp_die();
}

add_action('wp_ajax_cd__get_keys_programs_list', 'cd__get_keys_programs_list');
add_action('wp_ajax_nopriv_cd__get_keys_programs_list', 'cd__get_keys_programs_list');
function cd__get_keys_programs_list(){
    $director_id = get_current_user_id();
    $controller = new KeyController();
    $controller->actionViewDirectorPrograms($director_id);
    wp_die();
}

add_action('wp_ajax_cd__get_key_programs_details', 'cd__get_key_programs_details');
add_action('wp_ajax_nopriv_cd__get_key_programs_details', 'cd__get_key_programs_details');
function cd__get_key_programs_details(){
    $program_id = $_POST['id'];
    $controller = new KeyController();
    $controller->actionViewProgramKeys($program_id);
    wp_die();
}

add_action('wp_ajax_cd__create_and_attach_key', 'cd__create_and_attach_key');
add_action('wp_ajax_nopriv_cd__create_and_attach_key', 'cd__create_and_attach_key');
function cd__create_and_attach_key(){
    $director_id = get_current_user_id();
    $program_id = $_POST['id'];
    $controller = new KeyController();
    $controller->actionCreateAndAttachKey($director_id, $program_id);
    wp_die();
}




add_action('wp_ajax_cd__get_create_program_view', 'cd__get_create_program_view');
add_action('wp_ajax_nopriv_cd__get_create_program_view', 'cd__get_create_program_view');
function cd__get_create_program_view(){
    //$director_id = $_POST['id'];
    $director_id = get_current_user_id();
    $controller = new ProgramController();
    $controller->actionViewCreateProgram($director_id);
    wp_die();
}

add_action('wp_ajax_cd__get_program_details', 'cd__get_program_details');
add_action('wp_ajax_nopriv_cd__get_program_details', 'cd__get_program_details');
function cd__get_program_details(){
    $program_id = $_POST['id'];
    $controller = new ProgramController();
    $controller->actionViewProgramDetails($program_id);
    wp_die();
}

add_action('wp_ajax_cd__create_new_program', 'cd__create_new_program');
add_action('wp_ajax_nopriv_cd__create_new_program', 'cd__create_new_program');
function cd__create_new_program(){
    $director_id = get_current_user_id();
    $name = $_POST['name'];
    $description = $_POST['description'];
    $courses = $_POST['courses'] ?? [];

    $controller = new ProgramController();
    $controller->actionCreateProgram($director_id, $name, $description, $courses, '' );
    wp_die();
}


add_action('wp_ajax_cd__create_new_separate_programs', 'cd__create_new_separate_programs');
add_action('wp_ajax_nopriv_cd__create_new_separate_programs', 'cd__create_new_separate_programs');
function cd__create_new_separate_programs(){
    $director_id = get_current_user_id();
    $name = $_POST['name'];
    $description = $_POST['description'];
    $courses = $_POST['courses']['chapters'] ?? [];

    if(!$name){
        echo 'errorName';
        wp_die();
    }elseif(!$courses){
        echo 'errorCoursesIds';
        wp_die();
    }
    foreach ($courses as $key => $value){
        $title = $name . ' (' . get_term($key, 'wpm-category')->name .')';
        $courses_arr = $value;

        $controller = new ProgramController();
        $controller->actionCreateProgram( $director_id, $title, $description, $courses_arr, '' );
    }

    wp_die();
}


add_action('wp_ajax_cd__add_course_to_director', 'cd__add_course_to_director');
add_action('wp_ajax_nopriv_cd__add_course_to_director', 'cd__add_course_to_director');
function cd__add_course_to_director(){
    $course_id = $_POST['id'];
    $director_id = get_current_user_id();

    $controller = new ProgramController();
    $controller->actionAddCourseToDirector($director_id, $course_id);
    wp_die();
}

add_action('wp_ajax_cd__get_chapters_list', 'cd__get_chapters_list');
add_action('wp_ajax_nopriv_cd__get_chapters_list', 'cd__get_chapters_list');
function cd__get_chapters_list(){
    $course_id = $_POST['id'];
    $controller = new ProgramController();
    $controller->actionViewChaptersList($course_id);
    wp_die();
}

add_action('wp_ajax_cd__connect_student_with_program', 'cd__connect_student_with_program');
add_action('wp_ajax_nopriv_cd__connect_student_with_program', 'cd__connect_student_with_program');
function cd__connect_student_with_program(){
    $key = $_POST['key'];
    $controller = new StudentController();
    $controller->actionConnectStudentWithProgram($key);
    wp_die();
}




// Создание нового пользователя и добавление его к программе
//--------------------------------------------------------------------
add_action('wp_ajax_cd__add_new_student', 'cd__add_new_student');
add_action('wp_ajax_nopriv_cd__add_new_student', 'cd__add_new_student');
function cd__add_new_student(){
    function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL)
            && preg_match('/@.+\./', $email);
    }

    // Проверим защитные поля
    //if( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'vb_new_user' ) ){
    //	die( 'Оооопс, попробуйте еще раз, но чуть позже.' );
    //}

    // Данные переданные в $_POST
    $userdata = [
        'user_login' => $_POST['user_login'],
        'user_pass'  => $_POST['userPassword'] ?? '123',
        'user_email' => $_POST['user_email'],
        'role'       => 'customer',
        'first_name' => $_POST['first_name'],
        'program_id' => $_POST['program_id']
    ];

    /**
     * Проверять/очищать передаваемые поля не обязательно,
     * WP сделает это сам.
     */
    $is_valid_email = isValidEmail($_POST['user_email']);

    if($is_valid_email){
        $user_id = wp_insert_user( $userdata );
        if( ! is_wp_error( $user_id ) ){

          //  update_user_meta($user_id, 'billing_phone', $_POST['billing_phone']);

         //   update_user_meta($user_id, 'user_company_name', $_POST['user_company_name']);
         //   update_user_meta($user_id, 'user_inn', $_POST['user_inn']);
            update_user_meta($user_id, 'user_position', $_POST['user_position']);

            $creds = array();
            $creds['user_login'] = $userdata['user_login'];
            $creds['user_password'] = '123';
            $creds['remember'] = true;

            //$user = wp_signon( $creds, false );

            $studentController = new StudentController();
            $studentController->actionOnlyConnectStudentWithProgram($user_id, $userdata['program_id']);

            echo '<div class="scbt__notice_success">Студент успешно создан. </div>';
        }
        else {
            echo '<div class="scbt__notice_error">' . $user_id->get_error_message() . '</div>';
        }
    }else{
        echo '<div class="scbt__notice_error">Поле E-mail заполнено некорректно.</div>';
    }


    // возврат

    wp_die();
}

//--------------------------------------------------------------------




// Создание и скачивание docx файла Учебной программы
//--------------------------------------------------------------------
add_action('wp_ajax_cd__send_program_details_document', 'cd__send_program_details_document');
add_action('wp_ajax_nopriv_cd__send_program_details_document', 'cd__send_program_details_document');
function cd__send_program_details_document(){
    $phpWord = new  \PhpOffice\PhpWord\PhpWord();
    $phpWord->setDefaultFontName('Times New Roman');
    $phpWord->setDefaultFontSize(14);

    $properties = $phpWord->getDocInfo();
    $properties->setCreator('Учебный Центр');
    $properties->setCompany('My factory');
    $properties->setTitle('My title');
    $properties->setDescription('My description');
    $properties->setCategory('My category');
    $properties->setLastModifiedBy('My name');
    $properties->setCreated(mktime(0, 0, 0, 3, 12, 2014));
    $properties->setModified(mktime(0, 0, 0, 3, 14, 2014));
    $properties->setSubject('My subject');
    $properties->setKeywords('my, key, word');


    $full_name =     !$_POST['full_name']     ?  '_______________' : $_POST['full_name'];
    $short_name =    !$_POST['short_name']    ?  '_______________' : $_POST['short_name'];
    $program_name =  !$_POST['program_name']  ?  '_______________' : $_POST['program_name'];
    $hours =         !$_POST['hours']         ?  '_______________' : $_POST['hours'];
    $director_post = !$_POST['director_post'] ?  '_______________' : $_POST['director_post'];
    $director_name = !$_POST['director_name'] ?  '_______________' : $_POST['director_name'];
    $courses =       !$_POST['courses'] ?  [] : $_POST['courses'];


    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($_SERVER["DOCUMENT_ROOT"] . '/wp-content/plugins/courses_dashboard_2/views/program/template.docx');
    $templateProcessor->setValue('full_name', htmlspecialchars($full_name));
    $templateProcessor->setValue('short_name', htmlspecialchars($short_name));
    $templateProcessor->setValue('program_name', htmlspecialchars($program_name));
    $templateProcessor->setValue('hours', htmlspecialchars($hours));
    $templateProcessor->setValue('director_post', htmlspecialchars($director_post));
    $templateProcessor->setValue('director_name', htmlspecialchars($director_name));



    $section = $phpWord->addSection();

    $section->addPageBreak();

    $table = new Table(array('borderSize' => 12, 'borderColor' => '333333', 'cellSpacing' => 150 ));
    $row = $table->addRow();
    $row->addCell(1000, array('vMerge' => 'restart', 'borderColor' => '006699'))->addText('№ п/п');
    $row->addCell(3500, array('vMerge' => 'restart', 'borderColor' => '006699'))->addText('Наименование разделов');
    $row->addCell(1500, array('vMerge' => 'restart', 'borderColor' => '006699'))->addText('Всего часов');
    $row->addCell(1500, array('gridSpan' => 2, 'vMerge' => 'restart', 'borderColor' => '006699'))->addText('В том числе');

    $row = $table->addRow();
    $row->addCell(1000, array('vMerge' => 'continue', 'borderColor' => '006699'));
    $row->addCell(3500, array('vMerge' => 'continue', 'borderColor' => '006699'));
    $row->addCell(1500, array('vMerge' => 'continue', 'borderColor' => '006699'));
    $row->addCell(1500, array('borderColor' => '006699'))->addText('лекции');
    $row->addCell(1500, array('borderColor' => '006699'))->addText('практические занятия, самоподготовка');

    $counter = 1;
    foreach ($courses as $course) {
        $row = $table->addRow();
        $term = get_term( $course, 'wpm-category' );
        $row->addCell(1000, array('borderColor' => '006699'))->addText($counter++);
        $row->addCell(3500, array('borderColor' => '006699'))->addText($term->name);
        $row->addCell(1500, array('borderColor' => '006699'))->addText('');
        $row->addCell(1500, array('borderColor' => '006699'))->addText('');
        $row->addCell(1500, array('borderColor' => '006699'))->addText('');
    }

    $templateProcessor->setComplexBlock('program_plan', $table);



    $section = $phpWord->addSection();
    $section->addPageBreak();

    $table = new Table(array('borderSize' => 12, 'borderColor' => '333333', 'cellSpacing' => 150 ));
    $row = $table->addRow();
    $row->addCell(1000, array('vMerge' => 'restart'))->addText('№ п/п');
    $row->addCell(3500, array('vMerge' => 'restart'))->addText('Наименование разделов');
    $row->addCell(1500, array('vMerge' => 'restart'))->addText('Всего часов');
    $row->addCell(1500, array('gridSpan' => 2, 'vMerge' => 'restart'))->addText('В том числе');

    $row = $table->addRow();
    $row->addCell(1000, array('vMerge' => 'continue'));
    $row->addCell(3500, array('vMerge' => 'continue'));
    $row->addCell(1500, array('vMerge' => 'continue'));
    $row->addCell(1500)->addText('лекции');
    $row->addCell(1500)->addText('практические занятия, самоподготовка');

    $counter = 1;
    foreach ($courses as $course) {
        $row = $table->addRow();
        $term = get_term( $course, 'wpm-category' );
        $row->addCell(1000)->addText($counter, array('bold' => true, 'size' => 13));
        $row->addCell(3500)->addText($term->name, array('bold' => true, 'size' => 13));
        $row->addCell(1500)->addText('');
        $row->addCell(1500)->addText('');
        $row->addCell(1500)->addText('');

        $posts = get_posts(
            array(
                'post_type' => 'wpm-page',
                'numberposts' => 999,
                'order'       => 'ASC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'wpm-category',
                        'field' => 'slug',
                        'terms' => array($term->slug),
                        'operator' => 'IN',
                    )
                )
            )
        );
        $subcounter = 1;
        foreach( $posts as $post ){
            setup_postdata( $post );
            $row = $table->addRow();
            $term = get_term( $course, 'wpm-category' );
            $row->addCell(1000)->addText($counter . '.' . $subcounter++);
            $row->addCell(3500)->addText($post->post_title);
            $row->addCell(1500)->addText('');
            $row->addCell(1500)->addText('');
            $row->addCell(1500)->addText('');
        }
        $counter++;
        wp_reset_postdata();

    }

    $templateProcessor->setComplexBlock('program_plan_2', $table);


    header("Content-Description: File Transfer");
    header('Content-Disposition: attachment; filename="scbt.docx"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Expires: 0');


    $pathToSave = __DIR__ . '/../views/program/template_result.docx';
    $templateProcessor->saveAs($pathToSave);
    echo ('<a href="/wp-content/plugins/courses_dashboard_2/views/program/template_result.docx"> 
                Скачать файл  
               <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M5,20H19V18H5M19,9H15V3H9V9H5L12,16L19,9Z" />
                </svg> 
            </a>');
    wp_die();
}
//--------------------------------------------------------------------