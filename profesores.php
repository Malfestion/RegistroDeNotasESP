<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia o resume sesion y se verifica si el rol es admin
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "php/db_conn.php";
    //se buscan todos los profesores
    $sql = "SELECT * FROM profesor";
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
            <h2>Agregar Docente</h2>
            <br>
            <form action="php/insert_profe.php" method="POST"><!--La accion de el submit del formulario es importante-->

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
                        placeholder="Extension de oficina o # de celular" maxlength="8">
                </div>
                <input type="submit" class="btn btn-primary" style="margin-left: 15px;" value="Agregar Profesor a la Lista">

            </form>
        </div>
        <br>
        <div class="container" style="margin-bottom: 80px;">
            <h2>Docentes en la lista</h2>
            <br>
            <table id="tabla-profes" class="table table-striped table-hover">
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
                        while ( $row = mysqli_fetch_array($query)): ?>
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
                            <th><a class="btn btn-primary"
                                    href="update_profe.php?id=<?= $row['id'] //se envia el id a update?>">Editar</a></th>
                            <th><a class="btn btn-danger"
                                    href="php/delete_profe.php?id=<?= $row['id'] //se envia el id a delete?>"
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
        <script>
            $(document).ready(function () {
                $('#tabla-profes').DataTable({
                    "oLanguage": {
                        "sSearch": "Busqueda por nombre:"
                    }
                });
            }); 
        </script>
    </body>

    </html>
<?php } else {
    header("Location: login.php"); //si hay una sesion iniciada se reenvia a login
} ?>