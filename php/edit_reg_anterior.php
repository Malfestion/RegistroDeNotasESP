<?php
//se inicia o resume sesion y si el rol es admin se realiza el update del elemento en la bd, con el ID enviado desde el formulario anterior $_POST['id']
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";
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
        Header("Location: ../registros_anteriores.php");
    }
    ;
}
?>