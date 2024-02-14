<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia o resume sesion 
session_start();

include "php/db_conn.php";
$sql = "SELECT estado FROM formulario_estado";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);
if ($row[0]==1) { //Esto abre o cierra el formulario dependiendo de la fecha en que se esté, en este caso, el mes.
    //se buscan todos los estudiantes
    $sql = "SELECT * FROM estudiante";
    $query = mysqli_query($conn, $sql);
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


        <div class="container" style="margin-top: 80px;">
            <h2>Por favor ingrese sus detalles de Estudiante:</h2>
            <br>
            <p>Este formulario ayudará a ingresar sus datos en el sistema de notas de Inglés por Áreas, para que los docentes puedan registrar las notas de cada curso finalizado.</p>
            <ul>
                <li>
                    <p>Por favor asegurese de que los datos ingresados sean correctos antes de hacer el registro.</p>
                </li>
                <li>
                    <p>En el espacio de "Carné o Cédula, por favor ingrese su carné en caso de ser estudiante. Si usted es un funcionario por favor ingrese su numero de cédula".</p>
                </li>
                <li>
                    <p>Ingrese el nombre de la carrera en la que está empadronado o su lugar de trabajo (en caso de funcionarios).</p>
                </li>
                <li>
                    <p>En caso de no estar en una segunda carrera, puede dejar este espacio en blanco.</p>
                </li>
                <li>
                    <p>En caso de equivocarse en los datos ingresados, puede notificar a la administracion de Inglés por Áreas para realizar las correcciones necesarias.</p>
                </li>
            </ul>
            <hr>
            <h3>Mis Datos:</h3>
            <form action="php/insert_estudiante_public.php" method="POST">
                <div class="d-flex">
                    <div class="mb-3 p-3">
                        <label for="name" class="form-label">Carné de estudiante o Cédula en caso de funcionarios</label>
                        <input type="text" class="form-control" id="id" name="id" placeholder="Identificación" required="required" maxlength="9">
                    </div>
                    <div class="mb-3 p-3">
                        <label for="name" class="form-label">Nombre y apellidos</label>
                        <input type="text" class="form-control" id="name" name="nombre" placeholder="Nombre Completo" required="required" maxlength="50">
                    </div>
                    <div class="mb-3  p-3">
                        <label for="email" class="form-label">Correo Institucional</label>
                        <input type="email" class="form-control" id="email" name="correo" placeholder="Correo @ucr.ac.cr" required="required" maxlength="50">
                    </div>
                    <div class="mb-3  p-3">
                        <label for="tel" class="form-label">Número de Teléfono</label>
                        <input type="number" class="form-control" id="tel" name="telefono" placeholder="Extension de oficina o # de celular" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="8">
                    </div>
                    <div class="mb-3  p-3" hidden>
                        <label for="estado" class="form-label">Estado del Estudiante</label>
                        <select class="form-select" id="estado" name="estado">
                            <option value="ACT" selected>Activo</option>
                            <option value="RJ">Retiro Justificado</option>
                            <option value="RI">Retiro Injustificado</option>
                            <option value="FIN">Finalizado</option>
                            <option value="CONG">Congelado</option>
                        </select>

                    </div>
                </div>

                <div class="d-flex">
                    <div class="mb-3  p-3">
                        <label for="1career" class="form-label">Carrera</label>
                        <input type="text" class="form-control" id="1career" name="1career" placeholder="Carrera" maxlength="50" required="required">
                    </div>
                    <div class="mb-3  p-3">
                        <label for="2career" class="form-label">Segunda Carrera (solo si aplica)</label>
                        <input type="text" class="form-control" id="2career" name="2career" placeholder="2° Carrera (si aplica)" maxlength="50">
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" style="margin-left: 15px;" value="Registrar mis datos">

            </form>
        </div>
        <br>
        <?php
        include "layout/footer.php";
        ?>
        <script type="text/javascript" src="js/maintainscroll.min.js"></script>
    </body>

    </html>
<?php } else {
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


        <div class="container" style="margin-top: 80px;">
            <h1>Este formulario ya no está disponible.</h1>
            <p>Si necesita registrar sus datos por favor contactar a la administración de Inglés por Áreas</p>
            <p>Teléfono: 2511-8449</p>
            <p>Correo: inglesxareas.elm@ucr.ac.cr</p>'
        </div>
        <br>
        <?php
        include "layout/footer.php";
        ?>
        <script type="text/javascript" src="js/maintainscroll.min.js"></script>
    </body>

    </html>

<?php }
