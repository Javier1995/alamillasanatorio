<?php include_once './selected.php';?>
<?php include_once '../extend/header.php';?>
<?php if(isset($_SESSION['nick'])): ?>


    <p>En producción</p>
<?php include_once '../extend/errorMessage.php' ?>
<?php include '../extend/scripts.php'; ?>
<?php include_once '../extend/footer.php'; ?>
<?php else: ?>

  <?php header("Location:../"); ?>

<?php endif; ?>

