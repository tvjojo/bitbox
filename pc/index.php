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
 * Date: 2017/8/9 0009
 * Time: 下午 12:36
 */
define('IN_BOX', true);
define('BOXID', 1);
define('INIT_NO_SMARTY', true);

//define('BIND_MODULE', 'index');
//define('APP_NAME', 'pc');


echo $_SERVER['SCRIPT_NAME'];
echo "</br>";
echo $_SERVER['PHP_SELF'];
echo "</br>";

require './includes/init.php';
echo ROOT_PATH;
echo "</br>";
//$host = $_SERVER['HTTP_HOST'];
//$a = $_GET['a'] ?? 'err';
//$m = $_GET['m'] ?? 'err';
//$c = $_GET['c'] ?? 'err';
//$f = $_GET['f'] ?? 'err';
//require_once (dirname(__FILE__) . './'.$f.'/'.$c.'.php');

function boxhost(){};

echo 'index123   index的起点起点起点起点起点起点起点起点';
echo "</br>";
echo "</br> ‘ROOT_PATH’";
echo ROOT_PATH;
echo "</br> ‘BASE_PATH’";

echo BASE_PATH;
echo "</br> ‘APP_NAME’";
echo APP_NAME;
echo "</br> ‘_APP_NAME：’";
 //  echo _APP_NAME;
echo "</br> ‘APP_BOXPATH’";
echo APP_BOXPATH;
echo "</br>  ‘APP_PATH’ ";
echo  APP_PATH;
echo "</br>";
echo _PHP_FILE_;
echo "</br>";
echo  __SELF__;
echo "</br>";
//echo BIND_MODULE;
echo "7</br>";
echo CONTROLLER_NAME;

echo "8</br> ‘__APP__’";
echo __APP__;
echo "</br> ";
echo __CONTROLLER__;
echo "</br> ‘DEFAULT_APP’";
echo DEFAULT_APP;
echo "</br>";
//echo $_SERVER['PATH_INFO'];
echo "</br>";
echo "pathinfo是空值";
//echo BIND_MODULE;
echo "</br>";
//echo BIND_CONTROLLER;
echo "</br> ‘BIND_ACTION’";
//echo BIND_ACTION;
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br> ‘_PHP_FILE_’ ";
echo _PHP_FILE_;
echo "</br>";

//echo  VAR_CONTROLLER;
echo "</br>‘ACTION_DEFAULT：’";
//echo ACTION_DEFAULT;
echo "</br>";
//echo $varPath;
echo "</br>";
//echo $varModule;
echo "</br>";
//echo $_SERVER['PATH_INFO'];
echo "</br>";
//echo $varAction;
echo "</br>";
//echo $varController ;
echo "</br>";
//echo  $urlCase;
echo "</br>";
//echo $url;
echo "</br>‘CONTROLLER_NAME’";
echo CONTROLLER_NAME;
echo "</br> ‘ACTION_NAME’";
echo  ACTION_NAME;
echo "</br> ‘ __ACTION__’";
echo  __ACTION__;
echo "</br>";

//echo MODULE_ALIAS;
echo "</br>";
//echo ACTION_ALIAS;
echo "</br> ‘ DEFAULT_ACTION’";

echo DEFAULT_ACTION;
echo "</br>‘DEFAULT_CONTROLLER’";
echo DEFAULT_CONTROLLER;
echo "</br>‘__MODULE__’";
echo __MODULE__;
echo "</br>‘MODULE_NAME’";
 echo MODULE_NAME;
echo "</br>";
echo constant('APP_APPPATH');
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
//$smarty->assign('page_title','');
 //$smarty->display('index2.html', $cache_id);

$act = !empty($_GET['act']) ? $_GET['act'] : '';
if ($act == 'index')
{
    echo "KKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKK";
}




// $smarty->display('index.html', $cache_id);