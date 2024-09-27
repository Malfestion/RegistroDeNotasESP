<!DOCTYPE html>
<html lang="es">
<?php include "../layout/head.php"; ?>
<body>
<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && ($_SESSION['role'] == 'admin')) {
    include "db_conn.php";

    // Asegurarse de que la conexión a la base de datos esté en UTF-8
    mysqli_set_charset($conn, "utf8mb4");

    if (isset($_POST['previsualizar']) && isset($_FILES['file']['name'])) {
        $file = $_FILES['file']['tmp_name'];
        $handle = fopen($file, "r");

        // Omitimos la primera fila (cabecera)
        fgetcsv($handle, 1000, ",");

        echo "<h2>Previsualización de estudiantes</h2>";
        echo "<form action='subir_csv_estudiantes.php' method='POST'>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nombre Completo</th><th>Correo</th><th>Teléfono</th><th>Primera Carrera</th><th>Segunda Carrera</th></tr>";

        $estudiantes = [];

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Procesar los datos
            $id = preg_replace('/[\s-]+/', '', $data[0]);
            $apellido1 = $data[1];
            $apellido2 = $data[2];
            $nombre = $data[3];
            $nombre_completo = "$nombre $apellido1 $apellido2";
            $correo = $data[4];
            $telefono = !empty($data[5]) ? preg_replace('/[\s-]+/', '', $data[5]) : 'NULL';
            $carrera1 = $data[6];
            $carrera2 = !empty($data[7]) ? $data[7] : 'NULL';

            $estudiantes[] = [
                'id' => $id,
                'nombre_completo' => $nombre_completo,
                'correo' => $correo,
                'telefono' => $telefono,
                'carrera1' => $carrera1,
                'carrera2' => $carrera2
            ];

            echo "<tr>
                <td>$id</td>
                <td>$nombre_completo</td>
                <td>$correo</td>
                <td>$telefono</td>
                <td>$carrera1</td>
                <td>$carrera2</td>
            </tr>";
        }

        echo "</table>";
        echo "<input type='hidden' name='estudiantes' value='" . base64_encode(serialize($estudiantes)) . "'>";
        echo "<button type='submit' class='btn btn-primary' name='confirmar'>Confirmar Subida</button>";
        echo "</form>";

        fclose($handle);
    } elseif (isset($_POST['confirmar'])) {
        $estudiantes = unserialize(base64_decode($_POST['estudiantes']));
        $query = "INSERT IGNORE INTO estudiante (id, nombre_estudiante, correo_estudiante, telefono_estudiante, carrera_1, carrera_2, estado_estudiante, estado_fecha) VALUES ";

        foreach ($estudiantes as $estudiante) {
            $id = mysqli_real_escape_string($conn, $estudiante['id']);
            $nombre_completo = mysqli_real_escape_string($conn, $estudiante['nombre_completo']);
            $correo = mysqli_real_escape_string($conn, $estudiante['correo']);
            $telefono = $estudiante['telefono'] !== 'NULL' ? "'" . mysqli_real_escape_string($conn, $estudiante['telefono']) . "'" : 'NULL';
            $carrera1 = mysqli_real_escape_string($conn, $estudiante['carrera1']);
            $carrera2 = $estudiante['carrera2'] !== 'NULL' ? "'" . mysqli_real_escape_string($conn, $estudiante['carrera2']) . "'" : 'NULL';

            $estado = 'ACT';
            $estado_fecha = date("Y-m-d");

            $query .= "('$id', '$nombre_completo', '$correo', $telefono, '$carrera1', $carrera2, '$estado', '$estado_fecha'),";
        }

        $query = rtrim($query, ',');
        if (mysqli_query($conn, $query)) {
            echo "<p>Estudiantes subidos exitosamente.</p>";
            echo "<a href=\"../estudiantes.php\">volver</a>";
        } else {
            echo "Error al subir estudiantes: " . mysqli_error($conn);
        }
    } else {
        echo "Por favor, selecciona un archivo CSV.";
    }
} else {
    header("Location: login.php");
}
?>
</body>
</html>