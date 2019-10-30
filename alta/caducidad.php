<?php include_once './selected.php';?>
<?php require_once '../extend/header.php';
    $medicamentos = mostrar_medicamentos();
    $row_num = $medicamentos->num_rows;
?>
<?php if(isset($_SESSION['nick'])): ?>

             

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