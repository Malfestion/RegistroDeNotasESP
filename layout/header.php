<header>
    <nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="https://www.inglesporareas.ucr.ac.cr/">
                <img src="img/logoESP.png" alt="" width="110" height="48">
            </a>
            <a class="navbar-brand" href="index.php">Registro de notas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">


                    <!-- Notas (solo admin) -->
                    <?php if ($_SESSION['role'] == 'admin') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="notas.php">Notas</a>
                        </li>
                    <?php } ?>
                    

                    <!-- Inventario (solo admin) -->
                    <?php if ($_SESSION['role'] == 'admin') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="inventario.php">Inventario</a>
                        </li>
                    <?php } ?>


                    <!-- Certificaciones (solo admin) -->
                    <?php if ($_SESSION['role'] == 'admin') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="certificaciones.php">Certificaciones</a>
                        </li>
                    <?php } ?>


                    <!-- Mi Registro de Notas (solo user) -->
                    <?php if ($_SESSION['role'] == 'user') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="notas.php">Mi Registro de Notas</a>
                        </li>
                    <?php } ?>


                    <!-- Importar Datos (solo admin) -->
                    <?php if ($_SESSION['role'] == 'admin') { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Importar Datos
                            </a>
                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
                                <li><a class="dropdown-item" href="registro_grupal_estudiantes.php">Importar Estudiantes</a>
                                </li>
                                <li><a class="dropdown-item" href="registro_grupal.php">Subir notas de grupo</a></li>
                            </ul>
                        </li>
                    <?php } ?>


                    <!-- Configuración -->
                    <?php if (isset($_SESSION['username']) && isset($_SESSION['id']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'user')) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Configuración
                            </a>
                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
                                <?php if ($_SESSION['role'] == 'admin') { ?>
                                    <li><a class="dropdown-item" href="usuarios.php">Usuarios</a></li>
                                <?php } ?>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Base de datos</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="estudiantes.php">Estudiantes</a></li>
                                        <li><a class="dropdown-item" href="profesores.php">Profesores</a></li>
                                        <li><a class="dropdown-item" href="areas.php">Áreas</a></li>
                                        <li><a class="dropdown-item" href="niveles.php">Niveles</a></li>
                                    </ul>
                                </li>
                                <li><a class="dropdown-item" href="micuenta.php">Mi Cuenta</a></li>
                            </ul>
                        </li>
                    <?php } ?>


                    <!-- Formulario oculto -->
                    <?php if (1 == 2) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="infoform.php">Formulario de inscripción estudiantes</a>
                        </li>
                    <?php } ?>
                </ul>


                <!-- Usuario logueado -->
                <?php if (isset($_SESSION['username']) && isset($_SESSION['id']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'user')) { ?>
                    <p style="margin-left:2.5em;">Hola, <?php echo $_SESSION['name']; ?>.&nbsp;&nbsp;&nbsp;&nbsp;</p>
                    <a class="btn btn-warning" href="logout.php" role="button">Cerrar Sesión</a>
                <?php } else { ?>
                    <a class="btn btn-primary" href="login.php" role="button">Iniciar Sesión</a>
                <?php } ?>
            </div>
        </div>
    </nav>
</header>


<!-- JavaScript para manejar el submenú anidado -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Obtener todos los elementos con la clase 'dropdown-submenu'
        var dropdownSubmenus = document.querySelectorAll('.dropdown-submenu');

        // Para cada submenú, añadir eventos de clic
        dropdownSubmenus.forEach(function (submenu) {
            submenu.addEventListener('click', function (e) {
                e.stopPropagation();
                this.classList.toggle('show');

                // Asegurarse de que el menú principal no se cierre al hacer clic
                var dropdownMenu = this.querySelector('.dropdown-menu');
                if (dropdownMenu) {
                    dropdownMenu.classList.toggle('show');
                }
            });
        });

        // Cerrar todos los submenús al hacer clic fuera del menú
        document.addEventListener('click', function (e) {
            if (!e.target.closest('.dropdown-submenu')) {
                dropdownSubmenus.forEach(function (submenu) {
                    submenu.classList.remove('show');
                    var dropdownMenu = submenu.querySelector('.dropdown-menu');
                    if (dropdownMenu) {
                        dropdownMenu.classList.remove('show');
                    }
                });
            }
        });
    });
</script>


<!-- CSS para desplegar el submenú a la derecha -->
<style>
    /* Estilo para submenús desplegables hacia la derecha */
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%; /* Desplaza el submenú a la derecha */
        margin-top: -5px;
        margin-left: 0;
    }

    .dropdown-submenu:hover>.dropdown-menu {
        display: block;
    }
</style>