<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se busca el id  $_GET['id'] y se realiza el delete from
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";
    include "logging.php";
    $id = $_GET['id'];

    $sql = "DELETE FROM area WHERE id='$id'";

    $query = mysqli_query($conn, $sql);
    if ($query) {
        writeLog("logsWrite.log", $_SESSION['username']." Elimina area ".$id."  from: ".$ip);
        Header("Location: ../areas.php");
    }
    ;
}
?>