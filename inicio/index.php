<?php include_once './selected.php';?>
<?php include_once '../extend/header.php';?>
<?php include_once '../extend/helpers.php';?>
<?php 
  include_once '../autoload.php';
  use Medicamento\Caducidad;
?>
<?php if(isset($_SESSION['nick'])): ?>

  <div class="row">
    <div class="col 12">
      <h2>Mensajes <i class="material-icons medium">
message
</i></h2>
    </div>
  </div>

  <?php 

    $mensajesActivados =  getAllMessageActivado();
  
  ?>
  <div class="row">
    
    <div class="col s12">
    <ul class="collapsible popout" data-collapsible="accordion">
    <li>
      <div class="collapsible-header"><i class="material-icons">
arrow_downward
</i>Caducidad<span data-badge-caption="Mensajes" class="new badge"><?=$mensajesActivados->num_rows?></span></div>
      <div class="collapsible-body"><span>

  

      <div class="row">

        <div class="col s12">

        <table class="responsive-table centered highlight">

          <thead>
            <tr>
                <th>#</th>
                <th>Mensaje</th>
                <th>Lote</th>
                <th>Nombre Comercial</th>
                <th>Fecha Caducidad</th>
                <th>Dias restantes</th>
            </tr>
          </thead>

          <tbody>
          <?php $i=1; while($m = $mensajesActivados->fetch_object()): ?>
            <tr>
              <td><?= $i?></td>
              <td><?= $m->message?></td>
              <td><?= $m->lote?></td>
              <td><?=$m->comercial?></td>
              <td><?=$m->caducidad?></td>
              <td><?=$m->restantes. ' dia(s)'?></td>
            </tr>
            <?php $i++; endwhile; ?>
          </tbody>
        </table>

        </div>

      </div>

      </ul>

      </span></div>
    </li>
    
  </ul>
    </div>
  
  </div>
   
<?php include_once '../extend/errorMessage.php' ?>
<?php include '../extend/scripts.php'; ?>
<?php include_once '../extend/footer.php'; ?>
<?php else: ?>

  <?php header("Location:../"); ?>

<?php endif; ?>

