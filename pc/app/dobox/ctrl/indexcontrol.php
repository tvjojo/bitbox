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
 * Time: 下午 13:18
 */

echo  "indexcontrol  00000000000000000000000000000000000000000000000000000</br>";
class IndexControl extends PcControl
{


    public function index()
    {
        echo "  index 111 index index index index index9999999999999999 @@@@@@@@@@@@@@@@@@@@@@@@@ </br>";
       $this->assign('indexnews', model('Index')->indexnews2());


      // die("DIEdieDIEdieDIEdieDIEdieDIEdieDIEdie");
         //  $smarty->assign('indexnews', model('Index')->indexnews());

        echo "DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD";
        echo  $this->template_dir;
           $this->display('index.html');




        echo "</br>‘CONTROLLER_NAME’";
        echo CONTROLLER_NAME;
        echo "</br> ‘ACTION_NAME’";
        echo  ACTION_NAME;
        echo "</br> ‘ __ACTION__’";
        echo  __ACTION__;
        echo "</br>‘MODULE_PATH’";
        echo MODULE_PATH;
       // echo MODULE_ALIAS;
        echo "</br>";
       // echo ACTION_ALIAS;
        echo "</br> ‘ DEFAULT_ACTION’";

        echo DEFAULT_ACTION;
        echo "</br>‘DEFAULT_CONTROLLER’";
        echo DEFAULT_CONTROLLER;
        echo "</br>‘__MODULE__’";
        echo __MODULE__;
        echo "</br>";
       // echo DEFAULT_MODULE;
        echo "</br>";
        echo "</br> ‘DEFAULT_APP’";
        echo DEFAULT_APP;
        echo "</br>‘__APP__:’";
        echo __APP__;
        echo "</br>";

   //     echo $_SERVER['PATH_INFO'];
        echo "</br>";


        echo '222 index 222  index index index index index9999999999999999 @@@@@@@@@@@@@@@@@@@@@@@@@</br>';
    }
   // ctrlbox($f);

//echo $f;
//echo "PPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPP";


   public  function  index2()
   {  echo 'iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii22222222222222222222';
      $news2= $this->assign('indexnews', model('Index')->indexnews2());
       $this->assign('indexnews2', model('Index')->indexnews1());

       $news="######321news#####";
       $this->assign('indexnews4', $news);
       $this->assign('indexnews3', model('box')->index());
       
       $news6 = model('Index')->indexnews3();
           $this->assign('indexnews5', $news2);
           $this->assign('indexnews6', $news6);




     //  $this->assign('indexnews2',model('index')->indexnews1());
       echo "DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD";
    echo  $this->template_dir;
       // die("DIEdieDIEdieDIEdieDIEdieDIEdieDIEdie");
       //   $smarty->assign('indexnews', model('Index')->indexnews());
      //   $smarty->display('index.html' );

      $this->display('index2.html' );


   }
}
?>