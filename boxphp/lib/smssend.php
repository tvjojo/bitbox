<?php
/**
 *   ============================================================================
 *  Copyright (c) 2017. 本软件系统由北天团队与投缘互联团队共同开发，对于非商业用途
 *  的代码使用完全免费，而对商业用户经过我方授权后也可免费使用，但所有用户不得任意破坏
 *  我们设计的产品结构，也不得使用该软件做为非法用途.如果商业用户希望获得一些平台型的支
 *  持，以及获得我方各类接口的支持，也可联系我方购买更丰富的支持.
 *  ** http://bitbox.5viv.com    EMAIL:tvjojo@5viv.com   QQ群：229487894
 *   ============================================================================
 */

/**
 * User: Huangbt
 * Date: 2017/10/25 0025
 * Time: 上午 0:27
 */
class smssend
{




    /**
     *短信发送  BY XP
     *$mobile  电话号码
     *$txt  内容
     * $sm[0] = 0发送失败，1发送成功，2手机号不正确，3群发信息中不能包括验证码,4短信接口配置出错，请联系管理员,10发送条数大于10条
     * $code 验证码
     * sm[0]返回成功与否（0，失败；1成功）
     * sm[1]返回信息
     * sm[2]群发信息中发送成功电话号码
     * sm[3]群发信息中发送失败电号码
     **/
    function send_msg($mobile, $txt, $code = 0)
    {
        if (strstr($mobile, ',') || strstr($mobile, '，')) {
            $mobile = strtr($mobile, array('，' => ',')); //将中文逗号转为英文
            if ($code <> 0) {
                $sm[0] = 3;
                $sm[1] = '群发信息中不能包括验证码';
                return $sm;
            }
            $send = explode(',', $mobile);
            $mobile = array_unique($send); //去重
            if (count($send) > 10) {
                $sm[0] = 10;
                $sm[1] = '根据短信平台要求，每次发送信息条数不能大于10条';
                return $sm;
            }
            $i = 0;
            $y = 0;
            foreach ($send AS $val) {
                if (preg_match("/1[34578]{1}\d{9}$/", $val)) {
                    $send_m[$i] = $val; //是手机号，加入发送数组
                    $i++;
                } else {
                    $send_n[$y] = $val; //不是手机号，加入非发送数组
                    $y++;
                }
            }
            if (count($send_m) > 0) {
                $sm[2] = $mobile = implode(',', $send_m); //手机号发送组
            } else {
                $sm[0] = 2;
                $sm[1] = '手机号不正确';
                return $sm; //   sys_msg('手机号不正确');
            }

            if (count($send_n) > 0) {
                $sm[3] = implode(',', $send_n); //错误手机号
            }
            unset($i);
            unset($y);
        } else {
            $mobile = trim($mobile);
            if (!preg_match("/1[34578]{1}\d{9}$/", $mobile)) {
                $sm[0] = 2;
                $sm[1] = '手机号不正确';
                return $sm; //   sys_msg('手机号不正确');
            }
        }

        $t = date('Y-m-d H:i:s', time());
        $flag = 0;
        //要post的数据
        if (file_exists(ROOT_PATH . 'config/config_msg.php')) {
            include_once(ROOT_PATH . 'config/config_msg.php');
        } else {
            //sys_msg('短信接口配置出错，请联系管理员');
            $sm[0] = 4;
            $sm[1] = '短信接口配置出错，请联系管理员';
            return $sm;
        }
        if (!isset($msg_sn) || !isset($msg_pwd)) {
            //sys_msg('短信接口配置出错，请联系管理员');
            $sm[0] = 4;
            $sm[1] = '短信接口配置出错，请联系管理员';
            return $sm;
        }
        $argv = array(
            'sn' => $msg_sn, ////序列号
            'pwd' => strtoupper(md5($msg_sn . $msg_pwd)), //此处密码需要加密 加密方式为 md5(sn+password) 32位大写
            'mobile' => $mobile, //13522910010手机号 多个用英文的逗号隔开
            'content' => iconv("gb2312", "UTF-8//IGNORE", $txt . $t . '【bitbox】'), //短信内容
            'ext' => '',
            'stime' => '', //定时时间 格式为2011-6-29 11:09:21
            'msgfmt' => '',
            'rrid' => ''
        );
        //构造要post的字符串
        foreach ($argv as $key => $value) {
            if ($flag != 0) {
                $params .= "&";
                $flag = 1;
            }
            $params .= $key . "=";
            $params .= urlencode($value);
            $flag = 1;
        }
        $length = strlen($params);
        //创建socket连接
        $fp = fsockopen("sdk.entinfo.cn", 8061, $errno, $errstr, 10) or exit($errstr . "--->" . $errno);
        //构造post请求的头
        $header = "POST /webservice.asmx/mdsmssend HTTP/1.1\r\n";
        $header .= "Host:sdk.entinfo.cn\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . $length . "\r\n";
        $header .= "Connection: Close\r\n\r\n";
        //添加post的字符串
        $header .= $params . "\r\n";
        //发送post的数据
        fputs($fp, $header);
        $inheader = 1;
        while (!feof($fp)) {
            $line = fgets($fp, 1024); //去除请求包的头只显示页面的返回数据
            if ($inheader && ($line == "\n" || $line == "\r\n")) {
                $inheader = 0;
            }
            if ($inheader == 0) {
                // echo $line;
            }
        }
        $line = str_replace("<string xmlns=\"http://tempuri.org/\">", "", $line);
        $line = str_replace("</string>", "", $line);
        $result = explode("-", $line);
        // echo $line."-------------";
        if (count($result) > 1) {
            $sm[0] = 0;
            $sm[1] = '发送失败 返回值为:' . $line . '。请查看webservice返回值对照表';
        } else {
            $sm[0] = 1;
            $sm[1] = '发送成功 返回值为:' . $line;
        }
        return $sm;
    }
}