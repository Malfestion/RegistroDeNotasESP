<?php  
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)


//Recupera la informacion de las notas de la base de datos
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
    
    $sql = "SELECT * FROM notas 
            JOIN estudiante ON (estudiante.id = notas.id_estudiante)
            JOIN area ON (area.id = notas.id_area) 
            JOIN profesor ON (profesor.id = notas.id_profesor)
            JOIN nivel ON (nivel.id = notas.id_nivel)    
            ORDER BY id_estudiante ASC";


    $res = mysqli_query($conn, $sql);
}else{
	header("Location: login.php");
} 