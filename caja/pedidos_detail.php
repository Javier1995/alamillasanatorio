<?php 
  include_once './selected.php'; 
  include_once '../extend/header.php';
  $id = filter_input(INPUT_GET,'co',FILTER_VALIDATE_INT);
  
  //Valida si es una entero
  if($id != true){
   echo "<script>location.href='./'</script>";
  }

  use Caja\Caja;
  $caja = new Caja();
  $rows = $caja->getCashOutByOne($id);

  //valida si existe el corte de caja
  if($rows->num_rows == 0){
    echo "<script>location.href='./'</script>";
  }

  $caja->setCashoutId($id);
  $pedidos = $caja->getOrdersByCashout();

  
?>
<?php if(isset($_SESSION['nick']) && $_SESSION['nick']=='admin'): ?>

<input type="hidden" value="<?=$id?>" id="id_detail">

<div class="row">
  <!-- LISTA DE PEDIDOS -->
  <div class="col l8 s12">
    <div class="orderByCashout"></div>
  </div>

<!--MONTO DE GASTO -->
  <div class="col l4 s12">
    <div class="mount"></div>
  </div>

</div>



<?php 
 include_once '../extend/errorMessage.php';
 include '../extend/scripts.php';
?>
<script src="../js/Pagination.js"></script>
<script src="orderbycashout.js"></script>
<?php include_once '../extend/footer.php';?>
<?php else: ?>

<?php header("Location:../"); ?>

<?php endif; ?>