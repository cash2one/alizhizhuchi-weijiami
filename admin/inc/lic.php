<?php
header ( "Content-type:text/html;charset=utf-8" );
require("data.php");
include("function.php");
define('SYSTEM_NAME','阿里蜘蛛池');
define('SITE_NAME','阿里蜘蛛池');

//手动授权验证
$a=isset($_GET['a'])?$_GET['a']:"";
if($a=="shouquan"){
    $duankou=$_SERVER["SERVER_PORT"];
    $yuming=$_SERVER['HTTP_HOST'];
    $yuming=str_replace(':'.$duankou, '', $yuming);
    $url="http://vip.xianzhihulian.com/index.php";
    $post_data['act']="shouquan";
    $post_data['domain']=$yuming;
    if($request=request_post($url, $post_data)){
        $result=json_decode($request);
        $sql="update config set title='".$result->title."',vip='".base64_encode($result->vip)."',domain='".base64_encode($result->domain)."',templates='".base64_encode($result->templates)."',enddate='".base64_encode($result->enddate)."',date='".base64_encode(mt_rand(strtotime(date('Y-m-d',strtotime("+1 day"))),strtotime(date('Y-m-d',strtotime("+2 day")))))."' limit 1";
        $mysqli->query($sql);
        echo "授权更新成功";exit;
    }else{
        echo "此域名未授权";exit;
    }
}
//自动授权验证
$config=config_list();
if($config['title']&&$config['enddate']&&$config['date']&&$config['vip']&&$config['domain']&&$config['templates']){//如果为空,可能为第一次使用,需要获取服务器信息
    if($config['enddate']-time()>48*60*60||time()>$config['date']){//如果验证时间大于当前时间48小时,或者当前时间大于验证时间,那么联网验证,一天联网验证一次
        $url="http://vip.xianzhihulian.com/index.php";
        $post_data['act']="shouquan";
        $post_data['domain']=$config['title'];
        if($request=request_post($url, $post_data)){
            $result=json_decode($request);
            $sql="update config set vip='".base64_encode($result->vip)."',domain='".base64_encode($result->domain)."',templates='".base64_encode($result->templates)."',enddate='".base64_encode($result->enddate)."',date='".base64_encode(mt_rand(strtotime(date('Y-m-d',strtotime("+1 day"))),strtotime(date('Y-m-d',strtotime("+2 day")))))."' limit 1";
            $mysqli->query($sql);
            //todo:验证成功,发送当前数据到服务器:域名个数,昨日蜘蛛数量
        }else{
            $sql="update config set enddate='".time()."',date='".base64_encode(mt_rand(strtotime(date('Y-m-d',strtotime("+1 day"))),strtotime(date('Y-m-d',strtotime("+2 day")))))."' limit 1";
            $mysqli->query($sql);
            echo "此域名未授权";exit;
        }
    }
    if(time()>$config['enddate']){//如果过期
        echo "您的帐号已过期,请购买授权。";exit;
    }
}elseif($config['ver']&&$config['ver_date']){
    //如果授权信息为空,那么为第一次使用
    $duankou=$_SERVER["SERVER_PORT"];
    $yuming=$_SERVER['HTTP_HOST'];
    $yuming=str_replace(':'.$duankou, '', $yuming);
    $url="http://vip.xianzhihulian.com/index.php";
    $post_data['act']="shouquan";
    $post_data['domain']=$yuming;
    if($request=request_post($url, $post_data)){
        $result=json_decode($request);
        $sql="update config set title='".$result->title."',vip='".base64_encode($result->vip)."',domain='".base64_encode($result->domain)."',templates='".base64_encode($result->templates)."',enddate='".base64_encode($result->enddate)."',date='".base64_encode(mt_rand(strtotime(date('Y-m-d',strtotime("+1 day"))),strtotime(date('Y-m-d',strtotime("+2 day")))))."' limit 1";
        $mysqli->query($sql);
    }else{
        echo "此域名未授权";exit;
    }
}else{
    echo "数据损坏";exit;
}
?>