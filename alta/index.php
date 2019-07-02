<?php include_once './selected.php';?>
<?php require_once '../extend/header.php';
    $medicamentos = mostrar_medicamentos();
    $row_num = $medicamentos->num_rows;
?>
<?php if(isset($_SESSION['nick'])): ?>
    <div class="row">
        <div class="col s12 l3 fadeInUp  animated fast delay-1s">
            <div class="card blue lighten-3 ">
                <div class="card-content">
                    <span class="card-title">Entradas<i class="material-icons small left">
                            assignment_turned_in
                        </i></span>
                    <div class="row">
                        <div class="col s6 112">

                            <h3><?=cantidad_lotes()?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 l3 fadeInUp  animated fast delay-1s">
            <div class="card orange lighten-3 ">
                <div class="card-content">
                    <span class="card-title">Medicamentos<i class="fa fa-medkit left" aria-hidden="true"></i></span>
                    <div class="row">
                        <div class="col s6 112">

                            <h3><?=$row_num?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="row fadeInDown animated fast" id="buscador">
    <div class="col s12 m12 l12 xl12">
        <nav class="blue darken-1">
            <div class="nav-wrapper">
                <div class="input-field">
                    <input type="search" id="buscar" autocomplete="off" placeholder="Escriba aquí...">
                    <label for="buscar" class="label-icon"><i class="material-icons" style="font-size:40px;">search</i></label>
                    <i class="material-icons">close</i>
                </div>

            </div>

        </nav>
    </div>
</div>
<div class="row fadeInRight animated fast" id="inicio" >
    <div class="col s12 m12 l12 xl12">
        <div class="card">
            <div class="card-content">


                <?php if ($row_num != 0):?>
                
                <span class="card-title">LISTA DE MEDICAMENTOS REGISTRADOS</span>


                <div class="row">

                    <table class="bordered striped centered highlight responsive-table">

                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Precio Entrada</th>
                                <th>Precio Salida</th>
                                <th>Categoria</th>
                                <th>Stock Minimo</th>
                                <th>En inventario</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php  while($medicamento = $medicamentos->fetch_assoc()) :?>
                            <tr id="<?=$medicamento['cve_medicamento']?>">
                                <td>
                                    <?=$medicamento['cve_medicamento']?>
                                </td>
                                <td>
                                    <?=$medicamento['nombre_generico']?>
                                </td>
                                <td>
                                    $<?=$medicamento['precio_adquisitivo']?>
                                </td>
                                <td>
                                    $<?=$medicamento['precio_venta']?>
                                </td>
                                <td>
                                    <?=$medicamento['categoria']?>
                                </td>
                                <td>
                                    <?=$medicamento['stock_minimo']?>
                                </td>
                                <td>
                                    <?=stock($medicamento['cve_medicamento'])?>
                                </td>
                                <td>

                                    <a href="#" class="btn-floating grey lighten-2 dropdown-button" href='#'
                                        data-activates='options<?=$medicamento['cve_medicamento']?>'>
                                        <i class="material-icons black-text">more_vert</i>
                                    </a>
                                    <ul id='options<?=$medicamento['cve_medicamento']?>' class='dropdown-content'>
                                        <li><a class="left-align" href="edit_medicamento.php?q=<?=$medicamento['cve_medicamento']?>">Editar</a></li>
                                        <li><a class="left-align" href="#" onclick="borrar_medicamento('<?=$medicamento['cve_medicamento']?>')">Borrar</a></li>
                                    </ul>

                                </td>
                            </tr>

                            <?php  endwhile;?>
                        </tbody>

                    </table>
                </div>

                <?php else :?>


                <h5>No hay medicamentos registrados <a href="agregar_productos.php">click aquí</a> para registrar uno nuevo</h5>


                <?php endif;?>
            </div>
        </div>
    </div>
</div>

<?php include_once '../extend/alter_box.php';?>
<?php include_once '../extend/opciones.php'; ?>
<?php include_once '../extend/errorMessage.php' ?>
<?php include '../extend/scripts.php'; ?>
<?php include_once '../extend/footer.php'; ?>
<script src="../js/validacion_user.js"></script>
<script src="../js/validacion_alta.js"></script>
</body>
</html>
<?php else: header("Location:../");?>

<?php endif; ?>

<?php Elimina_id_url(); ?>