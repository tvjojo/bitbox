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
 * Smarty plugin
 *
 * @package    Smarty
 * @subpackage PluginsModifierCompiler
 */

/**
 * Smarty wordwrap modifier plugin
 * Type:     modifier<br>
 * Name:     wordwrap<br>
 * Purpose:  wrap a string of text at a given length
 *
 * @link   http://smarty.php.net/manual/en/language.modifier.wordwrap.php wordwrap (Smarty online manual)
 * @author Uwe Tews
 *
 * @param array $params parameters
 * @param       $compiler
 *
 * @return string with compiled code
 */
function smarty_modifiercompiler_wordwrap($params, $compiler)
{
    if (!isset($params[ 1 ])) {
        $params[ 1 ] = 80;
    }
    if (!isset($params[ 2 ])) {
        $params[ 2 ] = '"\n"';
    }
    if (!isset($params[ 3 ])) {
        $params[ 3 ] = 'false';
    }
    $function = 'wordwrap';
    if (Smarty::$_MBSTRING) {
        if ($compiler->template->caching && ($compiler->tag_nocache | $compiler->nocache)) {
            $compiler->parent_compiler->template->compiled->required_plugins[ 'nocache' ][ 'wordwrap' ][ 'modifier' ][ 'file' ] =
                SMARTY_PLUGINS_DIR . 'shared.mb_wordwrap.php';
            $compiler->template->required_plugins[ 'nocache' ][ 'wordwrap' ][ 'modifier' ][ 'function' ] =
                'smarty_mb_wordwrap';
        } else {
            $compiler->parent_compiler->template->compiled->required_plugins[ 'compiled' ][ 'wordwrap' ][ 'modifier' ][ 'file' ] =
                SMARTY_PLUGINS_DIR . 'shared.mb_wordwrap.php';
            $compiler->parent_compiler->template->compiled->required_plugins[ 'compiled' ][ 'wordwrap' ][ 'modifier' ][ 'function' ] =
                'smarty_mb_wordwrap';
        }
        $function = 'smarty_mb_wordwrap';
    }

    return $function . '(' . $params[ 0 ] . ',' . $params[ 1 ] . ',' . $params[ 2 ] . ',' . $params[ 3 ] . ')';
}
