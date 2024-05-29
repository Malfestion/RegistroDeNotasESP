<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se busca el id  $_GET['id'] y se realiza el delete from
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";
    include "logging.php";
    $item_id = $_GET['item_id'];

    $sql = "DELETE FROM esp_inventario WHERE item_id='$item_id' and 1=1";

    $query = mysqli_query($conn, $sql);
    if ($query) {
        writeLog("logsWrite.log", $_SESSION['username']." Elimina item en inventario #".$item_id."  from: ".$ip);
        Header("Location: ../inventario.php");
    }
    ;
}
?>