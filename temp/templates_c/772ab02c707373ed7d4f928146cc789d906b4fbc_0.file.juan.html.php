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

/* Smarty version 3.1.30, created on 2017-10-21 15:52:24
  from "E:\web\bitbox\view\template\juan.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59eb6d38388571_78492940',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '772ab02c707373ed7d4f928146cc789d906b4fbc' => 
    array (
      0 => 'E:\\web\\bitbox\\view\\template\\juan.html',
      1 => 1508601142,
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
function content_59eb6d38388571_78492940 (Smarty_Internal_Template $_smarty_tpl) {
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
	<?php $_smarty_tpl->_subTemplateRender("file:head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<div class="container">
		<!--   .container -->
		<div class="headright"> bitbox 的改进还希望更多借助大家的力量</br>
			</br>
			</br>
			</br>
		</div>
		<div class="header">
			<a href="index.php"><img src="public/images/box/base/logo.jpg" alt="bitbox" name="Insert_logo" width="180" id="Insert_logo" style="background: #C6D580; display:block;" /></a>

			<!-- end .header -->
		</div>
		<div class="sidebar1">
			<?php $_smarty_tpl->_subTemplateRender("file:left.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

			<!-- end .sidebar1 -->
		</div>
		<div class="bodybox">
			<div class="content">

				<div class="contenttop">
					<h2> 捐赠给bitbox </h2>

					<p> bitbox是一个强大的框架产品，即为学习提供了便利，也为大量国内商业项目提供了支持 。您对于bitbox的捐赠将完全用于该产品的升级与发展上。 我们希望未来有机会成为一支国内研发界的重要推动者。
					</p>

					<div class="contentfirst">
						感谢每一位捐赠者对于bitbox的支持！

						<div>
							<table cellspacing="0" cellpadding="0">
								<tr>
									<td>
										<div>
											<h4>支付宝捐赠：</h4> 支付宝帐号：(曾)   <br /> 可以用手机扫描二维码捐赠
											<br />
											<img src="public/images/box/base/alipay.jpg" alt="" /></div>
									</td>
									<td>
										<div>
											<h4>微信捐赠：</h4> 微信帐号：(黄) <br /> 可以用手机扫描二维码捐赠
											<br />
											<img src="public/images/box/base/weixin.jpg" alt="" /></div>
									</td>
								</tr>
							</table>
						</div>

						<div>
							<h3>捐赠列表</h3>
							<table>
								<tbody>
									<tr>
										<td>20¥</td>
										<td>tom</td>
										<td>2017-10-21</td>
										<td>支付宝</td>
									</tr>
									<tr>
										<td>10¥</td>
										<td>tom</td>
										<td>2017-10-20</td>
										<td>支付宝</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

				</div>

				<div class="contentmin">
 
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
 

				<div id="app-5">
					<p> {{ message }} </p>
					<button v-on:click="reverseMessage">逆转消息</button>
				</div>

				<?php echo '<script'; ?>
>
					var app5 = new Vue({
						el: '#app-5',
						data: {
							message: '你好BitBox!'
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
							message: '你是最棒的捐献者!'
						}
					})
				<?php echo '</script'; ?>
>

			</div>

		</div>
		<!-- end .container -->
	</div>
	<?php $_smarty_tpl->_subTemplateRender("file:foot.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


</body>

</html><?php }
}
