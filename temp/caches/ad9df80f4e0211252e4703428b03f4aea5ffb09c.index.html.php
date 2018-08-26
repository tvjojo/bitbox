<?php
/* Smarty version 3.1.30, created on 2018-08-25 17:54:38
  from "E:\web\bitbox\view\template\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b8197ded35e81_55062269',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8b2dccd649c57dc697cd6feced8731d0455f596f' => 
    array (
      0 => 'E:\\web\\bitbox\\view\\template\\index.html',
      1 => 1508603391,
      2 => 'file',
    ),
    '1ca3c8dc31407623108ef9ea2513509f017d3e6f' => 
    array (
      0 => 'E:\\web\\bitbox\\view\\template\\head.html',
      1 => 1508598793,
      2 => 'file',
    ),
    '013078e5cfd24baed3f54942ec3f3b13aa4056a8' => 
    array (
      0 => 'E:\\web\\bitbox\\view\\template\\left.html',
      1 => 1508598457,
      2 => 'file',
    ),
    'c3080f1471efe971b64b63da97de01402c853363' => 
    array (
      0 => 'E:\\web\\bitbox\\view\\template\\foot.html',
      1 => 1508601684,
      2 => 'file',
    ),
  ),
  'cache_lifetime' => 66,
),true)) {
function content_5b8197ded35e81_55062269 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<!--
  ~ Copyright (c) 2017. 本软件系统由北天团队与投缘互联团队共同开发，对于非商业用途
  ~ 的代码使用完全免费，而对商业用户经过我方授权后也可免费使用，但所有用户不得任意破坏
  ~ 我们设计的产品结构，也不得使用该软件做为非法用途.如果商业用户希望获得一些平台型的支
  ~ 持，以及获得我方各类接口的支持，也可联系我方购买更丰富的支持. 
  -->
<!--
 	作者：tvjojo@5viv.com
 	时间：2017-10-21
 	描述：
 -->

<body>
	<!--
包含头文件
 -->
	<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title> BitBoxPHP beta版 1.0.1 开源框架 技术界的混乱开拓者</title>

		<link rel="stylesheet" href="public/css/box/base/baseindex.css" />
		<script type="text/javascript" src="public/js/box/base/vue.js"></script>

	</head>

	<body>

		<div class="headtop">
			<div class="headtop.ul">
				<h1> BitBoxPHP Beta 1.0.1 版 草稿激情搞事版本发布。</h1>
				</br>
			</div>

			<div class="top">
				<div class="top-nav">
					|
					<a href="index.php">首页</a> |
					<a href="index.php?a=1">关于我们</a> |
					<a href="index.php?a=2"> 帮助文档</a> |
					<a href="index.php?a=3">版本</a> |
					<a href="index.php?a=5">捐赠</a> |
					
					<a href="http://www.hahahuyu.com">hahahuyu.com</a> |
				</div>
				</br>
			</br> --------------------------------------------------------------------------------
			</div>
		</div>

	</body>

</html>
<div class="container"><!--   .container -->
		<div class="headright"> bitbox 的改进还希望更多借助大家的力量</br>
			 </br>
			 </br>
			 </br>
		</div>
	  <div class="header">
	  	<a href="index.php"><img src="public/images/box/base/logo.jpg" alt="bitbox" name="Insert_logo" width="180"   id="Insert_logo" style="background: #C6D580; display:block;" /></a>
	  
    <!-- end .header --></div>
    <div class="sidebar1">
<!DOCTYPE html>
 
		   <ul class="nav">
      <li><a href="index.php">首页</a></li>
      <li><a href="#">bitbox java版</a></li>
      <li><a href="#">bitbox C#版</a></li>
      <li><a href="#">bitbox C/c++版</a></li>
    </ul>
    <p> bitbox 是为了给北天书院的IT学生提供一个强大的，可学习，可以发展，可以创新的新型服务端框架，
        我们更重视未来互联网的发展与应用，我们借签了众多国内外优秀框架的设计思想，同时也兼容许多国内外的开源系统，
    同时，我们在框架内大量植入开源的插件，组件及闭包产品。
    bitbox无论学习，还是纯商业使用都会是不错的选择。</p>
    <p>我们的框架是完全开放的，用户可以学习，升级，自行修改，以及自行发布新版本，但需要申明本版权的基础之上。</p>
 
    <!-- end .sidebar1 --></div>
	<div class="bodybox">
		<div class="content">

			<div class="contenttop">
				<h2> BitBox PHP版 beta 1.0.1 </h2>
              <div class="contentfirst">
            	<a href="public/download/base/BitBox-beta1.0.1.rar"> 官方下载链接 ：点击下载</a> 
            	</br>
            <p> 这绝对是个牛逼又爽的系统，值得你去尝试一下</p>	</br>
            早期我们的功能很单薄，只是先将整体设计思路拿出来，未来我们会不断更新，强壮起来。	</br>
         版本目前只有UTF-8版，   	</br>
          支持环境：php7.0 以上   mysql 5.5以上 	</br>
           服务器环境：windows NT类系统 linux  可由iis,apache,Nginx等来支持  	</br>
            	</br>
            	</br>
            	</br>
            	
            	
              </div>

			</div>
           
           <div class="contentmin">
            				
				<div id="app">
					{{ message }}
				</div>
				

				<script>
					var app = new Vue({
						el: '#app',
						data: {
							message: 'Hello Vue!'
						}
					})
				</script>
           </div>
           
           
           
			<div id="app-2">
				<span v-bind:title="message">
    鼠标悬停几秒钟查看此处动态绑定的提示信息！
  </span>
			</div>

			<script>
				var app2 = new Vue({
					el: '#app-2',
					data: {
						message: '页面加载于 ' + new Date().toLocaleString()
					}
				})
			</script>

			<div id="app-3">
				<p v-if="seen">现在你看到我了</p>
			</div>

			<script>
				var app3 = new Vue({
					el: '#app-3',
					data: {
						seen: true
					}
				})
			</script>

			<div id="app-4">
				<ol>
					<li v-for="todo in todos">
						{{ todo.text }}
					</li>
				</ol>
			</div>

			<script>
				var app4 = new Vue({
					el: '#app-4',
					data: {
						todos: [{
								text: '学习 JavaScript'
							},
							{
								text: '学习 Vue'
							},
							{
								text: '整个牛项目'
							}
						]
					}
				})
			</script>

			<div id="app-5">
				<p> {{ message }} </p>
				<button v-on:click="reverseMessage">逆转消息</button>
			</div>

			<script>
				var app5 = new Vue({
					el: '#app-5',
					data: {
						message: 'Hello Vue.js!'
					},
					methods: {
						reverseMessage: function() {
							this.message = this.message.split('').reverse().join('')
						}
					}
				})
			</script>

			<div id="app-6">
				<p> {{ message }} </p>
				<input v-model="message">
			</div>

			<script>
				var app6 = new Vue({
					el: '#app-6',
					data: {
						message: 'Hello Vue!'
					}
				})
			</script>

		</div>

	</div>
<!-- end .container --> </div>
	<!DOCTYPE html>
<html>
 
	<body>
		
		<div  class="footer">
					</br>
		北京 创业团队   ： 北天研发团队，  投缘互联团队，
		贡献开发者：  老王      姜山      阿牛   七宝   
		    <p><strong>联系我们</strong></p>
    <ul>
      <li>新浪微博：<a href="http://weibo.com/netjojo">关注netjojo</a><br />
        QQ群1：229487894(2000人群) <br />
        EMAIL：tvjojo@5viv.com  <br />
         </li>
    </ul>
		</div>
		

	</body>
</html>


</body>

</html><?php }
}
