<?php
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

        <?php
        include "layout/footer.php";
        ?>
        <script type="text/javascript" src="js/maintainscroll.min.js"></script>
    </body>

    </html>
<?php } else {
    header("Location: login.php"); //si hay una sesion iniciada se reenvia a login
} ?>