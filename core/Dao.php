<?php
namespace core;
class Dao
{
    protected $con;

    function __construct() {
        $this->con = mysqli_connect("localhost:3306", "root", "123456",
            "message_board");
    }

    function __destruct() {
        $this->con->close();
    }
}