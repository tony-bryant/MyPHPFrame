<?php

namespace Controller;

use Core\Controller;
use Dao\StudentDao;

class StudentController extends Controller
{
    function getStudentAction() {
        $studentDao = new StudentDao();
        $studentDao->getStudent();
    }

    function addStudentAction() {
        $student = [
            'name'     => $_REQUEST['name'],
            'sex'      => $_REQUEST['sex'],
            'birthday' => $_REQUEST['birthday']
        ];
        $studentDao = new StudentDao();
        $studentDao->setStudent($student);
    }
}