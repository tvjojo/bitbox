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
 * User: Huangbt
 * Date: 2017/8/10 0010
 * Time: 下午 13:55
 */
//利用面向对象思想实现不同语言首页欢迎！
//抽象类就是个模板，你们子类继承我的类和方法自己搞自己想要弄的东西
//比如我想要开发英语语言，只要增加一个子类，不用修改父类的东西
//所以面向对象是可插拔的
abstract class Language { //抽象方法
    public abstract function wel();
}
class China extends Language {
    public function wel() {
        echo "欢迎！";
    }
}
class English extends Language {
    public function wel($a) {
        echo "Welcome!";
    }
}
$language = 'China';
$w = new $language(); //666
$w->wel();
?>