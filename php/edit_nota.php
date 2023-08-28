<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia o resume sesion y si el rol es admin se realiza el update del elemento en la bd, con el ID enviado desde el formulario anterior $_POST['id']
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";
    $id_nota = $_POST['id'];
    $id_estudiante = $_POST['estudiante'];
    $id_area = $_POST['area'];
    $id_profesor = $_POST['profesor'];
    $id_nivel = $_POST['nivel'];
    $nombre_grupo = $_POST['grupo'];
    $periodo = $_POST['periodo'];
    $nota = $_POST['nota'];

    $sql = "UPDATE notas SET id_estudiante='$id_estudiante', id_area='$id_area', id_profesor='$id_profesor', id_nivel='$id_nivel', nombre_grupo='$nombre_grupo', periodo='$periodo', nota='$nota' WHERE id_nota='$id_nota' ";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        Header("Location: ../notas.php");
    }
    ;
}
?>