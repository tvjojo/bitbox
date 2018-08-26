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
 * Smarty Internal Plugin Compile Capture
 * Compiles the {capture} tag
 *
 * @package    Smarty
 * @subpackage Compiler
 * @author     Uwe Tews
 */

/**
 * Smarty Internal Plugin Compile Capture Class
 *
 * @package    Smarty
 * @subpackage Compiler
 */
class Smarty_Internal_Compile_Capture extends Smarty_Internal_CompileBase
{
    /**
     * Attribute definition: Overwrites base class.
     *
     * @var array
     * @see Smarty_Internal_CompileBase
     */
    public $shorttag_order = array('name');

    /**
     * Attribute definition: Overwrites base class.
     *
     * @var array
     * @see Smarty_Internal_CompileBase
     */
    public $optional_attributes = array('name', 'assign', 'append');

    /**
     * Compiles code for the {$smarty.capture.xxx}
     *
     * @param  array                            $args      array with attributes from parser
     * @param \Smarty_Internal_TemplateCompilerBase$compiler  compiler object
     * @param  array                            $parameter array with compilation parameter
     *
     * @return string compiled code
     * @throws \SmartyCompilerException
     */
    public static function compileSpecialVariable($args, Smarty_Internal_TemplateCompilerBase $compiler, $parameter = null)
    {
        $tag = trim($parameter[ 0 ], '"\'');
        $name = isset($parameter[ 1 ]) ? $compiler->getId($parameter[ 1 ]) : false;
        if (!$name) {
            $compiler->trigger_template_error("missing or illegal \$smarty.{$tag} name attribute", null, true);
        }
        return "\$_smarty_tpl->smarty->ext->_capture->getBuffer(\$_smarty_tpl, '{$name}')";
    }

    /**
     * Compiles code for the {capture} tag
     *
     * @param  array                            $args     array with attributes from parser
     * @param \Smarty_Internal_TemplateCompilerBase $compiler compiler object
     * @param null                              $parameter
     *
     * @return string compiled code
     */
    public function compile($args, Smarty_Internal_TemplateCompilerBase $compiler, $parameter = null)
    {
        // check and get attributes
        $_attr = $this->getAttributes($compiler, $args, $parameter, 'capture');

        $buffer = isset($_attr[ 'name' ]) ? $_attr[ 'name' ] : "'default'";
        $assign = isset($_attr[ 'assign' ]) ? $_attr[ 'assign' ] : 'null';
        $append = isset($_attr[ 'append' ]) ? $_attr[ 'append' ] : 'null';

        $compiler->_cache[ 'capture_stack' ][] = array($compiler->nocache);
        // maybe nocache because of nocache variables
        $compiler->nocache = $compiler->nocache | $compiler->tag_nocache;
        $_output = "<?php \$_smarty_tpl->smarty->ext->_capture->open(\$_smarty_tpl, $buffer, $assign, $append);\n?>\n";

        return $_output;
    }
}

/**
 * Smarty Internal Plugin Compile Captureclose Class
 *
 * @package    Smarty
 * @subpackage Compiler
 */
class Smarty_Internal_Compile_CaptureClose extends Smarty_Internal_CompileBase
{
    /**
     * Compiles code for the {/capture} tag
     *
     * @param  array                            $args     array with attributes from parser
     * @param \Smarty_Internal_TemplateCompilerBase $compiler compiler object
     * @param null                              $parameter
     *
     * @return string compiled code
     */
    public function compile($args, Smarty_Internal_TemplateCompilerBase $compiler, $parameter)
    {
        // check and get attributes
        $_attr = $this->getAttributes($compiler, $args, $parameter, '/capture');
        // must endblock be nocache?
        if ($compiler->nocache) {
            $compiler->tag_nocache = true;
        }

        list($compiler->nocache) = array_pop($compiler->_cache[ 'capture_stack' ]);

        return "<?php \$_smarty_tpl->smarty->ext->_capture->close(\$_smarty_tpl);\n?>\n";
    }
}
