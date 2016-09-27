<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>教室多媒体管理中心</title>
	<link rel="stylesheet" type="text/css" href="/jiaowu/Public/home/css/common.css">
	<link rel="stylesheet" type="text/css" href="/jiaowu/Public/home/css/index.css">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
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
			</ul>
		</div>
		<div id="scroll"></div>
		<div id="content">
			<div class="conLeft">
				<div class="leftTop">
					<span class="tz">通知公告</span>
					<a href="<?php echo ($adress["notice"]); ?>" class="gd">更多＞＞</a>
					<ul>
					    <?php if(is_array($timu)): foreach($timu as $key=>$v): ?><li><a href="<?php echo ($v["adress"]); ?>"><span class="tongzhi"><?php echo ($v["timu"]); ?></span><span class="shijian"><?php echo ($v["time"]); ?></span></a></li><?php endforeach; endif; ?>

					</ul>
				</div>
				<div class="leftBottom" >
					<span class="tz">技术文档</span>
					<a href="#" class="gd">更多＞＞</a>
					<ul>
					    <?php if(is_array($tech)): foreach($tech as $key=>$v): ?><li><a href="<?php echo ($v["adress"]); ?>"><span class="tongzhi"><?php echo ($v["timu"]); ?></span><span class="shijian"><?php echo ($v["time"]); ?></span></a></li><?php endforeach; endif; ?>
					</ul>
				</div>

				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">

				    <div class="item active">
				      <img src="/jiaowu/Public/home/images/1.jpg" alt="...">
				    </div>

				    <div class="item">
				      <img src="/jiaowu/Public/home/images/2.jpg" alt="...">
				    </div>

				    <div class="item">
				      <img src="/jiaowu/Public/home/images/3.jpg" alt="...">
				    </div>

				    <div class="item">
				      <img src="/jiaowu/Public/home/images/4.jpg" alt="...">
				    </div>
				   </div>

				  <!-- Controls -->
				  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				  </a>

				  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>

				  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>

				  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>

				</div>
			</div>
			<div class="conRight">
				<div class="rightTop">
					<!--<img src="images/denglu.png"><br/><br/>-->
                    <form action="<?php echo ($yanzheng); ?>" method="post">
					用户名：<input type="text" id="userName" name="userName" size="16"><br/><br/>
					密　码：<input type="password" id="password" name="password" size="16"><br/><br/>
					<!--验证码：<input type="text" id="password" name="password1" size="5">-->
					<!--<span><img src="<?php echo U('Home/Index/verify');?>"></span>-->
					<p align="center"><input type="radio" value="stu" name="xuan"/>学生&nbsp;
					<input type="radio" value="ch" name="xuan" />教师&nbsp;
					<input type="radio" value="admin" name="xuan" />管理&nbsp;</p>
					<input type="image" src="/jiaowu/Public/home/images/bt1.png" class="bt">
					<input type="image" src="/jiaowu/Public/home/images/bt2.png" class="bt">
                   </form>
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
    <script src="/jiaowu/Public/home/js/jquery-1.11.0.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/jiaowu/Public/home/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    	$(function(){
		$('.carousel').carousel({
		interval: 2000
		});
		});
    </script>
</body>

</html>