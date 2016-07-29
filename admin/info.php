<?php
require("inc/lic_admin.php");
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
//	case "edit":
//		$id = isset($_GET['id']) ? $_GET['id'] : "";
//		break;
//	case "save":
//		$data=isset($_POST['title'])?$_POST['title']:"";
//		$id = isset($_GET['id']) ? $_GET['id'] : "";
//		if(!empty($act)&&!empty($data)&&!empty($id)&&is_numeric($id)) {
//			info_save($act, $data, $page,$id);
//		}
//		break;
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
	<style>
		#loading{display:block}
	</style>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script>
		$(function(){
			$('#upload .userbtn').click(function(){
				$('#loading').show();
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
							<a class="userbtn" href="?act=<?=$act?>&action=del_all">删除所有数据</a>
							</form>
						</div>
						<div class="upload" id="upload">
							<form action="import.php?act=<?=$act?>" method="post" enctype="multipart/form-data">
								<input type="file" name="file">
								<input type="submit" value="导入txt(<1M)" class="userbtn">
							</form>
						</div>
				</div>
				<div class="conShow">
					<span style="float:right">合计(<?=data_num($act)?>)</span>
					<table border="1" cellspacing="0" cellpadding="0" width="100%" id="neirong">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td class="tdColor">内容</td>
							<?php
							if($act=="url"){
								$allnum=$mysqli->query("select SUM(count) as allnum from url")->fetch_object()->allnum;
								echo "<td class=\"tdColor\" width='100px'>引蜘蛛数<br>($allnum)</td><td class=\"tdColor\">详情</td>";
							}
							?>
							<td width="70px" class="tdColor">操作</td>
						</tr>
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
<script type="text/javascript">
	$.post('ajax_data.php',{act:"ajax_list_data", data:{"from":"<?=$act?>","page":"<?=$page?>","type":""}},
		function(result){
			var neirong=result.data;
			var str="";
			var act="<?=$act?>";
			for ( var p in neirong ){
				if(typeof neirong[p]=="object") {
					str += "<tr>";
					str += "<td height='40px'>" + neirong[p]['id'] + "</td>";
					str += "<td style='text-align:left;padding-left:20px;'>" + neirong[p]['title'] + "</td>";

					if (act == "url") {
						str += "<td>" + neirong[p]['count'] + "</td><td><a href='javascript:void(0)' onclick=\"javascript:alert('Google:" + neirong[p]['google'] + " | Baidu:" + neirong[p]['baidu'] + " | Bing:" + neirong[p]['bing'] + " | Yahoo:" + neirong[p]['yahoo'] + " | Sogou:" + neirong[p]['sogou'] + " | 360:" + neirong[p]['360'] + "')\">查看</a></td>";
					}
					str += "<td>";
					str += "<a href='?act=" + act + "&action=del&page=<?=$page?>&id=" + neirong[p]['id'] + "'><img class='operation delban' src='img/delete.png'></a></td>";
					str += "</tr>";
				}
			}
			$("#neirong").append(str);
			$("#loading").hide();
		},"json");
</script>
</body>
</html>