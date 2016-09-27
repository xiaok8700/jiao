<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<script type="text/javascript" src="/jiaowu/Public/home/Js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="/jiaowu/Public/home/Js/index.js"></script>
<link rel="stylesheet" href="/jiaowu/Public/home/css/public.css" />
<link rel="stylesheet" href="/jiaowu/Public/home/css/admin.css" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<base target="iframe"/>
<head>
</head>
<body>
	<div id="top">
		<div class="menu">
			<!--<a href="#">选择按钮</a>
			<a href="#">选择按钮</a>
			<a href="#">选择按钮</a>
			<a href="#">选择按钮</a>
			<a href="#">选择按钮</a>-->
			<h1>欢迎<?php echo ($name); ?>登录后台</h1>
		</div>
		<div class="exit">
			<a href="#" target="_self">退出</a>
			<a href="#" target="_blank">获得帮助</a>
			<a href="#" target="_blank">标题栏</a>
		</div>
	</div>
	<div id="left">
		<dl>
			<dt>功能标题</dt>
			<dd><a href="<?php echo ($adress['editor']); ?>" target="iframe">通知公告发布页面</a></dd>
			<dd><a href="<?php echo U('Editor2/index');?>" target="iframe">技术文章发布页面</a></dd>
			<dd><a href="<?php echo ($adress['gzht']); ?>" target="iframe">未处理故障报修页面</a></dd>
			<dd><a href="<?php echo ($adress['ycl']); ?>" target="iframe">已处理故障页面</a></dd>
			<dd><a href="<?php echo U('');?>">技术文档发布页面</a></dd>
			<dd><a href="#">功能标题</a></dd>
			<dd><a href="#">功能标题</a></dd>
		</dl>
	</div>
	<div id="right">
		<iframe name="iframe" src="<?php echo ($adress['editor']); ?>"></iframe>
		
	</div>
</body>
</html>