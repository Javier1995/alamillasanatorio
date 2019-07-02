<?php

require_once '../conexion/conexion.php';
require_once '../extend/helpers.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    header("Content-Type", "application/json; charset=UTF-8");
    
    $lote = isset($_POST['lote'])?(string)$con->real_escape_string(htmlentities($_POST['lote'])): NULL;
    $errores = array('errores' => array());
    var_dump($lote);
    
    
     $datos = borrar_lote($_POST['lote']);
      if ($datos == false) {
      array_push($errores['errores'], "Error al borrar");
     }
    echo json_encode($errores['errores']);
} else {

    header("Location:./");
}


