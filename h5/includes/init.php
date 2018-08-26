<?php
/**
 * Copyright (c) 2017. 本软件系统由北天团队与投缘互联团队共同开发，对于非商业用途
 * 的代码使用完全免费，而对商业用户经过我方授权后也可免费使用，但所有用户不得任意破坏
 * 我们设计的产品结构，也不得使用该软件做为非法用途.如果商业用户希望获得一些平台型的支
 * 持，以及获得我方各类接口的支持，也可联系我方购买更丰富的支持.
 */

/**
 * User: Huangbt
 * Date: 2017/8/7 0007
 * Time: 下午 15:14
 */
define('IN_BOX', true);

include '../boxphp/init.php';


//require '../base.php';
//$smarty->template_dir = BASE_PATH . 'h5/tpl/';

echo "中间中层init问候你了。";




x


/*
function __autoload($controller){
    require_once(dirname(__FILE__) . './ctrl/'.$controller.'.php');

    $Q= new controller(); //创建实例调用的类也是c
    echo $Q->Q;
}
spl_autoload_register(function ($name) {
    echo "Want to load $name.\n";
    throw new Exception("Unable to load $name.");
});

try {
    $obj = new index();
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}
*/

?>