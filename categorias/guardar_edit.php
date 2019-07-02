<?php

require_once '../conexion/conexion.php';
 
 if($_SERVER['REQUEST_METHOD'] == 'POST') {

     $id =  $con->real_escape_string($_GET['id']);
     $categoria = $con->real_escape_string($_POST['categoria']);
     $insert = $con->query("UPDATE categorias_medicamentos SET nombre = '$categoria' WHERE id = $id");
    if($insert) {
        header('location:../extend/alert.php?ms=Se ha actualizado correctamente&c=ca&p=in&t=success');
    } else {
        header('location:../extend/alert.php?ms=Es posible que la categoria ya exista&c=ca&p=in&t=error');
    }

 } 


 
