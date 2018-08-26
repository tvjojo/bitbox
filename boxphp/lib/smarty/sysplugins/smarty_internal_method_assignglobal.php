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
 * Smarty Method AssignGlobal
 *
 * Smarty::assignGlobal() method
 *
 * @package    Smarty
 * @subpackage PluginsInternal
 * @author     Uwe Tews
 */
class Smarty_Internal_Method_AssignGlobal
{
    /**
     * Valid for all objects
     *
     * @var int
     */
    public $objMap = 7;

    /**
     * assigns a global Smarty variable
     *
     * @param \Smarty_Internal_Data|\Smarty_Internal_Template|\Smarty $data
     * @param  string                                                 $varName the global variable name
     * @param  mixed                                                  $value   the value to assign
     * @param  boolean                                                $nocache if true any output of this variable will be not cached
     *
     * @return \Smarty_Internal_Data|\Smarty_Internal_Template|\Smarty
     */
    public function assignGlobal(Smarty_Internal_Data $data, $varName, $value = null, $nocache = false)
    {
        if ($varName != '') {
            Smarty::$global_tpl_vars[ $varName ] = new Smarty_Variable($value, $nocache);
            $ptr = $data;
            while ($ptr->_objType == 2) {
                $ptr->tpl_vars[ $varName ] = clone Smarty::$global_tpl_vars[ $varName ];
                $ptr = $ptr->parent;
            }
        }
        return $data;
    }
}