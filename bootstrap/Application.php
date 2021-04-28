<?php

namespace Bootstrap;

include 'util/DebugUtil.php';
include 'core/Controller.php';
include 'dao/MessageDao.php';
include 'dao/StudentDao.php';
include 'controller/Student.php';

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

    public function bootstrap() {
        //自动预加载文件
        //DebugUtil::my_print_r(__FILE__ . "/controller");
        //$studentController = new StudentController();
        //$studentController->addStudentAction();
        //$studentController->getStudentAction();
        //$studentController->indexAction();

        if ($this->loadFile()) {

        }

        if ($this->loadController()) {

        }
    }

    public function run() {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        DebugUtil::my_print_r($_SERVER['REQUEST_URI']);
    }

    private function init() {

    }

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
}