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
 * Date: 2017/8/10 0010
 * Time: 下午 23:56
 */

if (!defined('IN_BOX'))
{
    die('Hacking attempt 非法入侵');
}


class Loadboxfile {
    public static function autoload($className) {
    $array = array(
        ROOT_PATH . 'boxphp/class/' . $className . '.php',
        ROOT_PATH . 'boxphp/base/ctrl/' . $className . '.php',
        ROOT_PATH . 'boxphp/base/mod/' . $className . '.php',
        ROOT_PATH . 'boxphp/lib/' . $className . '.php',
        ROOT_PATH . 'boxphp/lib/smarty/' . $className . '.class.php',
        ROOT_PATH . 'boxphp/lib/driver/db/' . $className . '.php',
        ROOT_PATH . 'boxphp/lib/' . $className . '. class .'.'.php',
     //   ROOT_PATH . 'h5/mod/' . $className . '.php',
     //   ROOT_PATH . 'h5/ctrl/' . $className . '.php',
        ROOT_PATH . 'boxphp/'. '. class . '. $className . '.php',
        ROOT_PATH . 'boxphp/' . $className . '.php',
        ROOT_PATH . 'boxphp/bitbox/' . $className . '.php',
        ROOT_PATH . $className .'.php',
        ROOT_PATH . 'pc/'. $className .'.php',
        //ROOT_PATH . 'pc/app/dobox/ctrl/'. $className .'.php',
       // ROOT_PATH . 'pc/app/dobox/mod/'. $className .'.php',
        APP_PATH . C('_APP_NAME') . '/mod/' . $className . '.php',
        APP_PATH . C('_APP_NAME') . '/ctrl/' . $className . '.php',
        APP_BASEPATH . '/box/mod/' . $className . '.php',
        APP_BASEPATH . '/box/ctrl/' . $className . '.php',
    );
    foreach ($array as $file) {
        if (is_file($file)) {
            require_once ($file);
            return true;
        }
    }
    return false;

  }


}

/**
 * 加载配置文件 支持格式转换 仅支持一级配置
 * @param string $file 配置文件名
 * @param string $parse 配置解析方法 有些格式需要用户自己解析
 * @return void
 */
function load_file($file) {
    if (file_exists($file)) {
        return include $file;
    }
}



/**
 * 加载动态扩展文件
 * @var string $path 文件路径
 * @return void
 */
function load_ext_file($path) {
    // 加载自定义外部文件
    if($files = C('LOAD_EXT_FILE')) {
        $files      =  explode(',',$files);  //打散
        foreach ($files as $file){
            $file   = $path.'box/'.$file.'.php';
            if(is_file($file)) include $file;
        }
    }
    // 加载自定义的动态配置文件
    if($configs = C('LOAD_EXT_CONFIG')) {
        if(is_string($configs)) $configs =  explode(',',$configs);
        foreach ($configs as $key=>$config){
            $file   = $path.'config/'.$config.'.php';
            if(is_file($file)) {
                is_numeric($key)?C(load_config($file)):C($key,load_config($file));
            }
        }
    }
}

/**
 * 加载配置文件 支持格式转换 仅支持一级配置
 * @param string $file 配置文件名
 * @param string $parse 配置解析方法 有些格式需要用户自己解析
 * @return array
 */
function load_config($file,$parse=CONF_PARSE){
    $ext  = pathinfo($file,PATHINFO_EXTENSION);  // 函数以数组的形式返回文件路径的信息。
    switch($ext){
        case 'php':
            return include $file;
        case 'xml':
            return (array)simplexml_load_file($file);
        case 'json':
            return json_decode(file_get_contents($file), true);
        default:
            if(function_exists($parse)){
                return $parse($file);
            }else{
                E('Nonsupport:'.$ext);
            }
    }
}


/**
 * 路由解析
 */
function urlRoute() {
    dispatcher::dispatch(); // URL调度
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

/**
 * URL组装 支持不同URL模式
 * @param string $url URL表达式，格式：'[模块/控制器/操作#锚点@域名]?参数1=值1&参数2=值2...'
 * @param string|array $vars 传入的参数，支持数组和字符串
 * @param string|boolean $suffix 伪静态后缀，默认为true表示获取配置值
 * @param boolean $domain 是否显示域名
 * @return string
 */
function U($url='',$vars='',$suffix=true,$domain=false) {
    // 解析URL
    $info   =  parse_url($url);

    $url    =  !empty($info['path'])?$info['path']:ACTION_NAME;
    if(isset($info['fragment'])) { // 解析锚点
        $anchor =   $info['fragment'];
        if(false !== strpos($anchor,'?')) { // 解析参数
            list($anchor,$info['query']) = explode('?',$anchor,2);
        }
        if(false !== strpos($anchor,'@')) { // 解析域名
            list($anchor,$host)    =   explode('@',$anchor, 2);
        }
    }elseif(false !== strpos($url,'@')) { // 解析域名
        list($url,$host)    =   explode('@',$info['path'], 2);
    }
    // 解析子域名
    if(isset($host)) {
        $domain = $host.(strpos($host,'.')?'':strstr($_SERVER['HTTP_HOST'],'.'));
    }elseif($domain===true){
        $domain = $_SERVER['HTTP_HOST'];

    }

    // 解析参数
    if(is_string($vars)) { // aaa=1&bbb=2 转换成数组
        parse_str($vars,$vars);
    }elseif(!is_array($vars)){
        $vars = array();
    }
    if(isset($info['query'])) { // 解析地址里面参数 合并到vars
        parse_str($info['query'],$params);
        $vars = array_merge($params,$vars);
    }

    // URL组装
    $depr       =   C('URL_PATHINFO_DEPR');
  //  die(empty($depr));
    $urlCase    =   C('URL_CASE_INSENSITIVE');
    if($url) {
        if(0=== strpos($url,'/')) {// 定义路由
            $route      =   true;
            $url        =   substr($url,1);
            if('/' != $depr) {
                $url    =   str_replace('/',$depr,$url);
            }
        }else{
            if('/' != $depr) { // 安全替换
                $url    =   str_replace('/',$depr,$url);
            }
            // 解析模块、控制器和操作
            $url        =   trim($url,$depr);   //移除空白，整理
            $path       =   explode($depr,$url);   //用“/”来分割信息，方便以后使用
            $var        =   array();
            $varModule      =   C('VAR_MODULE');
            $varController  =   C('VAR_CONTROLLER');
            $varAction      =   C('VAR_ACTION');
            $var[$varAction]       =   !empty($path)?array_pop($path):ACTION_NAME;   //array_pop弹出数组最后一个单元（出栈）
            $var[$varController]   =   !empty($path)?array_pop($path):CONTROLLER_NAME;
            if($maps = C('URL_ACTION_MAP')) {
                if(isset($maps[strtolower($var[$varController])])) {
                    $maps = $maps[strtolower($var[$varController])];
                    if($action = array_search(strtolower($var[$varAction]),$maps)){    //在数组中搜索给定的值，如果成功则返回首个相应的键名
                        $var[$varAction] = $action;
                    }
                }
            }
            if($maps = C('URL_CONTROLLER_MAP')) {
                if($controller = array_search(strtolower($var[$varController]),$maps)){
                    $var[$varController] = $controller;
                }
            }
            if($urlCase) {
                $var[$varController] = parse_name($var[$varController]);
            }
            $module =   '';
            if(!empty($path)) {
                $var[$varModule] = implode($depr,$path);  //把路径信息拼接成模块
            }else{
                if(C('MULTI_MODULE')) {
                    if(APP_NAME != C('DEFAULT_APP')){
                        $var[$varModule] = APP_NAME;
                    }
                }
            }
            if($maps = C('URL_MODULE_MAP')) {
                if($_module = array_search(strtolower($var[$varModule]),$maps)){
                    $var[$varModule] = $_module;
                }
            }
            if(isset($var[$varModule])){
                $module =   $var[$varModule];
                unset($var[$varModule]);
            }
        }
    }

    if(C('URL_MODEL') == 0) { // 普通模式URL转换
        $url        =   __APP__.'?'.$varModule."={$module}&".http_build_query(array_reverse($var), '', '&');   //生成 URL-encode 之后的请求字符串// 以相反的元素顺序返回数组：

        if($urlCase){
            $url    =   strtolower($url);
        }
        if(!empty($vars)) {
            $vars   =   http_build_query($vars, '', '&');
            $url   .=   '&'.$vars;
        }
    }else{ // PATHINFO模式或者兼容URL模式
        if(isset($route)) {
            $url    =   __APP__.'/'.rtrim($url,$depr);
        }else{
            $module =   (defined('BIND_MODULE') && BIND_MODULE==$module )? '' : $module;
            $url    =   __APP__.'/'.($module?$module.$depr:'').implode($depr,array_reverse($var));
        }
            if($urlCase){
                $url    =   strtolower($url);
            }
            if(!empty($vars)) { // 添加参数
            foreach ($vars as $var => $val){
                if('' !== trim($val))   $url .= $depr . $var . $depr . urlencode($val);
            }
        }
        if($suffix) {
            $suffix   =  $suffix===true ? C('URL_HTML_SUFFIX'):$suffix;
            if($pos = strpos($suffix, '|')){
                $suffix = substr($suffix, 0, $pos);
            }
            if($suffix && '/' != substr($url,-1)){
                $url  .=  '.'.ltrim($suffix,'.');
            }
        }
    }
    if(isset($anchor)){
        $url  .= '#'.$anchor;
    }
    if($domain) {
        $url   =  (is_ssl()?'https://':'http://').$domain.$url;
    }
    return $url;
}

/**
 * 字符串命名风格转换
 * type 0 将Java风格转换为C的风格 1 将C风格转换为Java的风格
 * @param string $name 字符串
 * @param integer $type 转换类型
 * @return string
 */
function parse_name($name, $type=0, $ucfirst = true) {
    if ($type) {
     //   return ucfirst(preg_replace_callback("/_([a-zA-Z])/e", "strtoupper('\\1')", $name));   //函数把字符串中的首字符转换为大写。   //strtoupper把所有字符转换为大写：
        $name = preg_replace_callback('/_([a-zA-Z])/', function ($match) {
            return strtoupper($match[1]);
        }, $name);
        return $ucfirst ? ucfirst($name) : lcfirst($name);
    } else {
        return strtolower(trim(preg_replace("/[A-Z]/", "_\\0", $name), "_"));
    }
}
/**
 * 判断是否SSL协议
 * @return boolean
 */
function is_ssl() {
    if(isset($_SERVER['HTTPS']) && ('1' == $_SERVER['HTTPS'] || 'on' == strtolower($_SERVER['HTTPS']))){
        return true;
    }elseif(isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'] )) {
        return true;
    }
    return false;
}

/**
 * 获取和设置配置参数 支持批量定义
 * @param string|array $name 配置变量
 * @param mixed $value 配置值
 * @param mixed $default 默认值
 * @return mixed
 */
function C($name=null, $value=null, $default=null) {
    static $_config = array();
    // 无参数时获取所有
    if (empty($name)) {
        return $_config;
    }
    // 优先执行设置获取或赋值
    if (is_string($name)) {
        if (!strpos($name, '.')) {    //查找 "php" 在字符串中第一次出现的位置：
            $name = strtoupper($name);    //将字符串转化为大写
            if (is_null($value)){
                if(isset($_config[$name])){
                    return $_config[$name];
                } else if (isset($_config['APP'][$name])) {
                    return $_config['APP'][$name];
                } else if (isset($_config['DB'][$name])) {
                    return $_config['DB'][$name];
                } else if (isset($_config['TPL'][$name])) { //暂时无用
                    return $_config['TPL'][$name];
                } else if (isset($_config['CFG'][$name])) { //暂时无用
                    return $_config['CFG'][$name];
                } else if (isset($_config['SESSION'][$name])) {
                    return $_config['SESSION'][$name];
                } else if (isset($_config['COOKIE'][$name])) {
                    return $_config['COOKIE'][$name];
                }else{
                    return $default;
                }
            }
            if(is_array($value) && isset($_config[$name])){
                $_config[$name] = array_merge($_config[$name], $value);
            }else{
                $_config[$name] = $value;
            }
            return null;
        }
        // 二维数组设置和获取支持
        $name = explode('.', $name);
        $name[0] = strtoupper($name[0]);
        if (is_null($value)){
            if(isset($_config[$name[0]][$name[1]])){
                return $_config[$name[0]][$name[1]];
            } else if (isset($_config['APP'][$name[0]][$name[1]])) {
                return $_config['APP'][$name[0]][$name[1]];
            } else if (isset($_config['DB'][$name[0]][$name[1]])) {
                return $_config['DB'][$name[0]][$name[1]];
            } else if (isset($_config['TPL'][$name[0]][$name[1]])) {
                return $_config['TPL'][$name[0]][$name[1]];
            } else if (isset($_config['CFG'][$name[0]][$name[1]])) {
                return $_config['CFG'][$name[0]][$name[1]];
            } else if (isset($_config['SESSION'][$name[0]][$name[1]])) {
                return $_config['SESSION'][$name[0]][$name[1]];
            } else if (isset($_config['COOKIE'][$name[0]][$name[1]])) {
                return $_config['COOKIE'][$name[0]][$name[1]];
            }else{
                return $default;
            }
        }
        // return isset($_config[$name[0]][$name[1]]) ? $_config[$name[0]][$name[1]] : $default;
        $_config[$name[0]][$name[1]] = is_array($value) ? array_merge($_config[$name[0]][$name[1]], $value) : $value;
        return null;
    }
    // 批量设置
    if (is_array($name)){
        $_config = array_merge($_config, array_change_key_case($name,CASE_UPPER));  //将数组的所有的键转换为大写字母：
        return null;
    }
    return null; // 避免非法参数
}


/**
 * 数据模型
 * @param unknown $model
 * @throws Exception
 * @return Ambigous <unknown>
 */
function model($model) {

    static $objArray = array();
    $className = $model . 'Mod';
    if (!is_object($objArray[$className])) {      //检查变量是否一个对象
        if (!class_exists($className)) {                //检查类是否已定义
            throw new Exception(C('_APP_NAME') . '/' . $className . '.php 模型类不存在');
        }
        $objArray[$className] = new $className();
    }
    return $objArray[$className];
}




/**
 * 记录和统计时间（微秒）和内存使用情况
 * @param string $flag 开始标签
 * @param boolean $end 结束标签
 * @return mixed
 */
function debug($flag = 'system', $end = false) {
    static $arr = array();
    if (!$end) {
        $arr[$flag] = microtime(true);
    } else if ($end && isset($arr[$flag])) {
        echo '<p>' . $flag . ': runtime:' . round((microtime(true) - $arr[$flag]), 6) . ' memory_usage:' . memory_get_usage() / 1000 . 'KB</p>';
    }
}

/**
 * 抛出异常处理
 * @param string $msg 异常消息
 * @param integer $code 异常代码 默认为0
 * @return void
 */
function E($msg, $code = 0) {
    throw new Exception($msg, $code);
    exit($msg);
  include(BASE_PATH. '/bitbox/404.html');
    exit();
}






/**
 * 取得当前的域名
 * @return string
 */
function get_domain() {
    /* 协议 */
    $protocol = (isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) != 'off')) ? 'https://' : 'http://';
    /* 域名或IP地址 */
    if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
        $host = $_SERVER['HTTP_X_FORWARDED_HOST'];
    } elseif (isset($_SERVER['HTTP_HOST'])) {
        $host = $_SERVER['HTTP_HOST'];
    } else {
        /* 端口 */
        if (isset($_SERVER['SERVER_PORT'])) {
            $port = ':' . $_SERVER['SERVER_PORT'];
            if ((':80' == $port && 'http://' == $protocol) || (':443' == $port && 'https://' == $protocol)) {
                $port = '';
            }
        } else {
            $port = '';
        }
        if (isset($_SERVER['SERVER_NAME'])) {
            $host = $_SERVER['SERVER_NAME'] . $port;
        } elseif (isset($_SERVER['SERVER_ADDR'])) {
            $host = $_SERVER['SERVER_ADDR'] . $port;
        }
    }
    return $protocol . $host;
}



/**
 * 获取输入参数 支持过滤和默认值    对于将来获得数据 ，然后进行处理还是很重要的，包括防SQL
 * 使用方法:
 * <code>
 * I('id',0); 获取id参数 自动判断get或者post
 * I('post.name','','htmlspecialchars'); 获取$_POST['name']
 * I('get.'); 获取$_GET
 * </code>
 * @param string $name 变量的名称 支持指定类型
 * @param mixed $default 不存在的时候默认值
 * @param mixed $filter 参数过滤方法
 * @param mixed $datas 要获取的额外数据源
 * @return mixed
 */
function I($name, $default = '', $filter = null, $datas = null) {
    if (strpos($name, '.')) { // 指定参数来源
        list($method, $name) = explode('.', $name, 2);
    } else { // 默认为自动判断
        $method = 'param';
    }
    switch (strtolower($method)) {
        case 'get':
            $input = & $_GET;
            break;
        case 'post':
            $input = & $_POST;
            break;
        case 'put':
            parse_str(file_get_contents('php://input'), $input);
            break;
        case 'param':
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $input = $_POST;
                    break;
                case 'PUT':
                    parse_str(file_get_contents('php://input'), $input);
                    break;
                default:
                    $input = $_GET;
            }
            break;
        case 'path':
            $input = array();
            if (!empty($_SERVER['PATH_INFO'])) {
                $depr = '/';
                $input = explode($depr, trim($_SERVER['PATH_INFO'], $depr));
            }
            break;
        case 'request':
            $input = & $_REQUEST;
            break;
        case 'session':
            $input = & $_SESSION;
            break;
        case 'cookie':
            $input = & $_COOKIE;
            break;
        case 'server':
            $input = & $_SERVER;
            break;
        case 'globals':
            $input = & $GLOBALS;
            break;
        case 'data':
            $input = & $datas;
            break;
        default:
            return NULL;
    }
    if ('' == $name) { // 获取全部变量
        $data = $input;
        array_walk_recursive($data, 'filter_exp');
        $filters = isset($filter) ? $filter : 'htmlspecialchars';
        if ($filters) {
            if (is_string($filters)) {
                $filters = explode(',', $filters);
            }
            foreach ($filters as $filter) {
                $data = array_map_recursive($filter, $data); // 参数过滤
            }
        }
    } elseif (isset($input[$name])) { // 取值操作
        $data = $input[$name];
        is_array($data) && array_walk_recursive($data, 'filter_exp');
        $filters = isset($filter) ? $filter : 'htmlspecialchars';
        if ($filters) {
            if (is_string($filters)) {
                $filters = explode(',', $filters);
            } elseif (is_int($filters)) {
                $filters = array(
                    $filters
                );
            }

            foreach ($filters as $filter) {
                if (function_exists($filter)) {
                    $data = is_array($data) ? array_map_recursive($filter, $data) : $filter($data); // 参数过滤
                } else {
                    $data = filter_var($data, is_int($filter) ? $filter : filter_id($filter));
                    if (false === $data) {
                        return isset($default) ? $default : NULL;
                    }
                }
            }
        }
    } else { // 变量默认值
        $data = isset($default) ? $default : NULL;
    }
    return $data;
}
/**
 * 递归数组
 * @param type $filter
 * @param type $data
 * @return type
 */
function array_map_recursive($filter, $data) {
    $result = array();
    foreach ($data as $key => $val) {
        $result[$key] = is_array($val) ? array_map_recursive($filter, $val) : call_user_func($filter, $val);
    }
    return $result;
}
/**
 * 创建类的别名
 */
if (!function_exists('class_alias')) {

    function class_alias($original, $alias) {
        $newclass = create_function('', 'class ' . $alias . ' extends ' . $original . ' {}');
        $newclass();
    }

}

/**
 * 过滤表单中的表达式
 * @param unknown $value
 */
function filter_exp(&$value) {
    if (in_array(strtolower($value), array('exp', 'or'))) {
        $value .= ' ';
    }
}

/**
 * 不区分大小写的in_array实现
 * @param unknown $value
 * @param unknown $array
 * @return boolean
 */
function in_array_case($value, $array) {
    return in_array(strtolower($value), array_map('strtolower', $array));
}


// 数据过滤用的，
function in($data, $force = false) {
    if (is_string($data)) {
        $data = trim(htmlspecialchars($data)); // 防止被挂马，跨站攻击
        if (($force == true) || (!get_magic_quotes_gpc())) {  // 已经取消的函数以后可以删除掉。
            $data = addslashes($data); // 防止sql注入
        }
        return $data;
    } else if (is_array($data)) {
        foreach ($data as $key => $value) {
            $data[$key] = in($value, $force);
        }
        return $data;
    } else {
        return $data;
    }
}

echo 'COMCOMCOMCOMONCCCCCCC大通用基础库 COM</br>';