<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "db_conn.php";
    $sql = "SELECT * FROM profesor";
    $query = mysqli_query($conn, $sql);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Registro de notas ESP</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="bootstrap5/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="img/favicon.ico">
        <script src="bootstrap5/js/bootstrap.bundle.min.js"></script>
    </head>

    <body>
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


        <div style="margin-top: 80px;">
            <h2>Agregar Docente</h2>
            <br>
            <form action="php/insert_profe.php" method="POST">

                <div class="mb-3 p-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="nombre" placeholder="Nombre Completo">
                </div>
                <div class="mb-3  p-3">
                    <label for="email" class="form-label">Correo Institucional</label>
                    <input type="email" class="form-control" id="email" name="correo" placeholder="Correo @ucr.ac.cr">
                </div>
                <div class="mb-3  p-3">
                    <label for="tel" class="form-label">Número de Teléfono</label>
                    <input type="number" class="form-control" id="tel" name="telefono"
                        placeholder="Extension de oficina o # de celular">
                </div>
                <input type="submit" class="btn btn-primary" style="margin-left: 15px;" value="Agregar Profesor a la Lista">

            </form>
        </div>
        <br>
        <div style="margin-bottom: 80px;">
            <h2>Docentes en la lista</h2>
            <br>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php $i = 1;
                        while ($row = mysqli_fetch_array($query)): ?>
                            <th>
                                <?= $i ?>
                            </th>
                            <th>
                                <?= $row['nombre_profesor'] ?>
                            </th>
                            <th>
                                <?= $row['correo_profesor'] ?>
                            </th>
                            <th>
                                <?= $row['telefono_profesor'] ?>
                            </th>
                            <th><a class="btn btn-primary" href="update_profe.php?id=<?= $row['id'] ?>">Editar</a></th>
                            <th><a class="btn btn-danger" href="php/delete_profe.php?id=<?= $row['id'] ?>">Eliminar</a></th>
                            <?php $i++; ?>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>


        <footer class="bg-light text-center text-lg-start fixed-bottom">
            <div class="text-center p-3">
                © 2023 Copyright:
                <a class="text-dark">Alejandro Duarte Lobo</a>
            </div>
        </footer>
    </body>

    </html>
<?php } else {
    header("Location: login.php");
} ?>