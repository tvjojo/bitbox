<?php
/**
 * Created by PhpStorm.
 * User: tvjojo
 * Date: 2017-08-12
 * Time: 18:18
 */

define('IN_BOX', true);
define('BOXID', 1);
define('INIT_NO_SMARTY', true);
define('BASE_PATH2',str_replace('\\','/',realpath(dirname(__FILE__).'/'))."/");


require './boxphp/init.php';

$smarty =new Smarty();
$smarty->template_dir = ROOT_PATH . 'view/template/';


$smarty->debugging = true;
$smarty->caching = true;
$smarty->cache_lifetime = 120;

//$smarty->assign('page_title','');
$smarty->display('index.html', $cache_id);