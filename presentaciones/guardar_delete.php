<?php

require_once '../conexion/conexion.php';
 
 if($_SERVER['REQUEST_METHOD'] == 'GET') {
     $presentacion = $con->real_escape_string($_GET['presentacion']);
     $delete = $con->query("DELETE FROM presentacion WHERE id = $id");
    if($delete) {
        header('location:../extend/alert.php?ms=Se ha eliminado correctamente&c=ca&p=in&t=success');
    } else {
        header('location:../extend/alert.php?ms=No se ha podido eliminar&c=ca&p=in&t=error');
    }

 } 


 
