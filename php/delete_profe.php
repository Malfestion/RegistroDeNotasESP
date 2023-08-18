<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "../db_conn.php";
    $id = $_GET['id'];

    $sql = "DELETE FROM profesor WHERE id='$id'";

    $query = mysqli_query($conn, $sql);
    if ($query) {
        Header("Location: ../profesores.php");
    }
    ;
}
?>