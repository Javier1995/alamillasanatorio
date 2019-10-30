<?php
require_once '../conexion/conexion.php';
require_once '../extend/helpers.php';
if ($_SERVER['REQUEST_METHOD']=='POST') {

    header("Content-Type", "application/json; charset=UTF-8");
    $barcode  = isset($_POST['barcode'])? (double)$con->real_escape_string(htmlentities($_POST['barcode'])) : NULL;
    $lote = isset($_POST['lote'])? (string)$con->real_escape_string(htmlentities(trim($_POST['lote']))): NULL;
    $caducidad = isset($_POST['caducidad'])? (string)$con->real_escape_string(htmlentities($_POST['caducidad'])): NULL;
    $piezas = isset($_POST['piezas'])? (int)$con->real_escape_string(htmlentities($_POST['piezas'])): NULL;
    $usuario = $_SESSION['id'];


    $errores = array('errores'=>array());
    //Validacion de codigo de barra
    if (empty($piezas)) {
        array_push($errores['errores'], "No ha introducido la cantidad piezas");
    } 
    
     $lote_valido = true;
    if (empty(trim($lote))) {
        $lote_valido = false;
        array_push($errores['errores'], "El campo de lotes esta vacío");
     } 


     if (!empty($caducidad) && is_string($caducidad)) {
        $caducidad_valido = true;
 
     } else {
         $caducidad_valido = false;
         array_push($errores['errores'], "El campo de caducidad esta vacío");
     }


     
      if(count($errores['errores']) == 0) {

      

        $datos = guardar_lote($barcode, $lote, $caducidad, $piezas);
       
        if($datos == false){
            array_push($errores['errores'], "Error al guardar");
        }
      
     }
     
 
    echo json_encode($errores['errores']); 
 



} 


