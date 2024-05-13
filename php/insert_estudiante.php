<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)


//Se  inserta el elemento recuperado por POST a la base de datos
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";
    include "logging.php";
    
    $id = $_POST['id'];
    $nombre_estudiante = $_POST['nombre'];
    $correo_estudiante = $_POST['correo'];
    $telefono_estudiante = $_POST['telefono'];
    $carrera_1 = $_POST['1career'];
    $carrera_2 = $_POST['2career'];
    $estado_estudiante = $_POST['estado'];


    $query = "SELECT id FROM estudiante WHERE id = '$id'";

    $result = $conn->query($query);

    if ($result) {//Si ya existe el estudiante en la base de datos, muestra un mensaje de error, si no, agrega el estudiante a la base de datos.
        if (mysqli_num_rows($result) > 0) {
            echo '<h1 style="color:red;">ERROR!: Ya Existe un estudiante con este ID en la base de datos, Por favor intente de nuevo o contacte al administrador de la página</h1>';
            $query=0;
        } else {
            $sql = "INSERT INTO estudiante (id, nombre_estudiante,correo_estudiante,telefono_estudiante,carrera_1,carrera_2,estado_estudiante) VALUES('$id','$nombre_estudiante','$correo_estudiante','$telefono_estudiante','$carrera_1','$carrera_2','$estado_estudiante')";
            $query = mysqli_query($conn, $sql);
        }
    } else {
        echo 'Error de Base de datos!';
        writeLog("logsError.log", "Error al ingresar datos en la BD, insert_estudiante from: ".$ip);
        $query=0;
    }


    if ($query) {
        writeLog("logsWrite.log", $_SESSION['username']." Inserta nuevo estudiante ".$id."  from: ".$ip);

        Header("Location: ../estudiantes.php");
    };
}
