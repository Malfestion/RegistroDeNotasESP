<?php 
// (c) 2023 Alejandro Duarte Lobo
// This code is licensed under BSD 3-Clause License (see LICENSE for details) 

$ip=$_SERVER['HTTP_CLIENT_IP'] 
    ? : ($_SERVER['HTTP_X_FORWARDED_FOR'] 
    ? : $_SERVER['REMOTE_ADDR']);


function writeLog($path,$message) {
    $myfile = fopen($path, "a") or die("Unable to open file!");
    fwrite($myfile, date("Y/m/d")." ".date("h:i:sa").":  ". $message."\n");
    fclose($myfile);
}
?>