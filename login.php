<?php 
    //si el inicio de sesion es nulo muestra el login
   session_start();
   if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {   ?>
<!DOCTYPE html>
<html lang="es" >
<head>
	<title>Registro de Notas ESP</title>
	<link href="bootstrap5/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
</head>
<body>
<header>
        <nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="img/logoESP.png" alt="" width="110" height="48">
                </a>
                <a class="navbar-brand" href="index.php">Registro de notas  </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.inglesporareas.ucr.ac.cr/">Página web principal</a>
                        </li>
                    </ul>
                    <?php if (isset($_SESSION['username']) && isset($_SESSION['id']) && ($_SESSION['role'] == 'admin' ||$_SESSION['role'] == 'user') ) { echo("<p style=\"margin-left:=2.5em;\"> Hola, ".$_SESSION['name'].".&nbsp;&nbsp;&nbsp;&nbsp;</p> ");?>
                        <a class="btn btn-warning" href="logout.php" role="button">Cerrar Sesion</a>
                    <?php } else {  ?>
                        <a class="btn btn-primary" href="login.php" role="button">Iniciar Sesion</a>
                    <?php } ?>
                </div>
            </div>
        </nav>
    </header>
      <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
      	<form class="border shadow p-3 rounded"
      	      action="php/check-login.php" 
      	      method="post" 
      	      style="width: 450px;">
      	      <h1 class="text-center p-3">INICIO DE SESION AL REGISTRO DE NOTAS ESP</h1>
      	      <?php if (isset($_GET['error'])) { ?>
      	      <div class="alert alert-danger" role="alert">
				  <?=$_GET['error']?>
			  </div>
			  <?php } ?>
		  <div class="mb-3">
		    <label for="username" 
		           class="form-label">Nombre de Usuario</label>
		    <input type="text" 
		           class="form-control" 
		           name="username" 
		           id="username">
		  </div>
		  <div class="mb-3">
		    <label for="password" 
		           class="form-label">Contraseña</label>
		    <input type="password" 
		           name="password" 
		           class="form-control" 
		           id="password">
		  </div>
				
		  <button type="submit" 
		          class="btn btn-primary">Ingresar</button>
		</form>
      </div>

	  <footer class="bg-light text-center text-lg-start fixed-bottom">
        <div class="text-center p-3">
            © 2023 Copyright:
            <a class="text-dark">Alejandro Duarte Lobo</a>
        </div>
    </footer>
</body>
</html>
<?php }else{
	header("Location: index.php");//si no es nulo el valor de la sesion, redirecciona a index
} ?>