<?php 
  include_once './selected.php'; 
  include_once '../extend/header.php';
  use Caja\Caja;
  $caja = new Caja();
  $orders = $caja->getOrders();
  $cashouts = $caja->getCashOut();
?>
<?php if(isset($_SESSION['nick'])): ?>

<!-- CONTENIDO -->

<div class="row">
  <div class="col l5 s12">
    <div class="corteCaja"></div>
  </div>


  <!-- LISTA DE PEDIDOS -->
  <div class="col l7 s12">
    <div class="pedidoList"></div>
  </div>

</div>

<!--Boton para generar corte de caja -->
<div class="row ">
  <div class="col s12 l12">
    <div class="fixed-action-btn vertical zoomIn animated delay-1s">
      <button class="btn-floating pulse btn-large blue" title="Generar corte caja" id="corte_caja">
        <i class="material-icons">check_box</i>
      </button>
    </div>
  </div>

</div>

<?php 
 include_once '../extend/errorMessage.php';
 include '../extend/scripts.php';
?>
<script src="../js/Pagination.js"></script>
<script src="caja.js"></script>
<?php include_once '../extend/footer.php';?>
<?php else: ?>

<?php header("Location:../"); ?>

<?php endif; ?>