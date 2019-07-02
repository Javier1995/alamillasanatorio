<?php include_once './selected.php';?>
<?php include_once '../extend/header.php'; ?>
<?php if(isset($_SESSION['nick']) AND isset($_GET['q'])): ?>

<?php  
             

             //Evitar el cambio en el id
            if (!isset($_SESSION['q'])) {

                $_SESSION['q'] = $_GET['q'];
                $dato = $_SESSION['q'];

             } else{

                  $dato = $_SESSION['q'];
                
             } 

           $id = $con->real_escape_string(htmlentities($dato ));
           $medicamentos = mostrar_medicamentos($id); 
           $medicamento = $medicamentos->fetch_assoc();
           $categorias = mostrarCategorias();
           
    ?>
    <div class="row">
        <div class="col s12 m12 l12 xl12">
            <div class="card">
                <div class="card-content">
                <span class="card-title">EDITAR PRODUCTO</span>    
                    <form action="#!" method="POST" id="formulario">
                    <div class="row">
                        <div class="col input-field s12 l4">
                            <label for="codigo_barras">Codigo de Barra*</label>
                            <input readonly value="<?=$medicamento['cve_medicamento']?>" type="text" name="barcode" id="barcode" maxlength="13" required title="Introduzca el codigo de barra del producto" onkeyup="this.value=Numeros(this.value)" >
                        </div>
                        <div class="col input-field s12 l4">
                            <label for="nombregenerico">Nombre Generico*</label>
                            <input autofocus='on' value="<?=$medicamento['nombre_generico']?>" type="text" name="nombregenerico" id="nombregenerico" onkeyup="may(this.value, this.id)" required>
                        </div>
                        <div class="col input-field s12 l4">
                            <label for="nombrecomercial">Nombre Comercial*</label>
                            <input value="<?=$medicamento['nombre_comercial']?>" type="text" name="nombrecomercial" id="nombrecomercial" onkeyup="may(this.value, this.id)" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col input-field s12 l4">
                            <select name="categoria" id="categoria" required>
                                <option value="0" selected disabled>SELECCIONA</option>
                               <?php while($categoria = $categorias->fetch_assoc()) :?>
                                  
                                  <option value="<?=$categoria['id']?>" <?php ($categoria['id']==$medicamento['id_categoria'])? print('selected'): '';?> ><?=$categoria['nombre']?></option>

                               <?php endwhile;?>
                            </select>
                            <label for="categoria">Categoria*</label>
                        </div>

                        <div class="col input-field s12 l4">
                            <label for="precioa">Precio Adquisitivo*</label>
                            <input value="<?=$medicamento['precio_adquisitivo']?>" type="text" name="precioa" id="precioa" onKeyPress="return acceptNum(event)" required>
                        </div>
                        <div class="col input-field s12 l4">
                            <label for="preciov">Precio Venta*</label>
                            <input value="<?=$medicamento['precio_venta']?>" type="text" name="preciov" id="preciov" onKeyPress="return acceptNum(event)" required> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col input-field s12 l3">
                            <label for="presentacion">Presentacion</label>
                            <textarea class="materialize-textarea" name="presentacion" id="presentacion" cols="30" rows="10"  onkeyup="may(this.value, this.id)"><?=$medicamento['presentacion']?></textarea>     
                        </div>
                        <div class="col input-field s12 l3">
                            <textarea name="descripcion" id="descripcion" class="materialize-textarea" onkeyup="may(this.value, this.id)"><?=$medicamento['descripcion']?></textarea>
                            <label for="descripcion">Descripcion</label>
                        </div>
                        <div class="col input-field s12 l2">
                                <label for="unidades">Unidades de caja</label> 
                                <input value="<?=$medicamento['unidades_caja']?>" type="text" name="unidades" id="unidades" required onkeyup="this.value=Numeros(this.value)">
                        </div>
                        <div class="col input-field s12 l2">
                                <label for="stockmin">Stock Minimo</label>
                                <input value="<?=$medicamento['stock_minimo']?>" type="text" name="stockmin" id="stockmin" required onkeyup="this.value=Numeros(this.value)">
                        </div>
                        <div class="col input-field s12 l2">
                                <select name="proveedor" id="proveedor">
                                    <option value="0">Ninguno</option>
                                </select>
                                <label for="proveedor">Proveedor</label>
                        </div> 
                    </div>


                        <button id="submit_edit" class="btn">Actualizar <i class="material-icons right">update</i> </button>
                        <a href="./" class="btn red">Cancelar<i class="material-icons right">arrow_back</i> </a>
                    </form>
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
<?php else: header("Location:./");?>

<?php endif; ?>