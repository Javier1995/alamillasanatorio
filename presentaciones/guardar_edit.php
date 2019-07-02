<?php

require_once '../conexion/conexion.php';
 
 if($_SERVER['REQUEST_METHOD'] == 'POST') {

     $id =  $con->real_escape_string($_GET['id']);
     $presentacion = $con->real_escape_string($_POST['presentacion']);
     $insert = $con->query("UPDATE presentaciones SET nombre = '$presentacion' WHERE id = $id");
    if($insert) {
        header('location:../extend/alert.php?ms=Se ha actualizado correctamente&c=pre&p=in&t=success');
    } else {
        header('location:../extend/alert.php?ms=Es posible que la categoria ya exista&c=pre&p=in&t=error');
    }

 } 


 
