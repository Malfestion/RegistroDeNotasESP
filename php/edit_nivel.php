<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia o resume sesion y si el rol es admin se realiza el update del elemento en la bd, con el ID enviado desde el formulario anterior $_POST['id']
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";
    include "logging.php";
    $id = $_POST['id'];
    $nombre_nivel = $_POST['nombre'];

    $sql = "UPDATE nivel SET nombre_nivel='$nombre_nivel' WHERE id='$id' ";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        writeLog("logsWrite.log", $_SESSION['username']." Edita nivel ".$id."  from: ".$ip);

        Header("Location: ../niveles.php");
    }
    ;
}
?>