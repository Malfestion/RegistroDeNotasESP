<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia sesion y se verifica si el rol es admin
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
        include "php/db_conn.php";
        //se consiguie el id del estudiante enviado para editar y se busca en la bd
        $id = $_GET['id'];

        $sql = "SELECT * FROM notas
        JOIN estudiante ON (estudiante.id = notas.id_estudiante)
        JOIN area ON (area.id = notas.id_area) 
        JOIN profesor ON (profesor.id = notas.id_profesor)
        JOIN nivel ON (nivel.id = notas.id_nivel)    
        WHERE id_nota='$id' ";
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
                        <form action="php/edit_nota.php" method="POST">
                                <h1>Editar Registro</h1>
                                <div class="mb-3 p-3">
                                        <label for="id" class="form-label">Numero de registro</label>
                                        <input type="text" class="form-control" id="id" name="id" readonly
                                                value="<?= $row['id_nota'] //se muestran los datos existentes para qye se pueda editar?>">
                                </div>
                                <div class="mb-3  p-3">
                                        <label for="estudiante" class="form-label">Estudiante</label>
                                        <select class="form-select select2-single" id="estudiante" name="estudiante">
                                                <option value="<?= $row['id_estudiante'] ?>" selected><?= $row['id_estudiante'] ?></option>
                                                <?php
                                                $res_estudiante = mysqli_query($conn, "SELECT * FROM estudiante");
                                                while ($row_estudiante = mysqli_fetch_array($res_estudiante)): ?>
                                                        <option value="<?= $row_estudiante['id'] ?>"><?= $row_estudiante['id'] ?>
                                                        </option>
                                                <?php endwhile; ?>
                                        </select>
                                </div>

                                <div class="mb-3  p-3">
                                        <label for="area" class="form-label">Area</label>
                                        <select class="form-select select2-single" id="area" name="area">
                                                <option value="<?= $row['id_area'] ?>" selected><?= $row['nombre_area'] ?>
                                                </option>
                                                <?php
                                                $res_area = mysqli_query($conn, "SELECT * FROM area");
                                                while ($row_area = mysqli_fetch_array($res_area)): ?>
                                                        <option value="<?= $row_area['id'] ?>"><?= $row_area['nombre_area'] ?></option>
                                                <?php endwhile; ?>
                                        </select>
                                </div>
                                <div class="mb-3  p-3">
                                        <label for="profesor" class="form-label">Profesor</label>
                                        <select class="form-select select2-single" id="profesor" name="profesor">
                                                <option value="<?= $row['id_profesor'] ?>" selected><?= $row['nombre_profesor'] ?></option>
                                                <?php
                                                $res_profesor = mysqli_query($conn, "SELECT * FROM profesor");
                                                while ($row_profesor = mysqli_fetch_array($res_profesor)): ?>
                                                        <option value="<?= $row_profesor['id'] ?>"><?= $row_profesor['nombre_profesor'] ?></option>
                                                <?php endwhile; ?>
                                        </select>
                                </div>
                                <div class="mb-3  p-3">
                                        <label for="nivel" class="form-label">Nivel</label>
                                        <select class="form-select select2-single" id="nivel" name="nivel">
                                                <option value="<?= $row['id_nivel'] ?>" selected><?= $row['nombre_nivel'] ?>
                                                </option>
                                                <?php
                                                $res_nivel = mysqli_query($conn, "SELECT * FROM nivel");
                                                while ($row_nivel = mysqli_fetch_array($res_nivel)): ?>
                                                        <option value="<?= $row_nivel['id'] ?>"><?= $row_nivel['nombre_nivel'] ?>
                                                        </option>
                                                <?php endwhile; ?>
                                        </select>
                                </div>
                                <div class="mb-3  p-3">
                                        <label for="grupo" class="form-label">Grupo</label>
                                        <input type="text" class="form-control" id="grupo" name="grupo"
                                                placeholder="Nombre del grupo"
                                                value="<?= $row['nombre_grupo'] //se muestran los datos existentes para qye se pueda editar?>">
                                </div>
                                <div class="mb-3  p-3">
                                        <label for="periodo" class="form-label">Periodo Lectivo</label>
                                        <input type="text" class="form-control" id="periodo" name="periodo"
                                                placeholder="Periodo Lectivo"
                                                value="<?= $row['periodo'] //se muestran los datos existentes para qye se pueda editar?>">
                                </div>
                                <div class="mb-3  p-3">
                                        <label for="tel" class="form-label">Nota</label>
                                        <input type="text" class="form-control" id="nota" name="nota" placeholder="Nota"
                                                value="<?= $row['nota'] //se muestran los datos existentes para qye se pueda editar?>">
                                </div>
                                <input type="submit" class="btn btn-primary" style="margin-left: 15px;"
                                        value="Actualizar informacion">

                        </form>
                </div>
                <?php
                include "layout/footer.php";
                ?>
                <script type="text/javascript">
                        $(document).ready(function () {
                                $('.select2-single').select2();
                        });
                </script>

        </body>

        </html>
<?php } else {
        header("Location: login.php");
} ?>