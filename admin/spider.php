<?php
require("inc/data.php");
session_start();
if(!isset($_SESSION['admin_id'])||!isset($_SESSION['is_login'])||empty($_SESSION['admin_id'])||empty($_SESSION['is_login'])){
	header("Location: log.php");
}
$act=isset($_GET['act'])?$_GET['act']:"";
$type=isset($_GET['type'])?$_GET['type']:"";
$page=isset($_GET['page'])?$_GET['page']:1;
if($act=="ip_update"){
	$err=ip_update($page);
}
//if($act=="del_all"){
//	spider_del_all();
//}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>蜘蛛日志-<?=SYSTEM_NAME?></title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<link rel="stylesheet" type="text/css" href="css/pageGroup.css" />
	<script type="text/javascript">
		<?php
		if(isset($err)){?>
		var err=<?=$err?>;
		if(err){
			alert('更新完成');
		}
		<?}?>
	</script>
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="img/coin02.png" style="float:left;margin-top:10px;" /><span><a href="main.php">首页</a>&nbsp;-&nbsp;-</span>&nbsp;蜘蛛日志
			</div>
		</div>

		<div class="page">
			<div class="connoisseur">
				<div class="conShow">
					今日(<?=data_num('spider',1)?>) | 7日(<?=data_num('spider',7)?>) | 30日(<?=data_num('spider',30)?>) | <?=spider_type_list()?>
					<span style="float:right">合计(<?=data_num('spider','all')?>)<!--<a class="userbtn" href="?act=del_all">删除所有数据</a>--></span>
					
					<table border="1" cellspacing="0" cellpadding="0" width="100%">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td class="tdColor">搜索引擎</td>
							<td class="tdColor">访问地址</td>
							<td class="tdColor">来路地址</td>
							<td class="tdColor">日期</td>
							<td width="130px" class="tdColor">IP地址(<a href="?act=ip_update&page=<?=$page?>">更新</a>)</td>
						</tr>
						<?php
						if(list_data('spider',$page,$type)){
							foreach(list_data('spider',$page,$type) as $row){
								?>
								<tr height="40px" title="<?=$row['age']?>">
								<td><?= $row['id'] ?></td>
								<td style="text-align:left;padding-left:20px;"><?= $row['ssyq'] ?></td>
								<td style="text-align:left;padding-left:20px;"><?= $row['fwdz'] ?></td>
								<td style="text-align:left;padding-left:20px;"><?= $row['lldz'] ?></td>
								<td style="text-align:left;padding-left:20px;"><?= date('Y-m-d H:i:s',$row['rq']) ?></td>
								<td><?=$row['ipdz']?><br><span style="font-size:10px;"><?=$row['ipinfo']?></span></td>
								</tr>
								<?php
							}
						}
						?>
					</table>
					
					<div class="paging">
						<div id="pageGro" class="cb clear">
							<?=list_page('spider',$page,$type)?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>