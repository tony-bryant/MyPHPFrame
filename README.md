## 该项目背景
* 参考&模仿现有CI，Yaf框架实现的功能
## 该项目目的
* 熟悉PHP基本语法
* 通过模仿框架，回顾和复习设计模式
## TODO LIST
|  功能   | 进度  |
|  ----  | ----  |
| 自动加载类  | 未完成 |
| 路由请求  | 完成(待改进) |
| 加载配置文件  | 未完成 |
| 全局捕获异常  | 完成 |

## 路由请求实现(通过index.php分发请求)->待改进
```
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
        }
    }
```