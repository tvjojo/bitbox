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

echo "BASECtrlBASECtrl基础控制配置底BASECtrlBASECtrl</br>";
class BaseCtrl {

   //  protected $model = NULL; //   数据库模型
     protected $layout = NULL; //布局视图
     private $_data = array();

    public function __construct() {
     //   $this->model = model('Base')->model;    // 处理ECS合作mysql使用
    //     die(KKKKKKKKKKKKKKKKKKKKKKK);
        // 定义当前请求的系统常量

     //   var $input = array();

        define('NOW_TIME', $_SERVER ['REQUEST_TIME']);
        define('REQUEST_METHOD', $_SERVER ['REQUEST_METHOD']);
        define('IS_GET', REQUEST_METHOD == 'GET' ? true : false );
        define('IS_POST', REQUEST_METHOD == 'POST' ? true : false );    // 未来会慢慢用input 之类的替代掉，暂时用来做一些存储类的判断，大爷的。用户注册在用啊。
        define('IS_PUT', REQUEST_METHOD == 'PUT' ? true : false );
        define('IS_DELETE', REQUEST_METHOD == 'DELETE' ? true : false );
        define('IS_AJAX', (isset($_SERVER ['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER ['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'));


    }

    public function __get($name) {
        return isset($this->_data [$name]) ? $this->_data [$name] : NULL;
    }

    public function __set($name, $value) {
        $this->_data [$name] = $value;
    }


    //获取模板对象
    protected function tpl() {
        static $view = NULL;
        if (empty($view)) {
            $view = new template(C('TPL'));     //用于调取自定义的一种模版结构，将来可以自己独创优化一个新的。
          //  $view = new Smarty(C('TPL'));
        }
        return $view;
    }


    //模板赋值
    protected function assign($name, $value) {
        return $this->tpl()->assign($name, $value);
    }

/*
    function init_input($getagent = '') {
        $input = getgpc('input', 'R');
        if($input) {
            $input = $this->authcode($input, 'DECODE', $this->app['authkey']);
            parse_str($input, $this->input);
            $this->input = daddslashes($this->input, 1, TRUE);
            $agent = $getagent ? $getagent : $this->input['agent'];

            if(($getagent && $getagent != $this->input['agent']) || (!$getagent && md5($_SERVER['HTTP_USER_AGENT']) != $agent)) {
                exit('Access denied for agent changed');
            } elseif($this->time - $this->input('time') > 3600) {
                exit('Authorization has expired');
            }
        }
        if(empty($this->input)) {
            exit('Invalid input');
        }
    }
*/
    function input($k) {
        if($k == 'user_name' && !preg_match("/^[0-9]+$/", $this->input[$k])){
            return NULL;
        }
        return isset($this->input[$k]) ? (is_array($this->input[$k]) ? $this->input[$k] : trim($this->input[$k])) : NULL;
    }



    //  模板显示
    protected function display($tpl = '', $return = false, $is_tpl = true) {
        if ($is_tpl) {
            $tpl = empty($tpl) ? strtolower(CONTROLLER_NAME . '_' . ACTION_NAME) : $tpl;
            if ($is_tpl && $this->layout) {
                $this->__template_file = $tpl;
                $tpl = $this->layout;
            }
        }
        $this->tpl()->config ['TPL_TEMPLATE_PATH'] = APP_BASEPATH  . 'view/template/';  // APP_PATH . 'app/' . C('_APP_NAME') . '/view/';   针对自定义的模版块
        $this->tpl()->assign($this->_data);
        return $this->tpl()->display($tpl, $return, $is_tpl);
    }

    //  直接跳转
    protected function redirect($url, $code = 302) {
        header('location:' . $url, true, $code);
        exit();
    }



}