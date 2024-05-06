<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia o resume sesion y si el rol es admin se realiza el update del elemento en la bd, con el ID enviado desde el formulario anterior $_POST['id']
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";
    include "logging.php";
    $id = $_POST['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    if (empty($password)) {
        $sql = "UPDATE users SET name='$name', username='$username', role='$role' WHERE id='$id' ";
    }else {
        $sql = "UPDATE users SET name='$name', username='$username', role='$role', password=MD5('$password') WHERE id='$id' ";
    }
   
    $query = mysqli_query($conn, $sql);
    if ($query) {
        writeLog("logsWrite.log", $_SESSION['username']." Edita usuario ".$id."  from: ".$ip);

        Header("Location: ../usuarios.php");
    }
    ;
}
?>