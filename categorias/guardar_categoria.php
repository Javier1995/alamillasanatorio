<?php
 
 require_once '../conexion/conexion.php';
 
 if($_SERVER['REQUEST_METHOD'] == 'POST') {

     $categoria = $con->real_escape_string($_POST['categoria']);
     $insert = $con->query("INSERT INTO categorias_medicamentos VALUES(null, '$categoria')");
     
    if($insert) {
        header('location:../extend/alert.php?ms=Se ha guardado correctamente&c=ca&p=in&t=success');
    } else {
        header('location:../extend/alert.php?ms=Es posible que la categoria ya exista&c=ca&p=in&t=error');
    }

 } 


 
