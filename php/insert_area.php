<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//Se  inserta el elemento recuperado por POST a la base de datos
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";

    $id = null;
    $nombre_area = $_POST['nombre'];

    $sql = "INSERT INTO area (nombre_area) VALUES('$nombre_area')";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        Header("Location: ../areas.php");
    }
    ;
}
?>