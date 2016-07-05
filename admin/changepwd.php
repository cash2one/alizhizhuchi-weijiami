<?php
require("inc/data.php");
session_start();
if(!isset($_SESSION['admin_id'])||!isset($_SESSION['is_login'])||empty($_SESSION['admin_id'])||empty($_SESSION['is_login'])){
header("Location: log.php");
}
//密码验证
$act=isset($_GET['act'])?$_GET['act']:"";
if($act=="save"){
	$oldpass=isset($_POST['oldpass'])?$_POST['oldpass']:"";
	$oldpass=!empty($oldpass)?sha1($oldpass):"";
	$password=isset($_POST['password'])?$_POST['password']:"";
	$password=!empty($password)?sha1($password):"";
	$err="";
	if($password){
		$sql="select id from admin where password='".$oldpass."'";
		$result=$mysqli->query($sql);
		$row=$result->fetch_assoc();
		if($result->num_rows>0&&$row['id']==$_SESSION['admin_id']){
			$mysqli->query("update admin set password='".$password."' where id=".$row['id']);
			$err="修改成功";
		}else{
			$err="旧密码错误";
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改密码-<?=SYSTEM_NAME?></title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript">
		<?php
		if(isset($err)){
		?>
		var err="<?=$err?>";
		if(err){
			alert(err);
		}
		<?}?>
	</script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="img/coin02.png" /><span><a href="main.php">首页</a>&nbsp;-&nbsp;<a
					href="changepwd.php#">系统管理</a>&nbsp;-</span>&nbsp;修改密码
			</div>
		</div>
		<div class="page ">
			<!-- 修改密码页面样式 -->
			<div class="bacen">
				<form action="?act=save" method="post">
				<div class="bbD">
					&nbsp;&nbsp;&nbsp;&nbsp;管理员 ID：&nbsp;&nbsp;&nbsp;&nbsp;<?=$_SESSION['admin_id']?></div>
				<div class="bbD">
					&nbsp;&nbsp;&nbsp;&nbsp;输入旧密码：<input name="oldpass" type="password" class="input3" onblur="checkpwd1()" id="pwd1" /> <img class="imga" src="img/ok.png" /><img class="imgb" src="img/no.png" />
				</div>
				<div class="bbD">
					&nbsp;&nbsp;&nbsp;&nbsp;输入新密码：<input name="password" type="password" class="input3" onblur="checkpwd2()" id="pwd2" /> <img class="imga" src="img/ok.png" /><img class="imgb" src="img/no.png" />
				</div>
				<div class="bbD">
					再次确认密码：<input type="password" class="input3" onblur="checkpwd3()" id="pwd3" /> <img class="imga" src="img/ok.png" /><img class="imgb" src="img/no.png" />
				</div>
				<div class="bbD">
					<p class="bbDP">
						<button class="btn_ok btn_yes">提交</button>
						<a class="btn_ok btn_no" href="changepwd.php#">取消</a>
					</p>
				</div>
				</form>
			</div>

			<!-- 修改密码页面样式end -->
		</div>
	</div>
</body>
<script type="text/javascript">
function checkpwd1(){
var user = document.getElementById('pwd1').value.trim();
 if (user.length >= 6 && user.length <= 12) {
  $("#pwd1").parent().find(".imga").show();
  $("#pwd1").parent().find(".imgb").hide();
 }else{
  $("#pwd1").parent().find(".imgb").show();
  $("#pwd1").parent().find(".imga").hide();
	 alert("请输入6位以上12位以下密码");
 }
}
function checkpwd2(){
var user = document.getElementById('pwd2').value.trim();
 if (user.length >= 6 && user.length <= 12) {
  $("#pwd2").parent().find(".imga").show();
  $("#pwd2").parent().find(".imgb").hide();
 }else{
  $("#pwd2").parent().find(".imgb").show();
  $("#pwd2").parent().find(".imga").hide();
	 alert("请输入6位以上12位以下密码");
 }
}
function checkpwd3(){
var user = document.getElementById('pwd3').value.trim();
var pwd = document.getElementById('pwd2').value.trim();
 if (user.length >= 6 && user.length <= 12 && user == pwd) {
  $("#pwd3").parent().find(".imga").show();
  $("#pwd3").parent().find(".imgb").hide();
 }else{
   $("#pwd3").parent().find(".imgb").show();
  $("#pwd3").parent().find(".imga").hide();
	 alert("两次密码输入不一致");
 }
}
</script>
</html>