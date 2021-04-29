<?php
include "core/Model.php";

use core\Model;

$user = [
    'username' => '123',
    'password' => '123'
];
$model = new Model();
var_dump($model->validateModel($user, "username", "password"));