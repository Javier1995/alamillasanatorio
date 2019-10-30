<?php
@session_start();
require_once 'DB.php';
use Conexion\DB;

//Modificacion de host, DB y contraseña ir a la carpeta classes/conexion/DB.php
$con = DB::conection();

if ($con->connect_errno) {
    die( "Fallo la conexion");
}
$con->query("SET time_zone='-6:00';");
$con->set_charset("UTF8");


//Modificar cuando se cambie de HOST 
//define('RUTA_BASE','http://localhost/alamilla/');

//Development mode direction
$host = $_SERVER['HTTP_HOST'];
//Si es una ip
 if(filter_var($host, FILTER_VALIDATE_IP)){
    define('RUTA_BASE','http://'.$_SERVER['HTTP_HOST'].'/alamillasanatorio/');
 } else {
    define('RUTA_BASE','http://'.$_SERVER['HTTP_HOST'].'/');
 }

/**
 *                          ---PRECAUCION------
 * 
 * ANTES DE INSTALAR EL SISTEMA SE DEBE CONFIGURAR LA DIRECCIÓN URL, YA QUE LAS IMPRESIONES
 * TIENE RUTA ABSOLUTA PARA LA BIBLIOTECA DE print.js,
 * 
 */


