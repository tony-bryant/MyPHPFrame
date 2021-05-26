<?php

class Plugin extends AbstractBootstrap
{
    /**
     * Hello World
     *
     * @return void
     */
    function initCall(){
        echo "Hello World";
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
    private function initFile() {
        try {
            foreach ($this::FOLDERS as $folder) {
                $path = __DIR__ . 'Plugin.php/' . $folder;
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

    private function initController() {
        return true;
    }
}