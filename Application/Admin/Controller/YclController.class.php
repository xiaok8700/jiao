<?php
namespace Admin\Controller;
use Think\Controller;
class YclController extends Controller {
   public function index(){
       session_start();
          if(!isset($_SESSION['user'])){ 
              $this->redirect('home/Index/index','',5,'您还没有登录，请您登录，5秒后自动跳转到系统登录页面~~~~');
          }else{
   	   $db=new \Model('guzhang');
         $page=isset($_GET['page'])?$_GET['page']:1;
         //echo $page;
         $db=new \Model('guzhang');
         $re=$db->where("`state`='1'")->select();
         $num=$db->get_count();
         //echo $num;
         $per=5;
         $a=ceil($num/$per);
         //echo $a;
         if($page > $a) $page=$a;
         if($page < 1)  $page=1;
         $arr=array();
         $arr['shang']=U('/Admin/Ycl/index/page/'.($page-1));
         $arr['next']=U('/Admin/Ycl/index/page/'.($page+1));
   	   $res=$db->where("`state`='1'")->order("`id` DESC")->limit(5,1)->select();
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

  } }
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
   public function fink(){
       session_start();
          if(!isset($_SESSION['user'])){ 
              $this->redirect('home/Index/index','',5,'您还没有登录，请您登录，5秒后自动跳转到系统登录页面~~~~');
          }else{
      $post=array();
      $post=$_POST;
      //print_r($post);   
      $post['page']=isset($_POST['page'])?$_POST['page']:1;      
      //print_r($post);      
      $db=new \Model('guzhang');
      $re=$db->where("`state`='1'")->select();
      $num=$db->get_count();
      //echo $num;
      $per=16;
      $a=ceil($num/$per);
      //echo $a;
      if($page > $a) $page=$a;
      if($page < 1)  $page=1;
      if(!empty($post['datetmin'])){
         $time=explode('/',$post['datetmin']);
         $time1=$time[2].'-'.$time[0].'-'.$time[1]; 
         $arr=array();       
         if(!empty($post['roomId'])){
            $res=$db->where("`time`='$time1' and  `class`='{$post['roomId']}' and `state`='1'")->order("`id` DESC")->limit($per,$page)->select();
         }else{
            $res=$db->where("`time`='$time1' and `state`='1'")->order("`id` DESC")->limit($per,$page)->select();
         }
      }else{
         if(!empty($post['roomId'])){
            $res=$db->where(" `class`='{$post['roomId']}' and `state`='1'")->order("`id` DESC")->limit($per,$page)->select();
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