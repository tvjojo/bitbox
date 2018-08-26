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
 * Smarty Internal Plugin Compile Registered Function
 * Compiles code for the execution of a registered function
 *
 * @package    Smarty
 * @subpackage Compiler
 * @author     Uwe Tews
 */

/**
 * Smarty Internal Plugin Compile Registered Function Class
 *
 * @package    Smarty
 * @subpackage Compiler
 */
class Smarty_Internal_Compile_Private_Registered_Function extends Smarty_Internal_CompileBase
{
    /**
     * Attribute definition: Overwrites base class.
     *
     * @var array
     * @see Smarty_Internal_CompileBase
     */
    public $optional_attributes = array('_any');

    /**
     * Compiles code for the execution of a registered function
     *
     * @param  array                                $args      array with attributes from parser
     * @param \Smarty_Internal_TemplateCompilerBase $compiler  compiler object
     * @param  array                                $parameter array with compilation parameter
     * @param  string                               $tag       name of function
     *
     * @return string compiled code
     */
    public function compile($args, Smarty_Internal_TemplateCompilerBase $compiler, $parameter, $tag)
    {
        // check and get attributes
        $_attr = $this->getAttributes($compiler, $args);
        unset($_attr[ 'nocache' ]);
        if (isset($compiler->smarty->registered_plugins[ Smarty::PLUGIN_FUNCTION ][ $tag ])) {
            $tag_info = $compiler->smarty->registered_plugins[ Smarty::PLUGIN_FUNCTION ][ $tag ];
        } else {
            $tag_info = $compiler->default_handler_plugins[ Smarty::PLUGIN_FUNCTION ][ $tag ];
        }
        // not cachable?
        $compiler->tag_nocache = $compiler->tag_nocache || !$tag_info[ 1 ];
        // convert attributes into parameter array string
        $_paramsArray = array();
        foreach ($_attr as $_key => $_value) {
            if (is_int($_key)) {
                $_paramsArray[] = "$_key=>$_value";
            } elseif ($compiler->template->caching && in_array($_key, $tag_info[ 2 ])) {
                $_value = str_replace("'", "^#^", $_value);
                $_paramsArray[] = "'$_key'=>^#^.var_export($_value,true).^#^";
            } else {
                $_paramsArray[] = "'$_key'=>$_value";
            }
        }
        $_params = 'array(' . implode(",", $_paramsArray) . ')';
        $function = $tag_info[ 0 ];
        // compile code
        if (!is_array($function)) {
            $output = "{$function}({$_params},\$_smarty_tpl)";
        } elseif (is_object($function[ 0 ])) {
            $output =
                "\$_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['{$tag}'][0][0]->{$function[1]}({$_params},\$_smarty_tpl)";
        } else {
            $output = "{$function[0]}::{$function[1]}({$_params},\$_smarty_tpl)";
        }
        if (!empty($parameter[ 'modifierlist' ])) {
            $output = $compiler->compileTag('private_modifier', array(),
                                            array('modifierlist' => $parameter[ 'modifierlist' ],
                                                  'value' => $output));
        }
        //Does tag create output
        $compiler->has_output = isset($_attr[ 'assign' ]) ? false : true;
        $output = "<?php " . ($compiler->has_output ? "echo " : '') . "{$output};?>\n";
        return $output;
    }
}
