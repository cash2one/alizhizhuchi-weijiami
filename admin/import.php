<?php
require("inc/lic_admin.php");
session_start();
if(!isset($_SESSION['admin_id'])||!isset($_SESSION['is_login'])||empty($_SESSION['admin_id'])||empty($_SESSION['is_login'])){
	header("Location: log.php");
}
$act=isset($_GET['act'])?$_GET['act']:"";

if (($_FILES["file"]["type"] == "text/plain") && ($_FILES["file"]["size"] < 1048576))
{
	if ($_FILES["file"]["error"] > 0)
	{
		echo "文件错误,上传失败";
	}
	else
	{
//		echo "Upload: " . $_FILES["file"]["name"] . "";
//		echo "Type: " . $_FILES["file"]["type"] . "";
//		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb";
//		echo "Temp file: " . $_FILES["file"]["tmp_name"] . "";

//		if (file_exists("upload/" . $_FILES["file"]["name"]))
//		{
//			echo $_FILES["file"]["name"] . " already exists. ";
//		}
//		else
//		{
			move_uploaded_file($_FILES["file"]["tmp_name"],
				"upload/" . $_FILES["file"]["name"]);
			//echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
//		}
		$file = fopen("upload/" . $_FILES["file"]["name"], "r") or exit("导入失败");

		while(!feof($file))
		{
			$line= fgets($file);
			$str= mb_convert_encoding($line, 'utf-8','gb2312');
			$sql="insert into ".$act." (`title`) values('".$str."')";
			$mysqli->query($sql);
		}
		fclose($file);
		unlink("upload/" . $_FILES["file"]["name"]);
		header("Location: info.php?act=".$act);
	}
}
else
{
	echo "格式错误或文件大于1M";
}

?>