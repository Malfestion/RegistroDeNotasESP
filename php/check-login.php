<!--
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)
-->
<?php  
session_start();
include "db_conn.php";

if (isset($_POST['username']) && isset($_POST['password']) /*&& isset($_POST['role'])*/) {

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$username = test_input($_POST['username']);
	$password = test_input($_POST['password']);
	//$role = test_input($_POST['role']);

	if (empty($username)) {
		header("Location: ../login.php?error=Se requiere ingresar un nombre de usuario.");
	}else if (empty($password)) {
		header("Location: ../login.php?error=Se requiere ingresar una contraseña.");
	}else {

		// Hashing the password
		$password = md5($password);
        
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
        	// the user name must be unique
        	$row = mysqli_fetch_assoc($result);
        	if ($row['password'] === $password /*&& $row['role'] == $role*/) {
        		$_SESSION['name'] = $row['name'];
        		$_SESSION['id'] = $row['id'];
        		$_SESSION['role'] = $row['role'];
        		$_SESSION['username'] = $row['username'];

        		header("Location: ../index.php");

        	}else {
        		header("Location: ../login.php?error=Nombre de usuario o contraseña incorrecto.");
        	}
        }else {
        	header("Location: ../login.php?error=Nombre de usuario o contraseña incorrecto.");
        }

	}
	
}else {
	header("Location: ../login.php");
}