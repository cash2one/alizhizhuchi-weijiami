<?php
header ( "Content-type:text/html;charset=utf-8" );
require("data.php");
include("function.php");
define('SYSTEM_NAME','阿里蜘蛛池');
define('SITE_NAME','阿里蜘蛛池');
//手动授权验证
$a=isset($_GET['a'])?$_GET['a']:"";
if($a=="shouquan"){
    $post_data['act']="shouquan";
    if($request=request_post($post_data)){
        $result=json_decode($request);
        $sql="update config set title='".$result->title."',vip='".base64_encode($result->vip)."',domain='".base64_encode($result->domain)."',templates='".base64_encode($result->templates)."',enddate='".base64_encode($result->enddate)."',date='".base64_encode(mt_rand(strtotime(date('Y-m-d',strtotime("+1 day"))),strtotime(date('Y-m-d',strtotime("+2 day")))))."' limit 1";
        $mysqli->query($sql);
        //域名限制
        $vip_domain_num=$result->domain;
        $domain_num=$mysqli->query("select count(*) as count from domains")->fetch_object()->count;
        if($domain_num>$vip_domain_num){
            //如果超出限制,删除多余
            $del_num=$domain_num-$vip_domain_num;
            $mysqli->query("delete from domains order by id desc limit ".$del_num);
        }
        //模板限制
        $vip_templates_num=$result->templates;
        $templates_num=$mysqli->query("select count(*) as count from templates where ok=1")->fetch_object()->count;
        if($templates_num>$vip_templates_num){
            //如果超出限制,禁用多余
            $del_num=$templates_num-$vip_templates_num;
            $mysqli->query("update templates set ok=0 where ok=1 order by id desc limit ".$del_num);
        }
        echo SITE_NAME."警告:授权更新成功";exit;
    }else{
        echo SITE_NAME."警告:此域名未授权";exit;
    }
}
//自动授权验证
$config=config_list();
if($config['title']&&$config['enddate']&&$config['date']&&$config['vip']&&$config['domain']&&$config['templates']){//如果为空,可能为第一次使用,需要获取服务器信息
    if($config['enddate']-time()>48*60*60||time()>$config['date']){//如果验证时间大于当前时间48小时,或者当前时间大于验证时间,那么联网验证,一天联网验证一次
        $post_data['act']="shouquan";
        if($request=request_post($post_data)){
            $result=json_decode($request);
            $sql="update config set vip='".base64_encode($result->vip)."',domain='".base64_encode($result->domain)."',templates='".base64_encode($result->templates)."',enddate='".base64_encode($result->enddate)."',date='".base64_encode(mt_rand(strtotime(date('Y-m-d',strtotime("+1 day"))),strtotime(date('Y-m-d',strtotime("+2 day")))))."' limit 1";
            $mysqli->query($sql);
            //验证成功,发送当前数据到服务器:域名个数,昨日蜘蛛数量
            $duankou=$_SERVER["SERVER_PORT"];
            $yuming=$_SERVER['HTTP_HOST'];
            $yuming=str_replace(':'.$duankou, '', $yuming);
            //获取域名数量
            $domain_num=data_num("domains");
            $spider_num=data_num('spider','',date('Y-m-d',time()-1*24*3600));
            file_get_contents("http://vip.alizhizhuchi.top/index.php?act=data&domain=".$yuming."&domain_num=".$domain_num."&spider_num=".$spider_num);//修改服务器域名
            //域名限制
            $vip_domain_num=$result->domain;
            $domain_num=$mysqli->query("select count(*) as count from domains")->fetch_object()->count;
            if($domain_num>$vip_domain_num){
                //如果超出限制,删除多余
                $del_num=$domain_num-$vip_domain_num;
                $mysqli->query("delete from domains order by id desc limit ".$del_num);
            }
            //模板限制
            $vip_templates_num=$result->templates;
            $templates_num=$mysqli->query("select count(*) as count from templates where ok=1")->fetch_object()->count;
            if($templates_num>$vip_templates_num){
                //如果超出限制,禁用多余
                $del_num=$templates_num-$vip_templates_num;
                $mysqli->query("update templates set ok=0 where ok=1 order by id desc limit ".$del_num);
            }
        }else{
            $sql="update config set enddate='".base64_encode(time())."',date='".base64_encode(mt_rand(strtotime(date('Y-m-d',strtotime("+1 day"))),strtotime(date('Y-m-d',strtotime("+2 day")))))."' limit 1";
            $mysqli->query($sql);
            echo SITE_NAME."警告:此域名未授权";exit;
        }
    }
    if(time()>$config['enddate']){//如果过期
        echo SITE_NAME."警告:您的帐号已过期,请购买授权。";exit;
    }
}else{
    echo SITE_NAME."警告:数据损坏";exit;
}
?>