
<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

$sname = "localhost";
$uname = "ingxareas";
$password = "11-L/m09-&";

$db_name = "ingxareas";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
	echo "Falló la conexion con el servidor!";
	exit();
}