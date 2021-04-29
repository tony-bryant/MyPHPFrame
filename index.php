<?php
include 'bootstrap/Application.php';

use Bootstrap\Application;

$app = Application::getAppInstance();

//加载配置
$app->bootstrap();

//运行中
$app->run();

