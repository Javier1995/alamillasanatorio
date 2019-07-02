<?php
require_once '../conexion/conexion.php';
require_once '../extend/helpers.php';
if ($_SERVER['REQUEST_METHOD']=='POST') {

    header("Content-Type", "application/json; charset=UTF-8");
    $id_paciente  = isset($_POST['id'])?(int)$con->real_escape_string(htmlentities($_POST['id'])): NULL;
    $diagnostico  = isset($_POST['diagnostico'])?(string)$con->real_escape_string(htmlentities($_POST['diagnostico'])): NULL;
    $medicamento  = isset($_POST['medicamento'])?(string)$con->real_escape_string(htmlentities($_POST['medicamento'])): NULL;
    $usuario = $_SESSION['id'];
    $errores = array('errores' =>array(), 'id'=>array());
   
    //Validacion de apellidos
    if (empty($diagnostico)) {
         array_push($errores['errores'], "No ha introducido ningun diagnostico");
    } 
    //validacion de nacimiento
    if (empty($medicamento)) {
         array_push($errores['errores'], "No ha introducido el medicamento");
    } 

     
     if(count($errores['errores']) == 0) {

       $datos = guardar_receta($id_paciente, $diagnostico, $medicamento, $usuario);
        if($datos == false){
           array_push($errores['errores'], "Error al guardar");
         
        } else {
          
           array_push($errores['id'], $datos);
            
   }
   
    }
     
 
   echo  json_encode($errores); 
 



}  else {
    header("Location:./");
}

