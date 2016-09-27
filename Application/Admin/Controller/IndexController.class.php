<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){ 
          session_start();
          if(isset($_SESSION['user'])){     
          $adress=array();
          $adress['editor']=U('Admin/Editor/index');
          $adress['gzht']=U('Admin/Gzht/index');
          $adress['ycl']=U('Admin/Ycl/index');
          $this->assign('adress',$adress);
          $this->display();
        }else{
          echo "请先登录";
        }
    }
    public function yanzheng(){
      
    	$user=I('post.userName','',htmlspecialchars);
    	$pass=I('post.password','',htmlspecialchars);
      $xuan=I('post.xuan','',htmlspecialchars);
      session_start();

      if($xuan=='stu'){
          $ze="学生";
      }else{
          $ze="教师";
      }
    	define('LOGIN_URL','http://121.22.25.47/default4.aspx');
        define('INDEX_URL', 'http://121.22.25.47/');
        $cookie_jar = tempnam('./tmp', 'cookie');
        $url = LOGIN_URL;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);
        $content = curl_exec($ch);
        curl_close($ch);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $ret = curl_exec($ch);
        curl_close($ch);

        $pattern = '/<input type="hidden" name="__VIEWSTATE" value="(.*)" \/>/i';
        preg_match($pattern, $ret, $matches);
        $view_size = sizeof($matches);
        if ($view_size > 1) {
            $viewstate = urlencode($matches[1]);
        }
        else{
            echo "网络故障!";
            exit;
        }

        $a = file_get_contents("http://121.22.25.47/default4.aspx");
        $a = strstr($a,"__VIEWSTATE");
        $a1 = strpos($a,"__VIEWSTATE")+20;
        $a2 = strpos($a,"/>");
        $post = array(
        "__VIEWSTATE" => substr($a,$a1,$a2-$a1-2),
        "TextBox1"    => "$user",
        "TextBox2"    => "$pass",
        "RadioButtonList1"=> iconv( "UTF-8", "gb2312" , "$ze"),
        "Button1"     => iconv( "UTF-8", "gb2312" , "提交"),
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, INDEX_URL."(gsv5oxfexlttmv32ll1nbcy4)/default4.aspx");
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
        $result=curl_exec($ch);
        curl_close($ch);
        
        if($xuan=='ch'){
          $check = strpos($result, 'js_main.aspx?xh=');
        }else{
          $check = strpos($result, ' /xsxk_syxm.aspx?xh=');
        }
      

        if($check) {
          if($xuan=="ch"){
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, INDEX_URL."html/jsxx/{$user}.html");
          curl_setopt($ch, CURLOPT_HEADER, false);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
          curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
          $abc=curl_exec($ch);
          curl_close($ch);
          $arr=iconv('gb2312', 'UTF-8', $abc);
          $pattern='/<TD width="490" height="1">(.+)<\/TD>/';
          preg_match_all($pattern, $arr, $matche);
          $name=$matche[1][0];
          }else{       
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, INDEX_URL."xskb.aspx?xh={$user}&xhxx={$user}2016-20171");
          curl_setopt($ch, CURLOPT_HEADER, false);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
          curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
          $abc=curl_exec($ch);
          curl_close($ch);          
          $pattern = '/<td><span id="Label5">(.+)<\/span><\/td>/';
          preg_match_all($pattern, $abc, $matche);
          $arr=array();
          $arr[]=$matche[1][0];
          $pattern = '/<TD><span id="Label6">(.+)<\/span><\/TD>/';
          preg_match_all($pattern, $abc, $matche);
          //print_r($matche);
          $arr[]=$matche[1][0]; 
          $pattern = '/<TD><span id="Label8">(.+)<\/span><\/TD>/';
          preg_match_all($pattern, $abc, $matche);
          $arr[]=$matche[1][0];
          $use=iconv('gb2312', 'UTF-8', $arr[1]);
          $name=explode('：', $use);
          $name=$name[1];
          //print_r($name);
          }
          $_SESSION['name']=$name;
          $db=new \Model('user');
          $res=$db->where("name=$user")->select();
          $content=$res->rows();
          //print_r($content);
       
          if($content['quanxian']=='1'){ 
          
          $_SESSION['user']=1;  
          $adress=array();
          $adress['editor']=U('Admin/Editor/index');
          $adress['gzht']=U('Admin/Gzht/index');
          $adress['ycl']=U('Admin/Ycl/index');
          $this->assign('adress',$adress); 
          $this->assign('name',$name);
          $this->display('index/index');
          }else{
            $this->error("对不起你没有权限");
          }
          
        }else{
           $num1=strpos($result, "Content-Length");
           $num=substr($result, ($num1+15),5);
           //echo $num;
           if ($xuan=='ch') {
             if($num==3752){
                 $this->error("账号或者密码错误");
              }else{
                $this->error("请输入正确的用户名或密码，或者您输入的用户名不存在");
              }
            }else{
              //echo $num; 
              if($num==3758){
                 $this->error("账号或者密码错误");
              }else{
                $this->error("请输入正确的用户名或密码，或者您输入的用户名不存在");
           }
           
        }

}
}
}
?>