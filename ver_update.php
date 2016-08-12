<?php
//自动更新、手动更新文件
require("admin/inc/lic.php");
//执行数据库版本更新
$mysqli->query("update config set ver='MS40LjE=',ver_date='MTQ3MDkzMTIwMA==' limit 1");
$file = file_exists("robots.php");
if($file){
    $unlink=unlink("robots.php");
    if($unlink){
        unlink("ver_update.php");
    }
}
echo "版本v1.4.1 更新成功!";
?>