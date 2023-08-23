<?php  
//archivo para la conexion con la base de datos, se incluye en las paginas donde se utilice la BD con la variable $conn

$sname = "localhost";
$uname = "administrador";
$password = "ingxar2023adl.!";

$db_name = "ingxareas";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
	echo "Connection Failed!";
	exit();
}