<?php

namespace core;

class Model
{
    /**
     * 判断某个对象必填字段是否填写
     *
     * @param $model   array 对象
     * @param ...$args string 校验字段
     *
     * @return bool
     */
    function validateModel($model, ...$args) {
        foreach ($args as $arg) {
            if (!array_key_exists($arg, $model)) {
                return false;
            }
            $value = $model[$arg];
            if (gettype($value) === "string" && strlen($value) == 0) {
                return false;
            }
        }
        return true;
    }
}

