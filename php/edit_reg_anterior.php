<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia o resume sesion y si el rol es admin se realiza el update del elemento en la bd, con el ID enviado desde el formulario anterior $_POST['id']
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";
    include "logging.php";
    $edit = $_POST['edit'];
    $id = $_POST['id'];
    $nombre = $_POST['name'];
    $periodo = $_POST['periodo'];
    $nivel = $_POST['nivel'];
    $grupo= $_POST['grupo'];
    $area= $_POST['area'];
    $nota= $_POST['nota'];
    $profesor= $_POST['profesor'];

    $sql = "UPDATE datos SET id='$id', nombre='$nombre', periodo='$periodo', nivel='$nivel', grupo='$grupo', area='$area', nota='$nota', profesor='$profesor' WHERE edit='$edit' ";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        writeLog("logsWrite.log", $_SESSION['username']." Edita nota en BD anterior ".$edit."  from: ".$ip);

        Header("Location: ../registros_anteriores.php");
    }
    ;
}
?>