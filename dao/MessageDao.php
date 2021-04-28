<?php

namespace Dao;

use Util\DebugUtil;

class MessageDao
{
    public $con;

    function __construct() {
        $this->con = mysqli_connect("localhost:3306", "root", "123456",
            "message_board");
    }

    public function getMessage() {
        $query = 'SELECT * FROM student';
        $result = $this->con->query($query);
        while ($obj = $result->fetch_object()) {
            printf("%s %s %s %s", $obj->stu_id, $obj->name, $obj->sex,
                $obj->birthday);
            echo "</br>";
        }
        $result->close();
    }
}