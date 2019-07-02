<?php

require_once '../conexion/conexion.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
  $usuario = $con->real_escape_string(htmlentities($_POST['usuario']));
  $pass = $con->real_escape_string(htmlentities($_POST['contrasena']));
 // En caso de que encuentre un espacio en el password y user
  $candado = ' ';
  $str_u = strpos($usuario,$candado);
  $str_p = strpos($pass,$candado);
  if(is_int($str_u)){
    $usuario = '';
  }else{
    $user = $usuario;
  }

   if(is_int($str_p)){
    $contra = '';
  }else{
    $pass2 = sha1($pass);
  }

  if($usuario==null && $contra==null){
      header('location:../extend/alert.php?ms=El formato no es correcto&c=salir&p=salir&t=error');
  }else{
    $sel = $con->query("SELECT nick, u.nombre AS 'nombre', apellidos, c.nombre AS 'nivel', bloqueo, foto, pass, u.id AS iduser FROM usuarios u INNER JOIN cat_niveles c ON c.id = u.id_nivel WHERE nick='$user' AND pass='$pass2' AND bloqueo=1");
    $row = mysqli_num_rows($sel);
    if($row!=0){
     $fetch= $sel->fetch_assoc();
        $id   = $fetch['iduser'];
        $nick = $fetch['nick'];
        $nombre = $fetch['nombre'];
        $apellidos = $fetch['apellidos'];
        $nivel = $fetch['nivel'];
        $bloqueo = $fetch['bloqueo'];
        $contra= $fetch['pass'];
        $foto = $fetch['foto'];

      if($nick ==$user && $contra == $pass2 && $nivel == 'ADMINISTRADOR'){
        $_SESSION['id'] = $id;
        $_SESSION['nick']= $nick;
        $_SESSION['nombre']= $nombre .' '. $apellidos;
        $_SESSION['nivel']= $nivel;
        $_SESSION['bloqueo']= $bloqueo;
        $_SESSION['foto'] = $foto;
        header('location:../extend/alert.php?ms=Bienvenido&c=home&p=home&t=success');

      } elseif($nick == $user && $contra == $pass2 && $nivel =='ALTA'){
        $_SESSION['id'] = $id;
        $_SESSION['nick']= $nick;
        $_SESSION['nombre']= $nombre;
        $_SESSION['nivel']= $nivel;
        $_SESSION['nombre']= $nombre .' '. $apellidos;
        $_SESSION['bloqueo']= $bloqueo;
        $_SESSION['foto'] = $foto;
        header('location:../extend/alert.php?ms=Bienvenido&c=al&p=home&t=success');

      } elseif($nick == $user && $contra == $pass2 && $nivel =='VENTA'){
        $_SESSION['id'] = $id;
        $_SESSION['nick']= $nick;
        $_SESSION['nombre']= $nombre .' '. $apellidos;
        $_SESSION['nivel']= $nivel;
        $_SESSION['bloqueo']= $bloqueo;
        $_SESSION['foto'] = $foto;
        header('location:../extend/alert.php?ms=Bienvenido&c=venta&p=home&t=success');

    } elseif($nick == $user && $contra == $pass2 && $nivel =='MEDICO'){
        $_SESSION['id'] = $id;
        $_SESSION['nick']= $nick;
        $_SESSION['nombre']= $nombre .' '. $apellidos;
        $_SESSION['nivel']= $nivel;
        $_SESSION['bloqueo']= $bloqueo;
        $_SESSION['foto'] = $foto;
        header('location:../extend/alert.php?ms=Bienvenido&c=doctor&p=home&t=success');

    } else {
        header('location:../extend/alert.php?ms=No tienes permiso para entrar&c=salir&p=salir&t=error');

      }
      
      
    } else {
      
      
      header('location:../extend/alert.php?ms=El usuario o contrasena son incorrecto&c=salir&p=salir&t=error');

    }

  }

}else{
  header('location:../extend/alert.php?ms=Utiliza el formulario&c=salir&p=salir&t=error');
}

 ?>
