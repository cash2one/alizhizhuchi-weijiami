<?php
require("inc/data.php");
session_start();
if(!isset($_SESSION['admin_id'])||!isset($_SESSION['is_login'])||empty($_SESSION['admin_id'])||empty($_SESSION['is_login'])){
	header("Location: log.php");
}
$act=isset($_GET['act'])?$_GET['act']:false;
$xAxisdata="'".date('n/j',time())."'";
$seriesdata="'".data_num('spider','',date('Y-m-d',time()))."'";
if(is_numeric($act)&&$act>0){
	for($i=1;$i<$act;$i++){
		$xAxisdata.=",'".date('n/j',time()-$i*24*3600)."'";
		$seriesdata.=",'".data_num('spider','',date('Y-m-d',time()-$i*24*3600))."'";
	}
}else{
	for($i=1;$i<7;$i++){
		$xAxisdata.=",'".date('n/j',time()-$i*24*3600)."'";
		$seriesdata.=",'".data_num('spider','',date('Y-m-d',time()-$i*24*3600))."'";
	}
}
$sql="select title from spiderset where ok=1 order by id asc";
$result=$mysqli->query($sql);
$str="";
while($row=$result->fetch_assoc()) {
	$option2[]="'".$row['title']."'";
	$series[]="{value:".data_num('spider','','',$row['title']).", name:'".$row['title']."'}";
}
$option2_data=implode(',',$option2);
$series_data=implode(',',$series);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>首页-<?=SYSTEM_NAME?></title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<script src="js/echarts.min.js"></script>
</head>

<body>
	<div id="pageAll">
		<div class="wellcom">欢迎使用<?=SYSTEM_NAME?></div>
		<div class="page">
			<div class="title">蜘蛛访问量<span>今日(<?=data_num('spider',1)?>) <a href="?">7日(<?=data_num('spider',7)?>)</a> <a href="?act=30">30日(<?=data_num('spider',30)?>)</a></span></div>
			<div id="main" style="width: 900px;height:300px;"></div>
			<div class="title">蜘蛛来源<span><?=spider_type_list()?></span></div>
			<div id="main2" style="width: 800px;height:500px;"></div>
		</div>
	</div>
	<script type="text/javascript">
		// 基于准备好的dom，初始化echarts实例
		var myChart = echarts.init(document.getElementById('main'));
		var myChart2 = echarts.init(document.getElementById('main2'));

		// 指定图表的配置项和数据
		option = {
			tooltip: {
				trigger: 'axis'
			},
//			toolbox: {
//				show: true,
//				feature: {
//					saveAsImage: {}
//				}
//			},
			xAxis:  {
				type: 'category',
				boundaryGap: false,
				data: [<?=$xAxisdata?>]
			},
			yAxis: {
				type: 'value',
				axisLabel: {
					formatter: '{value}'
				}
			},
			series: [
				{
					name:'蜘蛛访问量',
					type:'line',
					data:[<?=$seriesdata?>],
					markPoint: {
						data: [
							{type: 'max', name: '最大值'},
							{type: 'min', name: '最小值'}
						]
					},
					markLine: {
						data: [
							{type: 'average', name: '平均值'}
						]
					}
				}
			]
		};
		option2 = {
			tooltip : {
				trigger: 'item',
				formatter: "{a} <br/>{b} : {c} ({d}%)"
			},
			legend: {
				orient: 'vertical',
				left: 'right',
				data: [<?=$option2_data?>]
			},
			series : [
				{
					name: '访问来源',
					type: 'pie',
					radius : '75%',
					center: ['50%', '40%'],
					data:[<?=$series_data?>],
					itemStyle: {
						emphasis: {
							shadowBlur: 10,
							shadowOffsetX: 0,
							shadowColor: 'rgba(0, 0, 0, 0.5)'
						}
					}
				}
			]
		};

		// 使用刚指定的配置项和数据显示图表。
		myChart.setOption(option);
		myChart2.setOption(option2);
	</script>
</body>
</html>