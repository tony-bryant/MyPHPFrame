<?php

namespace Core;

include 'util/DebugUtil.php';
include 'core/Controller.php';
include 'core/Dao.php';
include 'core/Model.php';
include 'dao/MessageDao.php';
include 'dao/StudentDao.php';
include 'dao/UserDao.php';
include 'model/UserModel.php';
include 'controller/Student.php';
include 'controller/User.php';
include 'exception/ParameterException.php';
include 'exception/ExceptionHandler.php';

use Controller\StudentController;
use Couchbase\Exception;
use FrameException\ExceptionHandler;
use ReflectionClass;
use Util\DebugUtil;

final class Application
{

    const FOLDERS
        = [
            'config',
            'core',
            'dao',
            'model',
            'controller'
        ];

    private static $app;

    private function __construct() {

    }

    //单例
    public static function getAppInstance() {
        if (null === Application::$app) {
            Application::$app = new Application();
        }
        return Application::$app;
    }

    //自动加载类
    public function bootstrap() {
        $this->initPlugins();
    }

    public function run() {
        $this->invokeAction();
    }

    private function initPlugins(){

    }

    /**
     * 将index中的参数请求路由到Controller下Action中
     *
     * @return void
     */
    private function invokeAction() {
        try {
            $strSplit = explode("/", $_SERVER['REQUEST_URI']);
            $controllerName = '\\Controller\\' . $strSplit[2] . 'Controller';
            $actionName = explode("?", $strSplit[3])[0] . 'Action';
            $controller = new $controllerName();
            $controller->$actionName();
        } catch (\Error $e) {
            //统一处理
            throw new \RuntimeException('类或方法不存在',403);
        }
    }
}