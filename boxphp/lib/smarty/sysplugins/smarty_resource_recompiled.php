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
 * Smarty Resource Plugin
 *
 * @package    Smarty
 * @subpackage TemplateResources
 * @author     Rodney Rehm
 */

/**
 * Smarty Resource Plugin
 * Base implementation for resource plugins that don't compile cache
 *
 * @package    Smarty
 * @subpackage TemplateResources
 */
abstract class Smarty_Resource_Recompiled extends Smarty_Resource
{
    /**
     * Flag that it's an recompiled resource
     *
     * @var bool
     */
    public $recompiled = true;

    /**
     * Resource does implement populateCompiledFilepath() method
     *
     * @var bool
     */
    public $hasCompiledHandler = true;

    /**
     * compile template from source
     *
     * @param Smarty_Internal_Template $_smarty_tpl do not change variable name, is used by compiled template
     *
     * @throws Exception
     */
    public function process(Smarty_Internal_Template $_smarty_tpl)
    {
        $compiled = &$_smarty_tpl->compiled;
        $compiled->file_dependency = array();
        $compiled->includes = array();
        $compiled->nocache_hash = null;
        $compiled->unifunc = null;
        $level = ob_get_level();
        ob_start();
        $_smarty_tpl->loadCompiler();
        // call compiler
        try {
            eval("?>" . $_smarty_tpl->compiler->compileTemplate($_smarty_tpl));
        }
        catch (Exception $e) {
            unset($_smarty_tpl->compiler);
            while (ob_get_level() > $level) {
                ob_end_clean();
            }
            throw $e;
        }
        // release compiler object to free memory
        unset($_smarty_tpl->compiler);
        ob_get_clean();
        $compiled->timestamp = time();
        $compiled->exists = true;
    }

    /**
     * populate Compiled Object with compiled filepath
     *
     * @param  Smarty_Template_Compiled $compiled  compiled object
     * @param  Smarty_Internal_Template $_template template object
     *
     * @return void
     */
    public function populateCompiledFilepath(Smarty_Template_Compiled $compiled, Smarty_Internal_Template $_template)
    {
        $compiled->filepath = false;
        $compiled->timestamp = false;
        $compiled->exists = false;
    }

    /*
       * Disable timestamp checks for recompiled resource.
       *
       * @return bool
       */
    public function checkTimestamps()
    {
        return false;
    }
}
