<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)


//Se  inserta el elemento recuperado por POST a la base de datos
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";
    include "logging.php";

    $id = null;
    $nombre_nivel = $_POST['nombre'];

    $sql = "INSERT INTO nivel (nombre_nivel) VALUES('$nombre_nivel')";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        writeLog("logsWrite.log", $_SESSION['username']."Inserta Nuevo nivel ".$nombre_nivel."  from: ".$ip);

        Header("Location: ../niveles.php");
    }
    ;
}
?>