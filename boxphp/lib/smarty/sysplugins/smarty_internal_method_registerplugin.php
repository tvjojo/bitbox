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
 * Smarty Method RegisterPlugin
 *
 * Smarty::registerPlugin() method
 *
 * @package    Smarty
 * @subpackage PluginsInternal
 * @author     Uwe Tews
 */
class Smarty_Internal_Method_RegisterPlugin
{
    /**
     * Valid for Smarty and template object
     *
     * @var int
     */
    public $objMap = 3;

    /**
     * Registers plugin to be used in templates
     *
     * @api  Smarty::registerPlugin()
     * @link http://www.smarty.net/docs/en/api.register.plugin.tpl
     *
     * @param \Smarty_Internal_TemplateBase|\Smarty_Internal_Template|\Smarty $obj
     * @param  string                                                         $type       plugin type
     * @param  string                                                         $name       name of template tag
     * @param  callback                                                       $callback   PHP callback to register
     * @param  bool                                                           $cacheable  if true (default) this
     *                                                                                    function is cache able
     * @param  mixed                                                          $cache_attr caching attributes if any
     *
     * @return \Smarty|\Smarty_Internal_Template
     * @throws SmartyException              when the plugin tag is invalid
     */
    public function registerPlugin(Smarty_Internal_TemplateBase $obj, $type, $name, $callback, $cacheable = true,
                                   $cache_attr = null)
    {
        $smarty = isset($obj->smarty) ? $obj->smarty : $obj;
        if (isset($smarty->registered_plugins[ $type ][ $name ])) {
            throw new SmartyException("Plugin tag \"{$name}\" already registered");
        } elseif (!is_callable($callback)) {
            throw new SmartyException("Plugin \"{$name}\" not callable");
        } else {
            $smarty->registered_plugins[ $type ][ $name ] = array($callback, (bool) $cacheable, (array) $cache_attr);
        }
        return $obj;
    }
}