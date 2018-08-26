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
 * Smarty Plugin Data
 * This file contains the data object
 *
 * @package    Smarty
 * @subpackage Template
 * @author     Uwe Tews
 */

/**
 * class for the Smarty data object
 * The Smarty data object will hold Smarty variables in the current scope
 *
 * @package    Smarty
 * @subpackage Template
 */
class Smarty_Data extends Smarty_Internal_Data
{
    /**
     * Counter
     *
     * @var int
     */
    static $count = 0;

    /**
     * Data block name
     *
     * @var string
     */
    public $dataObjectName = '';

    /**
     * Smarty object
     *
     * @var Smarty
     */
    public $smarty = null;

    /**
     * create Smarty data object
     *
     * @param Smarty|array                    $_parent parent template
     * @param Smarty|Smarty_Internal_Template $smarty  global smarty instance
     * @param string                          $name    optional data block name
     *
     * @throws SmartyException
     */
    public function __construct($_parent = null, $smarty = null, $name = null)
    {
        parent::__construct();
        self::$count ++;
        $this->dataObjectName = 'Data_object ' . (isset($name) ? "'{$name}'" : self::$count);
        $this->smarty = $smarty;
        if (is_object($_parent)) {
            // when object set up back pointer
            $this->parent = $_parent;
        } elseif (is_array($_parent)) {
            // set up variable values
            foreach ($_parent as $_key => $_val) {
                $this->tpl_vars[ $_key ] = new Smarty_Variable($_val);
            }
        } elseif ($_parent != null) {
            throw new SmartyException("Wrong type for template variables");
        }
    }
}
