<?php
namespace Admin\Controller;
use Think\Controller;
class Editor2Controller extends Controller {
   public function index(){
    session_start();
          if(!isset($_SESSION['user'])){ 
              $this->redirect('home/Index/index','',5,'您还没有登录，请您登录，5秒后自动跳转到系统登录页面~~~~');
          }else{
   	   $this->display();}
   }
   public function edit(){
     session_start();
          if(!isset($_SESSION['user'])){ 
              $this->redirect('home/Index/index','',5,'您还没有登录，请您登录，5秒后自动跳转到系统登录页面~~~~');
          }else{
   	   $post=array();
   	   $post['timu']=$_POST['title'];
   	   $post['content']=$_POST['text'];
   	   $post['time']=date("Y-m-d");
       $db=new \Model('technical');
   	   $db->key='id';   	   
   	   $db->edit($post);
       /*
       $arr=json_encode($post);
       echo $arr;
       */
       echo "您一提交";

   	   
}
   }
  
  }
?>