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
 * Date: 2017/9/23 0023
 * Time: 上午 8:57
 */

echo "BsePcControlBsePcControlBsePcControlBsePcControl</br>";
class BasePcControl extends BaseCtrl
{
    protected static $err = NULL;
    protected $appConfig = array();
      protected static $db = NULL;

     public function  __construct()
     {  parent::__construct();
         $this->appConfig = C('APP');

         $this->_initialize();
      //   $this->_common();
     }

//die("diediediediediediediediediediediediediediediediediediedie");

    /*
    public  function  index(){
        $this->assign('error', $error);
         $this->display();
    }
*/

    static function & db() {
        return self::$db;
    }
//BBBBBBBBBBBBBBBBBBBBBBBBBBBBBB
    private function _initialize() {
        //初始化设置
        @ini_set('memory_limit', '64M');
        @ini_set('session.cache_expire', 180);
        @ini_set('session.use_cookies', 1);
        @ini_set('session.auto_start', 0);
        @ini_set('display_errors', 1);
        @ini_set("arg_separator.output", "&amp;");
        @ini_set('include_path', '.;' . BASE_PATH);
        //加载系统常量和函数库
      //  require(BASE_PATH . 'base/constant.php');
         require(APP_BASEPATH . 'box/function.php');
        //对用户传入的变量进行转义操作
        /*
      //  if (!get_magic_quotes_gpc()) {
            if (!empty($_GET)) {
                $_GET = addslashes($_GET);
            }
            if (!empty($_POST)) {
                $_POST = addslashes($_POST);
            }
            $_COOKIE = addslashes($_COOKIE);
            $_REQUEST = addslashes($_REQUEST);
       // }
          */
            //初始化数据库类
      //   self::$db = new BitMysqli(C('DB_HOST'), C('DB_USER'), C('DB_PWD'), C('DB_NAME'));  //老的ECS兼容处理，可以关闭,整合再打开
        //创建错误处理对象
        self::$err = new Error('message.dwt');
        //载入系统参数
     //   C('CFG', model('Base')->load_config());

    }
//BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB
    static function err() {
        return self::$err;
    }
/*
    protected function display($tpl = '', $return = false, $is_tpl = true) {
        if ($is_tpl) {
            $tpl = empty($tpl) ? strtolower(CONTROLLER_NAME . '_' . ACTION_NAME) : $tpl;
            if ($is_tpl && $this->layout) {
                $this->__template_file = $tpl;
                $tpl = $this->layout;
            }
        }
        $this->tpl()->config ['TPL_TEMPLATE_PATH'] = BASE_PATH . 'apps/' . C('_APP_NAME') . '/view/';
        $this->tpl()->assign($this->_data);
        return $this->tpl()->display($tpl, $return, $is_tpl);
    }


*/

    //载入函数、语言文件
    private function _common() {
        //加载模板解析扩展函数
   //     require(BASE_PATH . 'template.php');
    }


}
