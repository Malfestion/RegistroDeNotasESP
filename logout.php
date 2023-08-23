<?php  
session_start();
session_unset();
session_destroy();
//destruye la sesion y redirecciona a login
header("Location: login.php");
