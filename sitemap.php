<?php
header("HTTP/1.1 200 OK");
error_reporting(0);
require("admin/inc/data.php");
require_once("admin/inc/spider.php");
define( "DIR", dirname( __FILE__ ) );
if(get_naps_bot() == false)
//if(get_naps_bot() !== false)
{
    header("Location: http://www.baidu.com");
    exit;
}
else {
    $moban = $mysqli->query("select title from templates where ok=1 order by rand() limit 1")->fetch_object()->title;
    $moban_map = file_get_contents(DIR . "/templates/" . $moban . "/map.html");
    $moban_map = str_replace("<模板/>", "/templates/" . $moban, $moban_map);
    echo moban($moban_map);
}
?>