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
 * Date: 2017/9/9 0009
 * Time: ���� 18:49
 */

//header("Location: /pc/index.php");
//exit;
defined('APP_BOXNAME') or define('APP_BOXNAME', '');
defined('APP_BOXPATH') or define('APP_BOXPATH', '');
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/'))."/");
define('ROOT_PATH', str_replace('boxphp/init.php', '', str_replace('\\', '/', __FILE__)));
define('IN_BOX', true);
define('BOXID', 1);
define('INIT_NO_SMARTY', true);
define('BASE_PATH2',str_replace('\\','/',realpath(dirname(__FILE__).'/'))."/");
define('BIND_MODULE', 'index');
define('CONTROLLER_NAME', 'indexctrl');
//require './boxphp/init.php';
 require('./boxphp/lib/smarty/Smarty.class.php');

 
//$host = $_SERVER['HTTP_HOST'];

function boxhost(){};
/*
function arraysSum(array ...$arrays): array
{
	    return array_map(function(array $array): int {
		        return array_sum($array);
    }, $arrays);
}

*/

$smarty =new Smarty();

$smarty->debugging = false;
$smarty->caching = true;
$smarty->cache_lifetime = 66;
 
$smarty->template_dir = 'view/template/';

$smarty->assign('page_title','');


$a = !empty($_GET['a']) ? $_GET['a'] : '';


if($a==''){
 $smarty->display('index.html');
}

elseif($a=='2'){
 $smarty->display('help.html');
}

elseif($a=='3'){

 $smarty->display('version.html');
}

elseif($a=='5'){

 $smarty->display('juan.html');
}
elseif($a=='1'){

 $smarty->display('about.html');
}
else
{
	$smarty->display('box.html');



}











?>