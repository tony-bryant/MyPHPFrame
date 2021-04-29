<?php

namespace Controller;

use Core\Controller;
use Dao\UserDao;
use FrameException\ParameterException;
use Model\UserModel;

class UserController extends Controller
{
    function getAllUserInfoAction() {

    }

    /**
     * 登录
     *
     * @return void
     */
    function loginAction() {
//        $user = [
//            'username' => $_REQUEST['username'],
//            'password' => $_REQUEST['password']
//        ];
        $userModel = new UserModel();
        if (!$userModel->validateModel($_REQUEST,
            "username",
            "password")
        ) {
            throw new ParameterException();
        }
        $userDao = new UserDao();
        $name = $userDao->findUserByUsernameAndPassword($_REQUEST);
        if (isset($name)) {
            echo "你好! " . $name;
        } else {
            echo "登录失败";
        }
    }

    /**
     * 注册用户->姓名，账号，密码不为空->用户名是否注册
     *
     * @return void
     */
    function registerUser() {
//        $user = [
//            'name'     => $_REQUEST['name'],
//            'username' => $_REQUEST['username'],
//            'password' => $_REQUEST['password']
//        ];
        $userModel = new UserModel();
        if (!$userModel->validateModel($_REQUEST,
            "name",
            "username",
            "password")
        ) {
            throw new ParameterException();
        }
    }

    function updateUserInfoAction() {

    }
}