<?php
/* Smarty version 3.1.30, created on 2017-10-21 16:30:10
  from "E:\web\bitbox\view\template\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59eb761252a178_48227866',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8b2dccd649c57dc697cd6feced8731d0455f596f' => 
    array (
      0 => 'E:\\web\\bitbox\\view\\template\\index.html',
      1 => 1508603391,
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
function content_59eb761252a178_48227866 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1447459eb7612500879_26018395';
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
		<div class="headright"> bitbox 的改进还希望更多借助大家的力量</br>
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