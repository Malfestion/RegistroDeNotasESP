<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia sesion y se verifica si el rol es admin
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
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
            <form class="form-horizontal" action="php/insert_inventario.php" method="POST">

                <h1>Agregar Item</h1>
                <br>
                <div class="d-flex p-1">
                    <label for="name" class="control-label col-sm-1">Placa: </label>
                    <input type="text" class="form-control w-25" id="placa" name="placa" placeholder="Numero de placa" maxlength="50" value="">
                </div>
                <div class="d-flex p-1">
                    <label for="name" class="control-label col-sm-1">Descripción: </label>
                    <input type="text" class="form-control w-25" id="descripcion" name="descripcion" placeholder="Descripción" maxlength="50" value="">
                </div>
                <div class="d-flex p-1">
                    <label for="name" class="control-label col-sm-1">Marca: </label>
                    <input type="text" class="form-control w-25" id="marca" name="marca" placeholder="Marca" maxlength="50" value="">
                </div>
                <div class="d-flex p-1">
                    <label for="name" class="control-label col-sm-1">Modelo: </label>
                    <input type="text" class="form-control w-25" id="modelo" name="modelo" placeholder="Modelo" maxlength="50" value="">
                </div>
                <div class="d-flex p-1">
                    <label for="name" class="control-label col-sm-1">Serie: </label>
                    <input type="text" class="form-control w-25" id="serie" name="serie" placeholder="Serie" maxlength="50" value="">
                </div>
                <div class="d-flex p-1">
                    <label for="name" class="control-label col-sm-1">Categoría: </label>
                    <select class="form-select w-25" aria-label="Default select example" id="categoria" name="categoria">
                        <option selected value=""></option>
                        <option value="Cables computo">Cables computo</option>
                        <option value="Computo">Computo</option>
                        <option value="Electrodomesticos">Electrodomesticos</option>
                        <option value="Electronico">Electronico</option>
                        <option value="Moviliario">Moviliario</option>
                        <option value="Telefonía">Telefonía</option>
                    </select>
                </div>
                <div class="d-flex p-1">
                    <label for="name" class="control-label col-sm-1">Asignado a: </label>
                    <input type="text" class="form-control w-25" id="responsable" name="responsable" placeholder="Responsable" maxlength="50" value="">
                </div>
                <div class="d-flex p-1">
                    <label for="name" class="control-label col-sm-1">Observaciones: </label>
                    <input type="text" class="form-control w-50" id="observaciones" name="observaciones" placeholder="Observaciones" maxlength="200" value="">
                </div>
                <br>
                <input type="submit" class="btn btn-primary" style="margin-left: 15px;" value="Agregar">
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