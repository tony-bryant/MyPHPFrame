<?php

namespace Dao;

use core\Dao;

class StudentDao extends Dao
{
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