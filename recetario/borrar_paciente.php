<?php

require_once '../conexion/conexion.php';
require_once '../extend/helpers.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    header("Content-Type", "application/json; charset=UTF-8");
    $id = isset($_POST['id']) ? (double) $con->real_escape_string(htmlentities($_POST['id'])) : NULL;
    $errores = array('errores' => array());
    $datos = borrar_paciente($id);

    if ($datos == false) {
        array_push($errores['errores'], "Error al borrar");
    }
    
    //Imprime el archivo el formato JSON
    echo json_encode($errores['errores']);
} else {

    header("Location:./");
}



