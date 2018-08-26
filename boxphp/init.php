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
 * Time: 上午 11:09
 */

// 引入安全机制

if (!defined('IN_BOX'))
{
    die('Hacking attempt 非法入侵');
}

//require_once'safe/safety.php';
//require './config/config.php';
//include'base.php';
//报错结构
error_reporting(E_ALL);


/* 取得当前Bibox所在的根目录 */
//define('BASE_PATH', str_replace('boxphp/init.php', '', str_replace('\\', '/', __FILE__)));
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/'))."/");
define('ROOT_PATH', str_replace('boxphp/init.php', '', str_replace('\\', '/', __FILE__)));
//defined('APP_PATH') or define('APP_PATH', ROOT_PATH . 'box/');
//echo BASE_PATH;
defined('H5_PATH') or define('H5_PATH', ROOT_PATH . 'h5/');

defined('DEFAULT_CONTROLLER') or define('DEFAULT_CONTROLLER', 'index');
defined('DEFAULT_ACTION') or define('DEFAULT_ACTION', 'index');
defined('APP_PATH') or define('APP_PATH', ROOT_PATH .APP_BOXPATH. 'app/');
defined('APP_BASEPATH') or define('APP_BASEPATH', ROOT_PATH .APP_BOXPATH);
defined('APP_BASEBOXPATH') or define('APP_BASEBOXPATH', ROOT_PATH .APP_BOXPATH.'box/');
defined('DEFAULT_APP') or define('DEFAULT_APP','dobox');
defined('APP_APPPATH') or define('APP_APPPATH', ROOT_PATH .APP_BOXPATH. 'app/'.'MNAME/');
defined('CONF_PARSE')   or define('CONF_PARSE',     '');    // 配置文件解析方法



/* 系统函数 */
require(BASE_PATH . 'common.php');
//require(BASE_PATH . 'base.php');

 C(load_file(BASE_PATH . 'base.php'));

//require(ROOT_PATH . 'boxphp/lib/smarty/Smarty.class.php');


// 定义当前请求的系统常量   转为由basectrl 来配置。
/*
define('NOW_TIME', $_SERVER ['REQUEST_TIME']);
define('REQUEST_METHOD', $_SERVER ['REQUEST_METHOD']);
define('IS_GET', REQUEST_METHOD == 'GET' ? true : false );
define('IS_POST', REQUEST_METHOD == 'POST' ? true : false );
define('IS_PUT', REQUEST_METHOD == 'PUT' ? true : false );
*/
/* 初始化设置 */
/*
@ini_set('memory_limit',          '64M');
@ini_set('session.cache_expire',  180);
@ini_set('session.use_trans_sid', 0);
@ini_set('session.use_cookies',   1);
@ini_set('session.auto_start',    0);
@ini_set('display_errors',        1);
*/
//echo 'init';

//兼容与路径
if (__FILE__ == '')
{
    die('Fatal error code: 0');
}
if (DIRECTORY_SEPARATOR == '\\')
{
    @ini_set('include_path', '.;' . ROOT_PATH);
}
else
{
    @ini_set('include_path', '.:' . ROOT_PATH);
}

//$php_self = $_SERVER['PHP_SELF']?? $_SERVER['SCRIPT_NAME'];
//$url='http://'.$_SERVER['HTTP_HOST'].substr($php_self,0,strrpos($php_self,'/')+1);

//echo $php_self;

echo "</br>";
//echo $url;
echo "</br>";
//echo $_SERVER['HTTP_HOST'];
echo "</br>";
echo $_SERVER['PHP_SELF'];
echo "</br>";
echo $_SERVER['SCRIPT_NAME'];
echo "</br>";

/*
if ('/' == substr($php_self, -1))
{
    $php_self .= 'index.php';
}
*/
//define('PHP_SELF', $php_self);

//require(BASE_PATH . 'includes/inc_constant.php');

//require(BASE_PATH . 'includes/cls_error.php');
//require(BASE_PATH . 'includes/lib_time.php');
//require(BASE_PATH . 'lib/debug.php');
//require(BASE_PATH . 'template.php');


if(false === spl_autoload_functions()){
    if(function_exists('__autoload')){
        spl_autoload_registe('__autoload',false);
    }
}



/* 自动注册类文件 */
spl_autoload_register('Loadboxfile::autoload');
//spl_autoload_register();
//__autoload();

require(ROOT_PATH . 'boxphp/class/core.php');              //容易与一些结构冲突
require(ROOT_PATH . 'boxphp/class/Bitbox.php');            //容易与一些结构冲突

/* 创建 BOX对象 */
$box = new BOX($db_name, $prefix);
//define('DATA_DIR', $boxdata->data_dir());
//define('IMAGE_DIR', $boxdata->image_dir());



/* 创建 CORE对象 */
//$c = new core($db_name, $prefix);



/* 创建错误处理对象 */
//$err = new box_error('message.dwt');
//class DB extends box_database {};


/* 判断是否支持 Gzip 模式 */
if (!defined('INIT_NO_SMARTY') && gzip_enabled())
{
    ob_start('ob_gzhandler');
}
else
{
    ob_start();
}



echo "initinitinit最底层的狗日的init问候你了 initinit</br>";


/* 网址路由解析 */
urlRoute();

//die(urlRoute());
var_dump(spl_autoload_register());



try {
    /* 常规URL */
    defined('__HOST__') or define('__HOST__', get_domain());
    defined('__ROOT__') or define('__ROOT__', rtrim(dirname($_SERVER["SCRIPT_NAME"]), '\\/'));  //从字符串右侧移除字符
    defined('__URL__') or define('__URL__', __HOST__ . __ROOT__);
    defined('__ADDONS__') or define('__ADDONS__', __ROOT__ . '/plugins');
    defined('__PUBLIC__') or define('__PUBLIC__', __ROOT__ . '/data/common');
    defined('__ASSETS__') or define('__ASSETS__', __ROOT__ . '/data/assets/' . APP_NAME);

    /* 控制器和方法 */
    $controller = CONTROLLER_NAME . 'control';
    $action = ACTION_NAME;
    /* 控制器类是否存在 */
    if (! class_exists($controller)) {
        E(APP_NAME . '/' . $controller . '.php 控制器类不存在', 404);
    }

    $obj = new $controller();
   // die(__URL__);

    /* 是否非法操作 */
    if (! preg_match('/^[A-Za-z](\w)*$/', $action)) {
        E(APP_NAME . '/' . $controller . '.php的' . $action . '() 方法不合法', 404);
    }


    /* 控制器类中的方法是否存在 */
    if (! method_exists($obj, $action)) {
        E(APP_NAME . '/' . $controller . '.php的' . $action . '() 方法不存在', 404);
    }
    /* 执行当前操作 */
    $method = new ReflectionMethod($obj, $action);
    if ($method->isPublic() && ! $method->isStatic()) {
        $obj->$action();
    } else {
        /* 操作方法不是Public 抛出异常 */
        E(APP_NAME . '/' . $controller . '.php的' . $action . '() 方法没有访问权限', 404);
    }

} catch (Exception $e) {
  //  Error::show($e->getMessage(), $e->getCode());        //暂停老报错，以后再放开
    echo "Exception: {$e->getMessage()}\n";   //PHP7 的方法比较简洁
  //  print $e->getMessage();
}
