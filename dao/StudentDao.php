<?php

namespace Dao;

class StudentDao
{
    public $con;

    function __construct() {
        $this->con = mysqli_connect("localhost:3306", "root", "123456",
            "message_board");
    }

    function __destruct() {
        $this->con->close();
    }

    public function getStudent() {
        $query = 'SELECT * FROM student';
        $result = $this->con->query($query);
        while ($obj = $result->fetch_object()) {
            printf("%s %s %s %s", $obj->stu_id, $obj->name, $obj->sex,
                $obj->birthday);
            echo "</br>";
        }
        $result->close();
    }

    public function setStudent($student) {
        if ($stmt
            = $this->con->prepare("INSERT INTO student (name,sex,birthday) VALUES(?,?,?) ")
        ) {
            $stmt->bind_param("sis", $student['name'], $student['sex'],
                $student['birthday']);
            $stmt->execute();
            $stmt->close();
        }
    }
}