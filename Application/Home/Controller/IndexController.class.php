<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $db=new \Model("notice");
        $res=$db->order("`id` DESC")->limit(5,1)->select();        
        $timu=array();
        while($data=$res->rows()){
            $data['adress']=U("Home/Index/article/id/{$data['id']}");
            $timu[]=$data;
        }
        $db='';
        $db=new \Model('technical');
        $rs=$db->order("`id` DESC")->limit(5,1)->select();
        $tech=array();
        while($rows=$rs->rows()){
            $rows['adress']=U("Home/Index/technical/id/{$rows['id']}");
            $tech[]=$rows;
        }
        //print_r($tech);
        $adress=adres();
        $yanzheng=U("Admin/Index/yanzheng");
        $this->assign("yanzheng",$yanzheng);               
        $this->assign("adress",$adress);
        $this->assign('tech',$tech);
        $this->assign("timu",$timu);
        $this->display();
    }
    public function article(){
    	$id=I('get.id','','htmlspecialchars');
        $a=I('get.id','','htmlspecialchars');     
        $db=new \Model("notice");      
        $res=$db->where("`id`=$id")->select();
        $content=$res->rows();
        $adress=adres();               
        $this->assign("adress",$adress);
        $this->assign("content",$content);
        $this->display();

    }
    
    public function technical(){
        $id=I('get.id','','htmlspecialchars');
        $db=new \Model("technical");
        $res=$db->where("`id`=$id")->select();
        $content=$res->rows();   
        $adress=adres();               
        $this->assign("adress",$adress);
        $this->assign("content",$content);
        $this->display("article");
    } 
   public function verify() {

        $verify = new \Think\Verify();
        ob_clean();
        $verify->entry();
    }
   
}