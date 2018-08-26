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
 * Smarty Internal Plugin Nocache Insert
 * Compiles the {insert} tag into the cache file
 *
 * @package    Smarty
 * @subpackage Compiler
 * @author     Uwe Tews
 */

/**
 * Smarty Internal Plugin Compile Insert Class
 *
 * @package    Smarty
 * @subpackage Compiler
 */
class Smarty_Internal_Nocache_Insert
{
    /**
     * Compiles code for the {insert} tag into cache file
     *
     * @param  string                   $_function insert function name
     * @param  array                    $_attr     array with parameter
     * @param  Smarty_Internal_Template $_template template object
     * @param  string                   $_script   script name to load or 'null'
     * @param  string                   $_assign   optional variable name
     *
     * @return string                   compiled code
     */
    public static function compile($_function, $_attr, $_template, $_script, $_assign = null)
    {
        $_output = '<?php ';
        if ($_script != 'null') {
            // script which must be included
            // code for script file loading
            $_output .= "require_once '{$_script}';";
        }
        // call insert
        if (isset($_assign)) {
            $_output .= "\$_smarty_tpl->assign('{$_assign}' , {$_function} (" . var_export($_attr, true) .
                        ",\$_smarty_tpl), true);?>";
        } else {
            $_output .= "echo {$_function}(" . var_export($_attr, true) . ",\$_smarty_tpl);?>";
        }
        $_tpl = $_template;
        while (isset($_tpl->parent) && $_tpl->parent->_objType == 2) {
            $_tpl = $_tpl->parent;
        }

        return "/*%%SmartyNocache:{$_tpl->compiled->nocache_hash}%%*/" . $_output .
               "/*/%%SmartyNocache:{$_tpl->compiled->nocache_hash}%%*/";
    }
}
