<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se busca el id  $_GET['id'] y se realiza el delete from
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";
    $id_cert = $_GET['id_cert'];

    $sql = "DELETE FROM calificaciones_cert WHERE id_cert='$id_cert'";

    $query = mysqli_query($conn, $sql);
    if ($query) {
        Header("Location: ../certificaciones.php");
    }
    ;
}
?>