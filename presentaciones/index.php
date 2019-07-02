<?php include_once '../extend/header.php';
$presentaciones = mostrarPresentaciones();
$row_num = $presentaciones->num_rows;
    ?>
<?php if(isset($_SESSION['nick'])): ?>

<div class="row">
    <div class="col s12 m12 l12 xl12">
        <div class="card">
            <div class="card-content">
                <span class="card-title">PRESENTACIONES DE MEDICAMENTO</span>
                <div class="row">
                    <form action="guardar_presentaciones.php" method="POST">
                        <div class="input-field">
                            <label for="presentacion">Nombre de la categoria</label>
                            <input type="text" name="presentacion" id="presentacion" onkeyup="may(this.value, this.id)">
                            <button type="submit" class="btn">GUARDAR</button>
                        </div>
                    </form>
                </div>
                <?php if ($row_num != 0):?>
                <div class="row">

                    <table class="bordered striped centered highlight">

                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Editar</th>
                                <th>Borrar</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while($row = $presentaciones->fetch_assoc()) :?>
                            <tr>
                                <td>
                                    <?=$row['nombre']?>
                                </td>

                                <td><a href="edit.php?id=<?=$row['id']?>" class="btn-floating"> <i class="material-icons">edit</i></a></td>

                                <td><a href="delete.php?id=<?=$row['id']?>" class="btn-floating red"> <i class="material-icons">delete</i></a></td>
                            </tr>
                            <?php endwhile;?>
                        </tbody>

                    </table>

                </div>

                <?php else :?>

               
                        <h5>No hay presentaciones disponibles</h5>
                  

                <?php endif;?>
            </div>
        </div>
    </div>
</div>



<?php include '../extend/scripts.php'; ?>
<script src="../js/validacion_user.js"></script>

</body>


</html>
<?php else: header("Location:../");?>

<?php endif; ?>