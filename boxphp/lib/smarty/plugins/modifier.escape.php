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
 * @subpackage PluginsModifier
 */

/**
 * Smarty escape modifier plugin
 * Type:     modifier<br>
 * Name:     escape<br>
 * Purpose:  escape string for output
 *
 * @link   http://www.smarty.net/docs/en/language.modifier.escape
 * @author Monte Ohrt <monte at ohrt dot com>
 *
 * @param string  $string        input string
 * @param string  $esc_type      escape type
 * @param string  $char_set      character set, used for htmlspecialchars() or htmlentities()
 * @param boolean $double_encode encode already encoded entitites again, used for htmlspecialchars() or htmlentities()
 *
 * @return string escaped input string
 */
function smarty_modifier_escape($string, $esc_type = 'html', $char_set = null, $double_encode = true)
{
    static $_double_encode = null;
    if ($_double_encode === null) {
        $_double_encode = version_compare(PHP_VERSION, '5.2.3', '>=');
    }

    if (!$char_set) {
        $char_set = Smarty::$_CHARSET;
    }

    switch ($esc_type) {
        case 'html':
            if ($_double_encode) {
                // php >=5.3.2 - go native
                return htmlspecialchars($string, ENT_QUOTES, $char_set, $double_encode);
            } else {
                if ($double_encode) {
                    // php <5.2.3 - only handle double encoding
                    return htmlspecialchars($string, ENT_QUOTES, $char_set);
                } else {
                    // php <5.2.3 - prevent double encoding
                    $string = preg_replace('!&(#?\w+);!', '%%%SMARTY_START%%%\\1%%%SMARTY_END%%%', $string);
                    $string = htmlspecialchars($string, ENT_QUOTES, $char_set);
                    $string = str_replace(array('%%%SMARTY_START%%%', '%%%SMARTY_END%%%'), array('&', ';'), $string);

                    return $string;
                }
            }

        case 'htmlall':
            if (Smarty::$_MBSTRING) {
                // mb_convert_encoding ignores htmlspecialchars()
                if ($_double_encode) {
                    // php >=5.3.2 - go native
                    $string = htmlspecialchars($string, ENT_QUOTES, $char_set, $double_encode);
                } else {
                    if ($double_encode) {
                        // php <5.2.3 - only handle double encoding
                        $string = htmlspecialchars($string, ENT_QUOTES, $char_set);
                    } else {
                        // php <5.2.3 - prevent double encoding
                        $string = preg_replace('!&(#?\w+);!', '%%%SMARTY_START%%%\\1%%%SMARTY_END%%%', $string);
                        $string = htmlspecialchars($string, ENT_QUOTES, $char_set);
                        $string =
                            str_replace(array('%%%SMARTY_START%%%', '%%%SMARTY_END%%%'), array('&', ';'), $string);

                        return $string;
                    }
                }

                // htmlentities() won't convert everything, so use mb_convert_encoding
                return mb_convert_encoding($string, 'HTML-ENTITIES', $char_set);
            }

            // no MBString fallback
            if ($_double_encode) {
                return htmlentities($string, ENT_QUOTES, $char_set, $double_encode);
            } else {
                if ($double_encode) {
                    return htmlentities($string, ENT_QUOTES, $char_set);
                } else {
                    $string = preg_replace('!&(#?\w+);!', '%%%SMARTY_START%%%\\1%%%SMARTY_END%%%', $string);
                    $string = htmlentities($string, ENT_QUOTES, $char_set);
                    $string = str_replace(array('%%%SMARTY_START%%%', '%%%SMARTY_END%%%'), array('&', ';'), $string);

                    return $string;
                }
            }

        case 'url':
            return rawurlencode($string);

        case 'urlpathinfo':
            return str_replace('%2F', '/', rawurlencode($string));

        case 'quotes':
            // escape unescaped single quotes
            return preg_replace("%(?<!\\\\)'%", "\\'", $string);

        case 'hex':
            // escape every byte into hex
            // Note that the UTF-8 encoded character ä will be represented as %c3%a4
            $return = '';
            $_length = strlen($string);
            for ($x = 0; $x < $_length; $x ++) {
                $return .= '%' . bin2hex($string[ $x ]);
            }

            return $return;

        case 'hexentity':
            $return = '';
            if (Smarty::$_MBSTRING) {
                require_once(SMARTY_PLUGINS_DIR . 'shared.mb_unicode.php');
                $return = '';
                foreach (smarty_mb_to_unicode($string, Smarty::$_CHARSET) as $unicode) {
                    $return .= '&#x' . strtoupper(dechex($unicode)) . ';';
                }

                return $return;
            }
            // no MBString fallback
            $_length = strlen($string);
            for ($x = 0; $x < $_length; $x ++) {
                $return .= '&#x' . bin2hex($string[ $x ]) . ';';
            }

            return $return;

        case 'decentity':
            $return = '';
            if (Smarty::$_MBSTRING) {
                require_once(SMARTY_PLUGINS_DIR . 'shared.mb_unicode.php');
                $return = '';
                foreach (smarty_mb_to_unicode($string, Smarty::$_CHARSET) as $unicode) {
                    $return .= '&#' . $unicode . ';';
                }

                return $return;
            }
            // no MBString fallback
            $_length = strlen($string);
            for ($x = 0; $x < $_length; $x ++) {
                $return .= '&#' . ord($string[ $x ]) . ';';
            }

            return $return;

        case 'javascript':
            // escape quotes and backslashes, newlines, etc.
            return strtr($string, array('\\' => '\\\\', "'" => "\\'", '"' => '\\"', "\r" => '\\r', "\n" => '\\n',
                                        '</' => '<\/'));

        case 'mail':
            if (Smarty::$_MBSTRING) {
                require_once(SMARTY_PLUGINS_DIR . 'shared.mb_str_replace.php');

                return smarty_mb_str_replace(array('@', '.'), array(' [AT] ', ' [DOT] '), $string);
            }
            // no MBString fallback
            return str_replace(array('@', '.'), array(' [AT] ', ' [DOT] '), $string);

        case 'nonstd':
            // escape non-standard chars, such as ms document quotes
            $return = '';
            if (Smarty::$_MBSTRING) {
                require_once(SMARTY_PLUGINS_DIR . 'shared.mb_unicode.php');
                foreach (smarty_mb_to_unicode($string, Smarty::$_CHARSET) as $unicode) {
                    if ($unicode >= 126) {
                        $return .= '&#' . $unicode . ';';
                    } else {
                        $return .= chr($unicode);
                    }
                }

                return $return;
            }

            $_length = strlen($string);
            for ($_i = 0; $_i < $_length; $_i ++) {
                $_ord = ord(substr($string, $_i, 1));
                // non-standard char, escape it
                if ($_ord >= 126) {
                    $return .= '&#' . $_ord . ';';
                } else {
                    $return .= substr($string, $_i, 1);
                }
            }

            return $return;

        default:
            return $string;
    }
}
