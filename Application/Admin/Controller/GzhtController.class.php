<?php
namespace Admin\Controller;
use Think\Controller;
class GzhtController extends Controller {
   public function index(){
     session_start();
          if(!isset($_SESSION['user'])){ 
              $this->redirect('home/Index/index','',5,'您还没有登录，请您登录，5秒后自动跳转到系统登录页面~~~~');
          }else{
         $page=isset($_GET['page'])?$_GET['page']:1;
         //echo $page;
   	   $db=new \Model('guzhang');
         $re=$db->where("`state`='0'")->select();
         $num=$db->get_count();
         //echo $num;
         $per=5;
         $a=ceil($num/$per);
         //echo $a;
         if($page > $a) $page=$a;
         if($page < 1)  $page=1;
         //echo $page;
         $arr=array();
         $arr['shang']=U('/Admin/Gzht/index/page/'.($page-1));
         $arr['next']=U('/Admin/Gzht/index/page/'.($page+1));
   	   $res=$db->where("`state`='0'")->order("`id` DESC")->limit($per,$page)->select();
         $start=$per*($page-1)+1;
   	   $row=array();
   	   while($data=$res->rows()){
               $data['ci']=$start;
   	   	   $row[]=$data;
               $start++;
   	   }
   	   //print_r($row);
         $this->assign('arr',$arr);
   	   $this->assign('row',$row);
   	   $this->display();
   }}
   public function find(){
     session_start();
          if(!isset($_SESSION['user'])){ 
              $this->redirect('home/Index/index','',5,'您还没有登录，请您登录，5秒后自动跳转到系统登录页面~~~~');
          }else{
        $id=$_POST['id'];
        $db=new \Model('guzhang');
        $res=$db->where("`id`='$id'")->get_one();
        $arr=json_encode($res);
        echo  $arr;
  } }
   public function insert(){
     session_start();
          if(!isset($_SESSION['user'])){ 
              $this->redirect('home/Index/index','',5,'您还没有登录，请您登录，5秒后自动跳转到系统登录页面~~~~');
          }else{
        session_start();
        $id=$_POST['id'];
        $text=$_POST['text'];
        $time=date('Y-m-d');
        $cname=$_SESSION['name'];
        $db=new \Model('guzhang');
        $post['banfa']=$text;
        $post['state']=1;
        $post['cname']=$cname;
        $post['time1']=$time;
        $db->where("`id`='$id'")->update($post);
        echo "处理成功";

  } }
   public function fink(){
     session_start();
          if(!isset($_SESSION['user'])){ 
              $this->redirect('home/Index/index','',5,'您还没有登录，请您登录，5秒后自动跳转到系统登录页面~~~~');
          }else{
      $post=array();
      $post=$_POST; 
      //echo $post['page'];
      $page=$post['page'];     
      //print_r($post);      
      $db=new \Model('guzhang');
      $re=$db->where("`state`='0'")->select();
      $num=$db->get_count();
      //echo $num;
      $per=5;
      $a=ceil($num/$per);
      //echo $a;
      if($page > $a) $page=$a;
      if($page < 1)  $page=1;
      if(!empty($post['datetmin'])){
         $time=explode('/',$post['datetmin']);
         $time1=$time[2].'-'.$time[0].'-'.$time[1]; 
         $arr=array();       
         if(!empty($post['roomId'])){
            $res=$db->where("`time`='$time1' and  `class`='{$post['roomId']}' and `state`='0'")->order("`id` DESC")->limit($per,$page)->select();
         }else{
            $res=$db->where("`time`='$time1' and `state`='0'")->order("`id` DESC")->limit($per,$page)->select();
         }
      }else{
         if(!empty($post['roomId'])){
            $res=$db->where(" `class`='{$post['roomId']}' and `state`='0'")->order("`id` DESC")->limit($per,$page)->select();
         }else{
            $res=$db->limit($per,$page)->order("`id` DESC")->select();
         }
      }
      while($data=$res->rows()){
            $arr['xinxi'][]=$data;
         } 
      if(!empty($arr)){
            $arr['page']['next']=$page+1;
            $arr['page']['shang']=$page-1;
            $arr1=json_encode($arr);
            echo $arr1;
      }else{
            echo 'wu';
      }
      
          
   }
  
 } }
?>