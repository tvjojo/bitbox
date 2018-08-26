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
 * Smarty Method GetTags
 *
 * Smarty::getTags() method
 *
 * @package    Smarty
 * @subpackage PluginsInternal
 * @author     Uwe Tews
 */
class Smarty_Internal_Method_GetTags
{
    /**
     * Valid for Smarty and template object
     *
     * @var int
     */
    public $objMap = 3;

    /**
     * Return array of tag/attributes of all tags used by an template
     *
     * @api  Smarty::getTags()
     * @link http://www.smarty.net/docs/en/api.get.tags.tpl
     *
     * @param \Smarty_Internal_TemplateBase|\Smarty_Internal_Template|\Smarty $obj
     * @param null|string|Smarty_Internal_Template                            $template
     *
     * @return array of tag/attributes
     * @throws \SmartyException
     */
    public function getTags(Smarty_Internal_TemplateBase $obj, $template = null)
    {
        /* @var Smarty $smarty */
        $smarty = isset($this->smarty) ? $this->smarty : $obj;
        if ($obj->_objType == 2 && !isset($template)) {
            $tpl = clone $obj;
        } elseif (isset($template) && $template->_objType == 2) {
            $tpl = clone $template;
        } elseif (isset($template) && is_string($template)) {
            /* @var Smarty_Internal_Template $tpl */
            $tpl = new $smarty->template_class($template, $smarty);
            // checks if template exists
            if (!$tpl->source->exists) {
                throw new SmartyException("Unable to load template {$tpl->source->type} '{$tpl->source->name}'");
            }
        }
        if (isset($tpl)) {
            $tpl->smarty = clone $tpl->smarty;
            $tpl->smarty->_cache[ 'get_used_tags' ] = true;
            $tpl->_cache[ 'used_tags' ] = array();
            $tpl->smarty->merge_compiled_includes = false;
            $tpl->smarty->disableSecurity();
            $tpl->caching = false;
            $tpl->loadCompiler();
            $tpl->compiler->compileTemplate($tpl);
            return $tpl->_cache[ 'used_tags' ];
        }
        throw new SmartyException("Missing template specification");
    }
}