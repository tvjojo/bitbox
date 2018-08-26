<?php
/**
 *  ============================================================================
 * Copyright (c) 2017. 本软件系统由北天团队与投缘互联团队共同开发，对于非商业用途
 * 的代码使用完全免费，而对商业用户经过我方授权后也可免费使用，但所有用户不得任意破坏
 * 我们设计的产品结构，也不得使用该软件做为非法用途.如果商业用户希望获得一些平台型的支
 * 持，以及获得我方各类接口的支持，也可联系我方购买更丰富的支持.
 *  ============================================================================
 */

/**
 * User: Huangbt
 * Date: 2017/8/10 0010
 * Time: 下午 13:51
 */

class Single {
    //设置私有，保存实例状态
    static protected $ins = NULL;
    //设置为私有，限制类外实例化，若没有子类可去掉final
    final protected function __construct() {
        echo '实例化成功！';
    }
    //设置为静态方法，类外能调用，实例化
    static public function getinstance() {
        //self代表当前类，判断是否实例化
        if (self::$ins instanceof self) {
            return self::$ins;
        }
        self::$ins = new self();
        return self::$ins;
    }
}

$s1 = Single::getinstance();
$s2 = Single::getinstance();

//子类继承父类若还要单例，要用final修饰父类构造方法，
//阻止子类重写构造方法自己去new的问题
class Single2 extends Single {
}

$s11 = Single2::getInstance();
$s12 = Single2::getInstance();

if ($s11 === $s12) {
    echo "相等";
}
?>