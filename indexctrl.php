<?php
/**
 * Created by PhpStorm.
 * User: tvjojo
 * Date: 2017-08-13
 * Time: 21:33
 */

define('IN_BOX', true);
define('CONTROLLER_NAME', 'indexctrl');
require './boxphp/init.php';


class indexctrl {
    function indexecho(){
        echo   "CCCCCCCCCCCCCCCCCCCCCCC首页类引入";
    }
}
