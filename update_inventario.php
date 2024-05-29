<?php
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

//se inicia sesion y se verifica si el rol es admin
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
        include "php/db_conn.php";
        //se consiguie el id del area enviado para editar y se busca en la bd
        $id = $_GET['id'];
        $sql = "SELECT * FROM esp_inventario WHERE item_id='$id'";
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
                        <form class="form-horizontal" action="php/edit_inventario.php" method="POST">

                                <h1>Editar Item</h1>
                                <input type="hidden" name="item_id" value="<?= $row['item_id'] //el id se deja como un valor oculto, para enviarlo al script del query
                                                                                ?>">
                                <br>
                                <div class="d-flex p-1">
                                        <label for="name" class="control-label col-sm-1">Placa: </label>
                                        <input type="text" class="form-control w-25" id="placa" name="placa" placeholder="Numero de placa" maxlength="25" value="<?= $row['placa'] //se muestran los datos existentes para qye se pueda editar
                                                                                                                                                                        ?>">
                                </div>
                                <div class="d-flex p-1">
                                        <label for="name" class="control-label col-sm-1">Descripción: </label>
                                        <input type="text" class="form-control w-25" id="descripcion" name="descripcion" placeholder="Descripción" maxlength="25" value="<?= $row['descripcion'] //se muestran los datos existentes para qye se pueda editar
                                                                                                                                                                                ?>">
                                </div>
                                <div class="d-flex p-1">
                                        <label for="name" class="control-label col-sm-1">Marca: </label>
                                        <input type="text" class="form-control w-25" id="marca" name="marca" placeholder="Marca" maxlength="25" value="<?= $row['marca'] //se muestran los datos existentes para qye se pueda editar
                                                                                                                                                        ?>">
                                </div>
                                <div class="d-flex p-1">
                                        <label for="name" class="control-label col-sm-1">Modelo: </label>
                                        <input type="text" class="form-control w-25" id="modelo" name="modelo" placeholder="Modelo" maxlength="25" value="<?= $row['modelo'] //se muestran los datos existentes para qye se pueda editar
                                                                                                                                                                ?>">
                                </div>
                                <div class="d-flex p-1">
                                        <label for="name" class="control-label col-sm-1">Serie: </label>
                                        <input type="text" class="form-control w-25" id="serie" name="serie" placeholder="Serie" maxlength="25" value="<?= $row['serie'] //se muestran los datos existentes para qye se pueda editar
                                                                                                                                                        ?>">
                                </div>
                                <div class="d-flex p-1">
                                        <label for="name" class="control-label col-sm-1">Categoría: </label>
                                        <input type="text" class="form-control w-25" id="categoria" name="categoria" placeholder="Categoría" maxlength="25" value="<?= $row['categoria'] //se muestran los datos existentes para qye se pueda editar
                                                                                                                                                                        ?>">
                                </div>
                                <div class="d-flex p-1">
                                        <label for="name" class="control-label col-sm-1">Asignado a: </label>
                                        <input type="text" class="form-control w-25" id="responsable" name="responsable" placeholder="Responsable" maxlength="25" value="<?= $row['responsable'] //se muestran los datos existentes para qye se pueda editar
                                                                                                                                                                        ?>">
                                </div>
                                <div class="d-flex p-1">
                                        <label for="name" class="control-label col-sm-1">Observaciones: </label>
                                        <input type="text" class="form-control w-50" id="observaciones" name="observaciones" placeholder="Observaciones" maxlength="100" value="<?= $row['observaciones'] //se muestran los datos existentes para qye se pueda editar
                                                                                                                                                                        ?>">
                                </div>
                                <br>
                                <input type="submit" class="btn btn-primary" style="margin-left: 15px;" value="Guardar Cambios">
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