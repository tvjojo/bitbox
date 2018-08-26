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
 * Smarty Internal Plugin Compile extend
 * Compiles the {extends} tag
 *
 * @package    Smarty
 * @subpackage Compiler
 * @author     Uwe Tews
 */

/**
 * Smarty Internal Plugin Compile extend Class
 *
 * @package    Smarty
 * @subpackage Compiler
 */
class Smarty_Internal_Compile_Extends extends Smarty_Internal_Compile_Shared_Inheritance
{
    /**
     * Attribute definition: Overwrites base class.
     *
     * @var array
     * @see Smarty_Internal_CompileBase
     */
    public $required_attributes = array('file');

    /**
     * Array of names of optional attribute required by tag
     * use array('_any') if there is no restriction of attributes names
     *
     * @var array
     */
    public $optional_attributes = array('extends_resource');

    /**
     * Attribute definition: Overwrites base class.
     *
     * @var array
     * @see Smarty_Internal_CompileBase
     */
    public $shorttag_order = array('file');

    /**
     * Compiles code for the {extends} tag extends: resource
     *
     * @param array                                 $args     array with attributes from parser
     * @param \Smarty_Internal_TemplateCompilerBase $compiler compiler object
     *
     * @return string compiled code
     * @throws \SmartyCompilerException
     * @throws \SmartyException
     */
    public function compile($args, Smarty_Internal_TemplateCompilerBase $compiler)
    {
        // check and get attributes
        $_attr = $this->getAttributes($compiler, $args);
        if ($_attr[ 'nocache' ] === true) {
            $compiler->trigger_template_error('nocache option not allowed', $compiler->parser->lex->line - 1);
        }
        if (strpos($_attr[ 'file' ], '$_tmp') !== false) {
            $compiler->trigger_template_error('illegal value for file attribute', $compiler->parser->lex->line - 1);
        }
        // add code to initialize inheritance
        $this->registerInit($compiler, true);
        $file = trim($_attr[ 'file' ], '\'"');
        if (strlen($file) > 8 && substr($file, 0, 8) == 'extends:') {
            // generate code for each template
            $files = array_reverse(explode('|', substr($file, 8)));
            $i = 0;
            foreach ($files as $file) {
                if ($file[ 0 ] == '"') {
                    $file = trim($file, '".');
                } else {
                    $file = "'{$file}'";
                }
                $i ++;
                if ($i == count($files) && isset($_attr[ 'extends_resource' ])) {
                    $this->compileEndChild($compiler);
                }
                $this->compileInclude($compiler, $file);
            }
            if (!isset($_attr[ 'extends_resource' ])) {
                $this->compileEndChild($compiler);
            }
        } else {
            $this->compileEndChild($compiler);
            $this->compileInclude($compiler, $_attr[ 'file' ]);
        }
        $compiler->has_code = false;
        return '';
    }

    /**
     * Add code for inheritance endChild() method to end of template
     *
     * @param \Smarty_Internal_TemplateCompilerBase $compiler
     */
    private function compileEndChild(Smarty_Internal_TemplateCompilerBase $compiler)
    {
        $compiler->parser->template_postfix[] = new Smarty_Internal_ParseTree_Tag($compiler->parser,
                                                                                  "<?php \$_smarty_tpl->inheritance->endChild();\n?>\n");
    }

    /**
     * Add code for including subtemplate to end of template
     *
     * @param \Smarty_Internal_TemplateCompilerBase $compiler
     * @param  string                               $file subtemplate name
     */
    private function compileInclude(Smarty_Internal_TemplateCompilerBase $compiler, $file)
    {
        $compiler->parser->template_postfix[] = new Smarty_Internal_ParseTree_Tag($compiler->parser,
                                                                                  $compiler->compileTag('include',
                                                                                                        array($file,
                                                                                                              array('scope' => 'parent'))));
    }

    /**
     * Create source code for {extends} from source components array
     *
     * @param []\Smarty_Internal_Template_Source $components
     *
     * @return string
     */
    public static function extendsSourceArrayCode($components)
    {
        $resources = array();
        foreach ($components as $source) {
            $resources[] = $source->resource;
        }
        return '{extends file=\'extends:' . join('|', $resources) . '\' extends_resource=true}';
    }
}
