<?php
require("admin/inc/lic.php");
$file = file_exists("../robots.php");

$unlink=unlink("../robots.php");

if($unlink){
    $zhixing=true;
}
?>