<?php
/**
 *   ============================================================================
 *  Copyright (c) 2017. 本软件系统由北天团队与投缘互联共同开发，对于非商业用途
 *  的代码使用完全免费，而对商业用户经过我方授权后也可免费使用，但所有用户不得任意破坏
 *  我们设计的产品结构，也不得使用该软件做为非法用途.如果商业用户希望获得一些平台型的支
 *  持，以及获得我方各类接口的支持，也可联系我方购买更丰富的支持.
 *  ** http://bitbox.5viv.com    EMAIL:tvjojo@5viv.com   QQ群：229487894
 *   ============================================================================
 */

/**
 * User: Huangbt
 * Date: 2017/8/7 0007
 * Time: 上午 10:48
 */

//header("Location: /pc/index.php");

define('IN_BOX', true);
define('BOXID', 1);
define('INIT_NO_SMARTY', true);
define('BASE_PATH2',str_replace('\\','/',realpath(dirname(__FILE__).'/'))."/");
define('BIND_MODULE', 'index');
define('CONTROLLER_NAME', 'indexctrl');
require './boxphp/init.php';
echo ROOT_PATH;
echo "</br>";
echo BASE_PATH;
echo "</br>";

echo $url;
//$host = $_SERVER['HTTP_HOST'];
//$a = $_GET['a'] ?? 'err';

function boxhost(){};
/*
function arraysSum(array ...$arrays): array
{
	    return array_map(function(array $array): int {
		        return array_sum($array);
    }, $arrays);
}

*/
echo "indexFFFFFFFFFFFFFF";
$smarty =new Smarty();
$smarty->template_dir = ROOT_PATH . 'view/template/';

$smarty->assign('page_title','');
$smarty->display('index.html', $cache_id);

class boxofofof extends  pcindex
{
    //echo "23423423423423";
    function boxof()
    {
       $f= BASE_PATH;

    //echo $className;
        echo $f;
        //    $className;

    }
}
$aa = new boxofofof();

 $aa->boxof();