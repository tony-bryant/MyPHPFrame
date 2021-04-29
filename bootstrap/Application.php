<?php

namespace Bootstrap;

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

    const ENVIRONMENT = "dev";

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

    public function bootstrap() {
        $this->initConfig();
        $this->initExceptionHandler();
    }

    public function run() {
        $this->invokeAction();
    }

    /**
     * 根据环境初始化配置
     *
     * @return void
     */
    private function initConfig() {
        if ("dev" === self::ENVIRONMENT) {
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
        }
    }

    /**
     * 设置统一异常处理
     *
     * @return void
     */
    private function initExceptionHandler() {
        set_exception_handler(function ($exception) {
            header('Content-Type:application/json; charset=utf-8');
            $result = array(
                'code'    => $exception->getCode(),
                'message' => $exception->getMessage()
            );
            exit(json_encode($result));
        });
    }

    //自动加载类
    private function loadFile() {
        try {
            foreach ($this::FOLDERS as $folder) {
                $path = __DIR__ . '/' . $folder;
                echo $path;
                echo "<br>";
                $handler = opendir($path);
                while (($filename = readdir($handler)) !== false) {
                    if ($filename != "." && $filename != "..") {
                        echo $filename;
                        echo "<br>";
                    }
                }
//                include $file;
            }
        } catch (\Exception $e) {
            //log($e);//打日志
            return false;
        }
    }

    private function loadController() {
        return true;
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
//            DebugUtil::my_print_r($e);
//            DebugUtil::my_print_r('类或方法不存在');
        }
    }
}