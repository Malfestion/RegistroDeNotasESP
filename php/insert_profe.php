<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//Se  inserta el elemento recuperado por POST a la base de datos
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";
    include "logging.php";

    $id = null;
    $nombre_profesor = $_POST['nombre'];
    $correo_profesor = $_POST['correo'];
    $telefono_profesor = $_POST['telefono'];

    $sql = "INSERT INTO profesor (nombre_profesor,correo_profesor,telefono_profesor) VALUES('$nombre_profesor','$correo_profesor','$telefono_profesor')";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        writeLog("logsWrite.log", $_SESSION['username']."Inserta nuevo docente ".$nombre_profesor."  from: ".$ip);
        Header("Location: ../profesores.php");
    }
    ;
}
?>