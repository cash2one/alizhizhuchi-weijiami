<?php
require("inc/lic_admin.php");
session_start();
if(!isset($_SESSION['admin_id'])||!isset($_SESSION['is_login'])||empty($_SESSION['admin_id'])||empty($_SESSION['is_login'])){
	header("Location: log.php");
}
$act=isset($_GET['act'])?$_GET['act']:false;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>首页-<?=SYSTEM_NAME?></title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<script type="text/javascript" src="js/echarts.min.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript">
		$(function(){
			$(".loadimg").click(function(){
				$("#loading").show();
			})
		})
	</script>
</head>
<body>
	<div id="loading">
		<img src="img/load.gif">
	</div>
	<div id="pageAll">
		<div class="wellcom">欢迎使用<?=SYSTEM_NAME?>,您的等级为<span><?=$config['vip']?></span>,授权期限截止到<span><?=date('Y-m-d',$config['enddate'])?></span><em id="newver"><img src="img/loading.gif" height="20"></em>
		</div>
		<div class="wellcom" id="text1">
			<img src="img/loading.gif" height="20">
		</div>
		<div class="page">
			<div class="title">蜘蛛访问量<span><a href="?" class="loadimg">7日(<em id="zhizhu7ri"><img src="img/loading.gif" height="20"></em>)</a> | <a href="?act=30" class="loadimg">30日(<em id="zhizhu30ri"><img src="img/loading.gif" height="20"></em>)</a> | 合计(<em id="heji"><img src="img/loading.gif" height="20"></em>)</a> | <a href="?act=hour" class="loadimg" style="color:red;">查看过去三天24小时数据分析</a></span></div>
			<div id="main" style="width: 900px;height:300px;"><img src="img/loading.gif"></div>
			<?php
			if($act=='hour') {
				?>
				<div id="main3" style="width: 900px;height:300px;"><img src="img/loading.gif"></div>
				<?php
			}
			?>
			<div class="title">蜘蛛来源<span id="zhizhulaiyuan"><img src="img/loading.gif" height="20"></span></div>
			<div id="main2" style="width: 800px;height:500px;"><img src="img/loading.gif"></div>
		</div>
	</div>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript">
		//$(function(){

			//获取7日蜘蛛统计
			$.post('ajax_data.php',{act:"ajax_data_num", data:{"from":"spider","num":"7","day":"","type":""}},
			function(result){
				$("#zhizhu7ri").html(result.data);
			},"json");
			//获取30日蜘蛛统计
			$.post('ajax_data.php',{act:"ajax_data_num", data:{"from":"spider","num":"30","day":"","type":""}},
			function(result){
				$("#zhizhu30ri").html(result.data);
			},"json");
			//获取合计蜘蛛统计
			$.post('ajax_data.php',{act:"ajax_data_num", data:{"from":"spider","num":"all","day":"","type":""}},
			function(result){
				$("#heji").html(result.data);
			},"json");
			//蜘蛛来源统计
			$.post('ajax_data.php',{act:"spider_type_list", data:""},
			function(result){
				$("#zhizhulaiyuan").html(result.data);
			},"json");
			//获取新版本
			$.post('ajax_data.php',{act:"request_post", data:{"act":"update","ver_title":"<?=$config['ver']?>"}},
			function(result){
				if(result.data){
					$("#newver").html(",发现新版本<a href='update.php'>立即更新</a>");
				}else{
					$("#newver").html("已是最新版本");
				}
			},"json");
			//获取公告
			$.post('ajax_data.php',{act:"request_post", data:{"act":"gonggao"}},
			function(result){
				var gonggao_list=result.data;
				if(gonggao_list){
					var str='<ul>';
					var time='';
					var gonggao=JSON.parse(gonggao_list);
					for(var i=0; i<3; i++){//设置只读取3条
//					for(var i=0; i<gonggao.length; i++){
						time = new Date(gonggao[i].date*1000);
						str+="<li><a href='"+gonggao[i].url+"' target='_blank'>("+(time.getMonth()+1)+"/"+time.getDate()+")"+gonggao[i].title+"</a></li>";
					}
					str+='</ul>';
					$("#text1").html(str);
				}
			},"json");

		//})
	</script>
	<script type="text/javascript">
		// 基于准备好的dom，初始化echarts实例
		var xAxisdata=new Array();
		var seriesdata=new Array();
		<?php
			if(is_numeric($act)&&$act>0){
		?>
		for (i = <?=$act-1?>, l = 0; i >= 0; i--, l++) {
			var newdate = new Date(new Date().valueOf() - i * 24 * 60 * 60 * 1000);
			xAxisdata[l] = (newdate.getMonth() + 1) + "/" + newdate.getDate();
			var result_data="";
			$.ajax({
				type: "POST",
				url: "ajax_data.php",
				data: {act:"ajax_data_num", data:{
					"from": "spider",
					"num": "",
					"day": newdate.getFullYear() + "-" + (newdate.getMonth() + 1) + "-" + newdate.getDate(),
					"type": ""
				}},
				dataType: "json",
				cache : false,
				async : false,
				success: function(result){
					result_data=result.data;
				}
			});
			seriesdata[l] =result_data;
		}
		<?php
		}else{
		?>
		for (i = 6, l = 0; i >= 0; i--, l++) {
			var newdate = new Date(new Date().valueOf() - i * 24 * 60 * 60 * 1000);
			xAxisdata[l] = (newdate.getMonth() + 1) + "/" + newdate.getDate();
			var result_data="";
			$.ajax({
				type: "POST",
				url: "ajax_data.php",
				data: {act:"ajax_data_num", data:{
					"from": "spider",
					"num": "",
					"day": newdate.getFullYear() + "-" + (newdate.getMonth() + 1) + "-" + newdate.getDate(),
					"type": ""
				}},
				dataType: "json",
				cache : false,
				async : false,
				success: function(result){
					result_data=result.data;
				}
			});
			seriesdata[l] =result_data;
		}
		<?php
		}
		?>
		var myChart = echarts.init(document.getElementById('main'));
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
				data: xAxisdata
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
					data:seriesdata,
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
		myChart.setOption(option);
		</script>
		<script type="text/javascript">
		<?php
		$sql="select title from spiderset where ok=1 order by id asc";
		$result=$mysqli->query($sql);
		while($row=$result->fetch_assoc()) {
			$option2[]="'".$row['title']."'";
			$series[]="{value:".data_num('spider','','',$row['title']).", name:'".$row['title']."'}";
		}
		$option2_data=implode(',',$option2);
		$series_data=implode(',',$series);
		?>
		var myChart2 = echarts.init(document.getElementById('main2'));
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
		myChart2.setOption(option2);
		</script>
		<script type="text/javascript">
		<?php
		if($act=='hour') {
			for ($i = 3; $i >= 1; $i--) {
				$data = implode(',', hour_data_num('spider', $i));
				$option3[] = "{name:'" . date('n/j', time() - $i * 24 * 3600) . "',type:'line',stack: '总量',data:[" . $data . "]}";
				$option3_legend[] = "'" . date('n/j', time() - $i * 24 * 3600) . "'";
			}
			$option3_series_data = implode(',', $option3);
			$option3_legend_data = implode(',', $option3_legend);

		?>
		var myChart3 = echarts.init(document.getElementById('main3'));
		option3 = {
//			title: {
//				text: '折线图堆叠'
//			},
			tooltip: {
				trigger: 'axis'
			},
			legend: {
				data:[<?=$option3_legend_data?>]
			},
			grid: {
				left: '3%',
				right: '4%',
				bottom: '3%',
				containLabel: true
			},
//			toolbox: {
//				feature: {
//					saveAsImage: {}
//				}
//			},
			xAxis: {
				type: 'category',
				boundaryGap: false,
				data: ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24']
			},
			yAxis: {
				type: 'value'
			},
			series: [<?=$option3_series_data?>]
		};
		myChart3.setOption(option3);
		<?php
		}
		?>
	</script>

</body>
</html>