<?php
//se inicia o resume sesion y si el rol es admin se realiza el update del elemento en la bd, con el ID enviado desde el formulario anterior $_POST['id']
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";
    $id = $_POST['id'];
    $nombre_estudiante = $_POST['nombre'];
    $correo_estudiante = $_POST['correo'];
    $telefono_estudiante = $_POST['telefono'];
    $estado_estudiante = $_POST['estado'];

    $sql = "UPDATE estudiante SET nombre_estudiante='$nombre_estudiante', correo_estudiante='$correo_estudiante', telefono_estudiante='$telefono_estudiante', estado_estudiante='$estado_estudiante' WHERE id='$id' ";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        Header("Location: ../estudiantes.php");
    }
    ;
}
?>