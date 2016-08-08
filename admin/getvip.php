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
			<div style="font-size:18px;margin-bottom:10px;">授权截止日期:<span style="color:red;font-size:18px;font-weight:bold;"><?=date('Y-m-d',$config['enddate'])?></span></div>
			<?php
			//整个数据读取服务器,键名,值
			//获取服务器vip列表
			$post_data['act']="vipjibie";
			if($request=request_post($post_data)) {
				$request = json_decode($request, true);//转为数组
			?>
			<dl class="shuoming">
				<?php
				foreach($request['shuoming'] as $k=>$val) {
					if($k==0) {
						?>
						<dt><?= $val ?></dt>
						<?php
					}else {
						?>
						<dd><?= $val ?></dd>
						<?php
					}
				}
				?>
				<dd>&nbsp;</dd>
			</dl>
			<?php
				foreach($request[0] as $val){
			?>
			<dl<?if($config['vip']==$val['title']){?> class="cur"<?}?>>
				<?php
				foreach($val as $k=>$v) {
					if ($k == 'title') {
						?>
						<dt><?= $v ?></dt>
						<?php
					} elseif($k=='url') {
						?>
						<dd><a href="<?= $val['url'] ?>" target="_blank"><?if($val['title']=='免费'){echo "下载";}else{echo "升级";}?></a></dd>
						<?php
					}else{
						?>
					<dd><?= $v ?></dd>
					<?php
					}
				}
					?>
			</dl>
			<?php
				}
			}
			?>
		</div>
	</div>
</body>
</html>