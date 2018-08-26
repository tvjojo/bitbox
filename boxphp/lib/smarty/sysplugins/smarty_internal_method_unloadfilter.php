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
 * Smarty Method UnloadFilter
 *
 * Smarty::unloadFilter() method
 *
 * @package    Smarty
 * @subpackage PluginsInternal
 * @author     Uwe Tews
 */
class Smarty_Internal_Method_UnloadFilter extends Smarty_Internal_Method_LoadFilter
{
    /**
     * load a filter of specified type and name
     *
     * @api  Smarty::unloadFilter()
     *
     * @link http://www.smarty.net/docs/en/api.unload.filter.tpl
     *
     * @param \Smarty_Internal_TemplateBase|\Smarty_Internal_Template|\Smarty $obj
     * @param  string                                                         $type filter type
     * @param  string                                                         $name filter name
     *
     * @return bool
     */
    public function unloadFilter(Smarty_Internal_TemplateBase $obj, $type, $name)
    {
        $smarty = isset($obj->smarty) ? $obj->smarty : $obj;
        $this->_checkFilterType($type);
        if (isset($smarty->registered_filters[ $type ])) {
            $_filter_name = "smarty_{$type}filter_{$name}";
            if (isset($smarty->registered_filters[ $type ][ $_filter_name ])) {
                unset ($smarty->registered_filters[ $type ][ $_filter_name ]);
                if (empty($smarty->registered_filters[ $type ])) {
                    unset($smarty->registered_filters[ $type ]);
                }
            }
        }
        return $obj;
    }
}