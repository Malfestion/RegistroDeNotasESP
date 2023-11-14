<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia o resume sesion y se verifica si el rol es admin
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin' || 1==1) {
    include "php/db_conn.php";
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
            <form action="php/insert_estudiante_public.php" method="POST">
                <div class="d-flex">
                    <div class="mb-3 p-3">
                        <label for="name" class="form-label">Carné o Cédula en caso de funcionarios</label>
                        <input type="text" class="form-control" id="id" name="id" placeholder="Identificación"
                            required="required" maxlength="9">
                    </div>
                    <div class="mb-3 p-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="nombre" placeholder="Nombre Completo"
                            required="required" maxlength="50">
                    </div>
                    <div class="mb-3  p-3">
                        <label for="email" class="form-label">Correo Institucional</label>
                        <input type="email" class="form-control" id="email" name="correo" placeholder="Correo @ucr.ac.cr"
                            required="required" maxlength="50">
                    </div>
                    <div class="mb-3  p-3">
                        <label for="tel" class="form-label">Número de Teléfono</label>
                        <input type="number" class="form-control" id="tel" name="telefono"
                            placeholder="Extension de oficina o # de celular" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="8">
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
                        <input type="text" class="form-control" id="1career" name="1career"
                            placeholder="Carrera" maxlength="50">
                    </div>
                    <div class="mb-3  p-3">
                        <label for="2career" class="form-label">Segunda Carrera</label>
                        <input type="text" class="form-control" id="2career" name="2career"
                            placeholder="2° Carrera (si aplica)" maxlength="50">
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" style="margin-left: 15px;"
                    value="Agregar Estudiante a la Lista">

            </form>
        </div>
        <br>
        <?php
        include "layout/footer.php";
        ?>
        <script type="text/javascript" src="js/maintainscroll.min.js"></script>
    </body>

    </html>
<?php } 