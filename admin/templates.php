<?php
require("inc/lic_admin.php");
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
	if($ok==1){//如果启用模板,进行权限验证
		$vip_templates_num=$config['templates'];
		$templates_num=$mysqli->query("select count(*) as count from templates where ok=1")->fetch_object()->count;
		if($templates_num>=$vip_templates_num){
			echo "<script>alert('模板开启数量已达到VIP限制,请升级您的帐号');self.location.href='templates.php';</script>";
			exit;
//            header("Location: info.php?act=".$from);
		}
	}
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
	<script>
		$(function(){
			$('#templates .down').click(function(){
				$('#loading').show();
			});
			$('#templates .down_no').click(function(){
				alert('您目前是免费用户,升级VIP后将开启所有模板下载权限');
			});
		})
	</script>
</head>
<body>
	<div id="loading">
		<img src="img/load.gif">
	</div>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="img/coin02.png" /><span><a href="main.php">首页</a>&nbsp;-&nbsp;<a
					href="templates.php#">系统管理</a>&nbsp;-</span>&nbsp;模板管理
			</div>
		</div>
		<div class="page clear">
			<ul class="templates" id="templates">
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