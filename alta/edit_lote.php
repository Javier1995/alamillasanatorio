<?php include_once './selected.php';?>
<?php include_once '../extend/header.php'; ?>
<?php if(isset($_SESSION['nick'])): ?>
<?php date_default_timezone_set('America/Monterrey');
  $fecha_dia =date('Y-m-d'); ?>
<?php 
         if (!isset($_SESSION['l'])) {

            $_SESSION['l'] = $_GET['l'];
            $dato = $_SESSION['l'];

         } else{

              $dato = $_SESSION['l'];
            
         } 
      $id = $con->real_escape_string(htmlentities($dato));
      $lotes = mostrar_lotes($id);
      $lote = $lotes->fetch_assoc();
      
 ?>
<div class="row">
    <div class="col s12 m12 l12 xl12">
        <div class="card">
            <div class="card-content">
                <span class="card-title">MODIFICAR LOTE</span>

                <div class="row ">
                    <table class="bordered striped centered highlight responsive-table">

                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Nombre Comercial</th>
                                <th>Stock</th>
                                <th>Lote</th>
                                <th>Caducidad</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td><?=$lote['clave']?></td>
                                <td><?=$lote['nombre_c']?></td>
                                <td>2</td>
                                <td><input value ="<?=$lote['lote']?>" type="text" id="lote" onkeyup="may(this.value, this.id)" /></td>
                                <td><input value ="<?=$lote['caducidad']?>" type="text" class="datepicker" id="caducidad"></td>
                                <td><input  value ="<?=$lote['cantidad']?>"type="text" id="cantidad" onkeyup="this.value=Numeros(this.value)" /></td>
                                
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn" title="Modificar" id="agregar" onclick="modificar_lote('<?=$id?>','<?=$lote['clave']?>')">Editar<i class="material-icons right">border_color</i> </button>
                    <a class="btn red" href="../">Cancelar<i class="material-icons right">cancel</i> </a>
                </div>
                <div id="respuesta"></div>

            </div>
        </div>
    </div>
</div>

<div id="errores" class="modal red">
    <div class="modal-content">
        <h4 class="white-text">Errores</h4>
        <div id="m-error" class="white-text"></div>
    </div>
    <div class="icon_style">
        <i class="material-icons small white-text" id="icon-cerrar">close</i>
    </div>
</div>
</div>
<?php include_once '../extend/opciones.php'; ?>
<?php include '../extend/scripts.php'; ?>
<script src="../js/validacion_alta.js"></script>
<script src="../js/validacion_user.js"></script>
<script>
    var nav4 = window.Event ? true : false;

    function acceptNum(evt) {
        // NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57  
        var key = nav4 ? evt.which : evt.keyCode;
        return (key <= 13 || (key >= 48 && key <= 57 || key == 46));
    }
</script>
</body>


</html>
<?php else: header("Location:../");?>

<?php endif; ?>
