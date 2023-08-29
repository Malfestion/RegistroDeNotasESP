<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia sesion y se verifica si el rol es admin
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
        include "php/db_conn.php";
        //se consiguie el id del estudiante enviado para editar y se busca en la bd
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE id='$id'";
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
                        <form action="php/edit_user.php" method="POST">
                                <h1>Editar Usuario</h1>
                                <div class="mb-3 p-3">
                                        
                                        <input type="hidden" class="form-control" id="id" name="id" maxlength="50"
                                                value="<?= $row['id'] //se muestran los datos existentes para qye se pueda editar?>">
                                </div>
                                <div class="mb-3 p-3">
                                        <label for="name" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="name" name="name" maxlength="50"
                                                value="<?= $row['name'] //se muestran los datos existentes para qye se pueda editar?>">
                                </div>
                                <div class="mb-3 p-3">
                                        <label for="username" class="form-label">Nombre de Usuario</label>
                                        <input type="text" class="form-control" id="username" name="username" maxlength="25"
                                                placeholder="Nombre de usuario"
                                                value="<?= $row['username'] //se muestran los datos existentes para qye se pueda editar?>">
                                </div>
                                <div class="mb-3  p-3">
                                        <label for="password" class="form-label">Nueva Contraseña</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                                maxlength="100" placeholder="Dejar vacío si no se hacen cambios">
                                </div>

                                <div class="mb-3  p-3">
                                        <label for="role" class="form-label">Rol</label>
                                        <select class="form-select" id="role" name="role">
                                                <option value="<?= $row['role'] ?>" selected><?= $row['role'] ?>
                                                </option>
                                                <option value="admin">Administrador</option>
                                                <option value="user">Profesor</option>
                                        </select>
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