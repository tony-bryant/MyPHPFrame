<?php
//手动include include顺序很重要
include 'bootstrap/Application.php';

use Bootstrap\Application;

$app = Application::getAppInstance();

//加载
$app->bootstrap();

//启动
//$app->run();

