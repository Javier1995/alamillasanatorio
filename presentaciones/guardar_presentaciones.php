<?php
 
 require_once '../conexion/conexion.php';
 
 if($_SERVER['REQUEST_METHOD'] == 'POST') {

     $presentacion = $con->real_escape_string($_POST['presentacion']);
     $insert = $con->query("INSERT INTO presentaciones VALUES(null, '$presentacion')");
    
    if($insert) {
        header('location:../extend/alert.php?ms=Se ha guardado correctamente&c=pre&p=in&t=success');
    } else {
        header('location:../extend/alert.php?ms=Es posible que la presentacion ya exista&c=pre&p=in&t=error');
    }

 } 


 
