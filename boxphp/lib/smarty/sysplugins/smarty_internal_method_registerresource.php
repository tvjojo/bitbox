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
 * Smarty Method RegisterResource
 *
 * Smarty::registerResource() method
 *
 * @package    Smarty
 * @subpackage PluginsInternal
 * @author     Uwe Tews
 */
class Smarty_Internal_Method_RegisterResource
{
    /**
     * Valid for Smarty and template object
     *
     * @var int
     */
    public $objMap = 3;

    /**
     * Registers a resource to fetch a template
     *
     * @api  Smarty::registerResource()
     * @link http://www.smarty.net/docs/en/api.register.resource.tpl
     *
     * @param \Smarty_Internal_TemplateBase|\Smarty_Internal_Template|\Smarty $obj
     * @param  string                                                         $name             name of resource type
     * @param  Smarty_Resource|array                                          $resource_handler or instance of
     *                                                                                          Smarty_Resource, or
     *                                                                                          array of callbacks to
     *                                                                                          handle resource
     *                                                                                          (deprecated)
     *
     * @return \Smarty|\Smarty_Internal_Template
     */
    public function registerResource(Smarty_Internal_TemplateBase $obj, $name, $resource_handler)
    {
        $smarty = isset($obj->smarty) ? $obj->smarty : $obj;
        $smarty->registered_resources[ $name ] =
            $resource_handler instanceof Smarty_Resource ? $resource_handler : array($resource_handler, false);
        return $obj;
    }
}