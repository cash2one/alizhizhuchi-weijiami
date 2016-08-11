<?php
require("lic_admin.php");
session_start();
if(!isset($_SESSION['admin_id'])||!isset($_SESSION['is_login'])||empty($_SESSION['admin_id'])||empty($_SESSION['is_login'])){
	header("Location: log.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>头部-<?=SYSTEM_NAME?></title>
<link rel="stylesheet" type="text/css" href="../css/public.css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/public.js"></script>
</head>

<body>
	<!-- 头部 -->
	<div class="head">
		<div class="headL">
			<h1><?=SYSTEM_NAME?>&nbsp;<span>v<?=$config['ver']?></span></h1>
			<div><em><?=$config['vip']?></em>版本&nbsp;&nbsp;&nbsp;授权截止<em><?=date('Y-m-d',$config['enddate'])?></em></div>
		</div>
		<div class="headR">
			<img src="http://vip.alizhizhuchi.top/ad/wellcom.jpg" onerror="javascript:this.src='../img/wellcom.jpg';"/>
		</div>
	</div>
</body>
</html>