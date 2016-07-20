<?php
$mysqli = new mysqli('localhost','root','123456','zhizhuchi');

if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
mysqli_query($mysqli,'set names utf8');
?>