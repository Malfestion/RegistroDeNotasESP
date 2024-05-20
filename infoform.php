<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia o resume sesion y se verifica si el rol es admin
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "php/db_conn.php";
    //se busca estado de formulario
    $sql = "SELECT estado FROM formulario_estado";
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
            <h2>Formulario de inscripción de estudiantes</h2>
            <br>
            <br>
            <h4>Enlace al formulario:</h4>
            <a href="formulario_detalles_estudiante.php">https://inglesporareas.ucr.ac.cr/notas/formulario_detalles_estudiante.php</a>
            <br>
            <br>
            <h4>El formulario está:
            <?php
                $row = mysqli_fetch_array($query);
                if($row[0]==1){
                    echo '<span style="color: green;">HABILITADO</span>';
                }
                if($row[0]==0){
                    echo '<span style="color: red;">DESHABILITADO</span>';
                }
                
            ?>
            </h4>
            <div class="container pt-5">
            <form action="php/form_on.php" method="get">
                <button type="submit" class="btn btn-primary">Habilitar Formulario</button>
                <button type="submit" class="btn btn-danger" formaction="php/form_off.php">Deshabilitar Formulario</button>
            </form>
            </div>
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