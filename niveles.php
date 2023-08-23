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
    <html lang="es" >

    <head>
        <title>Registro de notas ESP</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="bootstrap5/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="img/favicon.ico">
        <script src="bootstrap5/js/bootstrap.bundle.min.js"></script>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">
                        <img src="img/logoESP.png" alt="" width="110" height="48">
                    </a>
                    <a class="navbar-brand" href="index.php">Registro de notas </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="mynavbar">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="https://www.inglesporareas.ucr.ac.cr/">Página web principal</a>
                            </li>
                            <?php if (isset($_SESSION['username']) && isset($_SESSION['id']) && ($_SESSION['role'] == 'admin')) { ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Administración
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item" href="profesores.php">Profesores</a></li>
                                        <li><a class="dropdown-item" href="areas.php">Areas</a></li>
                                        <li><a class="dropdown-item" href="niveles.php">Niveles</a></li>
                                        <li><a class="dropdown-item" href="estudiantes.php">Estudiantes</a></li>
                                        <li><a class="dropdown-item text-warning" href="notas.php">Notas</a></li>
                                    </ul>
                                </li>
                            <?php } ?>

                        </ul>
                        <?php if (isset($_SESSION['username']) && isset($_SESSION['id']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'user')) {
                            echo ("<p style=\"margin-left:=2.5em;\"> Hola, " . $_SESSION['name'] . ".&nbsp;&nbsp;&nbsp;&nbsp;</p> "); ?>
                            <a class="btn btn-warning" href="logout.php" role="button">Cerrar Sesion</a>
                        <?php } else { ?>
                            <a class="btn btn-primary" href="login.php" role="button">Iniciar Sesion</a>
                        <?php } ?>
                    </div>
                </div>
            </nav>
        </header>


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
                                    href="php/delete_nivel.php?id=<?= $row['id'] //se envia el id a delete?>" onclick="return confirm('Realmente quiere eliminar esta entrada? Los datos en el registro de notas pueden depender de esta.')">Eliminar</a></th>
                            <?php $i++; ?>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>


        <footer class="bg-light text-center text-lg-start fixed-bottom">
            <div class="text-center p-3">
                © 2023 Copyright:
                <a class="text-dark">Alejandro Duarte Lobo</a>
            </div>
        </footer>
        <script type="text/javascript" src="js/maintainscroll.min.js"></script>
    </body>

    </html>
<?php } else {
    header("Location: login.php"); //si hay una sesion iniciada se reenvia a login
} ?>