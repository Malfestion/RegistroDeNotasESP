<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia sesion y se verifica si el rol es admin
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') { ?>

    <!DOCTYPE html>
    <html lang="es">

    <?php
    include "layout/head.php";
    ?>

    <script>
        document.title = "Inventario de activos ESP";
    </script>

    <body>
        <?php
        include "layout/header.php";
        ?>
        <div class="container" style="margin-top: 80px; margin-bottom: 80px;">
            <h1 class="display-4 fs-1 text-dark"><b>Inventario de activos ESP</b></h1>
            <br><br>
            <a href="agregar_inventario.php" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Agregar</a>
            <br><br>
            <table id="inventarioTable" class="display table table-striped table-bordered table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Descripción</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Serie</th>
                        <th>Categoría</th>
                        <th>Asignado a:</th>
                        <th>Observaciones</th>
                        <th></th>
                        <th></th>
                        <!-- Add other headers as needed -->
                    </tr>
                </thead>
            </table>

        </div>
        <?php
        include "layout/footer.php";
        ?>

        <style>
            /* Adjust the search bar width */
            .dt-search {
                float: right;
                width: auto;
                max-width: 300px;
            }

            .dt-buttons {
                margin-left: 40%;
                margin-bottom: 20px;
            }
        </style>

        <script>
            $(document).ready(function() {
                var table = $('#inventarioTable').DataTable({
                    "language": {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar: _MENU_ ",
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
                    "lengthMenu": [
                        [1000, 10, 25, 50],
                        ['Todos', 10, 25, 50]
                    ],
                    "processing": true,
                    "serverSide": true,
                    "ajax": "php/ajax-grid-data-inventario.php", // Path to the PHP script to fetch data
                    "dom": '<"top"lfB>rt<"bottom"ip><"clear">', // Add this line to enable buttons
                    "buttons": [{
                        "extend": 'excelHtml5',
                        "text": '<i class="fas fa-file-excel"></i> Exportar a Excel ',
                        "className": 'btn btn-success',
                        "exportOptions": {
                            "columns": ':not(:last-child):not(:nth-last-child(2))'
                        }

                    }]
                });

                $('#exportButton').on('click', function() {
                    table.button('.buttons-excel').trigger();
                });
            });
        </script>
    </body>

    </html>
<?php } else {
    header("Location: login.php");
} ?>