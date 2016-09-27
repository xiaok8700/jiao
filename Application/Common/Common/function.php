<?php
    function adres(){
    	$adress=array();
    	$adress['index']=U("Home/Index/index");
    	$adress['notice']=U("Home/Notice/index");
    	$adress['technical']=U("Home/Technical/index");
    	$adress['feddback']=U('Home/Feddback/index');
    	return $adress;
    }
   
?>