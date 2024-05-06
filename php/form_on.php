<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//Se  inserta el elemento recuperado por POST a la base de datos
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";
    include "logging.php";
    
    $id = null;
    $nombre_area = $_POST['nombre'];

    $sql = "UPDATE formulario_estado SET estado = true WHERE 1=1";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        writeLog("logsWrite.log", $_SESSION['username']." Habilita Formulario de inscripcion de estudiantes "."  from: ".$ip);

        Header("Location: ../infoform.php");
    }
    ;
}
?>