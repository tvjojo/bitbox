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
 * Smarty Method LoadFilter
 *
 * Smarty::loadFilter() method
 *
 * @package    Smarty
 * @subpackage PluginsInternal
 * @author     Uwe Tews
 */
class Smarty_Internal_Method_LoadFilter
{
    /**
     * Valid for Smarty and template object
     *
     * @var int
     */
    public $objMap = 3;

    /**
     * Valid filter types
     *
     * @var array
     */
    private $filterTypes = array('pre' => true, 'post' => true, 'output' => true, 'variable' => true);

    /**
     * load a filter of specified type and name
     *
     * @api  Smarty::loadFilter()
     *
     * @link http://www.smarty.net/docs/en/api.load.filter.tpl
     *
     * @param \Smarty_Internal_TemplateBase|\Smarty_Internal_Template|\Smarty $obj
     * @param  string                                                         $type filter type
     * @param  string                                                         $name filter name
     *
     * @return bool
     * @throws SmartyException if filter could not be loaded
     */
    public function loadFilter(Smarty_Internal_TemplateBase $obj, $type, $name)
    {
        $smarty = isset($obj->smarty) ? $obj->smarty : $obj;
        $this->_checkFilterType($type);
        $_plugin = "smarty_{$type}filter_{$name}";
        $_filter_name = $_plugin;
        if (is_callable($_plugin)) {
            $smarty->registered_filters[ $type ][ $_filter_name ] = $_plugin;
            return true;
        }
        if ($smarty->loadPlugin($_plugin)) {
            if (class_exists($_plugin, false)) {
                $_plugin = array($_plugin, 'execute');
            }
            if (is_callable($_plugin)) {
                $smarty->registered_filters[ $type ][ $_filter_name ] = $_plugin;
                return true;
            }
        }
        throw new SmartyException("{$type}filter \"{$name}\" not found or callable");
    }

    /**
     * Check if filter type is valid
     *
     * @param string $type
     *
     * @throws \SmartyException
     */
    public function _checkFilterType($type)
    {
        if (!isset($this->filterTypes[ $type ])) {
            throw new SmartyException("Illegal filter type \"{$type}\"");
        }
    }
}