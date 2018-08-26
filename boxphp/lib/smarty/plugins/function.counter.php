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
 * Smarty {counter} function plugin
 * Type:     function<br>
 * Name:     counter<br>
 * Purpose:  print out a counter value
 *
 * @author Monte Ohrt <monte at ohrt dot com>
 * @link   http://www.smarty.net/manual/en/language.function.counter.php {counter}
 *         (Smarty online manual)
 *
 * @param array                    $params   parameters
 * @param Smarty_Internal_Template $template template object
 *
 * @return string|null
 */
function smarty_function_counter($params, $template)
{
    static $counters = array();

    $name = (isset($params[ 'name' ])) ? $params[ 'name' ] : 'default';
    if (!isset($counters[ $name ])) {
        $counters[ $name ] = array('start' => 1, 'skip' => 1, 'direction' => 'up', 'count' => 1);
    }
    $counter =& $counters[ $name ];

    if (isset($params[ 'start' ])) {
        $counter[ 'start' ] = $counter[ 'count' ] = (int) $params[ 'start' ];
    }

    if (!empty($params[ 'assign' ])) {
        $counter[ 'assign' ] = $params[ 'assign' ];
    }

    if (isset($counter[ 'assign' ])) {
        $template->assign($counter[ 'assign' ], $counter[ 'count' ]);
    }

    if (isset($params[ 'print' ])) {
        $print = (bool) $params[ 'print' ];
    } else {
        $print = empty($counter[ 'assign' ]);
    }

    if ($print) {
        $retval = $counter[ 'count' ];
    } else {
        $retval = null;
    }

    if (isset($params[ 'skip' ])) {
        $counter[ 'skip' ] = $params[ 'skip' ];
    }

    if (isset($params[ 'direction' ])) {
        $counter[ 'direction' ] = $params[ 'direction' ];
    }

    if ($counter[ 'direction' ] == "down") {
        $counter[ 'count' ] -= $counter[ 'skip' ];
    } else {
        $counter[ 'count' ] += $counter[ 'skip' ];
    }

    return $retval;
}
