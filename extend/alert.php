<?php require_once '../conexion/conexion.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../css/materialize.css">
        <link rel="stylesheet" href="../css/materialize.min.css">
        <link  href="../css/sweetalert.css" type="text/html" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Alerta</title>
    </head>
    <body>
        <?php
        if (isset($_GET['ms']) && isset($_GET['c']) && isset($_GET['p']) && isset($_GET['t'])) {
            $mensaje = htmlentities($_GET['ms']);
            $c = htmlentities($_GET['c']);
            $p = htmlentities($_GET['p']);
            $t = htmlentities($_GET['t']);
        } else {
            header("Location:../");
        }

        switch ($c) {
            case 'us':
                $carpeta = '../usuarios/';
                break;
            case 'venta';
                $carpeta = '../venta/';
                break;
            case 'salir';
                $carpeta = '../';
                break;
            case 'home':
                $carpeta = '../inicio/';
                break;
            case 'al':
                $carpeta = '../alta/';
                break;
            case 'admin':
                $carpeta = '../alta_admin/';
                break;
            case 'ca':
                $carpeta = '../categorias/';
                break;
            case 'pre':
                $carpeta = '../presentaciones/';
                break;
            case 'doctor':
                $carpeta = '../recetario/';
                break;
            case 'caja':
                $carpeta = '../caja/';
        }
        switch ($p) {
            case 'in':
                $pagina = 'index.php';
                break;
            case 'home':
                $pagina = './';
                break;
            case 'salir':
                $pagina = '';
                break;
            case'al':
                $pagina = 'index.php';
                break;
            case'admin':
                $pagina = 'pass.view.php';
                break;
          
        }

        $dir = $carpeta . $pagina;
        if ($t == 'error') {
            $titulo = 'Oppss..';
        } elseif ($t == 'warning') {
            $titulo = 'oh oh!';
        } else {
            $titulo = 'Bien hecho..';
        }
        ?>

        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/sweetalert.min.js"></script>
        <script type="text/javascript">
            swal({
                title: "<?php echo $titulo ?>",
                text: "<?php echo $mensaje ?>",
                icon: "<?php echo $t ?>",
                buttons: ["OK", false],
            }).then(function () {
                location.href = '<?php echo $dir ?>';
            });
            $(document).click(function () {
                location.href = '<?php echo $dir ?>';
            });
            $(document).keyup(function (e) {
                if (e.which == 27) {
                    location.href = '<?php echo $dir ?>';
                }
            });
        </script>
    </body>
</html>
