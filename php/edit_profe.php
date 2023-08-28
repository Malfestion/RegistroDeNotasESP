<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia o resume sesion y si el rol es admin se realiza el update del elemento en la bd, con el ID enviado desde el formulario anterior $_POST['id']
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";
    $id = $_POST['id'];
    $nombre_profesor = $_POST['nombre'];
    $correo_profesor = $_POST['correo'];
    $telefono_profesor = $_POST['telefono'];

    $sql = "UPDATE profesor SET nombre_profesor='$nombre_profesor', correo_profesor='$correo_profesor', telefono_profesor='$telefono_profesor' WHERE id='$id' ";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        Header("Location: ../profesores.php");
    }
    ;
}
?>