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
 * Smarty Internal Plugin Compile Modifier
 * Compiles code for modifier execution
 *
 * @package    Smarty
 * @subpackage Compiler
 * @author     Uwe Tews
 */

/**
 * Smarty Internal Plugin Compile Modifier Class
 *
 * @package    Smarty
 * @subpackage Compiler
 */
class Smarty_Internal_Compile_Private_Modifier extends Smarty_Internal_CompileBase
{
    /**
     * Compiles code for modifier execution
     *
     * @param  array                                $args      array with attributes from parser
     * @param \Smarty_Internal_TemplateCompilerBase $compiler  compiler object
     * @param  array                                $parameter array with compilation parameter
     *
     * @return string compiled code
     * @throws \SmartyCompilerException
     */
    public function compile($args, Smarty_Internal_TemplateCompilerBase $compiler, $parameter)
    {
        // check and get attributes
        $_attr = $this->getAttributes($compiler, $args);
        $output = $parameter[ 'value' ];
        // loop over list of modifiers
        foreach ($parameter[ 'modifierlist' ] as $single_modifier) {
            $modifier = $single_modifier[ 0 ];
            $single_modifier[ 0 ] = $output;
            $params = implode(',', $single_modifier);
            // check if we know already the type of modifier
            if (isset($compiler->known_modifier_type[ $modifier ])) {
                $modifier_types = array($compiler->known_modifier_type[ $modifier ]);
            } else {
                $modifier_types = array(1, 2, 3, 4, 5, 6);
            }
            foreach ($modifier_types as $type) {
                switch ($type) {
                    case 1:
                        // registered modifier
                        if (isset($compiler->smarty->registered_plugins[ Smarty::PLUGIN_MODIFIER ][ $modifier ])) {
                            $function =
                                $compiler->smarty->registered_plugins[ Smarty::PLUGIN_MODIFIER ][ $modifier ][ 0 ];
                            if (!is_array($function)) {
                                $output = "{$function}({$params})";
                            } else {
                                if (is_object($function[ 0 ])) {
                                    $output = '$_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER][\'' .
                                              $modifier . '\'][0][0]->' . $function[ 1 ] . '(' . $params . ')';
                                } else {
                                    $output = $function[ 0 ] . '::' . $function[ 1 ] . '(' . $params . ')';
                                }
                            }
                            $compiler->known_modifier_type[ $modifier ] = $type;
                            break 2;
                        }
                        break;
                    case 2:
                        // registered modifier compiler
                        if (isset($compiler->smarty->registered_plugins[ Smarty::PLUGIN_MODIFIERCOMPILER ][ $modifier ][ 0 ])) {
                            $output =
                                call_user_func($compiler->smarty->registered_plugins[ Smarty::PLUGIN_MODIFIERCOMPILER ][ $modifier ][ 0 ],
                                               $single_modifier, $compiler->smarty);
                            $compiler->known_modifier_type[ $modifier ] = $type;
                            break 2;
                        }
                        break;
                    case 3:
                        // modifiercompiler plugin
                        if ($compiler->smarty->loadPlugin('smarty_modifiercompiler_' . $modifier)) {
                            // check if modifier allowed
                            if (!is_object($compiler->smarty->security_policy) ||
                                $compiler->smarty->security_policy->isTrustedModifier($modifier, $compiler)
                            ) {
                                $plugin = 'smarty_modifiercompiler_' . $modifier;
                                $output = $plugin($single_modifier, $compiler);
                            }
                            $compiler->known_modifier_type[ $modifier ] = $type;
                            break 2;
                        }
                        break;
                    case 4:
                        // modifier plugin
                        if ($function = $compiler->getPlugin($modifier, Smarty::PLUGIN_MODIFIER)) {
                            // check if modifier allowed
                            if (!is_object($compiler->smarty->security_policy) ||
                                $compiler->smarty->security_policy->isTrustedModifier($modifier, $compiler)
                            ) {
                                $output = "{$function}({$params})";
                            }
                            $compiler->known_modifier_type[ $modifier ] = $type;
                            break 2;
                        }
                        break;
                    case 5:
                        // PHP function
                        if (is_callable($modifier)) {
                            // check if modifier allowed
                            if (!is_object($compiler->smarty->security_policy) ||
                                $compiler->smarty->security_policy->isTrustedPhpModifier($modifier, $compiler)
                            ) {
                                $output = "{$modifier}({$params})";
                            }
                            $compiler->known_modifier_type[ $modifier ] = $type;
                            break 2;
                        }
                        break;
                    case 6:
                        // default plugin handler
                        if (isset($compiler->default_handler_plugins[ Smarty::PLUGIN_MODIFIER ][ $modifier ]) ||
                            (is_callable($compiler->smarty->default_plugin_handler_func) &&
                             $compiler->getPluginFromDefaultHandler($modifier, Smarty::PLUGIN_MODIFIER))
                        ) {
                            $function = $compiler->default_handler_plugins[ Smarty::PLUGIN_MODIFIER ][ $modifier ][ 0 ];
                            // check if modifier allowed
                            if (!is_object($compiler->smarty->security_policy) ||
                                $compiler->smarty->security_policy->isTrustedModifier($modifier, $compiler)
                            ) {
                                if (!is_array($function)) {
                                    $output = "{$function}({$params})";
                                } else {
                                    if (is_object($function[ 0 ])) {
                                        $output =  $function[ 0 ] . '->'. $function[ 1 ] . '(' . $params . ')';
                                    } else {
                                        $output = $function[ 0 ] . '::' . $function[ 1 ] . '(' . $params . ')';
                                    }
                                }
                            }
                            if (isset($compiler->parent_compiler->template->compiled->required_plugins[ 'nocache' ][ $modifier ][ Smarty::PLUGIN_MODIFIER ][ 'file' ]) ||
                                isset($compiler->parent_compiler->template->compiled->required_plugins[ 'compiled' ][ $modifier ][ Smarty::PLUGIN_MODIFIER ][ 'file' ])
                            ) {
                                // was a plugin
                                $compiler->known_modifier_type[ $modifier ] = 4;
                            } else {
                                $compiler->known_modifier_type[ $modifier ] = $type;
                            }
                            break 2;
                        }
                }
            }
            if (!isset($compiler->known_modifier_type[ $modifier ])) {
                $compiler->trigger_template_error("unknown modifier \"" . $modifier . "\"", null, true);
            }
        }

        return $output;
    }
}
