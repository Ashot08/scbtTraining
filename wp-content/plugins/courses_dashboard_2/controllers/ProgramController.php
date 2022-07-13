<?php
namespace Controllers;

use Models\Course;
use Models\Program;
use Models\Director;
use Models\Key;
use Models\Student;

require_once __DIR__ . '/../views/program/programs_list.php';
require_once __DIR__ . '/../views/program/create_program.php';
require_once __DIR__ . '/../views/program/program_details.php';
require_once __DIR__ . '/../views/program/chapters_list.php';

class ProgramController{
    public function actionViewDirectorPrograms($director_id){
        $model = new Program();
        //$keyModel = new Key();
        //$studentModel = new Student();

        $user = get_current_user_id();
        $user_info = get_userdata(get_current_user_id());
        $is_company = false;
        if(is_user_logged_in() && isset($user_info->caps["customer_company"])){
            $is_company = true;
        }
        if(!$user)return false;
        if($is_company){
            $model = $model->getProgramsContentByDirectorId($user);
        }else{
            $programs_ids =  $model->getProgramsByStudentId($user);
            $programs = [];
            if(is_array($programs_ids) && !empty($programs_ids)){
                foreach ($programs_ids as $id){
                    $program = $model->getProgram($id->program_id)[0]->id;
                    if($program){
                        $programs[] = $model->getProgram($program);
                    }
                }
            }
            $model = $programs;
        }
        return programs_list($model);
    }
    public function actionViewCreateProgram($director_id){
        $model = new Course();
        $model = $model->getCoursesByDirectorId($director_id);
        return create_program($model);
    }
    public function actionViewChaptersList($course_id){
        return chapters_list($course_id);
    }
    public function actionViewProgramDetails($program_id){
        $model = new Course();
        $programModel = new Program();
        $model = $model->getCoursesByProgramId($program_id);
        $program_info = $programModel->getProgram($program_id)[0] ?? '';
        if($model){
            return program_details($model, $program_id, $program_info);
        }else{
            echo '';
        }

    }
    public function actionCreateProgram($director_id, $title, $description, $coursesIds, $image){
        if(!$title){
            echo 'errorName';
        }elseif (!$coursesIds){
            echo 'errorCoursesIds';
        }else{
            $model = new Program($title, $description, $image, $director_id);
            $programId = $model->createProgram();
            $course = new Course();
            foreach ($coursesIds as $courseId){
                $course->connectCourseWithProgram($courseId, $programId);
            }
            //echo 'success';
        }
    }
    public function actionAddCourseToDirector($director_id, $course_id){
        $model = new Director();
        $model->connectDirectorWithCourse($director_id, $course_id);
        echo 'Вы (id = ' . $director_id . ') зачислены на курс с ID = ' . $course_id;
    }
}