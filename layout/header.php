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
                    <?php if (isset($_SESSION['username']) && isset($_SESSION['id']) && ($_SESSION['role'] == 'admin')) { //solo un usuario de tipo admin puede ver:?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Administración
                            </a>
                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
                                <li><a class="dropdown-item" href="usuarios.php">Usuarios de la Página Web</a></li>
                                <li><a class="dropdown-item" href="profesores.php">Profesores</a></li>
                                <li><a class="dropdown-item" href="areas.php">Areas</a></li>
                                <li><a class="dropdown-item" href="niveles.php">Niveles</a></li>
                                <li><a class="dropdown-item" href="estudiantes.php">Estudiantes</a></li>
                                <li><a class="dropdown-item text-warning" href="notas.php">Notas</a></li>
                            </ul>
                        </li>

                    <?php } ?>
                    <?php if (isset($_SESSION['username']) && isset($_SESSION['id']) &&  ($_SESSION['role'] == 'user')) { //solo un usuario de tipo user puede ver:?>
                        <li class="nav-item">
                            <a class="nav-link" href="registro_grupal.php">Registrar Notas de grupo</a>
                        </li>
                    <?php } ?>
                    <?php if (isset($_SESSION['username']) && isset($_SESSION['id']) &&  ($_SESSION['role'] == 'user')) { //solo un usuario de tipo user puede ver:?>
                        <li class="nav-item">
                            <a class="nav-link" href="notas.php">Mi Registro de Notas</a>
                        </li>
                    <?php } ?>

                </ul>
                <?php if (isset($_SESSION['username']) && isset($_SESSION['id']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'user')) {
                    echo ("<p style=\"margin-left:=2.5em;\"> Hola, " . $_SESSION['name'] . ".&nbsp;&nbsp;&nbsp;&nbsp;</p> "); //mensaje de bienvenia al usuario y boton de cerrar sesion?>
                    <a class="btn btn-warning" href="logout.php" role="button">Cerrar Sesion</a>
                <?php } else { ?>
                    <a class="btn btn-primary" href="login.php" role="button">Iniciar Sesion</a>
                <?php } ?>
            </div>
        </div>
    </nav>
</header>