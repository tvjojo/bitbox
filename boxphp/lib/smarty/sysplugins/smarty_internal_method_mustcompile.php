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
 * Smarty Method MustCompile
 *
 * Smarty_Internal_Template::mustCompile() method
 *
 * @package    Smarty
 * @subpackage PluginsInternal
 * @author     Uwe Tews
 */
class Smarty_Internal_Method_MustCompile
{
    /**
     * Valid for template object
     *
     * @var int
     */
    public $objMap = 2;

    /**
     * Returns if the current template must be compiled by the Smarty compiler
     * It does compare the timestamps of template source and the compiled templates and checks the force compile
     * configuration
     *
     * @param \Smarty_Internal_Template $_template
     *
     * @return bool
     * @throws \SmartyException
     */
    public function mustCompile(Smarty_Internal_Template $_template)
    {
        if (!$_template->source->exists) {
            if (isset($_template->parent) && $_template->parent->_objType == 2) {
                $parent_resource = " in '$_template->parent->template_resource}'";
            } else {
                $parent_resource = '';
            }
            throw new SmartyException("Unable to load template {$_template->source->type} '{$_template->source->name}'{$parent_resource}");
        }
        if ($_template->mustCompile === null) {
            $_template->mustCompile = (!$_template->source->handler->uncompiled &&
                                       ($_template->smarty->force_compile || $_template->source->handler->recompiled ||
                                        !$_template->compiled->exists || ($_template->smarty->compile_check &&
                                                                          $_template->compiled->getTimeStamp() <
                                                                          $_template->source->getTimeStamp())));
        }

        return $_template->mustCompile;
    }
}