<?php
require("inc/data.php");
$act=isset($_GET['act'])?$_GET['act']:false;
$err="";
session_start();
if(isset($_SESSION['admin_id'])&&isset($_SESSION['is_login'])&&!empty($_SESSION['admin_id'])&&!empty($_SESSION['is_login'])){
	header("Location: index.php");
}
if($act=="login"){
	$name=isset($_POST['name'])?$_POST['name']:false;
	$name=!empty($name)?$name:false;
	$password=isset($_POST['password'])?$_POST['password']:false;
	$password=!empty($password)?sha1($password):false;
	if($name&&$password){
		$result=$mysqli->query("select id from admin where name='".$name."' and password='".$password."' limit 1");
		if($result->num_rows>0){
			$row=$result->fetch_object();
			$_SESSION['admin_id']=$row->id;
			$_SESSION['is_login']=1;
			header("Location: index.php");
		}else{
			$err="用户名或密码错误";
		}
	}
}
if($act=="out"){
	unset($_SESSION['admin_id']);
	unset($_SESSION['is_login']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录-<?=SYSTEM_NAME?></title>
<link rel="stylesheet" type="text/css" href="css/public.css" />
<link rel="stylesheet" type="text/css" href="css/page.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/public.js"></script>
</head>
<body>

	<!-- 登录页面头部 -->
	<div class="logHead clear">
		<div class="system_name"><?=SYSTEM_NAME?></div>
		<div class="ads"><img src="img/wellcom.jpg"/> </div>
	</div>
	<!-- 登录页面头部结束 -->

	<!-- 登录body -->
	<div class="logDiv">
		<img class="logBanner" src="img/logBanner.jpg" />
		<div class="logGet">
			<!-- 头部提示信息 -->
			<div class="logD logDtip">
				<p class="p1">登录</p>
				<p class="p2"><?=$err?></p>
			</div>
			<!-- 输入框 -->
			<form action="?act=login" method="post">
			<div class="lgD">
				<img class="img1" src="img/logName.png" /><input type="text"
					placeholder="输入用户名" name="name" />
			</div>
			<div class="lgD">
				<img class="img1" src="img/logPwd.png" /><input type="password"
					placeholder="输入用户密码" name="password" />
			</div>
			<div class="logC">
				<button>登 录</button>
<!--				<a href="#">注 册</a>-->
			</div>
			</form>
		</div>
	</div>
</body>
</html>