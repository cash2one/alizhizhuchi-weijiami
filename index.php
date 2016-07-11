<?php
header("HTTP/1.1 200 OK");
error_reporting(0);
require("admin/inc/data.php");
require("admin/inc/spider.php");
define( "DIR", dirname( __FILE__ ) );
//if(get_naps_bot() == false)
if(get_naps_bot() !== false)
{
	header("Location: http://www.baidu.com");
	exit;
}
else
{
	$moban=$mysqli->query("select title from templates where ok=1 order by rand() limit 1")->fetch_object()->title;
	$moban_index = file_get_contents(DIR."/templates/". $moban ."/shouye.html" );
	$moban_index = str_replace( "<模板/>", "/templates/".$moban, $moban_index );
	echo moban($moban_index);
}
?>