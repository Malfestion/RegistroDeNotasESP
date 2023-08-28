<!--
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)
-->
<?php
//si el inicio de sesion es nulo muestra el login
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) { ?>
    <!DOCTYPE html>
    <html lang="es">
    <?php
    include "layout/head.php";
    ?>

    <body>
        <?php
        include "layout/header.php";
        ?>
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
            <form class="border shadow p-3 rounded" action="php/check-login.php" method="post" style="width: 450px;">
                <h1 class="text-center p-3">INICIO DE SESION AL REGISTRO DE NOTAS ESP</h1>
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $_GET['error'] ?>
                    </div>
                <?php } ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Nombre de Usuario</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>

                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>
        </div>

        <?php
        include "layout/footer.php";
        ?>
    </body>

    </html>
<?php } else {
    header("Location: index.php"); //si no es nulo el valor de la sesion, redirecciona a index
} ?>