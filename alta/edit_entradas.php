<?php include_once './selected.php';?>
<?php include_once '../extend/header.php';
    $lotes = mostrar_lotes();
    $row_num = $lotes->num_rows;
?>
<?php if(isset($_SESSION['nick'])): ?>
<br>
<div class="row">
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
<div class="row">
    <div class="col s12 m12 l12 xl12">
        <div class="card">
            <div class="card-content">


                <?php if ($row_num != 0):?>
                <span class="card-title">LISTA DE ENTRADAS (
                    <?=$row_num?>)</span>


                <div class="row">

                    <table class="bordered striped centered highlight">

                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Medicamento</th>
                                <th>Lote</th>
                                <th>Caducidad</th>
                                <th>Cantidad</th>
                                <th>Fecha alta</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php  while($lote = $lotes->fetch_assoc()) :?>
                            <tr>
                                <td>
                                    <?=$lote['cve_medicamento']?>
                                </td>
                                <td>
                                    <?=$lote['nombre_generico']?>
                                </td>
                                <td>
                                    <?=$lote['cve_lote']?>
                                </td>
                                <td>
                                    <?=$lote['fecha_caducidad']?>
                                </td>
                                <td>
                                    <?=$lote['cantidad']?>
                                </td>
                                <td>
                                    <?=$lote['fecha_alta']?>
                                </td>
                                <td>

                                    <a href="#" class="btn-floating grey lighten-2 dropdown-button" href='#'
                                        data-activates='options<?=$lote['cve_lote']?>'>
                                        <i class="material-icons black-text">more_vert</i>
                                    </a>
                                    <ul id='options<?=$lote['cve_lote']?>' class='dropdown-content'>
                                        <li><a class="left-align" href="edit_medicamento.php?q=<?=$lote['cve_lote']?>">Editar</a></li>
                                        <li><a class="left-align">Borrar</a></li>
                                    </ul>

                                </td>
                            </tr>

                            <?php  endwhile;?>
                        </tbody>

                    </table>
                    <!--alert -->
                    <div class="row" id="alert_box">
                        <div class="col s6 m6 l7">
                            <div class="card green darken-1">
                                <div class="row">
                                    <div class="col s12 m10">
                                        <div class="card-content white-text">
                                            <p>1. Este Archivo ya se encuentra en el archivo inteligente</p>

                                        </div>
                                    </div>
                                    <div class="col s12 m2">
                                        <i class="tiny icon_style material-icons" id="alert_close" aria-hidden="true">close</i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--alert fin -->

                </div>

                <?php else :?>


                <h5>No hay Medicamentos</h5>


                <?php endif;?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col s12 l12">
        <div class="fixed-action-btn vertical ">
            <a class="btn-floating pulse btn-large" href="agregar_lote.php" title="Agregar entradas">
                <i class="material-icons">add</i>
            </a>
        </div>
    </div>

</div>


<?php include '../extend/scripts.php'; ?>
<script src="../js/validacion_user.js"></script>
</body>
</html>
<?php else: header("Location:../");?>

<?php endif; ?>

<?php Elimina_id_url(); ?>