<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>教室多媒体管理中心</title>
	<link rel="stylesheet" type="text/css" href="/jiaowu/Public/home/css/common.css">
	<link rel="stylesheet" type="text/css" href="/jiaowu/Public/home/css/index.css">
	<link rel="stylesheet" type="text/css" href="/jiaowu/Public/home/css/tongzhi.css">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="/jiaowu/Public/home/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body style="background: #BDD6F4">
	<div id="container">
		<div id="banner">
			<img src="/jiaowu/Public/home/images/logo.png">
			<ul>
				<li><a href="<?php echo U('Home/Index/index');?>">首页</a></li>
				<li><a href="<?php echo U('Home/Notice/index');?>">通知公告</a></li>
				<li><a href="<?php echo U('Home/Technical/index');?>">技术文档</a></li>
				<li><a href="<?php echo U('About/index');?>">关于我们</a></li>
				<li><a href="<?php echo U('Home/Feddback/index');?>">故障报修</a></li>
				<li><a href="<?php echo U('Contact/index');?>">联系我们</a></li>
		</div>
		<div id="scroll"></div>
		<div id="content">
			
			<div class="conLeft">
				<div class="leftTop">
					<span class="tz">技术文档</span>
					<a href="" class="gd">更多＞＞</a>
					<ul>
					    <?php if(is_array($content)): foreach($content as $key=>$v): ?><li><a href="http://localhost/jiaowu/index.php/Home/Index/Technical/id/<?php echo ($v["id"]); ?>"><span class="tongzhi"><?php echo ($v["timu"]); ?>
						  </span><span class="shijian"><?php echo ($v["time"]); ?></span></a></li><?php endforeach; endif; ?>
                        <?php
 for ($i=1; $i <= $a ; $i++) { echo "<a href=\"http://localhost/jiaowu/index.php/Home/Technical/index/page/$i\">$i</a>"; } ?>

					</ul>
				</div>
				


			</div>
			<div class="conRight">
				<div class="rightTop0">
					<ul>
						<li><a href="#">河北科技师范学院官网</a></li>
						<li><a href="#">河北科技师范学院教务处</a></li>
						<li><a href="#">河北科技师范学院教务系统</a></li>
						<li><a href="#">河北省教育考试院</a></li>
						<li><a href="#">河北省教育考试院</a></li>
						<li><a href="#">河北省教育考试院</a></li>
					</ul>
				</div>
				<div class="rightCenter">
					<div class="dateTime">
				        <object type="application/x-shockwave-flash" style="outline: none;" data="http://www.since2014.com.cn/wp-content/plugins/homehomeclock/flash/homehomeclocktr.swf?" width="230" height="120">
				            <param name="movie" value="http://www.since2014.com.cn/wp-content/plugins/homehomeclock/flash/homehomeclocktr.swf?" />
				            <param name="AllowScriptAccess" value="always" />
				            <param name="wmode" value="opaque" />
				            <param name="bgcolor" value="" />
				        </object>
			        </div>
				</div>
				<div class="rightBottom">
					<ul>
						<li><a href="#">河北科技师范学院官网</a></li>
						<li><a href="#">河北科技师范学院教务处</a></li>
						<li><a href="#">河北科技师范学院教务系统</a></li>
						<li><a href="#">河北省教育考试院</a></li>
						<li><a href="#">河北省教育考试院</a></li>
						<li><a href="#">河北省教育考试院</a></li>
					</ul>
				</div>
			</div>
		</div>
		<hr width="950" align="center">
		<div id="footer">
			<p>Copyright 2016 All rights reserved</p>
			<p>版权所有：河北科技师范学院 多媒体管理中心 制作维护</p>
		</div>
	</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/jiaowu/Public/home/js/bootstrap.min.js"></script>
</body>

</html>