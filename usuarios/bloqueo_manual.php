<?php
include_once '../conexion/conexion.php';

$id_user = $con->real_escape_string($_GET['id']);
$bl_user = $con->real_escape_string($_GET['bl']);

if($bl_user==1){

  $up = $con->query("UPDATE usuarios SET bloqueo=0 WHERE id = '$id_user' ");
  if($up){

    header('location:../extend/alert.php?ms=El usuario ha sido bloqueado&c=us&p=in&t=success');
  }else{
    header('location:../extend/alert.php?ms=El usuario no se ha podido ser bloqueado&c=us&p=in&t=error');
  }

}else{
  $up = $con->query("UPDATE usuarios SET bloqueo=1 WHERE id = '$id_user' ");
  if($up){
      header('location:../extend/alert.php?ms=El usuario ha sido desbloqueado&c=us&p=in&t=success');
  }else{
      header('location:../extend/alert.php?ms=El usuario no se ha podido ser desbloqueado&c=us&p=in&t=error');
  }
}
