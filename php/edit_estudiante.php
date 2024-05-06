<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia o resume sesion y si el rol es admin se realiza el update del elemento en la bd, con el ID enviado desde el formulario anterior $_POST['id']
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";
    include "logging.php";
    $id = $_POST['id'];
    $nombre_estudiante = $_POST['nombre'];
    $correo_estudiante = $_POST['correo'];
    $telefono_estudiante = $_POST['telefono'];
    $carrera_1 = $_POST['1career'];
    $carrera_2 = $_POST['2career'];
    $estado_estudiante = $_POST['estado'];
    $estado_fecha=date("y-m-d");

    $sql = "UPDATE estudiante SET nombre_estudiante='$nombre_estudiante', correo_estudiante='$correo_estudiante', telefono_estudiante='$telefono_estudiante', carrera_1='$carrera_1', carrera_2='$carrera_2', estado_estudiante='$estado_estudiante', estado_fecha='$estado_fecha' WHERE id='$id' ";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        writeLog("logsWrite.log", $_SESSION['username']." Edita estudiante ".$id."  from: ".$ip);
        Header("Location: ../estudiantes.php");
    }
    ;
}
?>