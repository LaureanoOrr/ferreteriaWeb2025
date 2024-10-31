<?php
define('SERVIDOR', 'localhost');
define('USUARIO', 'root');
define('PASSWORD', '');
define('BD', 'sistemadeventas');

$servidor = "mysql:dbname=" . BD . ";host=" . SERVIDOR;

try {
  
    $pdo = new PDO($servidor, USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    //echo "La conexión a la base de datos fue con éxito";
} catch (PDOException $e) {
   
    //print_r($e);
 
   echo "Error al conectar base de datos";
}

$URL = "http://localhost/www.sistemadeventas.com";

date_default_timezone_set("America/Argentina/Buenos_Aires");
$fechaHora = date('Y-m-d H:i:s');


  