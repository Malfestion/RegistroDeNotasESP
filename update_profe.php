<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia sesion y se verifica si el rol es admin
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
        include "php/db_conn.php";
        //se consiguie el id del profesor enviado para editar y se busca en la bd
        $id = $_GET['id'];
        $sql = "SELECT * FROM profesor WHERE id='$id'";
        $query = mysqli_query($conn, $sql);
        $row = $row = mysqli_fetch_array($query);
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
                <div class="container" style="margin-top: 80px; margin-bottom: 80px;">
                        <form action="php/edit_profe.php" method="POST">
                                <h1>Editar Profesor</h1>
                                <input type="hidden" name="id"
                                        value="<?= $row['id'] //el id se deja como un valor oculto, para enviarlo al script del query?>">
                                <div class="mb-3 p-3">
                                        <label for="name" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="name" name="nombre"
                                                placeholder="Nombre Completo" maxlength="50"
                                                value="<?= $row['nombre_profesor'] //se muestran los datos existentes para qye se pueda editar?>">
                                </div>
                                <div class="mb-3  p-3">
                                        <label for="email" class="form-label">Correo Institucional</label>
                                        <input type="email" class="form-control" id="email" name="correo" maxlength="50"
                                                placeholder="Correo ucr.ac.cr" value="<?= $row['correo_profesor'] ?>">
                                </div>
                                <div class="mb-3  p-3">
                                        <label for="tel" class="form-label">Número de Teléfono</label>
                                        <input type="number" class="form-control" id="tel" name="telefono"
                                                placeholder="Extension de oficina o # de celular" maxlength="8"
                                                value="<?= $row['telefono_profesor'] ?>">
                                </div>
                                <input type="submit" class="btn btn-primary" style="margin-left: 15px;"
                                        value="Actualizar informacion">

                        </form>
                </div>
                <?php
                include "layout/footer.php";
                ?>
        </body>

        </html>
<?php } else {
        header("Location: login.php");
} ?>