<!--
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)
-->
<?php
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

                <div class="mb-3 p-3">
                    <label for="name" class="form-label">Carné/Cédula</label>
                    <input type="text" class="form-control" id="id" name="id" placeholder="Identificación"
                        required="required">
                </div>
                <div class="mb-3 p-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="nombre" placeholder="Nombre Completo"
                        required="required">
                </div>
                <div class="mb-3  p-3">
                    <label for="email" class="form-label">Correo Institucional</label>
                    <input type="email" class="form-control" id="email" name="correo" placeholder="Correo @ucr.ac.cr"
                        required="required">
                </div>
                <div class="mb-3  p-3">
                    <label for="tel" class="form-label">Número de Teléfono</label>
                    <input type="number" class="form-control" id="tel" name="telefono"
                        placeholder="Extension de oficina o # de celular">
                </div>
                <div class="mb-3  p-3">
                    <label for="estado" class="form-label">Estado del Estudiante</label>
                    <select class="form-select" id="estado" name="estado">
                        <option value="ACT">Activo</option>
                        <option value="RJ">Retiro Justificado</option>
                        <option value="RI">Retiro Injustificado</option>
                    </select>

                </div>
                <input type="submit" class="btn btn-primary" style="margin-left: 15px;"
                    value="Agregar Estudiante a la Lista">

            </form>
        </div>
        <br>
        <div class="container" style="margin-bottom: 80px;">
            <h2>Estudiantes en la lista</h2>
            <br>
            <script>
                $(document).ready(function () {
                    $('#tabla-estudiantes').DataTable({
                        "oLanguage": {
                            "sSearch": "Busqueda por nombre o carné:"
                        }
                    });

                });
            </script>
            <table id="tabla-estudiantes" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_array($query)): ?>
                            <th>
                                <?= $i ?>
                            </th>
                            <th>
                                <?= $row['id'] ?>
                            </th>
                            <th>
                                <?= $row['nombre_estudiante'] ?>
                            </th>
                            <th>
                                <?= $row['correo_estudiante'] ?>
                            </th>
                            <th>
                                <?= $row['telefono_estudiante'] ?>
                            </th>
                            <th>
                                <?= $row['estado_estudiante'] ?>
                            </th>
                            <th><a class="btn btn-primary"
                                    href="update_estudiante.php?id=<?= $row['id'] //se envia el id a update?>">Editar</a></th>
                            <th><a class="btn btn-danger"
                                    href="php/delete_estudiante.php?id=<?= $row['id'] //se envia el id a delete?>"
                                    onclick="return confirm('Realmente quiere eliminar esta entrada? Los datos en el registro de notas pueden depender de esta.')">Eliminar</a>
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
        <script type="text/javascript" src="js/maintainscroll.min.js"></script>
    </body>

    </html>
<?php } else {
    header("Location: login.php"); //si hay una sesion iniciada se reenvia a login
} ?>