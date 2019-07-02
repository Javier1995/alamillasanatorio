<?php include_once './selected.php';?>
<?php include_once '../extend/header.php'; ?>
<?php if(isset($_SESSION['nick'])): ?>

<?php  
             
           $medicamentos = mostrar_medicamentos(); 
           $medicamento = $medicamentos->fetch_assoc();
           $categorias = mostrarCategorias();


           
    ?>



    <div id="registrar" class="col s12">
        <div class="row">
            <div class="col s12 m12 l8 offset-l2">
                <div class="card horizontal">
                    <div class="card-image blue lighten-2">
                        <img src="../img/bar.png">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content blue darken-4 ">
                            <form action="#" method="post">
                                <div class="input-field s12 m6 l12">
                                    <label for="agregar_lote">Codigo de barra</label>
                                    <input class="white-text" type="text" id="codigo" placeholder="Inserte codigo.."
                                           maxlength="13"  autofocus="on" autocomplete="off">
<!--                                    <a class="btn" id="busca_medicamento"><i class="fa fa-search fa-1x" aria-hidden="true"></i>Buscar</a>-->
                                    <div class="col" id="busqueda"></div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m12 l12 xl12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Agregar Lotes</span>
                        <div id="respuesta">No hay busqueda</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once '../extend/opciones.php';?>
<?php include_once '../extend/errorMessage.php' ?>
<?php include_once '../extend/scripts.php'; ?>
<?php include_once '../extend/footer.php'; ?>
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