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
 * Smarty compiler exception class
 *
 * @package Smarty
 */
class SmartyCompilerException extends SmartyException
{
    public function __toString()
    {
        return ' --> Smarty Compiler: ' . $this->message . ' <-- ';
    }

    /**
     * The line number of the template error
     *
     * @type int|null
     */
    public $line = null;

    /**
     * The template source snippet relating to the error
     *
     * @type string|null
     */
    public $source = null;

    /**
     * The raw text of the error message
     *
     * @type string|null
     */
    public $desc = null;

    /**
     * The resource identifier or template name
     *
     * @type string|null
     */
    public $template = null;
}
