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
 * {make_nocache} Runtime Methods save(), store()
 *
 * @package    Smarty
 * @subpackage PluginsInternal
 * @author     Uwe Tews
 *
 */
class Smarty_Internal_Runtime_Make_Nocache
{

    /**
     * Save current variable value while rendering compiled template and inject nocache code to
     * assign variable value in cahed template
     *
     * @param \Smarty_Internal_Template $tpl
     * @param string                    $var variable name
     *
     * @throws \SmartyException
     */
    public function save(Smarty_Internal_Template $tpl, $var)
    {
        if (isset($tpl->tpl_vars[ $var ])) {
            $export = preg_replace('/^Smarty_Variable::__set_state[(]|\s|[)]$/', '',
                                   var_export($tpl->tpl_vars[ $var ], true));
            if (preg_match('/(\w+)::__set_state/', $export, $match)) {
                throw new SmartyException("{make_nocache \${$var}} in template '{$tpl->source->name}': variable does contain object '{$match[1]}' not implementing method '__set_state'");
            }
            echo "/*%%SmartyNocache:{$tpl->compiled->nocache_hash}%%*/<?php " .
                 addcslashes("\$_smarty_tpl->smarty->ext->_make_nocache->store(\$_smarty_tpl, '{$var}', " . $export,
                             '\\') . ");?>\n/*/%%SmartyNocache:{$tpl->compiled->nocache_hash}%%*/";
        }
    }

    /**
     * Store variable value saved while rendering compiled template in cached template context
     *
     * @param \Smarty_Internal_Template $tpl
     * @param  string                   $var variable name
     * @param  array                    $properties
     */
    public function store(Smarty_Internal_Template $tpl, $var, $properties)
    {
        // do not overwrite existing nocache variables
        if (!isset($tpl->tpl_vars[ $var ]) || !$tpl->tpl_vars[ $var ]->nocache) {
            $newVar = new Smarty_Variable();
            unset($properties[ 'nocache' ]);
            foreach ($properties as $k => $v) {
                $newVar->$k = $v;
            }
            $tpl->tpl_vars[ $var ] = $newVar;
        }
    }
}
