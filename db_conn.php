<?php  

$sname = "localhost";
$uname = "root";
$password = "2266";

$db_name = "notasingxareas";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
	echo "Connection Failed!";
	exit();
}