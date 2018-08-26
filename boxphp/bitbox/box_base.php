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
 * Time: 下午 13:48
 */


if (!defined('IN_BOX'))
{
    die('Hacking attempt 非法入侵');
}
echo   'BOX_BASEBOX_BASE格子底层BOX_BASEBOX_BASE</br>';
abstract class box_base
{

    private $_e;
    private $_m;

    public function __construct() {

    }

    public function __set($name, $value) {
        $setter='set'.$name;
        if(method_exists($this,$setter)) {
            return $this->$setter($value);
        } elseif($this->canGetProperty($name)) {
            throw new Exception('The property "'.get_class($this).'->'.$name.'" is readonly');
        } else {
            throw new Exception('The property "'.get_class($this).'->'.$name.'" is not defined');
        }
    }

    public function __get($name) {
        $getter='get'.$name;
        if(method_exists($this,$getter)) {
            return $this->$getter();
        } else {
            throw new Exception('The property "'.get_class($this).'->'.$name.'" is not defined');
        }
    }

    public function __call($name,$parameters) {
        throw new Exception('Class "'.get_class($this).'" does not have a method named "'.$name.'".');
    }

    public function canGetProperty($name)
    {
        return method_exists($this,'get'.$name);
    }

    public function canSetProperty($name)
    {
        return method_exists($this,'set'.$name);
    }

    public function __toString() {
        return get_class($this);
    }

    public function __invoke() {
        return get_class($this);
    }

}