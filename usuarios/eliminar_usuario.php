<?php include_once '../conexion/conexion.php';

$id  = $con->real_escape_string(htmlentities($_GET['id']));

$del = $con->query("DELETE FROM usuarios where id='$id'");

if($del){
  header('location:../extend/alert.php?ms=El usuario ha sido eliminado correctamente&c=us&p=in&t=success');
}else{
  header('location:../extend/alert.php?ms=El usuario no se ha podido eliminar&c=us&p=in&t=error');
}
