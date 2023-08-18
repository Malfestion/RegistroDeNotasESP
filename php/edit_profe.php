<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "../db_conn.php";
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