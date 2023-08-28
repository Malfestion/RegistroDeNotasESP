<?php  
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details)

session_start();
session_unset();
session_destroy();
//destruye la sesion y redirecciona a login
header("Location: login.php");
