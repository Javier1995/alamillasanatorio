<?php
require_once '../conexion/conexion.php';
require_once '../extend/helpers.php';
if ($_SERVER['REQUEST_METHOD']=='POST') {

    header("Content-Type", "application/json; charset=UTF-8");
    $nombre  = isset($_POST['nombre'])? (string)$con->real_escape_string(htmlentities($_POST['nombre'])): NULL;
    $apellidos  = isset($_POST['apellidos'])? (string)$con->real_escape_string(htmlentities($_POST['apellidos'])): NULL;
    $nacimiento  = isset($_POST['nombre'])? (string)$con->real_escape_string(htmlentities($_POST['nacimiento'])): NULL;
    $id  = isset($_POST['id'])? (string)$con->real_escape_string(htmlentities($_POST['id'])): NULL;
    
    $errores = array('errores' =>array());
    //Validacion de nombre del paciente
    if (empty($nombre)) {
        array_push($errores['errores'], "No ha introducido ningun nombre");
    } 

    //Validacion de apellidos
    if (empty($apellidos)) {
         array_push($errores['errores'], "No ha introducido ningun apellido");
    } 
    //validacion de nacimiento
    if (empty($nacimiento)) {
         array_push($errores['errores'], "No ha introducido la fecha de nacimiento");
    } 

     if (empty($id)) {
         array_push($errores['errores'], "Error de edición del paciente");
    } 
     if(count($errores['errores']) == 0) {

       $datos = actualizar_paciente($nombre, $apellidos, $nacimiento, $id); 
        if($datos == false){
           array_push($errores['errores'], "Error al guardar");
         
        } 
   
    }
     
 
   echo  json_encode($errores['errores']); 
 

}  else {
    header("Location:./");
}

