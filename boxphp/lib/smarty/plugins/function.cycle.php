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
 * @subpackage PluginsFunction
 */

/**
 * Smarty {cycle} function plugin
 * Type:     function<br>
 * Name:     cycle<br>
 * Date:     May 3, 2002<br>
 * Purpose:  cycle through given values<br>
 * Params:
 * <pre>
 * - name      - name of cycle (optional)
 * - values    - comma separated list of values to cycle, or an array of values to cycle
 *               (this can be left out for subsequent calls)
 * - reset     - boolean - resets given var to true
 * - print     - boolean - print var or not. default is true
 * - advance   - boolean - whether or not to advance the cycle
 * - delimiter - the value delimiter, default is ","
 * - assign    - boolean, assigns to template var instead of printed.
 * </pre>
 * Examples:<br>
 * <pre>
 * {cycle values="#eeeeee,#d0d0d0d"}
 * {cycle name=row values="one,two,three" reset=true}
 * {cycle name=row}
 * </pre>
 *
 * @link     http://www.smarty.net/manual/en/language.function.cycle.php {cycle}
 *           (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @author   credit to Mark Priatel <mpriatel@rogers.com>
 * @author   credit to Gerard <gerard@interfold.com>
 * @author   credit to Jason Sweat <jsweat_php@yahoo.com>
 * @version  1.3
 *
 * @param array                    $params   parameters
 * @param Smarty_Internal_Template $template template object
 *
 * @return string|null
 */

function smarty_function_cycle($params, $template)
{
    static $cycle_vars;

    $name = (empty($params[ 'name' ])) ? 'default' : $params[ 'name' ];
    $print = (isset($params[ 'print' ])) ? (bool) $params[ 'print' ] : true;
    $advance = (isset($params[ 'advance' ])) ? (bool) $params[ 'advance' ] : true;
    $reset = (isset($params[ 'reset' ])) ? (bool) $params[ 'reset' ] : false;

    if (!isset($params[ 'values' ])) {
        if (!isset($cycle_vars[ $name ][ 'values' ])) {
            trigger_error("cycle: missing 'values' parameter");

            return;
        }
    } else {
        if (isset($cycle_vars[ $name ][ 'values' ]) && $cycle_vars[ $name ][ 'values' ] != $params[ 'values' ]) {
            $cycle_vars[ $name ][ 'index' ] = 0;
        }
        $cycle_vars[ $name ][ 'values' ] = $params[ 'values' ];
    }

    if (isset($params[ 'delimiter' ])) {
        $cycle_vars[ $name ][ 'delimiter' ] = $params[ 'delimiter' ];
    } elseif (!isset($cycle_vars[ $name ][ 'delimiter' ])) {
        $cycle_vars[ $name ][ 'delimiter' ] = ',';
    }

    if (is_array($cycle_vars[ $name ][ 'values' ])) {
        $cycle_array = $cycle_vars[ $name ][ 'values' ];
    } else {
        $cycle_array = explode($cycle_vars[ $name ][ 'delimiter' ], $cycle_vars[ $name ][ 'values' ]);
    }

    if (!isset($cycle_vars[ $name ][ 'index' ]) || $reset) {
        $cycle_vars[ $name ][ 'index' ] = 0;
    }

    if (isset($params[ 'assign' ])) {
        $print = false;
        $template->assign($params[ 'assign' ], $cycle_array[ $cycle_vars[ $name ][ 'index' ] ]);
    }

    if ($print) {
        $retval = $cycle_array[ $cycle_vars[ $name ][ 'index' ] ];
    } else {
        $retval = null;
    }

    if ($advance) {
        if ($cycle_vars[ $name ][ 'index' ] >= count($cycle_array) - 1) {
            $cycle_vars[ $name ][ 'index' ] = 0;
        } else {
            $cycle_vars[ $name ][ 'index' ] ++;
        }
    }

    return $retval;
}
