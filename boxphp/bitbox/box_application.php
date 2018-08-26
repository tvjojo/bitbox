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
 * Time: 下午 13:47
 */
if (!defined('IN_BOX'))
{
    die('Hacking attempt 非法入侵');
}

class box_application extends box_base
{

    static function &instance() {
        static $object;
        if(empty($object)) {
            $object = new self();
        }
        return $object;
    }

    public function __construct() {
        $this->_init_env();
        $this->_init_config();
        $this->_init_input();
        $this->_init_output();
    }

    public function init() {
        if(!$this->initated) {
            $this->_init_db();
            $this->_init_setting();
            $this->_init_user();
            $this->_init_session();
            $this->_init_mobile();
            $this->_init_cron();
            $this->_init_misc();
        }
        $this->initated = true;
    }



}

