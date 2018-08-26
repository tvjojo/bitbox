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
 * Smarty Method Append
 *
 * Smarty::append() method
 *
 * @package    Smarty
 * @subpackage PluginsInternal
 * @author     Uwe Tews
 */
class Smarty_Internal_Method_Append
{
    /**
     * Valid for all objects
     *
     * @var int
     */
    public $objMap = 7;

    /**
     * appends values to template variables
     *
     * @api  Smarty::append()
     * @link http://www.smarty.net/docs/en/api.append.tpl
     *
     * @param \Smarty_Internal_Data|\Smarty_Internal_Template|\Smarty $data
     * @param  array|string                                           $tpl_var the template variable name(s)
     * @param  mixed                                                  $value   the value to append
     * @param  bool                                                   $merge   flag if array elements shall be merged
     * @param  bool                                                   $nocache if true any output of this variable will
     *                                                                         be not cached
     *
     * @return \Smarty_Internal_Data|\Smarty_Internal_Template|\Smarty
     */
    public function append(Smarty_Internal_Data $data, $tpl_var, $value = null, $merge = false, $nocache = false)
    {
        if (is_array($tpl_var)) {
            // $tpl_var is an array, ignore $value
            foreach ($tpl_var as $_key => $_val) {
                if ($_key != '') {
                    $this->append($data, $_key, $_val, $merge, $nocache);
                }
            }
        } else {
            if ($tpl_var != '' && isset($value)) {
                if (!isset($data->tpl_vars[ $tpl_var ])) {
                    $tpl_var_inst = $data->ext->getTemplateVars->_getVariable($data, $tpl_var, null, true, false);
                    if ($tpl_var_inst instanceof Smarty_Undefined_Variable) {
                        $data->tpl_vars[ $tpl_var ] = new Smarty_Variable(null, $nocache);
                    } else {
                        $data->tpl_vars[ $tpl_var ] = clone $tpl_var_inst;
                    }
                }
                if (!(is_array($data->tpl_vars[ $tpl_var ]->value) ||
                      $data->tpl_vars[ $tpl_var ]->value instanceof ArrayAccess)
                ) {
                    settype($data->tpl_vars[ $tpl_var ]->value, 'array');
                }
                if ($merge && is_array($value)) {
                    foreach ($value as $_mkey => $_mval) {
                        $data->tpl_vars[ $tpl_var ]->value[ $_mkey ] = $_mval;
                    }
                } else {
                    $data->tpl_vars[ $tpl_var ]->value[] = $value;
                }
            }
            if ($data->_objType == 2 && $data->scope) {
                $data->ext->_updateScope->_updateScope($data, $tpl_var);
            }
        }
        return $data;
    }
}