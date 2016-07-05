<?php
$host = @trim($_SERVER[HTTP_HOST]);

$robots ="";
$robots .="User-agent: Baiduspider\n";
$robots .="Disallow: \n";
$robots .="User-agent: sogou spider\n";
$robots .="Disallow: \n";
$robots .="User-agent: Sogou web spider\n";
$robots .="Disallow: \n";
$robots .="User-agent: 360spider\n";
$robots .="Disallow: \n";
$robots .="User-agent: *\n";
$robots .="Disallow: /\n";
//$robots .="Crawl-delay: 5\n";
$robots .="Disallow: /\n";
//$robots. = "User-agent: *\n";
//$robots.= "Allow:/\n";
$robots .= "Sitemap: http://".$host."/sitemap.html";
echo $robots;
?>