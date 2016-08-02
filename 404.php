<?php
header("HTTP/1.1 200 OK");
error_reporting(0);
require("admin/inc/lic.php");
require("admin/inc/spider.php");
define( "DIR", dirname( __FILE__ ) );
$urlaa=$_SERVER['REQUEST_URI'];
if(get_naps_bot() == false)
//if(get_naps_bot() !== false)
{
	header("Location: http://www.baidu.com");
	exit;
}
else 
{
	if(stristr($urlaa,"sitemap")||stristr($urlaa,"sitemap.html"))
	{
		echo file_get_contents('sitemap.php');
		exit();
	}
//	$sql="SELECT title FROM `templates` AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM `templates`)-(SELECT MIN(id) FROM `templates`))+(SELECT MIN(id) FROM `templates`)) AS id) AS t2 WHERE t1.id >= t2.id and t1.ok=1 ORDER BY t1.id LIMIT 1";
//	$moban=$mysqli->query($sql)->fetch_object()->title;
	$moban=$mysqli->query("select title from templates where ok=1 order by rand() limit 1")->fetch_object()->title;
	$moban_neirong = file_get_contents(DIR."/templates/". $moban ."/neirong.html" );
	$moban_neirong = str_replace( "<模板/>", "/templates/".$moban, $moban_neirong );

	echo moban($moban_neirong);
}
?>