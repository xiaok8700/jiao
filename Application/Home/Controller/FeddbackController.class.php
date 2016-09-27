<?php
namespace Home\Controller;
use Think\Controller;
class FeddbackController extends Controller {
    public function index(){ 
         $this->display();
}
   public function charu(){
        $class=urldecode(I('post.data6','',htmlspecialchars));
        $cuser=urldecode(I('post.data7','',htmlspecialchars));
   	    $computer=urldecode(I('post.data1','',htmlspecialchars));
   	    $yin=urldecode(I('post.data2','',htmlspecialchars));
   	    $she=urldecode(I('post.data3','',htmlspecialchars));
   	    $zhong=urldecode(I('post.data4','',htmlspecialchars));
   	    $jiguang=urldecode(I('post.data5','',htmlspecialchars));
        $qita=urldecode(I('post.data8','',htmlspecialchars));
        $arr=array('computer=','audio=','tyj=','zk=','jgb=','1');
        $arr1=array('&nbsp;','&nbsp;','&nbsp;','&nbsp;','&nbsp;','');
   	    $str=$computer.$yin.$she.$zhong.$jiguang.$qita;
         $stre=str_replace($arr,'',$str);

         //echo $stre;
         if($stre){
          $time=date("Y/m/d");
          $db=new \Model('guzhang');
          $post['people']=$cuser;
          $post['class']=$class;
          $post['time']=$time;
          $post['time1']='';
          $post['program']=$stre;
          $post['state']=0;
          $post['banfa']='';
          $db->edit($post);
          echo "反馈成功";
        }
   }
  public function cuser(){
          $name=$_POST['name'];
          define('INDEX_URL', 'http://121.22.25.47/');
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, INDEX_URL."html/jsxx/{$name}.html");
          curl_setopt($ch, CURLOPT_HEADER, false);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
          $abc=curl_exec($ch);
          curl_close($ch);
          $arr=iconv('gb2312', 'UTF-8', $abc);
          $pattern='/<TD width="490" height="1">(.+)<\/TD>/';
          preg_match_all($pattern, $arr, $matche);
          $name=$matche[1][0];
          echo $name;
 }
}
?>    	