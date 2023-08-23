<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";

    $id = null;
    $nombre_area = $_POST['nombre'];

    $sql = "INSERT INTO area (nombre_area) VALUES('$nombre_area')";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        Header("Location: ../areas.php");
    }
    ;
}
?>