<?php
/* Smarty version 3.1.30, created on 2017-10-21 16:21:26
  from "E:\web\bitbox\view\template\version.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59eb740632cd51_40084187',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ac331b17e9f2dcfefe3b2e74ec7f994a46d3ac82' => 
    array (
      0 => 'E:\\web\\bitbox\\view\\template\\version.html',
      1 => 1508602868,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.html' => 1,
    'file:left.html' => 1,
    'file:foot.html' => 1,
  ),
),false)) {
function content_59eb740632cd51_40084187 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1302159eb7406323c10_34991863';
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
	<?php $_smarty_tpl->_subTemplateRender("file:head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="container"><!--   .container -->
		<div class="headright">  框架可以随意使用，大家不用担心版权问题。</br>
			 </br>
			 </br>
			 </br>
		</div>
	  <div class="header">
	  	<a href="index.php"><img src="public/images/box/base/logo.jpg" alt="bitbox" name="Insert_logo" width="180"   id="Insert_logo" style="background: #C6D580; display:block;" /></a>
	  
    <!-- end .header --></div>
    <div class="sidebar1">
<?php $_smarty_tpl->_subTemplateRender("file:left.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <!-- end .sidebar1 --></div>
	<div class="bodybox">
		<div class="content">

			<div class="contenttop">
				<ul> bitboxphp 1.0.1</ul>
              <div class="contentfirst">
                 <a href="">   </a>
                 
                 <h3>2017-10-22 bitboxphp 1.0.1 beta草稿版发布</h3>
                 <p> 整来了基本的路由，访问框架，文件结构，模版结构，MVC控制器结构，对象处理等。</p>
                 
                     <h3>2017-10-10 bitboxphp 1.0.0 beta 基础结构版</h3>
                 <p> 完成基础的框架，花了小半年时间来思考跟计划，以支持未来VR，AI，大数据，分散化APP为设计目标。</p>
              </div>

			</div>
           
           <div class="contentmin">
            				
				<div id="app">
					{{ message }}
				</div>
				

				<?php echo '<script'; ?>
>
					var app = new Vue({
						el: '#app',
						data: {
							message: 'Hello Vue!'
						}
					})
				<?php echo '</script'; ?>
>
           </div>
           
           
           
			<div id="app-2">
				<span v-bind:title="message">
    鼠标悬停几秒钟查看此处动态绑定的提示信息！
  </span>
			</div>

			<?php echo '<script'; ?>
>
				var app2 = new Vue({
					el: '#app-2',
					data: {
						message: '页面加载于 ' + new Date().toLocaleString()
					}
				})
			<?php echo '</script'; ?>
>

			<div id="app-3">
				<p v-if="seen">现在你看到我了</p>
			</div>

			<?php echo '<script'; ?>
>
				var app3 = new Vue({
					el: '#app-3',
					data: {
						seen: true
					}
				})
			<?php echo '</script'; ?>
>

			<div id="app-4">
				<ol>
					<li v-for="todo in todos">
						{{ todo.text }}
					</li>
				</ol>
			</div>

			<?php echo '<script'; ?>
>
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
			<?php echo '</script'; ?>
>

			<div id="app-5">
				<p> {{ message }} </p>
				<button v-on:click="reverseMessage">逆转消息</button>
			</div>

			<?php echo '<script'; ?>
>
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
			<?php echo '</script'; ?>
>

			<div id="app-6">
				<p> {{ message }} </p>
				<input v-model="message">
			</div>

			<?php echo '<script'; ?>
>
				var app6 = new Vue({
					el: '#app-6',
					data: {
						message: 'Hello Vue!'
					}
				})
			<?php echo '</script'; ?>
>

		</div>

	</div>
<!-- end .container --> </div>
	<?php $_smarty_tpl->_subTemplateRender("file:foot.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


</body>

</html><?php }
}
