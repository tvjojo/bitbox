/*
 *   ============================================================================
 *  Copyright (c) 2017. 本软件系统由北天团队与投缘互联团队共同开发，对于非商业用途
 *  的代码使用完全免费，而对商业用户经过我方授权后也可免费使用，但所有用户不得任意破坏
 *  我们设计的产品结构，也不得使用该软件做为非法用途.如果商业用户希望获得一些平台型的支
 *  持，以及获得我方各类接口的支持，也可联系我方购买更丰富的支持.
 *  ** http://bitbox.5viv.com    EMAIL:tvjojo@5viv.com   QQ群：229487894
 *   ============================================================================
 */

/**
 * Created by Administrator on 2017/10/28 0028.
 */
var ok1=false;
var ok2=false;
var ok3=false;
//var ok4=false;//去掉邮箱验证
var ok5=false;
var ok6=true;
var ok1msg='';
var ok2msg='';
var ok3msg='';
var ok4msg='';
var ok5msg='';
var ok6msg='';

function check_password(){
    var password=$("#password").val();
    if(password!='') {
        if (password.length >= 6 && password.length <= 20 && password!= '') {
            ok2msg="输入成功";
            $(".password_message").html(ok2msg).removeClass('state1').addClass('state4');
            ok2= true;
        } else {
            ok2msg='密码应该为6-20位之间';
            $(".password_message").html(ok2msg).removeClass('state4').removeClass('state1').addClass('state3');
            ok2= false;
        }
    }else{
        ok2msg='密码不能为空';
        $(".password_message").html(ok2msg).removeClass('state4').removeClass('state1').addClass('state3');
        //$("#password").focus();
        ok2= false;
    }
    return ok2;
}

function check_phone(){
    var phone=$("#mobile").val();
    var myreg = /(^1[3|4|5|7|8][0-9]{9}$)/;
    if(!(myreg.test(phone))){
        ok5msg='输入手机号有误';
        $(".phone_message").html(ok5msg).removeClass('state4').removeClass('state1').addClass('state3');
        //	  $("#phone").focus();
        ok5=  false;
    }else{
        $(".phone_message").html('输入成功').removeClass('state1').addClass('state4');
        ok5=  true;
    }
    return ok5;
}
function check_yqrphone(){
    var phone=$("#yqr_mobile").val();
    var myreg = /(^1[3|4|5|7|8][0-9]{9}$)/;
    if(!(myreg.test(phone))){
        ok5msg='输入手机号有误';
        $(".phone_message").html(ok5msg).removeClass('state4').removeClass('state1').addClass('state3');
        //	  $("#phone").focus();
        ok5=  false;
    }else{
        $(".phone_message").html('输入成功').removeClass('state1').addClass('state4');
        ok5=  true;
    }
    return ok5;
}
function check_verify(){
    var verify=$("#verify").val();
    if (verify.length == '' || verify.length != 6){
        ok6msg='验证码错误';
        $(".verify_message").html(ok6msg).removeClass('state1').addClass('state3').removeClass('state4');
        //     $("#verify").focus();
        ok6=  false;

    }else{
        $(".verify_message").html('输入位数正确').removeClass('state1').addClass('state4');
        ok6= true;
    }
    return ok6;
}

var InterValObj; //timer变量，控制时间
var count = 60; //间隔函数，1秒执行
var curCount;//当前剩余秒数
var phone = $("input[name$='verify']").val();
/* $("input[name$='start']").val(); 老版兼容问题所以替换了。
 *var phone = $('input[name=verify]').val();
  * */
function sendMessage() {

   // if(check_password()&&check_phone()){

        if(check_phone()){
        var phone =  $("#mobile").val();
        var reg = /(^1[3|4|5|7|8][0-9]{9}$)/;
        if (reg.test(phone)) {       //手机号正确
            curCount = count;
            //设置button效果，开始计时
            $("#btnSendCode").attr("disabled", "true");
              $("#btnSendCode").val("请在" + curCount + "秒内输入验证码");
            InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次

            $.ajax({
                type: "POST", //用POST方式传输
                dataType: "json", //数据格式:JSON
                //url: 'www.zc.com/api/zc/user/send_message.php', //目标地址
                url: 'index.php?m=dobox&c=index&a=validateMobile', //目标地址
                data: "action=register_verify&phone=" + phone,
                //data: "m=default&c=user&action=register_verify&phone=" + phone,
                //data: "/index.php?m=default&c=user&a=validateMobile&action=register_verify&phone=" + phone, 		　　
                error: function (XMLHttpRequest, textStatus, errorThrown) { },
                success: function (result){
                    alert(result.msg);
                }
            });
        }else{
            // $("input[name='mobile_phone']").val("").focus(); // 清空并获得焦点
            alert("手机号码不正确,请您重新输入~");
        }
    }else{
        alert("请把资料填写完整");

    }
}

//timer处理函数
function SetRemainTime() {
    if (curCount == 0) {
        window.clearInterval(InterValObj);//停止计时器
        $("#btnSendCode").removeAttr("disabled");//启用按钮
        $("#btnSendCode").val("重新发送验证码");
    }
    else {
        curCount--;
        $("#btnSendCode").val("可" + curCount + "秒后发送验证码");
    }
}

