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
 * @subpackage Debug
 */

/**
 * Smarty debug_print_var modifier plugin
 * Type:     modifier<br>
 * Name:     debug_print_var<br>
 * Purpose:  formats variable contents for display in the console
 *
 * @author Monte Ohrt <monte at ohrt dot com>
 *
 * @param array|object $var     variable to be formatted
 * @param int          $max     maximum recursion depth if $var is an array or object
 * @param int          $length  maximum string length if $var is a string
 * @param int          $depth   actual recursion depth
 * @param array        $objects processed objects in actual depth to prevent recursive object processing
 *
 * @return string
 */
function smarty_modifier_debug_print_var($var, $max = 10, $length = 40, $depth = 0, $objects = array())
{
    $_replace = array("\n" => '\n', "\r" => '\r', "\t" => '\t');
    switch (gettype($var)) {
        case 'array' :
            $results = '<b>Array (' . count($var) . ')</b>';
            if ($depth == $max) {
                break;
            }
            foreach ($var as $curr_key => $curr_val) {
                $results .= '<br>' . str_repeat('&nbsp;', $depth * 2) . '<b>' . strtr($curr_key, $_replace) .
                            '</b> =&gt; ' .
                            smarty_modifier_debug_print_var($curr_val, $max, $length, ++ $depth, $objects);
                $depth --;
            }
            break;

        case 'object' :
            $object_vars = get_object_vars($var);
            $results = '<b>' . get_class($var) . ' Object (' . count($object_vars) . ')</b>';
            if (in_array($var, $objects)) {
                $results .= ' called recursive';
                break;
            }
            if ($depth == $max) {
                break;
            }
            $objects[] = $var;
            foreach ($object_vars as $curr_key => $curr_val) {
                $results .= '<br>' . str_repeat('&nbsp;', $depth * 2) . '<b> -&gt;' . strtr($curr_key, $_replace) .
                            '</b> = ' . smarty_modifier_debug_print_var($curr_val, $max, $length, ++ $depth, $objects);
                $depth --;
            }
            break;

        case 'boolean' :
        case 'NULL' :
        case 'resource' :
            if (true === $var) {
                $results = 'true';
            } elseif (false === $var) {
                $results = 'false';
            } elseif (null === $var) {
                $results = 'null';
            } else {
                $results = htmlspecialchars((string) $var);
            }
            $results = '<i>' . $results . '</i>';
            break;

        case 'integer' :
        case 'float' :
            $results = htmlspecialchars((string) $var);
            break;

        case 'string' :
            $results = strtr($var, $_replace);
            if (Smarty::$_MBSTRING) {
                if (mb_strlen($var, Smarty::$_CHARSET) > $length) {
                    $results = mb_substr($var, 0, $length - 3, Smarty::$_CHARSET) . '...';
                }
            } else {
                if (isset($var[ $length ])) {
                    $results = substr($var, 0, $length - 3) . '...';
                }
            }

            $results = htmlspecialchars('"' . $results . '"', ENT_QUOTES, Smarty::$_CHARSET);
            break;

        case 'unknown type' :
        default :
            $results = strtr((string) $var, $_replace);
            if (Smarty::$_MBSTRING) {
                if (mb_strlen($results, Smarty::$_CHARSET) > $length) {
                    $results = mb_substr($results, 0, $length - 3, Smarty::$_CHARSET) . '...';
                }
            } else {
                if (strlen($results) > $length) {
                    $results = substr($results, 0, $length - 3) . '...';
                }
            }

            $results = htmlspecialchars($results, ENT_QUOTES, Smarty::$_CHARSET);
    }

    return $results;
}
