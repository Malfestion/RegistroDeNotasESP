<?php
session_start();
include "db_conn.php";
?>

<!DOCTYPE html>
<html lang="en" style="height: 100%;">

<head>
    <title>Registro de notas ESP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap5/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <script src="bootstrap5/js/bootstrap.bundle.min.js"></script>
</head>

<body class=" bg-light " style="height: 85%;">

    <header>
        <nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="img/logoESP.png" alt="" width="110" height="48">
                </a>
                <a class="navbar-brand" href="index.php">Registro de notas </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.inglesporareas.ucr.ac.cr/">Página web principal</a>
                        </li>
                        <?php if (isset($_SESSION['username']) && isset($_SESSION['id']) && ($_SESSION['role'] == 'admin')) { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Administración
                                </a>
                                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
                                    <li><a class="dropdown-item" href="profesores.php">Profesores</a></li>
                                    <li><a class="dropdown-item" href="#">Areas</a></li>
                                    <li><a class="dropdown-item" href="#">Estudiantes</a></li>
                                    <li><a class="dropdown-item text-warning" href="#">Notas</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                    </ul>
                    <?php if (isset($_SESSION['username']) && isset($_SESSION['id']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'user')) {
                        echo ("<p style=\"margin-left:=2.5em;\"> Hola, " . $_SESSION['name'] . ".&nbsp;&nbsp;&nbsp;&nbsp;</p> "); ?>
                        <a class="btn btn-warning" href="logout.php" role="button">Cerrar Sesion</a>
                    <?php } else { ?>
                        <a class="btn btn-primary" href="login.php" role="button">Iniciar Sesion</a>
                    <?php } ?>
                </div>
            </div>
        </nav>
    </header>

    <div style="margin-top: 80px; margin-bottom: 80px;">
        <div class=" container p-3 text-light justify-content-center table-responsive">

            <h1 class="display-4 fs-1">Consulta de Notas</h1>

            <br>

            <form action="" method="get" style="display: flex;">
                <input class="form-control" type="search" name="busqueda" style="width: 500px;" value="<?php if (!empty($_GET['busqueda'])) {
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
                    <?php
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
                        if (!empty($busqueda) && strlen($busqueda) >= 6) {
                            $consulta = $conn->query("SELECT * FROM notas 
                    JOIN estudiante ON (estudiante.id = notas.id_estudiante)
                    JOIN area ON (area.id = notas.id_area) 
                    JOIN profesor ON (profesor.id = notas.id_profesor)
                    JOIN nivel ON (nivel.id = notas.id_nivel)   
                    WHERE id_estudiante LIKE '%$busqueda%'
                    ORDER BY periodo ASC");

                            $i = 1;
                            while ($row = $consulta->fetch_array()) { ?>
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
                        } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer class="bg-light text-center text-lg-start fixed-bottom">
        <div class="text-center p-3" >
            © 2023 Copyright:
            <a class="text-dark">Alejandro Duarte Lobo</a>
        </div>
    </footer>

</body>

</html>