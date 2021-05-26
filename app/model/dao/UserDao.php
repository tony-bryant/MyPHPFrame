<?php

namespace Dao;

use core\Dao;

class UserDao extends Dao
{
    /**
     * 根据用户名，密码查询用户信息
     *
     * @param $user array 用户信息
     * @return mixed 姓名|null
     */
    function findUserByUsernameAndPassword($user) {
        if ($stmt
            = $this->con->prepare("SELECT name FROM user WHERE username=? AND password=?")
        ) {
            $stmt->bind_param("ss", $user['username'], $user['password']);
            $stmt->execute();
            $stmt->bind_result($name);
            $stmt->fetch();
            $stmt->close();
        }
        return $name;
    }
}