<?php
require("inc/data.php");
session_start();
if(!isset($_SESSION['admin_id'])||!isset($_SESSION['is_login'])||empty($_SESSION['admin_id'])||empty($_SESSION['is_login'])){
	header("Location: log.php");
}
$act=isset($_GET['act'])?$_GET['act']:"";
$id=isset($_GET['id'])?$_GET['id']:"";
$id=is_numeric($id)?$id:"";
$ok=isset($_GET['ok'])?$_GET['ok']:"";
$ok=$ok==1?1:0;
if($act=='edit'&&$id){
	$sql="update templates set ok=".$ok." where id=".$id;
	$mysqli->query($sql);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>模板管理-<?=SYSTEM_NAME?></title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="img/coin02.png" /><span><a href="main.php">首页</a>&nbsp;-&nbsp;<a
					href="templates.php#">系统管理</a>&nbsp;-</span>&nbsp;模板管理
			</div>
		</div>
		<div class="page clear">
			<ul class="templates">
				<?php
				foreach(templates_list() as $key=>$value){
				?>
				<li><img src="<?=$value['thumb']?>"><?=$value['name']?><?=$value['us']?></li>
				<?}?>
			</ul>
		</div>
	</div>
</body>
</html>