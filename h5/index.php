<?php
/**
 *  ============================================================================
 * Copyright (c) 2017. 本软件系统由北天团队与投缘互联团队共同开发，对于非商业用途
 * 的代码使用完全免费，而对商业用户经过我方授权后也可免费使用，但所有用户不得任意破坏
 * 我们设计的产品结构，也不得使用该软件做为非法用途.如果商业用户希望获得一些平台型的支
 * 持，以及获得我方各类接口的支持，也可联系我方购买更丰富的支持.
 *  ============================================================================
 */

/**
 * User: Huangbt
 * Date: 2017/8/9 0009
 * Time: 下午 12:41
 */
define('IN_BOX', true);
//define('BOXID', 1);
define('INIT_NO_SMARTY', true);
require_once './includes/init.php';

echo realpath("index.php");
echo "</br>";
echo BASE_PATH;
echo "</br>";
$host = $_SERVER['HTTP_HOST'];
$a = $_GET['a'] ?? 'err';
$m = $_GET['m'] ?? 'err';
$c = $_GET['c'] ?? 'err';
$f = $_GET['f'] ?? 'err';
require_once (dirname(__FILE__) . './'.$f.'/'.$c.'.php');

function boxhost(){};
function arraysSum(array ...$arrays): array
{
    return array_map(function(array $array): int {
        return array_sum($array);
    }, $arrays);
}
echo 'index';

/*
spl_autoload_register('controller');
function controller($f){
    echo '我引入了./'.$f.'/'.$c.'php','<br/>';
    require ('./'.$c.'.php');
}
*/

class hbox extends pcindex {

    function appsview23 (){
        $appview = 'adsfadsf ';
    }
}

?>