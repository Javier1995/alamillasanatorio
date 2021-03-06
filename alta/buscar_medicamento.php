<?php
require_once '../autoload.php';
require_once '../conexion/conexion.php';
require_once '../extend/helpers.php';
use Medicamento\Medicamento;

if ($_SERVER['REQUEST_METHOD']=='POST') {

    header("Content-Type", "application/json; charset=UTF-8");
    $barcode = isset($_POST['barcode2'])? (double)$con->real_escape_string(htmlentities(trim($_POST['barcode2']))):'';
    
    $errores = array('errores'=>array());
    $datos   =  '';
    if (!is_numeric($barcode)) {
        
        array_push($errores['errores'], 'El codigo de barra deber ser numerico');

    } 
    if (count($errores['errores']) == 0) {
        
        $datos = busca_medicamento($barcode);
          

        if(count($datos) == 0){
            array_push($errores['errores'], 'No existe este medicamento');
        } else {
             //En inventario
           $medicamento = new Medicamento();
           $medicamento->setCve_medicamento($barcode);
           $inventario = $medicamento->medicationStock();
           $datos['inventario'] =  $inventario;
            echo json_encode($datos);
        
       }
       
    }
    if (count($errores['errores']) > 0) {

        echo json_encode($errores['errores']); 
        
     } 



} 

