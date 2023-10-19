<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//Se  insertan los elementos recuperados por POST a la base de datos
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && ($_SESSION['role'] == 'admin') || ($_SESSION['role'] == 'user')) {
    include "db_conn.php";

    $id_area = $_POST['area'];
    $id_profesor = $_POST['profesor'];
    $id_nivel = $_POST['nivel'];
    $nombre_grupo = $_POST['nombre_grupo'];
    $periodo = $_POST['periodo'];
    $estado_fecha=date("y-m-d");
    
    $estudiantes = array();
    $notas = array();
    $commitments = array();

    $sql = "INSERT INTO notas (id_estudiante, id_area, id_profesor, id_nivel, nombre_grupo, periodo, nota) VALUES";

    //Se Revisa el commitment de cada nota ingresada y se le da un valor en el arreglo de commmitments
    for ($i = 1; $i <= 31; $i++) {
        $estudiantes[] = $_POST['estudiante-' . $i];
        $notas[] = $_POST['nota-' . $i];
        if (isset($_POST['commitment-' . $i]) && $_POST['commitment-' . $i] == 'SI') {
            $commitments[] = 'SI';
        } else {
            $commitments[] = 'NO';
        }
    }

    //Segun el commitment se actualiza en la Base de datos de estudiantes a la vez que se actualiza el query de agregado de notas.
    for ($i = 0; $i < 31; $i++) {
        if ($estudiantes[$i] != "" && $notas[$i] != "") {
            $sql = $sql . "('" . $estudiantes[$i] . "','" . $id_area . "','" . $id_profesor . "','" . $id_nivel . "','" . $nombre_grupo . "','" . $periodo . "','" . $notas[$i] . "'),";
            if ($commitments[$i] == 'NO') {
                $sql2 = "UPDATE estudiante SET estado_estudiante='RJ', estado_fecha='$estado_fecha' WHERE id='$estudiantes[$i]' ";
                $query2 = mysqli_query($conn, $sql2);
            }
        }
    }

    $sql = substr($sql, 0, -1);
    $query = mysqli_query($conn, $sql);

//Se muestra una página con la informacion de los elementos agregados
    if ($query) {
        echo ("<!DOCTYPE html>
        <html lang=\"es\">
        <head> <link href=\"../bootstrap5/css/bootstrap.min.css\" rel=\"stylesheet\"></head>
        ");
        echo ("<body><div class= \"container\" style=\"width: 500px; text-align: center;\"><br><br><h2>Se agregaron los siguientes datos al Registro de Notas ESP: </h2><br>");
        echo ("<table class=\"table  table-striped  table-bordered\">
        <thead>
        <tr>
          <th scope=\"col\">Estudiante</th>
          <th scope=\"col\">Nota</th>
          <th scope=\"col\">Continúa</th>
        </tr>
        <tbody>
            
        ");

        for ($i = 0; $i < 31; $i++) {
            if ($estudiantes[$i] != "" && $notas[$i] != "") {
                echo ("<tr><td>" . $estudiantes[$i] . "</td><td>" . $notas[$i] . "</td><td>" . $commitments[$i] . "</td></tr>");
            }
        }
        echo ("</tbody></table>");
        echo ("<br><a class=\"btn btn-primary\" href=\"../notas.php\">Volver al registro de notas ESP</a>");
        echo ("</div>");
    }
    ;
}


?>