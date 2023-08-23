<?php
//se inicia o resume sesion y se verifica si el rol es admin
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "php/db_conn.php";
    include "php/query_notas.php";
    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <title>Registro de notas ESP</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="bootstrap5/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" type="image/x-icon" href="img/favicon.ico">
        <script src="bootstrap5/js/bootstrap.bundle.min.js"></script>
        <script src="js/jQuery-3.7.0/jquery-3.7.0.min.js"></script>
        <script type="text/javascript" src="js/datatables.min.js"></script>
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
                                        <li><a class="dropdown-item" href="areas.php">Areas</a></li>
                                        <li><a class="dropdown-item" href="niveles.php">Niveles</a></li>
                                        <li><a class="dropdown-item" href="estudiantes.php">Estudiantes</a></li>
                                        <li><a class="dropdown-item text-warning" href="notas.php">Notas</a></li>
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


        <div class="container" style="margin-top: 80px;">
            <br><br>
            <a class="btn btn-primary" href="agregar_nota.php" role="button">Agregar Nuevo registro</a>
            <br><br><br>
        </div>
        <div class="container" style="margin-bottom: 80px;">
            <h2>Lista de notas</h2>
            <br>
            <script>
                $(document).ready(function () {
                    // Setup - add a text input to each footer cell
                    $('#tabla-notas thead tr')
                        .clone(true)
                        .addClass('filters')
                        .appendTo('#tabla-notas thead');

                    var table = $('#tabla-notas').DataTable({
                        orderCellsTop: true,
                        fixedHeader: true,
                        initComplete: function () {
                            var api = this.api();

                            // For each column
                            api
                                .columns()
                                .eq(0)
                                .each(function (colIdx) {
                                    // Set the header cell to contain the input element
                                    var cell = $('.filters th').eq(
                                        $(api.column(colIdx).header()).index()
                                    );
                                    var title = $(cell).text();
                                    $(cell).html('<input  size="8" type="text" placeholder="' + title + '" />');

                                    // On every keypress in this input
                                    $(
                                        'input',
                                        $('.filters th').eq($(api.column(colIdx).header()).index())
                                    )
                                        .off('keyup change')
                                        .on('change', function (e) {
                                            // Get the search value
                                            $(this).attr('title', $(this).val());
                                            var regexr = '({search})'; //$(this).parents('th').find('select').val();

                                            var cursorPosition = this.selectionStart;
                                            // Search the column for that value
                                            api
                                                .column(colIdx)
                                                .search(
                                                    this.value != ''
                                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                                        : '',
                                                    this.value != '',
                                                    this.value == ''
                                                )
                                                .draw();
                                        })
                                        .on('keyup', function (e) {
                                            e.stopPropagation();

                                            $(this).trigger('change');
                                            $(this)
                                                .focus()[0]
                                                .setSelectionRange(cursorPosition, cursorPosition);
                                        });
                                });
                        },
                    });
                });
            </script>
            <table id="tabla-notas" class=" table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Area</th>
                        <th>Estado</th>
                        <th>Profesor</th>
                        <th>Nivel</th>
                        <th>Grupo</th>
                        <th>Periodo</th>
                        <th>Nota</th>
                        <th id="tabla-boton"></th>
                        <th id="tabla-boton"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        while ($row = mysqli_fetch_array($res)): ?>
                            <th>
                                <?= $row['id_estudiante'] ?>
                            </th>
                            <th>
                                <?= $row['nombre_estudiante'] ?>
                            </th>
                            <th>
                                <?= $row['nombre_area'] ?>
                            </th>
                            <th>
                                <?= $row['estado_estudiante'] ?>
                            </th>
                            <th>
                                <?= $row['nombre_profesor'] ?>
                            </th>
                            <th>
                                <?= $row['nombre_nivel'] ?>
                            </th>
                            <th>
                                <?= $row['nombre_grupo'] ?>
                            </th>
                            <th>
                                <?= $row['periodo'] ?>
                            </th>
                            <th>
                                <?= $row['nota'] ?>
                            </th>
                            <th><a class="btn btn-primary"
                                    href="update_nota.php?id=<?= $row['id_nota'] //se envia el id a update?>">Editar</a></th>
                            <th><a class="btn btn-danger"
                                    href="php/delete_nota.php?id=<?= $row['id_nota'] //se envia el id a delete?>"
                                    onclick="return confirm('Realmente quiere eliminar esta entrada? Los datos en el registro de notas pueden depender de esta.')">Eliminar</a>
                            </th>
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
        <script type="text/javascript" src="js/maintainscroll.min.js"></script>
    </body>

    </html>
<?php } else {
    header("Location: login.php"); //si hay una sesion iniciada se reenvia a login
} ?>