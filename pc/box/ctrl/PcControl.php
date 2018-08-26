<?php
/**
 *   ============================================================================
 *  Copyright (c) 2017. 本软件系统由北天团队与投缘互联团队共同开发，对于非商业用途
 *  的代码使用完全免费，而对商业用户经过我方授权后也可免费使用，但所有用户不得任意破坏
 *  我们设计的产品结构，也不得使用该软件做为非法用途.如果商业用户希望获得一些平台型的支
 *  持，以及获得我方各类接口的支持，也可联系我方购买更丰富的支持.
 *   ============================================================================
 */

/**
 * User: Huangbt
 * Date: 2017/9/23 0023
 * Time: 上午 8:57
 */
echo "PcControlPcControlPcControlPcControlPcControl</br>";
class PcControl extends BasePcControl {
    protected static $user = NULL;

    protected static $sess = NULL;

    protected static $view = NULL;

     public function __construct()
     {
         parent::__construct();
         $this->pc_init();

         /* 模板赋值 */
     //    assign_template();
     }

    static function view()
    {
         return self::$view;
    }

    protected function assign($tpl_var, $value = '')
    {
       // self::$view = new Smarty();
       self::$view->assign($tpl_var, $value);
    }

    protected function display($tpl = '', $cache_id = '', $return = false)
    {
    //    self::$view = new Smarty();
       self::$view->display($tpl, $cache_id);
    }



//BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB
        protected function pc_init(){
                  //die(SSSSSSSSSSSSSSSSSSSSSSSSSS);
        // 创建 Smarty 对象
            self::$view = new Smarty();
        //self::$view->cache_lifetime = C('cache_time');
        self::$view->cache_lifetime = 120;

        self::$view->cache_dir = ROOT_PATH . 'pc/temp/cache/caches';
        self::$view->compile_dir = ROOT_PATH . 'pc/temp/data/cache/compiled';
        self::$view->caching = true;


        self::$view->template_dir = './view/template' ;                  //APP_BASEPATH . 'view/';


    //    $smarty->debugging = true;
     //   $smarty->caching = true;
      //  $smarty->cache_lifetime = 120;
      //  $smarty =new Smarty();
      //  $smarty->template_dir = ROOT_PATH . 'pc/view/template/';

/*
        if ((DEBUG_MODE & 2) == 2) {
            self::$view->direct_output = true;
            self::$view->force_compile = true;
        } else {
            self::$view->direct_output = false;
            self::$view->force_compile = false;
        }

*/


        // 判断是否支持gzip模式
   //     if (gzip_enabled()) {
      //      ob_start('ob_gzhandler');
     //   }


        // 模板替换
  //    defined('__TPL__') or define('__TPL__', __ROOT__ . '/pc/view/' . C('template'));
   //     $stylename = C('stylename');
    //    if (! empty($stylename)) {
    //        $this->assign('ectouch_css_path', __ROOT__ . '/themes/' . C('template') . '/css/ectouch_' . C('stylename') . '.css');
     //   } else {
      //      $this->assign('ectouch_css_path', __ROOT__ . '/themes/' . C('template') . '/css/ectouch.css');
      //  }
    }


}
//BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB
class_alias('PcControl', 'PcCtrl');