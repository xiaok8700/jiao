<?php
namespace Home\Controller;
use Think\Controller;
class NoticeController extends Controller {
    public function index(){
    	$page=I('get.page',1,'htmlspecialchars');
    	$db=new \Model("notice");
    	$res=$db->select();
    	$num=$db->get_count();
    	$per=5;
        $a=ceil($num/$per);
        $content=$db->get_list($per,$page);
        $adress=adres();
        $this->assign("adress",$adress); 
        $this->assign("a",$a);      
        $this->assign("content",$content);
        $this->display();

    }
}
?>