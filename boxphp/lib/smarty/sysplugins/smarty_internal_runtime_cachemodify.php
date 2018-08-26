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
 * Inline Runtime Methods render, setSourceByUid, setupSubTemplate
 *
 * @package    Smarty
 * @subpackage PluginsInternal
 * @author     Uwe Tews
 *
 **/
class Smarty_Internal_Runtime_CacheModify
{
    /**
     * check client side cache
     *
     * @param \Smarty_Template_Cached   $cached
     * @param \Smarty_Internal_Template $_template
     * @param  string                   $content
     */
    public function cacheModifiedCheck(Smarty_Template_Cached $cached, Smarty_Internal_Template $_template, $content)
    {
        $_isCached = $_template->isCached() && !$_template->compiled->has_nocache_code;
        $_last_modified_date =
            @substr($_SERVER[ 'HTTP_IF_MODIFIED_SINCE' ], 0, strpos($_SERVER[ 'HTTP_IF_MODIFIED_SINCE' ], 'GMT') + 3);
        if ($_isCached && $cached->timestamp <= strtotime($_last_modified_date)) {
            switch (PHP_SAPI) {
                case 'cgi': // php-cgi < 5.3
                case 'cgi-fcgi': // php-cgi >= 5.3
                case 'fpm-fcgi': // php-fpm >= 5.3.3
                    header('Status: 304 Not Modified');
                    break;

                case 'cli':
                    if ( /* ^phpunit */
                    !empty($_SERVER[ 'SMARTY_PHPUNIT_DISABLE_HEADERS' ]) /* phpunit$ */
                    ) {
                        $_SERVER[ 'SMARTY_PHPUNIT_HEADERS' ][] = '304 Not Modified';
                    }
                    break;

                default:
                    if ( /* ^phpunit */
                    !empty($_SERVER[ 'SMARTY_PHPUNIT_DISABLE_HEADERS' ]) /* phpunit$ */
                    ) {
                        $_SERVER[ 'SMARTY_PHPUNIT_HEADERS' ][] = '304 Not Modified';
                    } else {
                        header($_SERVER[ 'SERVER_PROTOCOL' ] . ' 304 Not Modified');
                    }
                    break;
            }
        } else {
            switch (PHP_SAPI) {
                case 'cli':
                    if ( /* ^phpunit */
                    !empty($_SERVER[ 'SMARTY_PHPUNIT_DISABLE_HEADERS' ]) /* phpunit$ */
                    ) {
                        $_SERVER[ 'SMARTY_PHPUNIT_HEADERS' ][] =
                            'Last-Modified: ' . gmdate('D, d M Y H:i:s', $cached->timestamp) . ' GMT';
                    }
                    break;
                default:
                    header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $cached->timestamp) . ' GMT');
                    break;
            }
            echo $content;
        }
    }
}
