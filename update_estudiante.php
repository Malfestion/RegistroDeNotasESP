<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia sesion y se verifica si el rol es admin
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
        include "php/db_conn.php";
        //se consiguie el id del estudiante enviado para editar y se busca en la bd
        $id = $_GET['id'];
        $sql = "SELECT * FROM estudiante WHERE id='$id'";
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
                        <form action="php/edit_estudiante.php" method="POST">
                                <h1>Editar Estudiante</h1>
                                <div class="mb-3 p-3">
                                        <label for="name" class="form-label">ID</label>
                                        <input type="text" class="form-control" id="id" name="id" readonly
                                                value="<?= $row['id'] //se muestran los datos existentes para qye se pueda editar?>">
                                </div>
                                <div class="mb-3 p-3">
                                        <label for="name" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="name" name="nombre" maxlength="50"
                                                placeholder="Nombre Completo"
                                                value="<?= $row['nombre_estudiante'] //se muestran los datos existentes para qye se pueda editar?>">
                                </div>
                                <div class="mb-3  p-3">
                                        <label for="email" class="form-label">Correo Institucional</label>
                                        <input type="email" class="form-control" id="email" name="correo" maxlength="50"
                                                placeholder="Correo ucr.ac.cr" value="<?= $row['correo_estudiante'] ?>">
                                </div>
                                <div class="mb-3  p-3">
                                        <label for="tel" class="form-label">Número de Teléfono</label>
                                        <input type="number" class="form-control" id="tel" name="telefono" maxlength="8"
                                                placeholder="Extension de oficina o # de celular"
                                                value="<?= $row['telefono_estudiante'] ?>">
                                </div>

                                <div class="mb-3  p-3">
                                        <label for="tel" class="form-label">Estado</label>
                                        <select class="form-select" id="estado" name="estado">
                                                <option value="<?= $row['estado_estudiante'] ?>" selected>Estado del Estudiante
                                                </option>
                                                <option value="ACT">Activo</option>
                                                <option value="RJ">Retiro Justificado</option>
                                                <option value="RI">Retiro Injustificado</option>
                                                <option value="FIN">Finalizado</option>
                                                <option value="CONG">Congelado</option>
                                        </select>
                                </div>

                                <div class="mb-3  p-3">
                                        <label for="1career" class="form-label">Carrera</label>
                                        <input type="text" class="form-control" id="1career" name="1career"
                                                placeholder="Carrera" maxlength="50" value="<?= $row['carrera_1'] ?>">
                                </div>
                                
                                <div class="mb-3  p-3">
                                        <label for="2career" class="form-label">Segunda Carrera</label>
                                        <input type="text" class="form-control" id="2career" name="2career"
                                                placeholder="2° Carrera (si aplica)" maxlength="50" value="<?= $row['carrera_2'] ?>">
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