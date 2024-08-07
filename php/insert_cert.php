<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)


//Se  inserta el elemento recuperado por POST a la base de datos
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";
    include "logging.php";

    $id_estudiante = $_POST['id_estudiante'];
    $nombre_estudiante = $_POST['nombre_estudiante'];
    $lectura = $_POST['lectura'];
    $escucha = $_POST['escucha'];
    $escritura = $_POST['escritura'];
    $habla = $_POST['habla'];
    $fecha_cert = $_POST['fecha_cert'];




    $sql = "INSERT INTO calificaciones_cert (id_estudiante, nombre_estudiante, lectura,escucha,escritura,habla,fecha_cert) VALUES('$id_estudiante','$nombre_estudiante','$lectura','$escucha','$escritura','$habla','$fecha_cert')";
    $query = mysqli_query($conn, $sql);


    if ($query) {
        writeLog("logsWrite.log", $_SESSION['username']." Inserta nueva Certificacion ".$id_estudiante." ".$fecha_cert."  from: ".$ip);
        Header("Location: ../certificaciones.php");
    };
}
