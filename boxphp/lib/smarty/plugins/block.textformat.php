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
 * Smarty plugin to format text blocks
 *
 * @package    Smarty
 * @subpackage PluginsBlock
 */

/**
 * Smarty {textformat}{/textformat} block plugin
 * Type:     block function<br>
 * Name:     textformat<br>
 * Purpose:  format text a certain way with preset styles
 *           or custom wrap/indent settings<br>
 * Params:
 * <pre>
 * - style         - string (email)
 * - indent        - integer (0)
 * - wrap          - integer (80)
 * - wrap_char     - string ("\n")
 * - indent_char   - string (" ")
 * - wrap_boundary - boolean (true)
 * </pre>
 *
 * @link   http://www.smarty.net/manual/en/language.function.textformat.php {textformat}
 *         (Smarty online manual)
 *
 * @param array                    $params   parameters
 * @param string                   $content  contents of the block
 * @param Smarty_Internal_Template $template template object
 * @param boolean                  &$repeat  repeat flag
 *
 * @return string content re-formatted
 * @author Monte Ohrt <monte at ohrt dot com>
 */
function smarty_block_textformat($params, $content, $template, &$repeat)
{
    if (is_null($content)) {
        return;
    }

    $style = null;
    $indent = 0;
    $indent_first = 0;
    $indent_char = ' ';
    $wrap = 80;
    $wrap_char = "\n";
    $wrap_cut = false;
    $assign = null;

    foreach ($params as $_key => $_val) {
        switch ($_key) {
            case 'style':
            case 'indent_char':
            case 'wrap_char':
            case 'assign':
                $$_key = (string) $_val;
                break;

            case 'indent':
            case 'indent_first':
            case 'wrap':
                $$_key = (int) $_val;
                break;

            case 'wrap_cut':
                $$_key = (bool) $_val;
                break;

            default:
                trigger_error("textformat: unknown attribute '$_key'");
        }
    }

    if ($style == 'email') {
        $wrap = 72;
    }
    // split into paragraphs
    $_paragraphs = preg_split('![\r\n]{2}!', $content);

    foreach ($_paragraphs as &$_paragraph) {
        if (!$_paragraph) {
            continue;
        }
        // convert mult. spaces & special chars to single space
        $_paragraph =
            preg_replace(array('!\s+!' . Smarty::$_UTF8_MODIFIER, '!(^\s+)|(\s+$)!' . Smarty::$_UTF8_MODIFIER),
                         array(' ', ''), $_paragraph);
        // indent first line
        if ($indent_first > 0) {
            $_paragraph = str_repeat($indent_char, $indent_first) . $_paragraph;
        }
        // wordwrap sentences
        if (Smarty::$_MBSTRING) {
            require_once(SMARTY_PLUGINS_DIR . 'shared.mb_wordwrap.php');
            $_paragraph = smarty_mb_wordwrap($_paragraph, $wrap - $indent, $wrap_char, $wrap_cut);
        } else {
            $_paragraph = wordwrap($_paragraph, $wrap - $indent, $wrap_char, $wrap_cut);
        }
        // indent lines
        if ($indent > 0) {
            $_paragraph = preg_replace('!^!m', str_repeat($indent_char, $indent), $_paragraph);
        }
    }
    $_output = implode($wrap_char . $wrap_char, $_paragraphs);

    if ($assign) {
        $template->assign($assign, $_output);
    } else {
        return $_output;
    }
}
