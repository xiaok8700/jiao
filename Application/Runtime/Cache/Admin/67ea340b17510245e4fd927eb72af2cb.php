<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="/jiaowu/Public/home/css/wangEditor.min.css"/>
		<title>测试页</title>
		<style type="text/css">
			input{
				padding: 3px 8px;
				font-size: 1.2em;
				line-height: 100%;
				height: 1.2em;
				width: 100%;
				margin-bottom: 30px;	
			}
			p{
				font-size: 1.2em;
				font-weight: bold;
				
			}
			span{
				display: block;
				padding-bottom: 10px;
			}
			body{
				background-color:#F1F1F1;
			}
		</style>
	</head>
	<body>
		<div style="width: 80%; margin: 0 auto;">
		<p>请输入文章的标题和内容</p>
		
		<input type="text" name="title" id="title" value="请输入文章的标题" />
		<span>请输入文章的内容：</span>
		<div id="div1" style="height: 300px;">
		</div>
		<p align="center"><button id="btn1">提交</button></p>
	</div>
	
	
	
	
	
	<script type="text/javascript" src="/jiaowu/Public/home/js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="/jiaowu/Public/home/js/wangEditor.min.js"></script>
	<script type="text/javascript">
		var editor=new wangEditor('div1');
		editor.create();
		 $('#btn1').click(function () {
        // 获取编辑器区域完整html代码
        var html = editor.$txt.html();
        $.ajax({
					async: true,
					url:"/jiaowu/index.php/Admin/Editor/edit",
					type:"POST",
					data:{
					title:$("#title").val(),
					text:html},
					dataType: "html",
					success: function(data){
					    alert(data);
					}
				
				})
    });
	</script>
	
	</body>
</html>