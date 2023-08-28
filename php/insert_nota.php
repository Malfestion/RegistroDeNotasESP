<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";

    $id_estudiante = $_POST['estudiante'];
    $id_area = $_POST['area'];
    $id_profesor = $_POST['profesor'];
    $id_nivel = $_POST['nivel'];
    $nombre_grupo= $_POST['grupo'];
    $periodo = $_POST['periodo'];
    $nota = $_POST['nota'];

    $sql = "INSERT INTO notas (id_estudiante, id_area, id_profesor, id_nivel, nombre_grupo, periodo, nota) VALUES('$id_estudiante','$id_area','$id_profesor','$id_nivel','$nombre_grupo','$periodo','$nota')";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        Header("Location: ../notas.php");
    }
    ;
}
?>