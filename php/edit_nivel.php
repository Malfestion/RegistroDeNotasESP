<?php
//se inicia o resume sesion y si el rol es admin se realiza el update del elemento en la bd, con el ID enviado desde el formulario anterior $_POST['id']
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";
    $id = $_POST['id'];
    $nombre_nivel = $_POST['nombre'];

    $sql = "UPDATE nivel SET nombre_nivel='$nombre_nivel' WHERE id='$id' ";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        Header("Location: ../niveles.php");
    }
    ;
}
?>