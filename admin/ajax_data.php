<?php
/**
 * ajax数据接收页面,返回json格式
 * 接收要调用的函数,及相关参数
 * $act:函数名
 * $data:参数数组
 */
require("inc/lic_admin.php");
session_start();
if(!isset($_SESSION['admin_id'])||!isset($_SESSION['is_login'])||empty($_SESSION['admin_id'])||empty($_SESSION['is_login'])){
	header("Location: log.php");
}
//正式改为post
$act=isset($_POST['act'])?$_POST['act']:"";
$data=isset($_POST['data'])?$_POST['data']:"";
if($act){
    if($act=="get"){
        echo file_get_contents($data);exit;
    }
    $return_data=['data'=>$act($data)];
	echo json_encode($return_data);
}
?>