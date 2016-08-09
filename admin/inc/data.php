<?php
$database_info=include('database.php');
extract($database_info['default']);

$mysqli = new mysqli($hostname,$username,$password,$database);

if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
mysqli_query($mysqli,'set names utf8');
?>