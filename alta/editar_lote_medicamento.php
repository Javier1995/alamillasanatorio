<?php
require_once '../conexion/conexion.php';
require_once '../extend/helpers.php';
if ($_SERVER['REQUEST_METHOD']=='POST') {

    header("Content-Type", "application/json; charset=UTF-8");
    $barcode  = isset($_POST['barcode'])? (double)$con->real_escape_string(htmlentities($_POST['barcode'])) : null;
    $lote = isset($_POST['lote'])? (string)$con->real_escape_string(htmlentities(trim($_POST['lote']))): null;
    $caducidad = isset($_POST['caducidad'])? (string)$con->real_escape_string(htmlentities($_POST['caducidad'])): null;
    $piezas = isset($_POST['piezas'])? (int)$con->real_escape_string(htmlentities($_POST['piezas'])): null;
    $lote_antiguo = isset($_POST['lote_antiguo'])? (string)$con->real_escape_string(htmlentities(trim($_POST['lote_antiguo']))): null;
    $errores = array('errores'=>array());
    
    //Validacion de codigo de barra
    if (empty($piezas)) {

        array_push($errores['errores'], "No ha introducido la cantidad piezas");
    } 
    
    //validacion de lote actual
    if (!empty($lote) && is_string($lote)) {

        
        if (valida_lote_actualizar($lote, $lote_antiguo, $barcode) == false ) {

            array_push($errores['errores'], "Este lote ya existe, ingrese otro");

        } else {
            $lote_valido = true;
        }
 
    } else {
        $lote_valido = false;
        array_push($errores['errores'], "El campo de lotes esta vacío");
    }


     //Validacion de caducidad
    if (!empty($caducidad) && is_string($caducidad)) {
        $caducidad_valido = true;
 
    } else {
        $caducidad_valido = false;
        array_push($errores['errores'], "El campo de caducidad esta vacío");
    }


     
    if (count($errores['errores']) == 0) {

        $datos = update_lote($barcode, $lote, $caducidad, $piezas, $lote_antiguo);
        
        if ($datos == false) {
            array_push($errores['errores'], "Error al guardar");
        }
      
    }
     
 
    echo json_encode($errores['errores']); 
 



} else {

    header("Location:./");
}


