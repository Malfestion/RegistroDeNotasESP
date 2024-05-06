<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia o resume sesion y si el rol es admin se realiza el update del elemento en la bd, con el ID enviado desde el formulario anterior $_POST['id']
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";
    include "logging.php";
    $id_cert = $_POST['id_cert'];
    $id_estudiante = $_POST['id_estudiante'];
    $nombre_estudiante = $_POST['nombre_estudiante'];
    $lectura = $_POST['lectura'];
    $escucha = $_POST['escucha'];
    $escritura = $_POST['escritura'];
    $habla = $_POST['habla'];
    $fecha_cert = $_POST['fecha_cert'];


    $sql = "UPDATE calificaciones_cert SET  id_estudiante='$id_estudiante', nombre_estudiante='$nombre_estudiante', lectura='$lectura', escucha='$escucha', escritura='$escritura', habla='$habla', fecha_cert='$fecha_cert' WHERE id_cert='$id_cert' ";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        writeLog("logsWrite.log", $_SESSION['username']." Edita certificado ".$id_cert."  from: ".$ip);
        Header("Location: ../certificaciones.php");
    }
    ;
}
?>