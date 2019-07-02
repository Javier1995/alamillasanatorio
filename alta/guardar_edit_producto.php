<?php
require_once '../conexion/conexion.php';
require_once '../extend/helpers.php';
if ($_SERVER['REQUEST_METHOD']=='POST') {

    header("Content-Type", "application/json; charset=UTF-8");


    $barcode  = isset($_POST['barcode2'])? (double)$con->real_escape_string(htmlentities($_POST['barcode2'])) : NULL;
    $nombregenerico = isset($_POST['nombregenerico'])? $con->real_escape_string(htmlentities($_POST['nombregenerico'])): NULL;
    $nombrecomercial = isset($_POST['nombrecomercial'])? $con->real_escape_string(htmlentities($_POST['nombrecomercial'])): NULL;
    $categoria = isset($_POST['categoria'])? (int)$con->real_escape_string(htmlentities($_POST['categoria'])): NULL;
    $precioa =isset($_POST['precioa'])? (float)$con->real_escape_string(htmlentities($_POST['precioa'])): NULL;
    $preciov = isset($_POST['preciov'])? (float)$con->real_escape_string(htmlentities($_POST['preciov'])): NULL;
    $presentacion = isset($_POST['presentacion'])? (string)$con->real_escape_string(htmlentities($_POST['presentacion'])): NULL;
    $unidades = isset($_POST['unidades'])? (int)$con->real_escape_string(htmlentities($_POST['unidades'])): NULL;
    $stockmin = isset($_POST['stockmin'])? (int)$con->real_escape_string(htmlentities($_POST['stockmin'])): NULL;
    $descripcion = isset($_POST['descripcion'])? (string)$con->real_escape_string(htmlentities($_POST['descripcion'])): NULL;
  
    $errores = array('errores'=>array());
    //Validacion de codigo de barra
    /* if (!empty($barcode) && is_numeric($barcode)) {

         $existeCodigo = barcodeExists($barcode); 
         if ($existeCodigo == false) {

          array_push($errores['errores'], 'Ya existe este codigo de barrar, verifique <a href="entradas.php" class="black-text">Entradas</a>');

         } elseif(strlen($barcode) != 13) {

           array_push($errores['errores'], 'El codigo de barra debe contener 13 digitos');

         } else {

            $barcode_valido = true;
        }

    } else {
        array_push($errores['errores'], 'El codigo de barra esta vacio');
    }
 */


    //Validacion de nombre generico
    if (!empty($nombregenerico)) {
        $nombregenerico_valido = true;

    } else {
        $nombregenerico_valido = false;
        array_push($errores['errores'], "El nombre generico esta vacío");
    }

        //validacion de nombre comercial
    if (!empty($nombrecomercial)) {
        $nombrecomercial_valido = true;

    } else {
        $nombrecomercial_valido = false;
        array_push($errores['errores'], "El nombre comercial esta vacío");
    }

    //validacion de categoria
    if (!empty($categoria) && is_numeric($categoria)) {
       $categoria_valido = true;

    } else {
        $categorias_valido = false;
        array_push($errores['errores'], "Categoria incorrecta");
    }

    //validacion de precio adquisitivo

    if (!empty($precioa) && is_numeric($precioa)) {
        $precioa_valido = true;
 
     } else {
         $precioa_valido = false;
         array_push($errores['errores'], "Verifique el precio de adquisitivo que sea numerico y que no este vacío");
     }


     //Validacion de precio de venta
     if (!empty($preciov) && is_numeric($preciov)) {
        $preciov_valido = true;
 
     } else {
         $preciov_valido = false;
         array_push($errores['errores'], "Verifique el precio de venta que sea numerico y que no este vacío");
     }


     //Validacion de unidades de caja
     if (!empty($unidades) && is_int($unidades)) {
        $unidades_valido = true;
 
     } else {
         $unidades_valido = false;
         array_push($errores['errores'], "El campo de unidades de caja esta vacío");
     }

     //Validacion de stock minimo
     if (!empty($stockmin) && is_int($stockmin)) {
        $stockmin_valido = true;
 
     } else {
         $stockmin_valido = false;
         array_push($errores['errores'], "El campo de stock minimo esta vacío");
     }



     
      if(count($errores['errores']) == 0) {

        $datos = actualizarProductos($categoria,  $barcode, $nombregenerico, $nombrecomercial, $descripcion, $presentacion, $precioa, $preciov,  $unidades, $stockmin);
        
        if($datos == false){
            array_push($errores['errores'], "Error al guardar");
        }
      
     }
     
 
    echo json_encode($errores['errores']); 
 



} 

