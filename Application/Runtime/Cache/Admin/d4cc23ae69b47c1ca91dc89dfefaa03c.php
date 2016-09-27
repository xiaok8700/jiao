<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="/jiaowu/Public/home/css/bootstrap.min.css"/>
		<link type="text/css" rel="stylesheet" href="/jiaowu/Public/home/css/gzht.css" />
		<link rel="stylesheet" href="/jiaowu/Public/home/css/jquery-ui.min.css" />
		<script type="text/javascript" src="/jiaowu/Public/home/js/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="/jiaowu/Public/home/js/jquery-ui.min.js"></script>
		<script type="text/javascript">
			$( function() {
    		$( "#date" ).datepicker();
    		var page='';
            
    		$("#xc").click(function(){	
    		var dateTime=$("#date").val();
			var roomId=$("#select").val();
				$.ajax({
					type:"post",
					url:"/jiaowu/index.php/Admin/Ycl/fink",
					data:{datetmin:dateTime,roomId:roomId,page:1},
					success:function(data){
					  s=data.indexOf('wu');
					  //alert(s);	
                      if(s!='-1'){
                      	alert('没有记录');
                      }else{
                      var str=eval("("+data+")");	
			          $(function(){				    
					  var data1="";
					  for(var i=0;i<str.xinxi.length;i++){
						  data1+="<tr id='tr1'><td>"+i+"</td><td>"+str.xinxi[i].class+"</td><td>"+str.xinxi[i].program+"</td><td>"+str.xinxi[i].people+"</td><td>"+str.xinxi[i].time+"</td><td>"+'未处理'+"</td><td><button data-toggle='modal' data-target='#myModal' onclick=get_msg("+str.xinxi[i].id+")>查看详情</button></td></tr>";}

					$("tr").remove("#tr1");	
					$("#table2").append(data1);
				
			      })
                  }
			      }
                                          
					
				});
    		
    		})
			
		})
			
			
		</script>
		<title>故障后台页</title>
	</head>
	<body>
		<table border="0" cellspacing="0" cellpadding="1" id="table1">
			<tr>
				<td>按日期查询</td><td id="time"><input type="text" id="date"></td>
				<td>按教室号查询</td><td id="roomid">
				<select id="select">
					<option id=""></option>
					<option id="A1033">A103</option>
					<option id="A1055">A105</option>
				</select>
				</td><!--按教室号查询-->
				<td><button id="xc" >查询</button></td>
			</tr>
		</table>
		<table  border="0" cellspacing="0" cellpadding="1" id="table2">
			<tr id="th">
				<td>编号</td>
				<td>问题教室</td>
				<td>问题情况</td>
				<td>反馈人</td>
				<td>处理时间</td>
				<td>问题状况</td>
				<td>处理人</td>
				<td>操作</td>
			</tr>
			<?php if(is_array($row)): foreach($row as $key=>$v): ?><tr id="tr1">
				<td><?php echo ($v["ci"]); ?></td>
				<td><?php echo ($v["class"]); ?></td>
				<td><?php echo ($v["program"]); ?></td>
				<td><?php echo ($v["people"]); ?></td>
				<td><?php echo ($v["time1"]); ?></td>
				<td>已处理</td>
				<td><?php echo ($v["cname"]); ?></td>
				<td><button data-toggle="modal" data-target="#myModal" onclick="get_msg(<?php echo ($v["id"]); ?>)">查看详情</button></td>
			  </tr><?php endforeach; endif; ?>
		</table>
		<!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>-->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">问题详情</h4>
      </div>
      <div class="modal-body" id='xiaok'>
       <script type="text/javascript"> 
          //function $(obj) {return document.getElementById(obj);}
          function get_msg(abc){
          	$.ajax({
					type:"post",
					url:"/jiaowu/index.php/Admin/Ycl/find",
					data:{id:abc},
					success:function(data){
					//alert(data);
					
                       var ob=eval("("+data+")");
                       //alert(ob.class);
                  
                       var html="<p>ID号:"+ob.id+"</p>"+"<p>教室:"+ob.class+"</p>"+"<p>提交人:"+ob.people+"</p>"+"<p>问题详情:"+ob.program+"</p>"+"<p>处理人:"+ob.cname+"</p>"+"<p>处理时间:"+ob.time1+"</p>"+ "<p>解决方法:"+ob.banfa+"</p>";
                       $('#xiaok').html(html);
                     
					}
    		   }); 
          }

      </script>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
		
		<p align="center"><a id="page1" href="<?php echo ($arr["shang"]); ?>">上一页</a><a id="page2" href="<?php echo ($arr["next"]); ?>">下一页</a></p>
		<!--<script type="text/javascript" src="jquery-1.11.0.min.js" ></script>-->
		<script type="text/javascript" src="/jiaowu/Public/home/js/bootstrap.min.js"></script>
		
	
	</body>
</html>