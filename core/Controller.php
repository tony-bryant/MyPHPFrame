<?php

namespace Core;

class Controller
{
    //调用404
    public function indexAction() {
        http_response_code(404);
        echo "调用默认方法";
    }

}