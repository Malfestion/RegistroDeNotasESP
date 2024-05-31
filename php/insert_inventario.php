<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)


//Se  inserta el elemento recuperado por POST a la base de datos
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";
    include "logging.php";

    $placa = $_POST['placa'];
    $descripcion = $_POST['descripcion'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $serie = $_POST['serie'];
    $categoria = $_POST['categoria'];
    $responsable = $_POST['responsable'];
    $observaciones = $_POST['observaciones'];



    $sql = "INSERT INTO esp_inventario (placa, descripcion, marca, modelo, serie, categoria, responsable, observaciones) VALUES('$placa','$descripcion','$marca','$modelo','$serie','$categoria','$responsable','$observaciones')";
    $query = mysqli_query($conn, $sql);


    if ($query) {
        writeLog("logsWrite.log", $_SESSION['username']." Inserta nuevo item inventario ".$descripcion."  from: ".$ip);
        Header("Location: ../inventario.php");
    };
}
