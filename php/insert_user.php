<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//Se  inserta el elemento recuperado por POST a la base de datos
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";

    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];

    $sql = "INSERT INTO users (role, username, password, name) VALUES('$role','$username', MD5('$password'),'$name')";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        Header("Location: ../usuarios.php");
    }
    ;
}
?>