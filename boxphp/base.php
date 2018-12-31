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
 * Time: 下午 12:36
 */


if (!defined('IN_BOX'))
{
    die('Hacking attempt 非法入侵');
}

define('$db_name ','bitbox' );
define('$prefix','box_' );

define('BOX_CHARSET','utf-8');

define('ADMIN_PATH','admin');

define('AUTH_KEY', 'this is a key');

define('OLD_AUTH_KEY', '');

define('API_TIME', '');

define('STORE_KEY','31cb2f0544e3a85a1e90199ad8a25026');
/* 调试配置 */
defined('DEBUG') or define('DEBUG', C('DEBUG'));

//define('IN_BOX', true);
//defined('DEFAULT_APP') or define('DEFAULT_APP', dirname($_SERVER['SCRIPT_FILENAME']);

return array(
    /* 应用配置 */
    'APP' => array(
        'DEFAULT_TIMEZONE' => 'PRC', // 时区设置
        /* 日志和错误调试配置 */
        'DEBUG' => true, // 是否开启调试模式，true开启，false关闭
        'LOG_ON' => true, // 是否开启出错信息保存到文件，true开启，false不开启
        'LOG_PATH' => ROOT_PATH . 'data/cache/log/', // 出错信息存放的目录，出错信息以天为单位存放，一般不需要修改
        'ERROR_URL' => '', // 出错信息重定向页面，为空采用默认的出错页面，一般不需要修改
    //    'APP_NAME' => '', // 名字

        /* 网址配置 */
        'URL_REWRITE_ON' => false, // 是否开启重写，true开启重写,false关闭重写
        'URL_MODULE_DEPR' => '/', // 模块分隔符，一般不需要修改
        'URL_ACTION_DEPR' => '-', // 操作分隔符，一般不需要修改
        'URL_PARAM_DEPR' => '-', // 参数分隔符，一般不需要修改
        'URL_HTML_SUFFIX' => 'html', // 伪静态后缀设置，例如 html ，一般不需要修改
        /* 模块配置 */
        'MULTI_MODULE' => true, // 是否允许多模块 如果为false 则必须设置 DEFAULT_APP
        'CONTROLLER_LEVEL' =>  2,
        'MODULE_PATH' => './box/', // 模块存放目录，一般不需要修改
        'MODULE_SUFFIX' => 'Module.class.php', // 模块后缀，一般不需要修改
        'MODULE_INIT' => 'init.php', // 初始程序，一般不需要修改
        'MODULE_DEFAULT' => 'dobox', // 默认模块，一般不需要修改
        'MODULE_EMPTY' => 'empty', // 空模块 ，一般不需要修改
        /* 操作配置 */
        'ACTION_DEFAULT' => 'index', // 默认操作，一般不需要修改
        'ACTION_EMPTY' => '_empty', // 空操作，一般不需要修改
        /* 模型配置 */
        'MODEL_PATH' => './mod/', // 模型存放目录，一般不需要修改
        'MODEL_SUFFIX' => 'Mod.php', // 模型后缀，一般不需要修改
        /* 静态页面缓存 */
        'HTML_CACHE_ON' => false, // 是否开启静态页面缓存，true开启.false关闭
        'HTML_CACHE_PATH' => ROOT_PATH . 'data/cache/html_cache/', // 静态页面缓存目录，一般不需要修改
        /* 静态页面缓存规则 array('模块名'=>array('方法名'=>缓存时间,)) 缓存时间,单位：秒 */
        'HTML_CACHE_RULE' => array(
            'dobox' => array('index' => array('index' => 1000))
        ),
        /* URL配置 */
        'URL_ROUTER_ON'         => false, // true,//    // 是否开启URL路由
        'URL_CASE_INSENSITIVE' => true, // 默认true则表示不区分大小写
        'URL_MODEL' => 0, // URL访问模式,可选参数0、1、2、3,代表以下四种模式：0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
        'URL_PATHINFO_DEPR' => '/',	// PATHINFO模式下，各参数之间的分割符号
        'URL_REQUEST_URI' =>  'REQUEST_URI', // 获取当前页面地址的系统变量 默认为REQUEST_URI
        /* 系统变量名称设置 */
        'VAR_APPBOX' => 'b', // 默认APP应用获取变量
        'VAR_MODULE' => 'm', // 默认模块获取变量
        'VAR_CONTROLLER' => 'c', // 默认控制器获取变量
        'VAR_ACTION' => 'a', // 默认操作获取变量
        'VAR_PATHINFO' =>  'r',    // 兼容模式PATHINFO获取变量例如 ?s=/module/action/id/1 后面的参数取决于URL_PATHINFO_DEPR
        'URL_PATHINFO_FETCH' =>  'ORIG_PATH_INFO,REDIRECT_PATH_INFO,REDIRECT_URL', // 用于兼容判断PATH_INFO 参数的SERVER替代变量列表
        'URL_PARAMS_BIND' =>  true, // URL变量绑定到Action方法参数
        'URL_PARAMS_BIND_TYPE'  =>  0, // URL变量绑定的类型 0 按变量名绑定 1 按变量顺序绑定
        'AUTOLOAD_DIR' => array(), // 自动加载扩展目录
    ),
    /* 数据库配置 */
    'DB' => array(
        'DB_TYPE' => 'mysqli', // 数据库类型，一般不需要修改
        'DB_HOST' => '1225', // 数据库主机，一般不需要修改
        'DB_USER' => 'b12', // 数据库用户名
        'DB_PWD' => 'b123', // 数据库密码
        'DB_PORT' => 3306, // 数据库端口，mysql默认是3306，一般不需要修改
        'DB_NAME' => 'b12x', // 数据库名
        'DB_CHARSET' => 'utf8', // 数据库编码，一般不需要修改
        'DB_PREFIX' => 'box_', // 数据库前缀
        'DB_CACHE_ON' => false, // 是否开启数据库缓存，true开启，false不开启
        'DB_CACHE_TYPE' => 'FileCache', // 缓存类型，FileCache或Memcache或SaeMemcache
        'DB_CACHE_TIME' => 600, // 缓存时间,0不缓存，-1永久缓存,单位：秒
        /* 文件缓存配置 */
        'DB_CACHE_PATH' => ROOT_PATH . 'data/cache/db_cache/', // 数据库查询内容缓存目录，地址相对于入口文件，一般不需要修改
        'DB_CACHE_CHECK' => false, // 是否对缓存进行校验，一般不需要修改
        'DB_CACHE_FILE' => 'cachedata', // 缓存的数据文件名
        'DB_CACHE_SIZE' => '15M', // 预设的缓存大小，最小为10M，最大为1G
        'DB_CACHE_FLOCK' => true, // /是否存在文件锁，设置为false，将模拟文件锁,，一般不需要修改
        /* memcache配置，可配置多台memcache服务器 */
        'MEM_SERVER' => array(
            array('127.0.0.1', 11211),
            array('localhost', 11211)
        ),
        'MEM_GROUP' => 'db',
        /* SaeMemcache配置 */
        'SAE_MEM_GROUP' => 'db',
        /* 数据库主从配置 */
        'DB_SLAVE' => array() // 数据库从机配置
    ),
    /* 模板配置 */
    'TPL' => array(
        'TPL_TEMPLATE_PATH' => ROOT_PATH, // 模板目录，一般不需要修改
        'TPL_TEMPLATE_SUFFIX' => '.php', // 模板后缀，一般不需要修改
        'TPL_CACHE_ON' => true, // 是否开启模板缓存，true开启,false不开启
        'TPL_CACHE_TYPE' => '', // 数据缓存类型，为空或Memcache或SaeMemcache，其中为空为普通文件缓存
        /* 普通文件缓存 */
        'TPL_CACHE_PATH' => ROOT_PATH . 'temp/data/cache/tpl_cache/', // 模板缓存目录，一般不需要修改
        'TPL_CACHE_SUFFIX' => '.php', // 模板缓存后缀,一般不需要修改
        /* memcache配置 */
        'MEM_SERVER' => array(
            array('127.0.0.1', 11211),
            array('localhost', 11211)
        ),
        'MEM_GROUP' => 'tpl',
        /* SaeMemcache配置 */
        'SAE_MEM_GROUP' => 'tpl'
    ),
    /* SESSION设置 */
    'SESSION' => array(
        'SESSION_AUTO_START' => true, // 是否自动开启Session
        'SESSION_OPTIONS' => array(), // session 配置数组 支持name id path expire domain 等参数
        'SESSION_PREFIX' => '' // session 前缀
    ),
    /* Cookie设置 */
    'COOKIE' => array(
        'COOKIE_EXPIRE' => 0, // Cookie有效期
        'COOKIE_DOMAIN' => '', // Cookie有效域名
        'COOKIE_PATH' => '/', // Cookie路径
        'COOKIE_PREFIX' => '', // Cookie前缀 避免冲突
        'COOKIE_HTTPONLY' => '' // Cookie httponly设置
    )
);


echo " basebaseDDD大后台配置参数basebase</br>";

/**
 * 自动加载
 * @param unknown $className
 * @return boolean
 */


