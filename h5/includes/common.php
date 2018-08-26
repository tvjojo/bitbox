<?php
/**
 * Created by PhpStorm.
 * User: tvjojo
 * Date: 2017-08-10
 * Time: 0:12
 */


class  common extends  base
{

}

/**
 * 路由解析
 */
function urlRoute() {
    Dispatcher::dispatch(); // URL调度
}

/**
 * 生成URL链接
 * @param string $route
 * @param unknown $params
 * @return Ambigous <string, mixed>|string
 */
function url($route = 'index/index', $params = array()) {
    return U($route, $params);
}
function autoload($className) {
    $array = array(
        BASE_PATH . 'base/model/' . $className . '.class.php',
        BASE_PATH . 'base/controller/' . $className . '.class.php',
        APP_PATH . C('_APP_NAME') . '/model/' . $className . '.class.php',
        APP_PATH . C('_APP_NAME') . '/controller/' . $className . '.class.php',
        BASE_PATH . $className . '.class.php',
        BASE_PATH . 'library/' . $className . '.class.php',
        BASE_PATH . 'vendor/' . $className . '.class.php'
    );
    foreach ($array as $file) {
        if (is_file($file)) {
            require_once ($file);
            return true;
        }
    }
    return false;
}


/**
 * 数据模型
 * @param unknown $model
 * @throws Exception
 * @return Ambigous <unknown>
 */
function model($model) {
    static $objArray = array();
    $className = $model . 'Model';
    if (!is_object($objArray[$className])) {
        if (!class_exists($className)) {
            throw new Exception(C('_APP_NAME') . '/' . $className . '.class.php 模型类不存在');
        }
        $objArray[$className] = new $className();
    }
    return $objArray[$className];
}



