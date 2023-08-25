<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "php/db_conn.php";
/*estudiantes
    for ($i=0; $i < 1000; $i++) { 
        $num_carne=10000+$i;
        $id="B".$num_carne;
        $nombre_estudiante="Fulanito ".$i;
        $correo_estudiante=$id."@ucr.ac.cr";
        $telefono_estudiante=10000000+$i;
        $estado_estudiante="ACT";
        $sql = "INSERT INTO estudiante (id, nombre_estudiante,correo_estudiante,telefono_estudiante,estado_estudiante) VALUES('$id','$nombre_estudiante','$correo_estudiante','$telefono_estudiante','$estado_estudiante')";
        $query = mysqli_query($conn, $sql);
    }
*/
    
/*Notas

for ($i=0; $i < 50000; $i++) { 
    
    $num_carne=rand(10000,10999);
    $id_estudiante="B".$num_carne;
    $id_area=rand(1,7);
    $id_profesor=rand(1,20);
    $id_nivel=rand(1,9);
    $nombre_grupo="GR-".rand(1,999);
    $periodo= rand(1,3)." Ciclo 20".rand(24,40);
    $nota= rand(0,100);

    $sql = "INSERT INTO notas (id_estudiante, id_area, id_profesor, id_nivel, nombre_grupo, periodo, nota) VALUES('$id_estudiante','$id_area','$id_profesor','$id_nivel','$nombre_grupo','$periodo','$nota')";
    $query = mysqli_query($conn, $sql);
}

 */   
    
    if ($query) {
        echo("<h1>SE HAN AGREGADO TODOS LOS DATOS DE PRUEBA DE ESTRES</h1>");
        sleep(5);
        Header("Location: index.php");
    }
    ;
}
?>