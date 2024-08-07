<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia sesion y se verifica si el rol es admin
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
        include "php/db_conn.php";
        //se consiguie el id del estudiante enviado para editar y se busca en la bd
        $id = $_GET['edit'];
        $sql = "SELECT * FROM datos WHERE edit='$id'";
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
                        <form action="php/edit_reg_anterior.php" method="POST">
                                <h1>Editar Registro</h1>
                                <div class="mb-3 p-3">
                                        <label for="edit" class="form-label">Número de Registro</label>
                                        <input type="text" class="form-control" id="edit" name="edit" readonly
                                                value="<?= $row['edit'] //se muestran los datos existentes para qye se pueda editar?>">
                                </div>
                                <div class="mb-3 p-3">
                                        <label for="id" class="form-label">Carné o Cédula</label>
                                        <input type="text" class="form-control" id="id" name="id" placeholder="Carné o Cédula" maxlength="14"
                                                value="<?= $row['id'] //se muestran los datos existentes para qye se pueda editar?>">
                                </div>
                                <div class="mb-3 p-3">
                                        <label for="name" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="name" name="name" maxlength="50"
                                                placeholder="Nombre Completo"
                                                value="<?= $row['nombre'] //se muestran los datos existentes para qye se pueda editar?>">
                                </div>
                                <div class="mb-3  p-3">
                                        <label for="periodo" class="form-label">Periodo</label>
                                        <input type="text" class="form-control" id="periodo" name="periodo" maxlength="20"
                                                placeholder="Periodo" value="<?= $row['periodo'] ?>">
                                </div>
                                <div class="mb-3  p-3">
                                        <label for="nivel" class="form-label">Nivel</label>
                                        <input type="text" class="form-control" id="nivel" name="nivel" placeholder="Nivel" maxlength="50"
                                                value="<?= $row['nivel'] ?>">
                                </div>
                                <div class="mb-3  p-3">
                                        <label for="grupo" class="form-label">Grupo</label>
                                        <input type="text" class="form-control" id="grupo" name="grupo" placeholder="Grupo" maxlength="10"
                                                value="<?= $row['grupo'] ?>">
                                </div>
                                <div class="mb-3  p-3">
                                        <label for="area" class="form-label">Área</label> 
                                        <input type="text" class="form-control" id="area" name="area" placeholder="Area" maxlength="50"
                                                value="<?= $row['area'] ?>">
                                </div>
                                <div class="mb-3  p-3">
                                        <label for="nota" class="form-label">Nota</label>
                                        <input type="text" class="form-control" id="nota" name="nota" placeholder="Nota" maxlength="4"
                                                value="<?= $row['nota'] ?>">
                                </div>
                                <div class="mb-3  p-3">
                                        <label for="profesor" class="form-label">Profesor</label>
                                        <input type="text" class="form-control" id="niprofesorvel" name="profesor" maxlength="50"
                                                placeholder="Profesor" value="<?= $row['profesor'] ?>">
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