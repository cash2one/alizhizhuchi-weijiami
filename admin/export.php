<?php
require("inc/lic_admin.php");
session_start();
if(!isset($_SESSION['admin_id'])||!isset($_SESSION['is_login'])||empty($_SESSION['admin_id'])||empty($_SESSION['is_login'])){
	header("Location: log.php");
}
$act=isset($_GET['act'])?$_GET['act']:"";
$type=isset($_GET['type'])?$_GET['type']:"";
$page=isset($_GET['page'])?$_GET['page']:"all";
if(list_data($act,$page,$type)) {
	$filename="ali_".$act.".txt";
	Header("Content-type:   application/octet-stream ");
	Header("Accept-Ranges:   bytes ");
	header("Content-Disposition:   attachment;   filename=$filename ");
	header("Expires:   0 ");
	header("Cache-Control:   must-revalidate,   post-check=0,   pre-check=0 ");
	header("Pragma:   public ");
	if($act=="spider"){
		foreach (list_data($act, $page, $type) as $row) {
			echo "序号:" . $row['id'] . " 搜索引擎:" . $row['ssyq'] . " 访问地址:" . $row['fwdz'] . " 来路地址:" . $row['lldz'] . " 日期:" . date('Y-m-d H:i:s', $row['rq']) . " IP地址:" . $row['ipdz'] . "\r\n";
		}
	}else{
		foreach (list_data($act, $page) as $row) {
			echo $row['title']."\r\n";
		}
	}
}
?>