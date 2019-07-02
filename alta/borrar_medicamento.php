<?php

require_once '../conexion/conexion.php';
require_once '../extend/helpers.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    header("Content-Type", "application/json; charset=UTF-8");
    $barcode = isset($_POST['barcode']) ? (double) $con->real_escape_string(htmlentities($_POST['barcode'])) : NULL;

    $errores = array('errores' => array());



    $datos = borrar_medicamento($barcode);

    if ($datos == false) {
        array_push($errores['errores'], "Error al borrar");
    }
    echo json_encode($errores['errores']);
} else {

    header("Location:./");
}



