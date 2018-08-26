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
 * Smarty Method RegisterFilter
 *
 * Smarty::registerFilter() method
 *
 * @package    Smarty
 * @subpackage PluginsInternal
 * @author     Uwe Tews
 */
class Smarty_Internal_Method_RegisterFilter
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
     * Registers a filter function
     *
     * @api  Smarty::registerFilter()
     *
     * @link http://www.smarty.net/docs/en/api.register.filter.tpl
     *
     * @param \Smarty_Internal_TemplateBase|\Smarty_Internal_Template|\Smarty $obj
     * @param  string                                                         $type filter type
     * @param  callback                                                       $callback
     * @param  string|null                                                    $name optional filter name
     *
     * @return \Smarty|\Smarty_Internal_Template
     * @throws \SmartyException
     */
    public function registerFilter(Smarty_Internal_TemplateBase $obj, $type, $callback, $name = null)
    {
        $smarty = isset($obj->smarty) ? $obj->smarty : $obj;
        $this->_checkFilterType($type);
        $name = isset($name) ? $name : $this->_getFilterName($callback);
        if (!is_callable($callback)) {
            throw new SmartyException("{$type}filter \"{$name}\" not callable");
        }
        $smarty->registered_filters[ $type ][ $name ] = $callback;
        return $obj;
    }

    /**
     * Return internal filter name
     *
     * @param  callback $function_name
     *
     * @return string   internal filter name
     */
    public function _getFilterName($function_name)
    {
        if (is_array($function_name)) {
            $_class_name = (is_object($function_name[ 0 ]) ? get_class($function_name[ 0 ]) : $function_name[ 0 ]);

            return $_class_name . '_' . $function_name[ 1 ];
        } elseif (is_string($function_name)) {
            return $function_name;
        } else {
            return 'closure';
        }
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