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
<title>系统升级-<?=SYSTEM_NAME?></title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="img/coin02.png" /><span><a href="main.php">首页</a>&nbsp;-&nbsp;<a
					href="update.php#">系统管理</a>&nbsp;-</span>&nbsp;系统升级
			</div>
		</div>
		<div class="page ">
			当前系统版本:v<?=$config['ver']?><br/>
			更新时间:<?=date('Y/m/d',$config['ver_date'])?><br/>

				<?php
				$post_data['act']="update";
				if($request=request_post($post_data)){
					$result=json_decode($request);
					if($result->date>$config['ver_date']) {
						?>
						发现新版本:v<?=$result->title?><br/>
						新版本说明:<?=$result->detail?><br/>
						发布时间:<?=$result->date?><br/>
						<a href="<?=$result->zip?>">更新</a>
						<?php
						//todo:远程更新
					}
				}
				?>
		</div>
	</div>
</body>
</html>