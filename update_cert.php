<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia sesion y se verifica si el rol es admin
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
        include "php/db_conn.php";
        //se consiguie el id del estudiante enviado para editar y se busca en la bd
        $id_cert = $_GET['id_cert'];
        $sql = "SELECT * FROM calificaciones_cert WHERE id_cert='$id_cert'";
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
                        <form action="php/edit_cert.php" method="POST">
                                <h1>Editar Información de Certificado</h1>
                                <input type="hidden" name="id_cert"
                                        value="<?= $row['id_cert'] //el id se deja como un valor oculto, para enviarlo al script del query?>">
                                <div class="mb-3 p-3">
                                        <label for="name" class="form-label">ID</label>
                                        <input type="text" class="form-control" id="id_estudiante" name="id_estudiante" 
                                                value="<?= $row['id_estudiante'] //se muestran los datos existentes para qye se pueda editar?>">
                                </div>
                                <div class="mb-3 p-3">
                                        <label for="name" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="id_estudiante" name="nombre_estudiante"
                                                value="<?= $row['nombre_estudiante'] //se muestran los datos existentes para qye se pueda editar?>">
                                </div>
                                <div class="mb-3 p-3">
                                        <label for="name" class="form-label">Reading</label>
                                        <input type="text" class="form-control" id="lectura" name="lectura" maxlength="3"
                                                placeholder=""
                                                value="<?= $row['lectura'] //se muestran los datos existentes para qye se pueda editar?>">
                                </div>
                                <div class="mb-3 p-3">
                                        <label for="name" class="form-label">Listening</label>
                                        <input type="text" class="form-control" id="escucha" name="escucha" maxlength="3"
                                                placeholder=""
                                                value="<?= $row['escucha'] //se muestran los datos existentes para qye se pueda editar?>">
                                </div>
                                <div class="mb-3 p-3">
                                        <label for="name" class="form-label">Writing</label>
                                        <input type="text" class="form-control" id="escritura" name="escritura" maxlength="3"
                                                placeholder=""
                                                value="<?= $row['escritura'] //se muestran los datos existentes para qye se pueda editar?>">
                                </div>
                                <div class="mb-3 p-3">
                                        <label for="name" class="form-label">Speaking</label>
                                        <input type="text" class="form-control" id="habla" name="habla" maxlength="3"
                                                placeholder=""
                                                value="<?= $row['habla'] //se muestran los datos existentes para qye se pueda editar?>">
                                </div>
                                <div class="mb-3 p-3">
                                        <label for="name" class="form-label">Fecha</label>
                                        <input type="text" class="form-control" id="fecha_cert" name="fecha_cert" maxlength="50"
                                                placeholder=""
                                                value="<?= $row['fecha_cert'] //se muestran los datos existentes para qye se pueda editar?>">
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