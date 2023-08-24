<?php
//se inicia o resume sesion y se verifica si el rol es admin
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {
    include "php/db_conn.php";
    //se buscan todos los niveles
    $sql = "SELECT * FROM nivel";
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
            <h2>Agregar nivel</h2>
            <br>
            <form action="php/insert_nivel.php" method="POST"><!--La accion de el submit del formulario es importante-->

                <div class="mb-3 p-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="nombre" placeholder="Nombre del nivel"
                        required="required">
                </div>
                <input type="submit" class="btn btn-primary" style="margin-left: 15px;" value="Agregar nivel a la Lista">

            </form>
        </div>
        <br>
        <div class="container" style="margin-bottom: 80px;">
            <h2>Niveles en la lista</h2>
            <br>

            <form action="" method="get" style="display: flex;">
                <input class="form-control" type="search" name="busqueda" style="width: 500px;" value="<?php if (!empty($_GET['busqueda'])) {
                    echo $_GET['busqueda']; //se mantiene el valor de la busqueda
            
                } ?>" placeholder="Busqueda por nombre" aria-label="Search">
                <button class="btn btn-primary" type="submit" name="enviar" value="Buscar">Buscar</button>
            </form>

            <br>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php $i = 1;
                        $busqueda = "";
                        if (isset($_GET['enviar'])) { //al buscar se muestran los valores en contrados pero aqui se muestran todos si la busqueda es vacia
                    
                            $busqueda = $_GET['busqueda'];
                        }
                        $consulta = $conn->query("SELECT * FROM nivel WHERE nombre_nivel LIKE '%$busqueda%'");
                        while ( /*$row = mysqli_fetch_array($query))*/$row = $consulta->fetch_array()): ?>
                            <th>
                                <?= $i ?>
                            </th>
                            <th>
                                <?= $row['nombre_nivel'] ?>
                            </th>
                            <th><a class="btn btn-primary"
                                    href="update_nivel.php?id=<?= $row['id'] //se envia el id a update?>">Editar</a></th>
                            <th><a class="btn btn-danger"
                                    href="php/delete_nivel.php?id=<?= $row['id'] //se envia el id a delete?>"
                                    onclick="return confirm('Realmente quiere eliminar esta entrada? Los datos en el registro de notas pueden depender de esta.')">Eliminar</a>
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