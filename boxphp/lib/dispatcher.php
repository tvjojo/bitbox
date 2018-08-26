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
 * Created by PhpStorm.
 * User: tvjojo
 * Date: 2017-08-11
 * Time: 18:46
 */

echo "dispatch路由控制dispatch</br>";

class dispatcher {

    /**
     * URL映射到控制器
     * @access public
     * @return void
     * 1：首先看是不是兼容模式，如果是的话，就取兼容参数赋值给PATH_INFO变量
    2：其次看是不是cli模式，如果是的话，取其参数赋值改PATH_INFO
    3: 是否开启子域名部署，如果开启了，从中分析出模块，控制器和参数。
    4: 开始分析pathinfo得到控制器，模块和操作
    5：

     */
    static public function dispatch() {

        $varPath        =   C('VAR_PATHINFO');  //定义路径信息并处理该路径
        $varModule      =  C('VAR_MODULE');
        $varController  =  C('VAR_CONTROLLER');
        $varAction      =    C('VAR_ACTION');
        $urlCase        =   C('URL_CASE_INSENSITIVE');
        $varAppbox       =    C('VAR_APPBOX');


        /*
        if(isset($_GET[$varPath])) { // 判断URL里面是否有兼容模式参数 ，基本现在用不上，我取消了CLI
            $_SERVER['PATH_INFO'] = $_GET[$varPath];
            unset($_GET[$varPath]);
        }

        /*
        // 开启子域名部署   ，基本现在用不上
        if(C('APP_SUB_DOMAIN_DEPLOY')) {
            $rules      = C('APP_SUB_DOMAIN_RULES');
            if(isset($rules[$_SERVER['HTTP_HOST']])) { // 完整域名或者IP配置
                define('APP_DOMAIN',$_SERVER['HTTP_HOST']); // 当前完整域名
                $rule = $rules[APP_DOMAIN];
            }else{
                if(strpos(C('APP_DOMAIN_SUFFIX'),'.')){ // com.cn net.cn
                    $domain = array_slice(explode('.', $_SERVER['HTTP_HOST']), 0, -3);
                }else{
                    $domain = array_slice(explode('.', $_SERVER['HTTP_HOST']), 0, -2);
                }
                if(!empty($domain)) {
                    $subDomain = implode('.', $domain);
                    define('SUB_DOMAIN',$subDomain); // 当前完整子域名
                    $domain2   = array_pop($domain); // 二级域名
                    if($domain) { // 存在三级域名
                        $domain3 = array_pop($domain);
                    }
                    if(isset($rules[$subDomain])) { // 子域名
                        $rule = $rules[$subDomain];
                    }elseif(isset($rules['*.' . $domain2]) && !empty($domain3)){ // 泛三级域名
                        $rule = $rules['*.' . $domain2];
                        $panDomain = $domain3;
                    }elseif(isset($rules['*']) && !empty($domain2) && 'www' != $domain2 ){ // 泛二级域名
                        $rule      = $rules['*'];
                        $panDomain = $domain2;
                    }
                }
            }

            if(!empty($rule)) {
                // 子域名部署规则 '子域名'=>array('模块名[/控制器名]','var1=a&var2=b');
                if(is_array($rule)){
                    list($rule,$vars) = $rule;
                }
                $array      =   explode('/',$rule);
                // 模块绑定
                define('BIND_MODULE',array_shift($array));
                // 控制器绑定
                if(!empty($array)) {
                    $controller  =   array_shift($array);
                    if($controller){
                        define('BIND_CONTROLLER',$controller);
                    }
                }
                if(isset($vars)) { // 传入参数
                    parse_str($vars,$parms);
                    if(isset($panDomain)){
                        $pos = array_search('*', $parms);
                        if(false !== $pos) {
                            // 泛域名作为参数
                            $parms[$pos] = $panDomain;
                        }
                    }
                    $_GET   =  array_merge($_GET,$parms);
                }
            }
        }
         */
        // 分析PATHINFO信息 坑爹的兼容。 这个INFO会用到
// 分析PATHINFO信息，这里的判断是否为空是针对上面的兼容模式的。如果不是兼容模式的话，那么这里肯定是没有设置的，
//那么下面条件里的代码果断执行。如果是兼容模式，PATH_INFO我们就得到了，就不需要执行下面条件中的代码了。
        /*
        下面我们来看看不使用兼容模式情况下的代码执行情况。这里仍然是再做兼容，为了支持更广泛的主机环境下正确获得pathinfo
        首先获得配置项URL_PATHINFO_FETCH，分离出函数名然后执行。配置项中函数的命名格式是  :函数名
        所以这里会先检测是否包含：，如果包含，那么说明用户定义了获得pathinfo的函数，执行执行获得后退出即可。
        如果没有包含，说明用户没有执行，那么就按照 默认执行的三个服务器端参数有没有。
         。
        */
   /*
        if(!isset($_SERVER['PATH_INFO'])) {

            $types   =  explode(',',C('URL_PATHINFO_FETCH'));  //分割'ORIG_PATH_INFO,REDIRECT_PATH_INFO,REDIRECT_URL'
            foreach ($types as $type){
                if(0===strpos($type,':')) {// 支持函数判断  strpos查找 "php" 在字符串中第一次出现的位置
                    $_SERVER['PATH_INFO'] =   call_user_func(substr($type,1));    //把第一个参数作为回调函数调用
                    break;
                }elseif(!empty($_SERVER[$type])) {
                    $_SERVER['PATH_INFO'] = (0 === strpos($_SERVER[$type],$_SERVER['SCRIPT_NAME']))?
                        substr($_SERVER[$type], strlen($_SERVER['SCRIPT_NAME']))   :  $_SERVER[$type];//substr() 函数返回字符串的一部分   strlen() 函数返回字符串的长度
                    break;

                }

            }
        }
  */
        $depr = C('URL_PATHINFO_DEPR');   //PATHINFO模式下，各参数之间的分割符号，一般为'/'
       // die(empty($depr));
        define('MODULE_PATHINFO_DEPR',  $depr);

        /*
到此为止，我们的兼容应该都处理完了。如果前面的兼容情况下获得了pathinfo的值，那么$_SERVER['PATH_INFO']这里的会有值。
        如果没有获得，那么在pathinfo模式下$_SERVER['PATH_INFO']这里应该也可以取得到值。
所以下面判断如果此$_SERVER['PATH_INFO']还为空，就是在无能为力了。直接定义PATH_INFO,__INFO__,__EXT__为空。
一般情况下这段代码都不会发生的。
重要的else后面的逻辑，这是我们得到了$_SERVER['PATH_INFO']的值后要做的事情。
*/
        //  die(empty($_SERVER['PATH_INFO']));
        /*
        if(empty($_SERVER['PATH_INFO'])) {   //由于这里他奶奶的为空了。不得不其它的都为空，我日你大爷

            $_SERVER['PATH_INFO'] = '';
            define('__INFO__','');
            define('__EXT__','');
           // define('__EXT__','index.php');
            //  设定如何输出index  在根目录的话   ，这里以后多注意用调试查看值，不容易灭兼容
          //  echo $_SERVER['PATH_INFO'];
          //  echo __EXT__;
          //  echo __INFO__;
        }else{
            define('__INFO__',trim($_SERVER['PATH_INFO'],'/')); //首先去除pathinfo字符串前后的/(如果有的话)，定义常量
            // URL后缀  // URL后缀（如果url是.html或者其他的有后缀的话就拿到这个后缀）
            define('__EXT__', strtolower(pathinfo($_SERVER['PATH_INFO'],PATHINFO_EXTENSION)));
            //反过来再次把处理后的pathinfo的值赋给$_SERVER['PATH_INFO']
            $_SERVER['PATH_INFO'] = __INFO__;
            //开始从pathinfo字符串中去解析mvc。在解析前首先确定有值并且没有定义模块名称和多模块。
            if (__INFO__ && !defined('BIND_MODULE') && C('MULTI_MODULE')){ // 获取模块名,核心是绑定跟以该模块为规则结构
                $paths      =   explode($depr,__INFO__,2);
               // $allowList = C('MODULE_ALLOW_LIST'); // 允许的模块列表
                //一般我们的url例如/moudles/con/action/这样的形式我们解析出的$paths就会是moudles，所以下面这句就没有啥作用。
//但是如果解析出的pathinfo是有扩展名称的，例如moudles.html.   那么如果我们要解析出模块名称的话，那么就需下面一句去掉扩展名称。

                $module     =   preg_replace('/\.' . __EXT__ . '$/i', '',$paths[0]);   // 执行一个正则表达式的搜索和替换
                //解析出模块后，就要验证是不是我们允许的模块，如果是的话我们就把它放到$_GET中。并且重新定义pathinfo的值，
                //这个时候的pathinfo的值应该是去掉模块名称字符串以后的值。重新赋给$_SERVER['PATH_INFO'] 。
                //自此为止，我们已经解析出了模块的名称。
                $_GET[$varModule]       =   $module;
                $_SERVER['PATH_INFO']   =   isset($paths[1])?$paths[1]:'';
            }
        }
*/
        // URL常量 得到当前的url
        define('_PHP_FILE_', rtrim($_SERVER['SCRIPT_NAME'],'/'));
       define('__SELF__',strip_tags($_SERVER[C('URL_REQUEST_URI')])); //这个基本最全面的网址，比较靠谱，指定访问页面，剥离不必要的标签  默认为REQUEST_URI
      //  define('__SELF__',strip_tags($_SERVER["REQUEST_URI"]));
        // 获取模块名称 重新构造了C('_APP_NAME')的模块值
        define('APP_NAME', defined('BIND_MODULE')? strtolower(BIND_MODULE) : self::getModule($varModule));
        C('_APP_NAME', APP_NAME);     //赋值 后的调用要注意，逻辑有点小BUG
         // die(BIND_MODULE);
        // 获取模块名称  另一个模型的名称兼容版本
        // 获取模块名称，如果绑定死了模块就使用这个，如果没有绑定死模块就获得前面得到的模块名称给MODULE_NAME常量
        define('MODULE_NAME', defined('BIND_MODULE')? BIND_MODULE : self::getModule($varModule));
//下面的一系列的都是在得到模块名称后定义其他的模块配置。比如路径，配置文件等等。
        // 检测模块是否存在


        // 检测模块是否存在
      //  if( APP_NAME && defined('BIND_MODULE') && is_dir(APP_PATH.APP_NAME)){
           if( APP_NAME  && is_dir(APP_PATH.APP_NAME)){

            // 定义当前模块路径
            define('MODULE_PATH', APP_PATH.APP_NAME.'/');

            // 加载模块配置文件
            if(is_file(MODULE_PATH.'config/config.php'))
                C(load_config(MODULE_PATH.'config/config.php'));

            // 加载模块函数文件
            if(is_file(MODULE_PATH.'box/function.php'))
                include MODULE_PATH.'box/function.php';

            // 加载模块的扩展配置文件
            load_ext_file(MODULE_PATH);
        }else{
             E('模块不存在:'.APP_NAME);
           //('模块不存在:'.APP_NAME);
        }
         //定义入口文件的地址。不同的url模式下入口文件也是不一样的。
        if(!defined('__APP__')){

            $urlMode = C('URL_MODEL');
            if($urlMode == 3){// 兼容模式判断
                define('PHP_FILE',_PHP_FILE_.'?'.$varPath.'=');
            }elseif($urlMode == 2) {
                $url = dirname(_PHP_FILE_);
                if($url == '/' || $url == '\\')
                    $url    =   '';
                define('PHP_FILE',$url);
            }else {
                define('PHP_FILE',_PHP_FILE_);
            }
            // 当前应用地址
            define('__APP__', strip_tags(PHP_FILE));
        }
        // 模块URL地址
        $moduleName    =   defined('MODULE_ALIAS')? MODULE_ALIAS : APP_NAME;
        //  多模块的结构修改，不区别大小写配置
        define('__MODULE__',(defined('BIND_MODULE') || !C('MULTI_MODULE'))? __APP__ : __APP__.'/'.($urlCase ? strtolower($moduleName) : $moduleName));
        /*
        下面开始解析控制器和操作，同时如果有路由规则的话，就先解析路由规则。
        */



        /*
        if('' != $_SERVER['PATH_INFO'] && (!C('URL_ROUTER_ON') ||  !Route::check()) ){   // 检测路由规则 如果没有则按默认规则调度URL   2017并未使用该项目

            // 去除URL后缀
            $_SERVER['PATH_INFO'] = preg_replace(C('URL_HTML_SUFFIX')? '/\.('.trim(C('URL_HTML_SUFFIX'),'.').')$/i' : '/\.'.__EXT__.'$/i', '', $_SERVER['PATH_INFO']);

            $depr   =   C('URL_PATHINFO_DEPR');
            $paths  =   explode($depr,trim($_SERVER['PATH_INFO'],$depr));

            if(!defined('BIND_CONTROLLER')) {// 获取控制器
                if(C('CONTROLLER_LEVEL')>1){// 控制器层次
                    $_GET[$varController]   =   implode('/',array_slice($paths,0,C('CONTROLLER_LEVEL')));
                    $paths  =   array_slice($paths, C('CONTROLLER_LEVEL'));
                }else{
                    $_GET[$varController]   =   array_shift($paths);
                }
            }
            // 获取操作
            if(!defined('BIND_ACTION')){
                $_GET[$varAction]  =   array_shift($paths);
            }
            // 解析剩余的URL参数
            $var = array();
            if(C('URL_PARAMS_BIND') && 1 == C('URL_PARAMS_BIND_TYPE')){
                $var = $paths; // URL参数按顺序绑定变量
            }else{
                preg_replace('@(\w+)\/([^\/]+)@e', '$var[\'\\1\']=strip_tags(\'\\2\');', implode('/',$paths));
            }
            $_GET = array_merge($var,$_GET);
        }

         */
        // 获取控制器和操作名
        define('CONTROLLER_NAME',   defined('BIND_CONTROLLER')? BIND_CONTROLLER : self::getController($varController,$urlCase));
        define('ACTION_NAME',       defined('BIND_ACTION')? BIND_ACTION : self::getAction($varAction,$urlCase));

        // 当前控制器的UR地址
        $controllerName    =   defined('CONTROLLER_ALIAS')? CONTROLLER_ALIAS : CONTROLLER_NAME;
        define('__CONTROLLER__',__MODULE__.$depr.(defined('BIND_CONTROLLER')? '': ( $urlCase ? parse_name($controllerName) : $controllerName )) );

        // 当前操作的URL地址
        define('__ACTION__',__CONTROLLER__.$depr.(defined('ACTION_ALIAS')?ACTION_ALIAS:ACTION_NAME));

        //保证$_REQUEST正常取值  合并数组
        $_REQUEST = array_merge($_POST,$_GET);

    }

    /**
     * 获得实际的控制器名称
     */


    static private function getController($var,$urlCase) {
        $controller = (!empty($_GET[$var])? $_GET[$var]:DEFAULT_CONTROLLER);

        unset($_GET[$var]);
        if($maps = C('URL_CONTROLLER_MAP')) {
            if(isset($maps[strtolower($controller)])) {
                // 记录当前别名
                define('CONTROLLER_ALIAS',strtolower($controller));
                // 获取实际的控制器名
                return ucfirst($maps[CONTROLLER_ALIAS]);
            }elseif(array_search(strtolower($controller),$maps)){
                // 禁止访问原始控制器
                return   '';
            }
        }
        if($urlCase) {
            // URL地址不区分大小写
            // 智能识别方式 user_type 识别到 UserTypeController 控制器
            $controller = parse_name($controller,1);
        }
        return strip_tags(ucfirst($controller));
    }

    /**
     * 获得实际的操作名称
     */
    static private function getAction($var,$urlCase) {
        $action = !empty($_POST[$var]) ? $_POST[$var] : (!empty($_GET[$var])?$_GET[$var]:DEFAULT_ACTION);
        unset($_POST[$var],$_GET[$var]);
        if($maps = C('URL_ACTION_MAP')) {
            if(isset($maps[strtolower(CONTROLLER_NAME)])) {
                $maps =   $maps[strtolower(CONTROLLER_NAME)];
                if(isset($maps[strtolower($action)])) {
                    // 记录当前别名
                    define('ACTION_ALIAS',strtolower($action));
                    // 获取实际的操作名
                    if(is_array($maps[ACTION_ALIAS])){
                        parse_str($maps[ACTION_ALIAS][1],$vars);
                        $_GET   =   array_merge($_GET,$vars);
                        return $maps[ACTION_ALIAS][0];
                    }else{
                        return $maps[ACTION_ALIAS];
                    }

                }elseif(array_search(strtolower($action),$maps)){
                    // 禁止访问原始操作
                    return   '';
                }
            }
        }
        return strip_tags( $urlCase ? strtolower($action) : $action );

    }

    /**
     * 获得实际的模块名称
     */
    static private function getModule($var) {
        $module = (!empty($_GET[$var])?$_GET[$var]:DEFAULT_APP);
      // die(empty($_GET[$var]));
        unset($_GET[$var]);
        if($maps = C('URL_MODULE_MAP') && isset($var[$varModule]))  {
            if(isset($maps[strtolower($module)])) {
                // 记录当前别名
                define('MODULE_ALIAS',strtolower($module));
                // 获取实际的模块名
                return ucfirst($maps[MODULE_ALIAS]);
            }elseif(array_search(strtolower($module),$maps)){
                // 禁止访问原始模块
                return   '';
            }
        }
        return strip_tags(strtolower($module));
    }

}
