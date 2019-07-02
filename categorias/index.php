<?php include_once './selected.php';?>
<?php include_once '../extend/header.php';
$categoria = mostrarCategorias();
$row_num = $categoria->num_rows;
    ?>
<?php if(isset($_SESSION['nick'])): ?>

<div class="row">
    <div class="col s12 m12 l12 xl12">
        <div class="card">
            <div class="card-content">
                <span class="card-title">CATEGORIAS MEDICAMENTOS</span>
                <div class="row">
                    <form action="guardar_categoria.php" method="POST">
                        <div class="input-field">
                            <label for="categoria">Nombre de la categoria</label>
                            <input type="text" name="categoria" id="categoria" oninput="may(this.value, id);">
                            <button type="submit" class="btn" id="submit">GUARDAR</button>
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
                            <?php while($row = $categoria->fetch_assoc()) :?>
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

               
                        <h5>No hay categorias disponibles</h5>
                  

                <?php endif;?>
            </div>
        </div>
    </div>
</div>



<?php include '../extend/scripts.php'; ?>
<?php include_once '../extend/footer.php'; ?>
<script src="../js/validacion_user.js"></script>
<script>
$(document).ready(function(){
    const categoria = $("#categoria");
    var boton    = $("#submit");
    boton.attr("disabled", "disabled");
    /* Esta funcion quita o agrega el atributo disabled a la id submit ya que si dar guardar sin escribir 
    * Se guardará vacio en el campo
    */ 
    categoria.on("keyup", function(){//inicio

        const categoria = $("#categoria");

        if (categoria.val().length != 0) {      

            boton.removeAttr("disabled");

        } else {

            boton.attr("disabled", "disabled");
        }

    });//fin
 
 

});

</script>
</body>


</html>
<?php else: header("Location:../");?>

<?php endif; ?>