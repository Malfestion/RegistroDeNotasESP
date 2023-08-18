<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
        include "db_conn.php";
        $id = $_GET['id'];
        $sql = "SELECT * FROM profesor WHERE id='$id'";
        $query = mysqli_query($conn, $sql);
        $row = $row = mysqli_fetch_array($query);
        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
                <title>Registro de notas ESP</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link href="bootstrap5/css/bootstrap.min.css" rel="stylesheet">
                <link rel="icon" type="image/x-icon" href="img/favicon.ico">
                <script src="bootstrap5/js/bootstrap.bundle.min.js"></script>
        </head>

        <body>
                <form action="php/edit_profe.php" method="POST">
                        <h1>Editar Profesor</h1>
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <div class="mb-3 p-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="nombre" placeholder="Nombre Completo"
                                        value="<?= $row['nombre_profesor'] ?>">
                        </div>
                        <div class="mb-3  p-3">
                                <label for="email" class="form-label">Correo Institucional</label>
                                <input type="email" class="form-control" id="email" name="correo" placeholder="Correo ucr.ac.cr"
                                        value="<?= $row['correo_profesor'] ?>">
                        </div>
                        <div class="mb-3  p-3">
                                <label for="tel" class="form-label">Número de Teléfono</label>
                                <input type="number" class="form-control" id="tel" name="telefono"
                                        placeholder="Extension de oficina o # de celular"
                                        value="<?= $row['telefono_profesor'] ?>">
                        </div>
                        <input type="submit" class="btn btn-primary" style="margin-left: 15px;" value="Actualizar informacion">

                </form>
        </body>

        </html>
<?php } else {
        header("Location: login.php");
} ?>