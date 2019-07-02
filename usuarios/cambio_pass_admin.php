<?php

require_once '../conexion/conexion.php';
require_once '../extend/helpers.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Content-Type", "application/json; charset=UTF-8");
     $oldPassword = isset($_POST['oldPassword']) ? (string) $con->real_escape_string(htmlentities($_POST['oldPassword'])) : null;
     $newPassword = isset($_POST['newPassword']) ? (string) $con->real_escape_string(htmlentities($_POST['newPassword'])) : null;
    $confirmPassword = isset($_POST['confirmPassword']) ? (string) $con->real_escape_string(htmlentities($_POST['confirmPassword'])) : null;
    $id = isset($_POST['id']) ? (string) $con->real_escape_string(htmlentities($_POST['id'])) : null;
    $errores = array('errores' => array());
    
//Validadacion de contraseña antigua
    if (empty($oldPassword)) {

        array_push($errores['errores'], "No ha introducido la contraseña anterior");
    }

//Validacion de constraseña nueva
    if (empty($newPassword)) {

        array_push($errores['errores'], "No ha introducido la nueva contraseña");
    }

    if (empty($confirmPassword)) {

        array_push($errores['errores'], "No ha introducido la confirmacion de nueva contraseña");
    }
    

//validacion de antigua contraseña
    if (getPassword($id) === sha1($oldPassword)) {

        if ($newPassword !== $confirmPassword) {
            array_push($errores['errores'], "La contraseña nueva no coincide con la confirmacion");
        }
    } else {
        array_push($errores['errores'], "La contraseña antigua no coincide");
    }







    if (count($errores['errores']) == 0) {

        if (updateUserPassword(sha1($confirmPassword), $id) == false) {

            array_push($errores['errores'], "Error al guardar la contraseña");
        }
    }


    echo json_encode($errores['errores']);
} else {

    header("Location:./");
}


