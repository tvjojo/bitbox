<?php
/**
 *   ============================================================================
 *  Copyright (c) 2017. 本软件系统由北天团队与大视线团队共同开发，对于非商业用途
 *  的代码使用完全免费，而对商业用户经过我方授权后也可免费使用，但所有用户不得任意破坏
 *  我们设计的产品结构，也不得使用该软件做为非法用途.如果商业用户希望获得一些平台型的支
 *  持，以及获得我方各类接口的支持，也可联系我方购买更丰富的支持.
 *   ============================================================================
 */

/**
 * User: Huangbt
 * Date: 2017/9/25 0025
 * Time: 上午 0:22
 */
define('IN_BOX', true);
define('BOXID', 1);
define('INIT_NO_SMARTY', true);

//define('BIND_MODULE', 'index');
//define('APP_NAME', 'pc');
require './includes/init.php';

//$smarty->assign('page_title','');
$smarty->display('index.html', $cache_id);
