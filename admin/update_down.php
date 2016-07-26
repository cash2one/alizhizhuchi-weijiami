<?php
require("inc/lic_admin.php");
session_start();
if(!isset($_SESSION['admin_id'])||!isset($_SESSION['is_login'])||empty($_SESSION['admin_id'])||empty($_SESSION['is_login'])){
	header("Location: log.php");
}
$ver=isset($_GET['ver'])?$_GET['ver']:"";
$ver_date=isset($_GET['ver_date'])?$_GET['ver_date']:"";
$zip=isset($_GET['zip'])?$_GET['zip']:"";
$url="http://vip.alizhizhuchi.top".$zip;
if($ver&&$ver_date&&$zip){
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
			$zip->extractTo('upload/'.$ver);
			$zip->close();
			//复制文件到根目录
			recurse_copy($upload_dir.$ver,"../");
			//如果根目录有update.sql文件,那么执行数据库更新
			$file = fopen("/update.sql");
			if($file){
				while(!feof($file))
				{
					$line= fgets($file);
					$mysqli->query($line);
				}
				fclose($file);
				unlink("/update.sql");
			}
			//更新数据库
			$mysqli->query("update config set ver='".base64_encode($ver)."',ver_date='".base64_encode($ver_date)."' limit 1");
			//删除更新包
			unlink($dir);
//		echo "下载成功";
			header("Location: update.php");
		}else{
			echo "解压失败";
		}
	}else{
		echo "下载失败";
	}
}
?>