<?php include_once '../extend/header.php';?>
<?php if(isset($_SESSION['nick'])): ?>
<?php $valor = mostrarPresentaciones($con->real_escape_string(htmlentities($_GET['id'])));
$info = $valor->fetch_assoc();
$id = $_GET['id'];
?>
<div class="row">
    <div class="col s12 m12 l12 xl12">
        <div class="card">
            <div class="card-content">
                <span class="card-title">EDITAR CATEGORIA MEDICAMENTO</span>
                <div class="row">
                    <form action="guardar_edit.php?id=<?=$id?>" method="POST">
                        <div class="input-field">
                            <label for="presentacion">Nombre de la categoria</label>
                            <input type="text" name="presentacion" VALUE="<?= $info['nombre']?>" id="presentacion" onkeyup="may(this.value, this.id)">
                            <button type="submit" class="btn">Actualizar</button>
                        </div>
                    </form>
                </div>
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