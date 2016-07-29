<?php
require("inc/lic_admin.php");
session_start();
if(!isset($_SESSION['admin_id'])||!isset($_SESSION['is_login'])||empty($_SESSION['admin_id'])||empty($_SESSION['is_login'])){
	header("Location: log.php");
}
$act=isset($_GET['act'])?$_GET['act']:"";
$type=isset($_GET['type'])?$_GET['type']:"";
$page=isset($_GET['page'])?$_GET['page']:1;
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
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<style>
		#loading{display:block}
	</style>
</head>

<body>
	<div id="loading">
		<img src="img/load.gif">
	</div>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="img/coin02.png" style="float:left;margin-top:10px;" /><span><a href="main.php">首页</a>&nbsp;-&nbsp;-</span>&nbsp;蜘蛛日志
			</div>
		</div>

		<div class="page">
			<div class="connoisseur">
				<div class="conShow" id="data_show">
					今日(<span id="jinri"></span>) | 7日(<span id="qiri"></span>) | 30日(<span id="sanshiri"></span>) | 合计(<span id="heji"></span>) | <span id="zhizhu"></span>
					<span style="float:right"><!--<a class="userbtn" href="?act=del_all">删除所有数据</a>--></span>
					<table border="1" cellspacing="0" cellpadding="0" width="100%" id="neirong">
						<tr>
<!--							<td width="150" class="tdColor tdC">序号</td>-->
							<td width="85" class="tdColor">搜索引擎</td>
							<td class="tdColor">访问地址</td>
							<td class="tdColor">来路地址</td>
							<td width="120" class="tdColor">日期</td>
							<td width="150" class="tdColor">IP地址</td>
						</tr>
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
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript">
		//获取今日蜘蛛统计
		$.post('ajax_data.php',{act:"ajax_data_num", data:{"from":"spider","num":"1","day":"","type":""}},
			function(result){
				$("#jinri").html(result.data);
			},"json");
		//获取7日蜘蛛统计
		$.post('ajax_data.php',{act:"ajax_data_num", data:{"from":"spider","num":"7","day":"","type":""}},
			function(result){
				$("#qiri").html(result.data);
			},"json");
		//获取30日蜘蛛统计
		$.post('ajax_data.php',{act:"ajax_data_num", data:{"from":"spider","num":"30","day":"","type":""}},
			function(result){
				$("#sanshiri").html(result.data);
			},"json");
		//获取合计蜘蛛统计
		$.post('ajax_data.php',{act:"ajax_data_num", data:{"from":"spider","num":"all","day":"","type":""}},
			function(result){
				$("#heji").html(result.data);
			},"json");
		//蜘蛛来源统计
		$.post('ajax_data.php',{act:"spider_type_list", data:""},
			function(result){
				$("#zhizhu").html(result.data);
			},"json");
		//内容
		$.post('ajax_data.php',{act:"ajax_list_data", data:{"from":"spider","page":"<?=$page?>","type":"<?=$type?>"}},
			function(result){
				var neirong=result.data;
				var str="";
				var time="";
				for ( var p in neirong ){
					if(typeof neirong[p]=="object") {
						time = new Date(neirong[p]['rq']*1000);

						str += "<tr height=\"40px\" title=\"" + neirong[p]['age'] + "\">";
						//str += "<td>" + neirong[p]['id'] + "</td>";
						str += "<td style=\"text-align:left;padding-left:20px;\">" + neirong[p]['ssyq'] + "</td>";
						str += "<td style=\"text-align:left;padding-left:20px;\">" + neirong[p]['fwdz'] + "</td>";
						str += "<td style=\"text-align:left;padding-left:20px;\">" + neirong[p]['lldz'] + "</td>";
						str += "<td style=\"text-align:left;padding-left:20px;\">"+(time.getMonth()+1)+"-"+time.getDate()+" "+time.getHours()+":"+time.getMinutes()+":"+time.getSeconds()+"</td>";
						str += "<td>" + neirong[p]['ipdz'] + "<br><span style=\"font-size:10px;\">" + neirong[p]['ipinfo'] + "</span></td>";
						str += "</tr>";
					}
				}
				$("#neirong").append(str);
				$("#loading").hide();
			},"json");
	</script>
</body>
</html>