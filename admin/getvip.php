<?php
require("inc/lic_admin.php");
session_start();
if(!isset($_SESSION['admin_id'])||!isset($_SESSION['is_login'])||empty($_SESSION['admin_id'])||empty($_SESSION['is_login'])){
	header("Location: log.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>帐号升级-<?=SYSTEM_NAME?></title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="img/coin02.png" /><span><a href="main.php">首页</a>&nbsp;-&nbsp;<a
					href="getvip.php#">系统管理</a>&nbsp;-</span>&nbsp;帐号升级
			</div>
		</div>
		<div class="page ">
			当前帐号级别为:<span style="color:red;">vip <?=$config['vip']?></span><br/>
			可添加域名数量:<span style="color:red;"><?=$config['domain']?></span><br/>
			可应用模板数量:<span style="color:red;"><?=$config['templates']?></span><br/>
		</div>
	</div>
</body>
</html>