<?php
require("inc/lic_admin.php");
session_start();
if(!isset($_SESSION['admin_id'])||!isset($_SESSION['is_login'])||empty($_SESSION['admin_id'])||empty($_SESSION['is_login'])){
	header("Location: log.php");
}
$title=isset($_GET['title'])?$_GET['title']:"";
$name=isset($_GET['name'])?$_GET['name']:"";
$zip=isset($_GET['zip'])?$_GET['zip']:"";
$url="http://vip.alizhizhuchi.top".$zip;
if($title&&$name&&$zip){
	//服务器文件下载
	$url=urldecode($url);
	$fname=basename("$url"); //返回路径中的文件名部分  fetion_sms.zip
	$upload_dir="upload/";//上传的路径
	$dir=$upload_dir.$fname;//创建上传目录
	$file = fopen ($url, "rb");
	if ($file) {
		$newf = fopen ($dir, "wb");
		if ($newf)
			while(!feof($file)) {
				fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
			}
	}
	if ($file) {
		fclose($file);
	}
	if ($newf) {
		fclose($newf);
		//下载后解压缩
		$zip=new ZipArchive();
		if($zip->open($dir)===TRUE){
			$zip->extractTo('../templates/'.$title);
			$zip->close();
			//写入数据库
			$mysqli->query("insert into templates (`title`,`ok`,`name`) VALUES ('".$title."',1,'".$name."')");
			//删除模板包
			unlink($dir);
//		echo "下载成功";
			header("Location: templates.php");
		}else{
			echo "解压失败";
		}
	}else{
		echo "下载失败";
	}
}
?>