<?php include_once '../extend/header.php';?>
<?php if($_SESSION['nivel']== 'ADMINISTRADOR'): ?>



<?php include_once '../extend/alter_box.php';?>
<?php include_once '../extend/opciones.php'; ?>
<?php include_once '../extend/errorMessage.php' ?>
<?php include_once '../extend/scripts.php'; ?>
<?php include_once '../extend/footer.php'; ?>
<script src="../js/validacion_user.js"></script>
<script src="../js/validacion_alta.js"></script>
</body>
</html>
<?php else: header("Location:../");?>

<?php endif; ?>

<?php Elimina_id_url(); ?>