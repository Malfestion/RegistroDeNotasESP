<?php
//se inicia la sesion o se resume la anteriormente iniciada
session_start();
//se incluye el script de conexion con la BD para usar la variable conn
include "php/db_conn.php";
?>

<!DOCTYPE html>
<html lang="es" style="height: 100%;">

<?php
include "layout/head.php";
?>

<body class=" bg-light " style="height: 85%; background-image: linear-gradient(to bottom, #ffffff, #0083b0);">
    <?php
    include "layout/header.php";
    ?>
    <div style="margin-top: 80px; margin-bottom: 80px;">
        <div class=" container p-3 text-light justify-content-center table-responsive">

            <h1 class="display-4 fs-1 text-dark">Consulta de Notas</h1>

            <br>

            <form action="" method="get" style="display: flex;">
                <input class="form-control" type="search" name="busqueda" style="width: 500px;" value="<?php if (!empty($_GET['busqueda'])) { //para que no se borre el valor ingresado+escape de caracteres
                        echo str_replace(
                            array(
                                '\'',
                                '"',
                                ',',
                                ';',
                                '<',
                                '>',
                                '?'
                            ),
                            '', $_GET['busqueda']
                        );
                    } ?>" placeholder="Ingrese el carné/cédula que quiera consultar" aria-label="Search">
                <button class="btn btn-primary" type="submit" name="enviar" value="Buscar">Buscar</button>
            </form>
            <br>
            <?php
            if (isset($_GET['enviar']) && !empty($_GET['busqueda']) && strlen($_GET['busqueda']) >= 6) { ?>
                <table class="table table-dark table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Carné</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Area</th>
                            <th scope="col">Profesor</th>
                            <th scope="col">Nivel</th>
                            <th scope="col">Grupo</th>
                            <th scope="col">Periodo</th>
                            <th scope="col">Nota</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php }
            if (isset($_GET['enviar'])) {

                $busqueda = $_GET['busqueda'];
                $busqueda = str_replace(
                    array(
                        '\'',
                        '"',
                        ',',
                        ';',
                        '<',
                        '>',
                        '?'
                    ),
                    '',
                    $busqueda
                );
                if (!empty($busqueda) && strlen($busqueda) >= 6) { //solo se muestran resultados si se hace una consulta con al menos 6 caracteres
                    $consulta = $conn->query("SELECT * FROM notas 
                    JOIN estudiante ON (estudiante.id = notas.id_estudiante)
                    JOIN area ON (area.id = notas.id_area) 
                    JOIN profesor ON (profesor.id = notas.id_profesor)
                    JOIN nivel ON (nivel.id = notas.id_nivel)   
                    WHERE id_estudiante LIKE '%$busqueda%'
                    ORDER BY periodo ASC"); //consulta completa a la BD con sus relaciones "join".
                    if ($consulta->num_rows > 0) { //si existen resultados
            
                        $i = 1;
                        while ($row = $consulta->fetch_array()) { //se muestran los resultados de la consulta?>
                                    <tr>
                                        <th scope="row">
                                            <?= $i ?>
                                        </th>
                                        <td>
                                            <?= $row['id_estudiante'] ?>
                                        </td>
                                        <td>
                                            <?= $row['nombre_estudiante'] ?>
                                        </td>
                                        <td>
                                            <?= $row['nombre_area'] ?>
                                        </td>
                                        <td>
                                            <?= $row['nombre_profesor'] ?>
                                        </td>
                                        <td>
                                            <?= $row['nombre_nivel'] ?>
                                        </td>
                                        <td>
                                            <?= $row['nombre_grupo'] ?>
                                        </td>
                                        <td>
                                            <?= $row['periodo'] ?>
                                        </td>
                                        <td>
                                            <?= $row['nota'] ?>
                                        </td>
                                    </tr>
                                    <?php $i++;
                        }
                    } else {
                        echo ("<p class=\"text-danger\"> No se han encontrado resultados. Verifique los datos ingresados. </p> ");
                    }
                } else {
                    echo ("<p class=\"text-danger\"> Ingrese un número de carné o número de cédula válido. </p> ");
                } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    include "layout/footer.php";
    ?>

    <script type="text/javascript" src="js/maintainscroll.min.js"></script>
</body>

</html>