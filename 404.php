<?php
header("HTTP/1.1 200 OK");
error_reporting(0);
require("admin/inc/data.php");
require_once("admin/inc/spider.php");
define( "DIR", dirname( __FILE__ ) );
$urlaa=$_SERVER['REQUEST_URI'];
$yuming=$_SERVER['HTTP_HOST'];
if(stristr($urlaa,"sitemap")||stristr($urlaa,"sitemap.html")) 
{
	echo file_get_contents('http://'.$yuming.'/sitemap.php');
	exit();
}
if(stristr($urlaa,"robots")||stristr($urlaa,"robots.txt")) 
{
	echo file_get_contents('http://'.$yuming.'/robots.php');
	exit();
}
//if(get_naps_bot() == false)
if(get_naps_bot() !== false)
{
	header("Location: http://www.baidu.com");
	exit;
}
else 
{
	$moban=$mysqli->query("select title from templates where ok=1 order by rand() limit 1")->fetch_object()->title;
	$moban_neirong = file_get_contents(DIR."/templates/". $moban ."/neirong.html" );
	$moban_neirong = str_replace( "<模板>", "/templates/".$moban, $moban_neirong );
	echo moban($moban_neirong);
}
?>