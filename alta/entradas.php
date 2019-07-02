<?php
 include_once './selected.php';
include_once '../extend/header.php';
$lotes = mostrar_lotes();
$row_num = $lotes->num_rows;
?>
<?php if (isset($_SESSION['nick'])): ?>
    <br>
    <div class="row fadeInDown animated slow" id="buscador-entrada">
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

    <div class="row fadeInDown animated fast" id="tabla-entrada">
        <div class="col s12 m12 l12 xl12">
            <div class="card">
                <div class="card-content">


                        <?php if ($row_num != 0): ?>
                        <span class="card-title">LISTA DE ENTRADAS</span>


                        <div class="row">

                            <table class="bordered striped centered highlight responsive-table">

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
        <?php while ($lote = $lotes->fetch_assoc()) : ?>
                                        <tr id="<?= $lote['lote'] ?>">
                                            <td>
            <?= $lote['clave'] ?>
                                            </td>
                                            <td>
            <?= $lote['nombre_c'] ?>
                                            </td>
                                            <td>
            <?= $lote['lote'] ?>
                                            </td>
                                            <td>
            <?= $lote['caducidad'] ?>
                                            </td>
                                            <td>
            <?= $lote['cantidad'] ?>
                                            </td>
                                            <td>
            <?= $lote['alta'] ?>
                                            </td>
                                            <td>

                                                <a href="#" class="btn-floating grey lighten-2 dropdown-button" href='#'
                                                   data-activates='lote<?= $lote['lote'] ?>'>
                                                    <i class="material-icons black-text">more_vert</i>
                                                </a>
                                                <ul id='lote<?= $lote['lote'] ?>' class='dropdown-content'>
                                                    <li><a class="left-align" href="edit_lote.php?l=<?= $lote['lote'] ?>"><i class="material-icons left">edit</i> Editar</a></li>
                                                    <li><a class="left-align" onclick="borrar_lote('<?= $lote['lote'] ?>')"><i class="material-icons left red-text">delete</i>Borrar</a></li>
                                                </ul>

                                            </td>
                                        </tr>

        <?php endwhile; ?>
                                </tbody>

                            </table>
                        </div>

                        <?php include_once '../extend/errorMessage.php' ?>

    <?php else : ?>


           <h5>No hay entradas disponibles <a href="agregar_lote.php"> click aquí</a> para nuevas entradas de medicamento</h5>


    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php include_once '../extend/alter_box.php'; ?>
    <?php include_once '../extend/opciones.php';?>
    <?php include_once'../extend/scripts.php'; ?>
    <?php include_once '../extend/footer.php'; ?>
    <script src="../js/validacion_user.js"></script>
    <script src="../js/validacion_alta.js"></script>
    <script>

    </script>

    </body>


    </html>
<?php else: header("Location:../"); ?>

<?php endif; ?>

<?php Elimina_id_url(); ?>