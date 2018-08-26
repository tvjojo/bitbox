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
 * Time: 下午 13:25
 */



define('APPNAME','BITbox');
define('VERSION','b1.0.1');



echo  "corecorecorecorecorecore";
//C::creatapp();

class  core
{
    /*
     var $db_name ='';
     var $prefix = 'box_';

    function BOXDATA($db_name, $prefix)
    {
        $this->db_name = $db_name;
        $this->prefix  = $prefix;
    }

    */

    //private static $_tables;
    //private static $_imports;
    private static $_app;
   // private static $_memory;

    public static function app() {
        return self::$_app;
    }


}
class CO extends core {}


?>