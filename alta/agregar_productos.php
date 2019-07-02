<?php include_once './selected.php';?>
<?php include_once '../extend/header.php'; ?>
<style>
  .select-dropdown{
        overflow-y: auto !important;
    }</style>
<?php if(isset($_SESSION['nick'])): ?>
<?php date_default_timezone_set('America/Monterrey');
  $fecha_dia =date('Y-m-d'); ?>
    <?php $categorias = mostrarCategorias(); 
    ?>
    <div class="row">
        <div class="col s12 m12 l12 xl12">
            <div class="card">
                <div class="card-content">
                <span class="card-title">AGREGAR PRODUCTO</span>    
                    <form action="#!" method="POST" id="formulario">
                    <div class="row">
                        <div class="col input-field s12 l4 xl4">
                            <label for="codigo_barras">Codigo de Barra*</label>
                            <input value="<?=isset($_GET['code'])?$_GET['code']:''?>" autofocus='on' type="text" name="barcode" id="barcode" maxlength="13" required title="Introduzca el codigo de barra del producto" onkeyup="this.value=Numeros(this.value)" >
                        </div>
                        <div class="col input-field s12 l4 xl4 ">
                            <label for="nombregenerico">Nombre Generico*</label>
                            <input type="text" name="nombregenerico" id="nombregenerico" onkeyup="may(this.value, this.id)" required>
                        </div>
                        <div class="col input-field s12 l4 xl4">
                            <label for="nombrecomercial">Nombre Comercial*</label>
                            <input type="text" name="nombrecomercial" id="nombrecomercial" onkeyup="may(this.value, this.id)" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col input-field s12 l4 xl4">
                            <select name="categoria" id="categoria" required>
                                <option value="0" selected disabled>SELECCIONA</option>
                               <?php while($categoria = $categorias->fetch_assoc()) :?>
                                <option value="<?=$categoria['id']?>"><?=$categoria['nombre']?></option>
                               <?php endwhile;?>
                            </select>
                            <label for="categoria">Categoria*</label>
                        </div>

                        <div class="col input-field s12 l4 xl4">
                            <label for="precioa">Precio Adquisitivo*</label>
                            <input type="text" name="precioa" id="precioa" onKeyPress="return acceptNum(event)" required>
                        </div>
                        <div class="col input-field s12 l4 xl4">
                            <label for="preciov">Precio Venta*</label>
                            <input type="text" name="preciov" id="preciov" onKeyPress="return acceptNum(event)" required> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col input-field s12 l3">
                            <label for="presentacion">Presentacion</label>
                            <textarea class="materialize-textarea" name="presentacion" id="presentacion" cols="30" rows="10"  onkeyup="may(this.value, this.id)"></textarea>     
                        </div>
                        <div class="col input-field s12 l3">
                            <textarea name="descripcion" id="descripcion" class="materialize-textarea" onkeyup="may(this.value, this.id)"></textarea>
                            <label for="descripcion">Descripcion</label>
                        </div>
                        <div class="col input-field s12 l2">
                                <label for="unidades">Unidades de caja*</label> 
                                <input type="text" name="unidades" id="unidades" required onkeyup="this.value=Numeros(this.value)">
                        </div>

                        <div class="col input-field s12 l2">
                                <label for="stockmin">No. de piezas Inicial*</label>
                                <input type="text" name="piezas" id="piezas" required onkeyup="this.value=Numeros(this.value)">
                        </div>    

                        <div class="col input-field s12 l2">
                                <label for="stockmin">Stock Minimo*</label>
                                <input type="text" name="stockmin" id="stockmin" required onkeyup="this.value=Numeros(this.value)">
                        </div>      
                    </div>

                    <div class="row">
                        <div class="col input-field s12 l4 xl4">
                                <label for="lote">Lote*</label>
                                <input type="text" name="lote" id="lote" onkeyup="may(this.value, this.id)" required>
                        </div>
                        <div class="col input-field s12 l4 xl4">
                                <label for="caducidad">Caducidad*</label>
                                <input type="text" name="caducidad" id="caducidad" class="datepicker" required>
                        </div>
                        <div class="col input-field s12 l4 xl4">
                                <select name="proveedor" id="proveedor">
                                    <option value="0">Ninguno</option>
                                </select>
                                <label for="proveedor">Proveedor</label>
                        </div>
                    </div>


                        <button id="submit" class="btn">Guardar <i class="material-icons right">save</i></button>
                        <a href="./" class="btn red"><i class="material-icons right">cancel</i>Cancelar</a>
                    </form>
                            *Campos obligatorios
                    <div id="respuesta"></div>
                    
                </div>
            </div>
        </div>
    </div>
    <?php include_once '../extend/errorMessage.php' ?>
    <?php include_once '../extend/opciones.php'; ?>
    <?php include '../extend/scripts.php'; ?>
    <?php include_once '../extend/footer.php'; ?>
    <script src="../js/validacion_alta.js"></script>
    <script src="../js/validacion_user.js"></script>
    <script>

        var nav4 = window.Event ? true : false;
        function acceptNum(evt){  
        // NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57  
        var key = nav4 ? evt.which : evt.keyCode;  
        return (key <= 13 || (key >= 48 && key <= 57 || key==46)); 
        }
    </script>
    </body>


    </html>
<?php else: header("Location:../");?>

<?php endif; ?>