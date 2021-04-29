<?php

namespace FrameException;

class ParameterException extends \RuntimeException
{
    public function __construct() {
        parent::__construct("参数填写有误", 501);
    }
}
