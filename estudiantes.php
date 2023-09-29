<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia o resume sesion y se verifica si el rol es admin
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "php/db_conn.php";
    //se buscan todos los estudiantes
    $sql = "SELECT * FROM estudiante";
    $query = mysqli_query($conn, $sql);
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
            <h2>Agregar Estudiante</h2>
            <br>
            <form action="php/insert_estudiante.php" method="POST">
                <div class="d-flex">
                    <div class="mb-3 p-3">
                        <label for="name" class="form-label">Carné/Cédula</label>
                        <input type="text" class="form-control" id="id" name="id" placeholder="Identificación"
                            required="required" maxlength="9">
                    </div>
                    <div class="mb-3 p-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="nombre" placeholder="Nombre Completo"
                            required="required" maxlength="50">
                    </div>
                    <div class="mb-3  p-3">
                        <label for="email" class="form-label">Correo Institucional</label>
                        <input type="email" class="form-control" id="email" name="correo" placeholder="Correo @ucr.ac.cr"
                            required="required" maxlength="50">
                    </div>
                    <div class="mb-3  p-3">
                        <label for="tel" class="form-label">Número de Teléfono</label>
                        <input type="number" class="form-control" id="tel" name="telefono"
                            placeholder="Extension de oficina o # de celular" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="8">
                    </div>
                    <div class="mb-3  p-3">
                        <label for="estado" class="form-label">Estado del Estudiante</label>
                        <select class="form-select" id="estado" name="estado">
                            <option value="ACT">Activo</option>
                            <option value="RJ">Retiro Justificado</option>
                            <option value="RI">Retiro Injustificado</option>
                            <option value="FIN">Finalizado</option>
                            <option value="CONG">Congelado</option>
                        </select>

                    </div>
                </div>

                <div class="d-flex"> 
                <div class="mb-3  p-3">
                        <label for="1career" class="form-label">Carrera</label>
                        <input type="text" class="form-control" id="1career" name="1career"
                            placeholder="Carrera" maxlength="50">
                    </div>
                    <div class="mb-3  p-3">
                        <label for="2career" class="form-label">Segunda Carrera</label>
                        <input type="text" class="form-control" id="2career" name="2career"
                            placeholder="2° Carrera (si aplica)" maxlength="50">
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" style="margin-left: 15px;"
                    value="Agregar Estudiante a la Lista">

            </form>
        </div>
        <br>
        <div class="container" style="margin-bottom: 80px;">
            <h2>Lista de Estudiantes</h2>
            <br>
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="content">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table id="lookup" class="table table-striped table-bordered table-hover">
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
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre </th>
                                                <th>Correo </th>
                                                <th>Teléfono</th>
                                                <th>Carrera 1 </th>
                                                <th>Carrera 2</th>
                                                <th>Estado</th>
                                                <th>Última modificación</th>
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
                var dataTable = $('#lookup').DataTable({

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
                        url: "php/ajax-grid-data-estudiantes.php", // json datasource
                        type: "post",  // method  , by default get
                        error: function () {  // error handling
                            $(".lookup-error").html("");
                            $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                            $("#lookup_processing").css("display", "none");

                        }
                    }
                });

                $('#lookup_filter').css("display", "none");
                $('.search-input-text').on('keyup click', function () {   // for text boxes
                    var i = $(this).attr('data-column');  // getting column index
                    var v = $(this).val();  // getting search input value
                    dataTable.columns(i).search(v).draw();
                });
            });
        </script>
        <script type="text/javascript" src="js/maintainscroll.min.js"></script>
        <script type="text/javascript" src="js/maintainscroll.min.js"></script>
    </body>

    </html>
<?php } else {
    header("Location: login.php"); //si hay una sesion iniciada se reenvia a login
} ?>