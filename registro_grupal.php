<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia o resume sesion y se verifica si el rol es admin
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'user')) {
    include "php/db_conn.php";
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
            <h2>Agregar Grupo de estudiantes</h2>
            <br>
            <p>Herramienta para agregar notas de estudiantes a la base de datos al finalizar el ciclo lectivo.</p>
            <ul>
                <li><p>El botón para agregar las notas a la Base de Datos se encuentra al final de esta lista para agregar notas de estudiantes.</p></li>
                <li><p>En el caso en que el estudiante no desee continuar los cursos, quitar la marca de "continúa". Esto
                    registrará automáticamente un Retiro Justificado en el sistema.</p></li>
                    <li><p>En caso de necesitar realizar cambios en un registro (Puede revisarlos en la pestaña "Mi registro de
                    notas"), contacte a la administración</p></li>
            </ul>
            <p><b>Nota:</b> Puede dejar espacios de estudiante vacíos. En caso de dejar vacío el espacio de "estudiante"
                o
                "nota" simplemente no se registrará en la base de datos.</p>
            <br>
            <hr>
            <h3>Información General del grupo:</h3>
            <p><small><b>Estos campos son obligatorios.</b> Por favor llenarlos antes de continuar con las
                    notas.</small></p>
            <form action="php/insert_nota_grupal.php" method="POST">
                <div class="d-inline-flex">
                    <div class="mb-3  p-3">
                        <label for="profesor" class="form-label">Profesor</label>
                        <br> 
                        <select class="select2-single" id="profesor" name="profesor" required="required" style="width: 250px;">
                            <?php
                            $nombre_bd = $_SESSION['name'];
                            $res_profesor = mysqli_query($conn, "SELECT * FROM profesor WHERE REPLACE(nombre_profesor, ' ', '') = REPLACE('$nombre_bd', ' ', '')"); //se usa replace para ignorar espacios.
                            if (mysqli_num_rows($res_profesor) != 0) { //Si el nombre de la cuenta coincide con algun profesor...
                                $row_profesor = mysqli_fetch_array($res_profesor) ?>
                                <option value="<?= $row_profesor['id'] ?>"><?= $row_profesor['nombre_profesor'] ?></option>
                            <?php } ?>
                            <option value=""></option>
                            <?php
                            $res_profesor = mysqli_query($conn, "SELECT * FROM profesor");
                            while ($row_profesor = mysqli_fetch_array($res_profesor)): ?>
                                <option value="<?= $row_profesor['id'] ?>"><?= $row_profesor['nombre_profesor'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3 p-3">
                        <label for="nombre_grupo" class="form-label">Grupo</label>
                        <input type="text" class="form-control" id="nombre_grupo" name="nombre_grupo"
                            placeholder="Siglas del grupo" required="required" maxlength="10">
                    </div>
                    <div class="mb-3  p-3">
                        <label for="nivel" class="form-label">Nivel</label>
                        <select class="form-select " id="nivel" name="nivel" required="required">
                            <option value=""></option>
                            <?php
                            $res_nivel = mysqli_query($conn, "SELECT * FROM nivel");
                            while ($row_nivel = mysqli_fetch_array($res_nivel)): ?>
                                <option value="<?= $row_nivel['id'] ?>"><?= $row_nivel['nombre_nivel'] ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3  p-3">
                        <label for="area" class="form-label">Area</label>
                        <select class="form-select " id="area" name="area" required="required">
                            <option value=""></option>
                            <?php
                            $res_area = mysqli_query($conn, "SELECT * FROM area");
                            while ($row_area = mysqli_fetch_array($res_area)): ?>
                                <option value="<?= $row_area['id'] ?>"><?= $row_area['nombre_area'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3  p-3">
                        <label for="periodo" class="form-label" >Periodo</label>
                        <select class="form-select" aria-label="periodo" id="periodo" name="periodo" required="required">
                            <option value="I Ciclo ">I Ciclo</option>
                            <option value="II Ciclo ">II Ciclo</option>
                            <option value="Verano ">Verano</option>
                        </select>
                    </div>
                </div>
                <h3>Estudiantes:</h3>
                <?php
                include "php/notas-grupales-layout.php"; //se imprimen 31 espacios de formulario para elegir estudiante y nota
                ?>
                <input type="submit" class="btn btn-primary" style="margin-left: 15px;"
                    value="Agregar Notas a la Base de Datos"
                    onclick="return confirm('Realmente quiere registrar este grupo de notas?')">
                <p class="text-secondary"><small><b>Recordatorio:Verificar que los datos estén correctos antes de
                            registrarlos en la base de
                            datos.</b></small></p>

            </form>

        </div>


        <?php
        include "layout/footer.php";
        ?>
        <script type="text/javascript" src="js/maintainscroll.min.js"></script>
        <script type="text/javascript">

            $(document).ready(function () {

                $('.select2-single').select2();
            });
        </script>
    </body>

    </html>
<?php } else {
    header("Location: login.php"); //si hay una sesion iniciada se reenvia a login
} ?>