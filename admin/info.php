<?php
require("inc/data.php");
session_start();
if(!isset($_SESSION['admin_id'])||!isset($_SESSION['is_login'])||empty($_SESSION['admin_id'])||empty($_SESSION['is_login'])){
	header("Location: log.php");
}
$act=isset($_GET['act'])?$_GET['act']:"";
$action=isset($_GET['action'])?$_GET['action']:"";
$page=isset($_GET['page'])?$_GET['page']:1;
switch($act){
	case "keywords":
		$title="关键词管理";break;
	case "wenzhang":
		$title="文章标题管理";break;
	case "domains":
		$title="域名管理";break;
	case "url":
		$title="外推链接";break;
	case "juzi":
		$title="句子管理";break;
	case "shipin":
		$title="视频管理";break;
	default:
		header("Location: index.php");
}
switch($action){
	case "add":
		$data=isset($_POST['title'])?$_POST['title']:"";
		if(!empty($act)&&!empty($data)){
			info_add($act,$data);
		}
		break;
	case "edit":
		$id = isset($_GET['id']) ? $_GET['id'] : "";
		break;
	case "save":
		$data=isset($_POST['title'])?$_POST['title']:"";
		$id = isset($_GET['id']) ? $_GET['id'] : "";
		if(!empty($act)&&!empty($data)&&!empty($id)&&is_numeric($id)) {
			info_save($act, $data, $page,$id);
		}
		break;
	case "del":
		$id = isset($_GET['id']) ? $_GET['id'] : "";
		if(!empty($act)&&!empty($id)&&is_numeric($id)) {
			info_del($act,$page,$id);
		}
		break;
	case "del_all":
		info_del_all($act);
		break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$title?>-<?=SYSTEM_NAME?></title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<link rel="stylesheet" type="text/css" href="css/pageGroup.css" />
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="img/coin02.png" style="float:left;margin-top:10px;" /><span><a href="main.php">首页</a>&nbsp;-&nbsp;-</span>&nbsp;<?=$title?>
			</div>
		</div>

		<div class="page">
			<div class="connoisseur">
				<div class="conform clear">
						<div class="cfD">
							<form action="?act=<?=$act?>&action=add" method="post">
							添加新数据:
							<input class="userinput vpr" type="text" name="title" />
							<button class="userbtn">添加</button>
<!--							<a class="userbtn" href="?act=--><?//=$act?><!--&action=del_all">删除所有数据</a>-->
							</form>
						</div>
						<div class="upload">
							<form action="import.php?act=<?=$act?>" method="post" enctype="multipart/form-data">
								<input type="file" name="file">
								<input type="submit" value="导入txt(<1M)" class="userbtn">
							</form>
						</div>
				</div>
				<div class="conShow">
					<span style="float:right">合计(<?=data_num($act)?>)</span>
					<table border="1" cellspacing="0" cellpadding="0" width="100%">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td class="tdColor">内容</td>
							<?php
							if($act=="url"){
								echo "<td class=\"tdColor\" width='100px'>引蜘蛛数</td>";
							}
							?>
							<td width="130px" class="tdColor">操作</td>
						</tr>
						<?php
						if(list_data($act,$page)){
							foreach(list_data($act,$page) as $row){
								if (isset($id)&&$id == $row['id']&&$action=="edit") {
									?>
									<tr bgcolor="#999">
									<form action='?act=<?= $act ?>&action=save&page=<?= $page ?>&id=<?= $id ?>' method='post'>
										<td height="40px"><?= $row['id'] ?></td>
										<td style="text-align:left;padding-left:20px;"><input type="text" name="title" value="<?= $row['title'] ?>"/>
										</td>
										<?php
										if($act=="url"){
											echo "<td>".$row['count']."</td>";
										}
										?>
										<td>
											<button><img src="img/ok.png"></button><a href="?act=<?= $act ?>&page=<?= $page ?>"><img src="img/no.png"></a></td>
									</form>
									</tr>
									<?php
								}else {
									?>
									<tr>
									<td height="40px"><?= $row['id'] ?></td>
									<td style="text-align:left;padding-left:20px;"><?= $row['title'] ?></td>
										<?php
										if($act=="url"){
											echo "<td>".$row['count']."</td>";
										}
										?>
									<td>
										<a href="?act=<?= $act ?>&action=edit&page=<?= $page ?>&id=<?= $row['id'] ?>"><img class="operation" src="img/update.png"></a> <a href="?act=<?=$act?>&action=del&page=<?=$page?>&id=<?=$row['id']?>"><img class="operation delban" src="img/delete.png"></a></td>
									</tr>
									<?php
								}
							}
						}
						?>
					</table>
					
					<div class="paging">
						<div id="pageGro" class="cb clear">
							<?=list_page($act,$page)?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>