<?php
require_once '../conexion/conexion.php';
require_once '../extend/helpers.php';
if ($_SERVER['REQUEST_METHOD']=='POST') {
    sleep(1);
    header("Content-Type", "application/json; charset=UTF-8");
    
   $busqueda = array();

   $busca  = isset($_POST['paciente'])?$con->real_escape_string(htmlentities($_POST['paciente'])) : NULL;
   $resultados = buscarPaciente($busca);
  
   while($row = $resultados->fetch_assoc()) {
       
        $busqueda[]= $row;
       
       
   }
    
    echo json_encode($busqueda);
 
} else {
    
    header("Location:./");
}

