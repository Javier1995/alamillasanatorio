<?php
require_once '../conexion/conexion.php';
require_once '../extend/helpers.php';
if ($_SERVER['REQUEST_METHOD']=='POST') {

    header("Content-Type", "application/json; charset=UTF-8");
    
    $barcode  = isset($_POST['barcode'])? (double)$con->real_escape_string(htmlentities($_POST['barcode'])) : NULL;
    $lote = isset($_POST['lote'])? (string)$con->real_escape_string(htmlentities(trim($_POST['lote']))): NULL;

    $datos =  getDateIfExist($lote, $barcode);
    $resultado = array('fecha'=>array());

    if(is_string($datos)){
      array_push($resultado['fecha'], $datos);
    }
    
    echo json_encode($resultado); 
 



} 

