<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia o resume sesion y si el rol es admin se realiza el update del elemento en la bd, con el ID enviado desde el formulario anterior $_POST['id']
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";
    include "logging.php";
    $item_id = $_POST['item_id'];
    $placa = $_POST['placa'];
    $descripcion = $_POST['descripcion'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $serie = $_POST['serie'];
    $categoria = $_POST['categoria'];
    $responsable = $_POST['responsable'];
    $observaciones = $_POST['observaciones'];


    $sql = "UPDATE esp_inventario SET  placa='$placa', descripcion='$descripcion', descripcion='$descripcion', marca='$marca', modelo='$modelo', serie='$serie', categoria='$categoria', responsable='$responsable', observaciones='$observaciones' WHERE item_id='$item_id' ";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        writeLog("logsWrite.log", $_SESSION['username']." Edita item de inventario #".$item_id."  from: ".$ip);
        Header("Location: ../inventario.php");
    }
    ;
}
?>