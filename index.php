<?php
include 'bootstrap/Application.php';

use Core\Application;

define("FRAME", __DIR__ . '/');
define("CORE", FRAME . 'core/');
define("APP", FRAME . 'app/');

$app = Application::getAppInstance();

//加载配置
$app->bootstrap();

//运行中
$app->run();

