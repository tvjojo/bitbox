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
 * Date: 2017/9/23 0023
 * Time: 上午 8:57
 */


echo   "indexModindexMod111</br>";

class IndexMod extends BaseMod
{
  // echo 'MODMODMODMODMODMODMODMODMODMODMODMODMOD';
    function indexnews2(){
        echo 'indexnews2indexnews2indexnews2indexnews2indexModindexMod222</br>';

        $sql = "SELECT user " ."FROM ". $this->pre ."bitbox WHERE id=2";

       $sql2 = $this->query($sql);
       // die(!empty($sql2));
     //   $sql2 = M()->query($sql);
        print_r($sql2);
        echo "QQQQQQQQQQQQQQQQQQ222222222222QQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQ";

    }
    // die("DIEDIEDIEDIEDIEDIEDIEDIEDIEDIEDIEDIE");


    function indexnews1(){

        echo "indexnews1indexnews1111111111111indexnews1indexnews1indexnews1";
    }

  function indexnews3(){

        $sql = "SELECT user " ."FROM ". $this->pre ."bitbox WHERE id=2";

       $sql2 = $this->query($sql);
       print_r($sql2);
    }




















}