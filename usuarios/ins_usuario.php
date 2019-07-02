<?php

require_once('../conexion/conexion.php');

//Atrapa los valores del formulario para agregar nuevos usuarios

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nick = $con->real_escape_string(htmlentities($_POST['nick']));
    $pass1 = $con->real_escape_string(htmlentities($_POST['pass1']));
    $nivel = (int) $con->real_escape_string(htmlentities($_POST['nivel']));
    $nombre = $con->real_escape_string(htmlentities($_POST['name']));
    $apellidos = $con->real_escape_string(htmlentities($_POST['apellidos']));
    // $correo = $con->real_escape_string(htmlentities($_POST['correo']));
    //Valida si los campos vienen vacios
    if (empty($nick) || empty($pass1) || empty($nivel) || empty($nombre) || empty($apellidos)) {
        header('location:../extend/alert.php?ms=Hay un campo sin especificar&c=us&p=in&t=error');
        exit;
    }



    /* var_dump($nivel);
      die(); */
    //el nick debe contener solo letras es por ello que se hace esta validacion
    if (!ctype_alpha($nick)) {
        header('location:../extend/alert.php?ms=El nick no contiene solo letras&c=us&p=in&t=error');
        exit;
    }
    //valida si no contiene nivel
    if (!is_numeric($nivel)) {
        header('location:../extend/alert.php?ms=El nivel no contiene solo letras&c=us&p=in&t=error');
        exit;
    }
 
    if ($nivel == 1) {
        
        $ruta = 'foto_perfil/ADMINISTRADOR.png';
        
    } elseif ($nivel == 2) {

        $ruta = 'foto_perfil/ALTA.png';
        
    } elseif ($nivel == 4) {

        $ruta = 'foto_perfil/doctor.png';
        
    } else {

        $ruta = 'foto_perfil/VENTA.png';
    }

    $pass1 = sha1($pass1);
    $ins = $con->query("INSERT INTO usuarios (id, nick , pass, nombre, apellidos, id_nivel, bloqueo, foto)VALUES(null, '$nick','$pass1','$nombre', '$apellidos', $nivel,1,'$ruta')");

    if ($ins) {
        header("location:../extend/alert.php?ms=El usuario se ha guardado correctamente&c=us&p=in&t=success");
    } else {

        header('location:../extend/alert.php?ms=El usuario no se ha guardado&c=us&p=in&t=error');
        exit;
    }

    $con->close();
} else {// primer else del primer if
    header('location:../extend/alert.php?ms=Utiliza el formulario&c=us&p=in&t=error');
}
