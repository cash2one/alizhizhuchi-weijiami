<?php
header ( "Content-type:text/html;charset=utf-8" );
require("data.php");
include("function.php");
define('SYSTEM_NAME','阿里蜘蛛池');
define('SITE_NAME','阿里蜘蛛池');

$config=config_list();
if(time()>$config['enddate']){//如果过期
    echo "您的帐号已过期,请购买授权。";exit;
}
?>