<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia o resume sesion y se verifica si el rol es admin
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "php/db_conn.php";
    include "php/query_notas.php";
    ?>

    <!DOCTYPE html>
    <html lang="es">

    <?php
    include "layout/head.php";
    ?>

    <body>
        <?php
        include "layout/header.php";
        ?>

        <div class="container" style="margin-top: 80px;">
            <br><br>
            <a class="btn btn-primary" href="agregar_nota.php" role="button">Agregar Nuevo registro</a>
            <a class="btn btn-primary" href="registros_anteriores.php" role="button">Buscar Registros del sistema
                anterior</a>
            <br><br><br>
        </div>
        <div class="container" style="margin-bottom: 80px;">
            <h2>Lista de notas 2024</h2>
            <br>
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="content">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table id="lookup-notas" class="table table-striped table-bordered table-hover">
                                        <thead align="center">
                                            <tr>
                                                <td><input type="text" data-column="0" class="search-input-text" size="8">
                                                </td>
                                                <th><input type="text" data-column="1" class="search-input-text" size="8">
                                                    </td>
                                                <th><input type="text" data-column="2" class="search-input-text" size="8">
                                                    </td>
                                                <th><input type="text" data-column="3" class="search-input-text" size="8">
                                                    </td>
                                                <th><input type="text" data-column="4" class="search-input-text" size="8">
                                                    </td>
                                                <td><input type="text" data-column="5" class="search-input-text" size="8">
                                                </td>
                                                <td><input type="text" data-column="6" class="search-input-text" size="8">
                                                </td>
                                                <td><input type="text" data-column="7" class="search-input-text" size="8">
                                                </td>
                                                <td><input type="text" data-column="8" class="search-input-text" size="8">
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre </th>
                                                <th>Area </th>
                                                <th>Estado</th>
                                                <th>Profesor </th>
                                                <th>Nivel</th>
                                                <th>Grupo</th>
                                                <th>Periodo</th>
                                                <th>Nota</th>
                                                <th></th>
                                                <th></th>
                                            </tr>

                                        </thead>
                                        <thead>

                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span12-->
                </div>
            </div>
        </div>

        <?php
        include "layout/footer.php";
        ?>
        <script type="text/javascript" src="js/maintainscroll.min.js"></script>
        <script src="bootstrap5/js/bootstrap.bundle.min.js"></script>
        <script src="js/jQuery-3.7.0/jquery-3.7.0.min.js"></script>
        <script type="text/javascript" src="js/datatables.min.js"></script>
        <script src="bootstrap5/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/DataTables-1.13.6/js/jquery.dataTables.js"></script>
        <script src="js/DataTables-1.13.6/js/dataTables.bootstrap.js"></script>
        <script type="text/javascript" language="javascript">
            $(document).ready(function () {
                var dataTable = $('#lookup-notas').DataTable({

                    "language": {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningún dato disponible en esta tabla",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Inicio",
                            "sLast": "Final",
                            "sNext": "Más",
                            "sPrevious": "Atrás"
                        },
                    },

                    "processing": true,
                    "serverSide": true,
                    "dom": 'lBfrtip',
                    "pageLength": 25, // set page search results length
                    "buttons": [
                        {
                            extend: 'collection',
                            text: 'Export',
                            buttons: [
                                'copy',
                                'excel',
                                'csv',
                                'pdf',
                                'print'
                            ]
                        }
                    ],
                    "ajax": {
                        url: "php/ajax-grid-data-notas.php", // json datasource
                        type: "post",  // method  , by default get
                        error: function (jqXHR, exception) {  // error handling
                            $(".lookup-notas-error").html("");
                            $("#lookup-notas").append('<tbody class="employee-grid-error"><tr><th colspan="3">Error del servidor, contacte al Administrador de la pagina.</th></tr></tbody>');
                            $("#lookup-notas_processing").css("display", "none");
                            console.log(jqXHR);

                        }
                    }
                });

                $('#lookup-notas_filter').css("display", "none");
                $('.search-input-text').on('keyup click', function () {   // for text boxes
                    var i = $(this).attr('data-column');  // getting column index
                    var v = $(this).val();  // getting search input value
                    dataTable.columns(i).search(v).draw();
                });
            });
        </script>
    </body>

    </html>
<?php } else if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'user') {
    include "php/db_conn.php";
    $nombre_bd = $_SESSION['name'];
    $sql = "SELECT * FROM profesor WHERE nombre_profesor LIKE '$nombre_bd' ";
    $query = mysqli_query($conn, $sql);
    if ($query->num_rows > 0) {
        $row = mysqli_fetch_array($query);
        $id_profesor = $row['id'];
        $sql = "SELECT * FROM notas JOIN estudiante ON (estudiante.id = notas.id_estudiante)
        JOIN area ON (area.id = notas.id_area) 
        JOIN profesor ON (profesor.id = notas.id_profesor)
        JOIN nivel ON (nivel.id = notas.id_nivel)   
        WHERE id_profesor LIKE '$id_profesor' ";
        $query = mysqli_query($conn, $sql);
    } else {
        $id_profesor = "--";
        $sql = "SELECT * FROM notas 
        JOIN estudiante ON (estudiante.id = notas.id_estudiante)
            JOIN area ON (area.id = notas.id_area) 
            JOIN profesor ON (profesor.id = notas.id_profesor)
            JOIN nivel ON (nivel.id = notas.id_nivel) WHERE id_profesor LIKE '$id_profesor' ";
        $query = mysqli_query($conn, $sql);
    }

    ?>
        <!DOCTYPE html>
        <html lang="es">

        <?php
        include "layout/head.php";
        ?>

        <body>
            <?php
            include "layout/header.php";
            ?>

            <div class="container" style="margin-bottom: 80px; margin-top: 80px;">
                <h2>Registros de nota</h2>
                <br>
                <table id="tabla-notas-profe" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Area </th>
                            <th>Profesor </th>
                            <th>Nivel</th>
                            <th>Grupo</th>
                            <th>Periodo</th>
                            <th>Nota</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_array($query)): ?>
                            <tr>

                                <th>
                                <?= $row['id_estudiante'] ?>
                                </th>
                                <th>
                                <?= $row['nombre_estudiante'] ?>
                                </th>
                                <th>
                                <?= $row['estado_estudiante'] ?>
                                </th>
                                <th>
                                <?= $row['nombre_area'] ?>
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
                            <?php $i++; ?>
                            </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <?php
            include "layout/footer.php";
            ?>
            <script>
                $(document).ready(function () {
                    $('#tabla-notas-profe').DataTable({
                        "oLanguage": {
                            "sSearch": "Buscar:"
                        }
                    });

                });
            </script>
        </body>

        </html>
<?php } else {
    header("Location: login.php"); //si hay una sesion iniciada se reenvia a login
} ?>