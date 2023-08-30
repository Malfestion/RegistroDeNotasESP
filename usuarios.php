<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia o resume sesion y se verifica si el rol es admin
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "php/db_conn.php";
    //se buscan todos los estudiantes
    $sql = "SELECT * FROM users";
    $query = mysqli_query($conn, $sql);
    ?>

    <!DOCTYPE html>
    <html lang="es">

    <?php
    include "layout/head.php";
    ?>

    <body>
    <script>
                function check() {
                    var input = document.getElementById('password_confirm');
                    if (input.value != document.getElementById('password').value) {
                        input.setCustomValidity('Las contraseñas no coinciden.');
                    } else {
                        
                        input.setCustomValidity('');
                    }
                }
            </script>
        <?php
        include "layout/header.php";
        ?>


        <div class="container" style="margin-top: 80px;">
            <h2>Agregar Usuario</h2>
            <br>
            <form action="php/insert_user.php" method="POST">

                <div class="mb-3 p-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="En caso de profesores, nombre igual a la lista de profes." required="required"
                        maxlength="50" required="required">
                </div>

                <div class="mb-3 p-3">
                    <label for="username" class="form-label">Nombre de usuario (login)</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="username"
                        required="required" maxlength="25" >
                </div>

                <div class="mb-3  p-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input class="form-control" id="password" name="password" placeholder="Password"
                        required="required" maxlength="50" oninput="check()" required="required" type="password">
                </div>
                <div class="mb-3  p-3">
                    <label for="password_confirm" class="form-label">Confirmar Contraseña</label>
                    <input class="form-control" id="password_confirm" name="password_confirm" placeholder="Password"
                        required="required" maxlength="50" oninput="check()" required="required" type="password">
                </div>

                <div class="mb-3  p-3">
                    <label for="role" class="form-label">Rol</label>
                    <select class="form-select" id="role" name="role">
                        <option value="admin">Administrador</option>
                        <option value="user">Profesor</option>
                    </select>

                </div>
                <input type="submit" class="btn btn-primary" style="margin-left: 15px;" value="Agregar Usuario">

            </form>
            
        </div>
        <br>
        <div class="container" style="margin-bottom: 80px;">
            <h2>Usuarios existentes</h2>
            <br>
            <script>
                $(document).ready(function () {
                    $('#tabla-usuarios').DataTable({
                        "oLanguage": {
                            "sSearch": "Busqueda por nombre o carné:"
                        }
                    });

                });
            </script>
            <table id="tabla-usuarios" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Nombre de usuario</th>
                        <th>Rol</th>
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
                                <?= $row['name'] ?>
                            </th>
                            <th>
                                <?= $row['username'] ?>
                            </th>
                            <th>
                                <?= $row['role'] ?>
                            </th>
                            <th><a class="btn btn-primary"
                                    href="update_usuario.php?id=<?= $row['id'] //se envia el id a update?>">Editar</a></th>
                            <th><a class="btn btn-danger"
                                    href="php/delete_usuario.php?id=<?= $row['id'] //se envia el id a delete?>"
                                    onclick="return confirm('Realmente quiere eliminar este usuario?')">Eliminar</a>
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