<!--
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)
-->
<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";

    $id = $_POST['id'];
    $nombre_estudiante = $_POST['nombre'];
    $correo_estudiante = $_POST['correo'];
    $telefono_estudiante = $_POST['telefono'];
    $estado_estudiante = $_POST['estado'];

    $sql = "INSERT INTO estudiante (id, nombre_estudiante,correo_estudiante,telefono_estudiante,estado_estudiante) VALUES('$id','$nombre_estudiante','$correo_estudiante','$telefono_estudiante','$estado_estudiante')";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        Header("Location: ../estudiantes.php");
    }
    ;
}
?>