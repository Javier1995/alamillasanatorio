<?php include_once './selected.php';?>
<?php require_once '../extend/header.php';
    $medicamentos = mostrar_medicamentos();
    $row_num = $medicamentos->num_rows;
?>
<?php if(isset($_SESSION['nick'])): ?>
<div class="row" id="inicio">
    <div class="col s12 m12 l12 xl12">
        <div class="card">
            <div class="card-content">
                <?php if ($row_num != 0):?>

                <span class="card-title">LISTA DE MEDICAMENTOS REGISTRADOS <span class="medication-count"><?=$row_num?>
                        REGISTRADOS</span></span>
                <div class="row">
                    <div class="col l6 m6 xl6 s12">
                        <div class="input-field">
                            <i class="material-icons prefix">search</i>
                            <input type="text" id="search_med" placeholder="Buscar..." accesskey="x" >
                        </div>
                    </div>

                    <div class="col l6 m6 xl6 s12">
                        <div class="input-field">
                            <button class="btn" id="impresion_inventario"><i class="material-icons left">picture_as_pdf</i> Inventario</button>
                        </div>
                    </div>

                </div>
                <div class="row">

                    <div id="list-medication"></div>
                
                </div>

                <?php else :?>


                <h5>No hay medicamentos registrados <a href="agregar_productos.php">click aquí</a> para registrar uno
                    nuevo</h5>


                <?php endif;?>
            </div>
        </div>
    </div>
</div>

<?php include_once '../extend/opciones.php'; ?>
<?php include '../extend/scripts.php'; ?>
<?php include_once '../extend/footer.php'; ?>
<script src="../js/Pagination.js"></script>
<script src="app_alta.js"></script>
<script src="../js/validacion_user.js"></script>
<script src="../js/validacion_alta.js"></script>

</body>

</html>
<?php else: header("Location:../");?>

<?php endif; ?>

<?php Elimina_id_url(); ?>