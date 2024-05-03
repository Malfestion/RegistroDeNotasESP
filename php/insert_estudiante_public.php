<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)


//Se  inserta el elemento recuperado por POST a la base de datos
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin' || 1==1) {
    include "db_conn.php";
    include "logging.php";

    $id = $_POST['id'];
    $nombre_estudiante = $_POST['nombre'];
    $correo_estudiante = $_POST['correo'];
    $telefono_estudiante = $_POST['telefono'];
    $carrera_1 = $_POST['1career'];
    $carrera_2 = $_POST['2career'];
    $estado_estudiante = $_POST['estado'];


    $query = "SELECT id, nombre_estudiante, carrera_1 FROM estudiante WHERE id = '$id'";

    $result = $conn->query($query);

    if ($result) {//Si ya existe el estudiante en la base de datos, muestra un mensaje de error, si no, agrega el estudiante a la base de datos.
        if (mysqli_num_rows($result) > 0) {
            $row = $result->fetch_array();
            echo '<h1 style="color:red;">Ya Existe un estudiante con este Carnet en el sistema</h1>';
            echo '<p><b>Datos existentes en el sistema:</b></p>';
            echo '<p>&emsp;&emsp;<b>Identificación:</b> '.$row['id'].'</p>';
            echo '<p>&emsp;&emsp;<b>Nombre:</b> '.$row['nombre_estudiante'].'</p>';
            echo '<p>&emsp;&emsp;<b>Carrera:</b> '.$row['carrera_1'].'</p>';
            echo '<p><b>Si esto es un error, o los datos no corresponden a los suyos, por favor intente de nuevo o contacte al administrador de la página:</b></p>';
            echo '<p>Teléfono: 2511-8449 / 2511-7245</p>';
            echo '<p>Correo: inglesxareas.elm@ucr.ac.cr</p>';
            $query=0;
            $myfile = fopen("logsRegistroEstudiante.log", "a") or die("Unable to open file!");
            $txt =date("Y/m/d")." ".date("h:i:sa").":  intento fallido, registro existente  from: ".$ip;
            fwrite($myfile, "\n". $txt);
            fclose($myfile);
        } else {
            $sql = "INSERT INTO estudiante (id, nombre_estudiante,correo_estudiante,telefono_estudiante,carrera_1,carrera_2,estado_estudiante) VALUES('$id','$nombre_estudiante','$correo_estudiante','$telefono_estudiante','$carrera_1','$carrera_2','$estado_estudiante')";
            $query = mysqli_query($conn, $sql);
        }
    } else {
        echo 'Error de Base de datos!';
        $query=0;
    }


    if ($query) {
        echo '<h1>Muchas gracias por ingresar sus datos en el sistema de notas ESP</h1>';
        echo '<h2>Los datos ingresados son los siguientes:</h2>';
        echo '<p>Carné o Cédula: '.$id.'</p>';
        echo '<p>Nombre: '.$nombre_estudiante.'</p>';
        echo '<p>Correo institucional: '.$correo_estudiante.'</p>';
        echo '<p>Número de teléfono: '.$telefono_estudiante.'</p>';
        echo '<p>Carrera  o lugar de trabajo: '.$carrera_1.'</p>';
        echo '<p>Segunda Carrera: '.$carrera_2.'</p>';
        echo '<p>En caso de necesitar realizar cambios en sus datos, puede contactar a la administración: </p>';
        echo '<p>Teléfono: 2511-8449</p>';
        echo '<p>Correo: inglesxareas.elm@ucr.ac.cr</p>';

        writeLog("logsRegistroEstudiante.log",date("Y/m/d")." ".date("h:i:sa").":  ".$id." ".$nombre_estudiante." ".$correo_estudiante."  from: ".$ip);
         
    };
}
