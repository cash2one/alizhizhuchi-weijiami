<?php
header ( "Content-type:text/html;charset=utf-8" );
$mysqli = new mysqli('localhost','root','123456','zhizhuchi');

if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
mysqli_query($mysqli,'set names utf8');
include("function.php");
include("ver.php");
?>