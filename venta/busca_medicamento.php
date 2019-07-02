<?php
require_once '../conexion/conexion.php';
require_once '../extend/helpers.php';
if ($_SERVER['REQUEST_METHOD']=='POST') {
    
    header("Content-Type", "application/json; charset=UTF-8");
    $barcode  = isset($_POST['codigo'])? (double)$con->real_escape_string(htmlentities($_POST['codigo'])) : NULL;
    $_SESSION['productos'] = array();

    if (!empty($nombregenerico)) {
        $nombregenerico_valido = true;

    } else {
        $nombregenerico_valido = false;
        array_push($errores['errores'], "El nombre generico esta vacío");
    }

    
    
    echo json_encode($errores['errores']); 
 



} else {
    
    header("Location:../");
    
}

