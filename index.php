<?php
require_once 'conexion/conexion.php';
if (isset($_SESSION['nick']) && $_SESSION['nivel'] =='ADMINISTRADOR') {
  header("location:inicio");
  exit;

} elseif(isset($_SESSION['nick']) && $_SESSION['nivel'] =='ALTA') {
  header('location:alta');
  exit;
  
} elseif(isset($_SESSION['nick']) && $_SESSION['nivel'] =='VENTA') {
    header('location:venta');
    exit;
}
 ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    
    <link rel="stylesheet" href="css/materialize.css">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/icon.css">
    <link rel="icon" href="img/logoalamilla.png" type="image/png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animation.css" type="text/css">
    
    <title>.:Acceder:.</title>
      <style>
    body {
      display: flex;
      min-height: 100vh;
      flex-direction: column;
    }

    main {
      flex: 1 0 auto;
    }

    body {
      background: #fff;
    }

    .input-field input[type=date]:focus + label,
    .input-field input[type=text]:focus + label,
    .input-field input[type=email]:focus + label,
    .input-field input[type=password]:focus + label {
      color: #e91e63;
    }

    .input-field input[type=date]:focus,
    .input-field input[type=text]:focus,
    .input-field input[type=email]:focus,
    .input-field input[type=password]:focus {
      border-bottom: 2px solid #e91e63;
      box-shadow: none;
    }
  </style>
  </head>
  <body class="blue darken-5">
    <main>
        <br> 
              <div class="row fadeInDown animated slow " id="login">
                <div class="col l4 push-l4 s12">
                  <div class="card hoverable z-depth-4">
                      <div class="card-content">
                          <form  action="login/index.php" method="POST">
                            <div class="row fadeInDown animated slow delay-1s">
                              <div class="col s12 center-align">
                                  <img src="img/logo.png" width="200px"/>
                              </div>
                            </div>
                              <h5 class="center blue-text fadeInDown animated slow delay-1s">Iniciar Sesión</h5>
                            <div class="row fadeInDown animated slow delay-1s">
                              <div class="col s12">
                                <div class="input-field" id="usuario">
                                  <i class="material-icons prefix ">perm_identity</i>
                                  <input type="text"  title="Ingrese su usuario" id="usuario" name="usuario" autofocus required  autocomplete="off">
                                  <label for="usuario">Usuario</label>
                                </div>
                              </div>
                            </div>
                            <div class="row fadeInDown animated slow delay-1s">
                              <div class="col s12">
                                <div class="input-field" id="pass">
                                  <i class="material-icons prefix ">vpn_key</i>
                                  <input type="password" name="contrasena" title="Ingrese contraseña" id="pass" required >
                                  <label for="pass" >Contraseña</label>
                                </div>
                              </div>
                            </div>
                            <div class="row fadeInDown animated slow delay-1s">
                              <div class="col s12 center-align" id="boton">
                                .<div class="input-field">
                                  <button type="submit" id="submit" class="btn waves-effect blue">Entrar</button>
                                </div>
                              </div>
                            </div>
                          </form>
                      </div>
                    </div>
                  </div>
                

      </main>


    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>
  </body>
  </html>
