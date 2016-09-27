<?php
namespace Home\Controller;
use Think\Controller;
class YanzhengController extends Controller {
      public function index(){
          $Verify=new \Think\Verify();
          $Verify->entry();
      }     


}

?>