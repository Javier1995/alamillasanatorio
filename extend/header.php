<?php
require_once '../conexion/conexion.php';
include_once '../autoload.php';
require_once 'helpers.php';
if (!isset($_SESSION['nick'])) {
    header('location:../');
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie-edge">
        <link rel="stylesheet" href="../css/materialize.css">
        <link href="../css/sweetalert.css" type="text/html" />
        <link rel="stylesheet" href="../css/icon.css" type ="text/css" >
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/jquery-confirm.css" type="text/css">
        <link rel="icon" href="../img/logoalamilla.png" type="image/png">
         <!-- <link rel="stylesheet" href="../css/animation.css"> -->
        <link rel="stylesheet" href="../css/print.min.css"/> 
        <link rel="stylesheet" href="../css/style.css">
        <title>Alamilla</title>
    </head>
    <body class="grey lighten-2">
        <main>
            <?php
            
            //Guarda Mensajes
            $mesNumber = getConfigMessage();
            $mensajes = getAllMessage();

            if($mensajes->num_rows == 0){
                caducidad((int)$mesNumber);
            } else{

                while($mensaje = $mensajes->fetch_object()){
                if(getMessageExist($mensaje->id_medicamento, $mensaje->id_lote) !== true){
                        caducidad((int)$mesNumber);
                    } 
                }
            }
            
            ejecutarCaducidadAutomatic();

            if ($_SESSION['nivel'] == 'ADMINISTRADOR') {
                include_once'menu_admin.php';
                
            } elseif ($_SESSION['nivel'] == 'ALTA') {
                include_once'menu_alta.php';
            }  elseif ($_SESSION['nivel'] == 'MEDICO') {
                include_once'menu_doctor.php';
            }  elseif($_SESSION['nivel'] == 'VENTA'){
                include_once 'menu_venta.php';
            }
            ?>

            <ul id="configuracion" class="dropdown-content collection">
                <li class="collection-item avatar">
				<img src="../usuarios/<?=$_SESSION['foto'];?>" alt="Nombre de usuario" class="circle">
                                <span class="title"><?=$_SESSION['nivel']?></span>
				<p><?=$_SESSION['nombre']?></p>
		</li>
                <?php if ($_SESSION['nivel'] == 'ADMINISTRADOR'):?>
                <li><a href="../usuarios/" class="waves-effect flex-text"><i class="material-icons left">contacts</i>Usuarios</a></li>
                <?php endif;?>
                <li ><a accesskey="g" href="../usuarios/password.php" cblack-textlass="waves-effect "><i class="material-icons left">vpn_key</i>Cambio de Contraseña</a></li>
                
                <li><a href="../extend/salir.php" class="waves-effect"><i class="fa fa-sign-out fa-2x left" aria-hidden="true"></i>Salir</a></li>
            </ul>
            <div class="navbar-fixed">
                <nav class="z-depth-3 blue">


                    <div class="nav-wrapper">
                        <a href="./" class="brand-logo center"> <img height="55" src="../img/logo1.png" alt="Logo alamilla"></a>
                        <ul class="right  show-on-large show-on-small show-on-medium-and-down">
                            <li><a class="dropdown-button" href="#!" data-activates="configuracion" data-beloworigin="true"><?=$_SESSION['nivel']; ?><i class="material-icons right">arrow_drop_down</i></a></li>
                        </ul>
                        <a href="#" class="button-collapse white-text show-on-large show-on-small" data-activates="menu" ><i class="material-icons">menu</i></a>
                    </div>


                </nav>

            </div>