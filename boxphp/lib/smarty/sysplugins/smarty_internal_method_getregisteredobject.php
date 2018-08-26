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
 * Smarty Method GetRegisteredObject
 *
 * Smarty::getRegisteredObject() method
 *
 * @package    Smarty
 * @subpackage PluginsInternal
 * @author     Uwe Tews
 */
class Smarty_Internal_Method_GetRegisteredObject
{
    /**
     * Valid for Smarty and template object
     *
     * @var int
     */
    public $objMap = 3;

    /**
     * return a reference to a registered object
     *
     * @api  Smarty::getRegisteredObject()
     * @link http://www.smarty.net/docs/en/api.get.registered.object.tpl
     *
     * @param \Smarty_Internal_TemplateBase|\Smarty_Internal_Template|\Smarty $obj
     * @param  string                                                         $object_name object name
     *
     * @return object
     * @throws \SmartyException if no such object is found
     */
    public function getRegisteredObject(Smarty_Internal_TemplateBase $obj, $object_name)
    {
        $smarty = isset($obj->smarty) ? $obj->smarty : $obj;
        if (!isset($smarty->registered_objects[ $object_name ])) {
            throw new SmartyException("'$object_name' is not a registered object");
        }
        if (!is_object($smarty->registered_objects[ $object_name ][ 0 ])) {
            throw new SmartyException("registered '$object_name' is not an object");
        }
        return $smarty->registered_objects[ $object_name ][ 0 ];
    }
}