<?php require_once "../../conexion/conexion.php"; 
  
$dato = $con->real_escape_string(htmlentities($_POST['dato']));

?>

<?php if($dato=='1'): ?>
    <!-- OPTION NO EN EXISTENCIA -->  
  <?php 

    $selExis = $con->query("SELECT * FROM existenca WHERE EXISTENCIA > 0");
 ?>

  <div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <table class="bordered centered ">
                <thead>
                  <tr>
                      <th>CODIGO</th>
                      <th>MEDICAMENTO</th>
                      <th>DESCRIPCION</th>
                      <th>PRECIO A.</th>
                      <th>PRECIO V.</th>
                      <th>UNIDAD CAJA</th>
                      <th>CATEGORIA</th>
                      <th>CANTIDAD</th>


                  </tr>
                </thead>

                <tbody class="green lighten-2">
              <?php while($fetchEx = $selExis->fetch_assoc()){
              
              $selMed = $con->query("SELECT * FROM medicamento WHERE CVE_MED ='{$fetchEx['CVE_MEDICAMENTO_EX']}'");
                
                while($fetchMed = $selMed->fetch_assoc()){
                  $med = $fetchMed['NOMBRE_GENERICO'];
                  $come = $fetchMed['NOMBRE_COMERCIAL'];
                  $des =  $fetchMed['DESCRIPCION'];
                  $precioAd  =   $fetchMed['PRECIO_ADQUISITIVO'];
                  $precioVen = $fetchMed['PRECIO_VENTA'];
                  $unidadCa = $fetchMed['UNIDADES_CAJA'];
                  $cat = $fetchMed['CATEGORIA'];
                }
                ?>

                  <tr>
                    <td><?php echo $fetchEx['CVE_MEDICAMENTO_EX'];?></td>
                    <td><?php echo $med.'/'.$come; ?></td>
                    <td><?php echo $des; ?></td>
                    <td><?php echo $precioAd;?></td>
                    <td><?php echo $precioVen;?></td>
                    <td><?php echo $unidadCa; ?></td>
                    <td><?php echo $cat; ?></td>
                    <td><?php echo $fetchEx['EXISTENCIA'];?></td>
                  </tr>

                <?php } ?>
                </tbody>
              </table>
      </div>
    </div>
  </div>
 </div>

  

<?php elseif($dato=='2'): ?>
  <!-- OPTION NO EN EXISTENCIA -->
   <?php 

    $selExis = $con->query("SELECT * FROM existenca WHERE EXISTENCIA =0");

    



   ?>

  <div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <table class="bordered centered ">
                <thead>
                  <tr>
                      <th>CODIGO</th>
                      <th>MEDICAMENTO</th>
                      <th>DESCRIPCION</th>
                      <th>PRECIO A.</th>
                      <th>PRECIO V.</th>
                      <th>UNIDAD CAJA</th>
                      <th>CATEGORIA</th>
                      <th>CANTIDAD</th>


                  </tr>
                </thead>

                <tbody class="red lighten-2">
              <?php while($fetchEx = $selExis->fetch_assoc()){
              
              $selMed = $con->query("SELECT * FROM medicamento WHERE CVE_MED ='{$fetchEx['CVE_MEDICAMENTO_EX']}'");
                
                while($fetchMed = $selMed->fetch_assoc()){
                  $med = $fetchMed['NOMBRE_GENERICO'];
                  $come = $fetchMed['NOMBRE_COMERCIAL'];
                  $des =  $fetchMed['DESCRIPCION'];
                  $precioAd  =   $fetchMed['PRECIO_ADQUISITIVO'];
                  $precioVen = $fetchMed['PRECIO_VENTA'];
                  $unidadCa = $fetchMed['UNIDADES_CAJA'];
                  $cat = $fetchMed['CATEGORIA'];
                }
                ?>

                  <tr>
                    <td><?php echo $fetchEx['CVE_MEDICAMENTO_EX'];?></td>
                    <td><?php echo $med.'/'.$come; ?></td>
                    <td><?php echo $des; ?></td>
                    <td><?php echo $precioAd;?></td>
                    <td><?php echo $precioVen;?></td>
                    <td><?php echo $unidadCa; ?></td>
                    <td><?php echo $cat; ?></td>
                    <td><?php echo $fetchEx['EXISTENCIA'];?></td>
                  </tr>

                <?php } ?>
                </tbody>
              </table>
      </div>
    </div>
  </div>
 </div>

  


<?php else:?>
    
      <!-- OPTION TODO -->
  <?php $selExis = $con->query("SELECT * FROM existenca");?>

  <div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <table class="bordered centered ">
                <thead>
                  <tr>
                      <th>CODIGO</th>
                      <th>MEDICAMENTO</th>
                      <th>DESCRIPCION</th>
                      <th>PRECIO A.</th>
                      <th>PRECIO V.</th>
                      <th>UNIDAD CAJA</th>
                      <th>CATEGORIA</th>
                      <th>CANTIDAD</th>


                  </tr>
                </thead>

                <tbody class="red lighten-2">
              <?php while($fetchEx = $selExis->fetch_assoc()){
              
              $selMed = $con->query("SELECT * FROM medicamento WHERE CVE_MED ='{$fetchEx['CVE_MEDICAMENTO_EX']}'");
                
                while($fetchMed = $selMed->fetch_assoc()){
                  $med = $fetchMed['NOMBRE_GENERICO'];
                  $come = $fetchMed['NOMBRE_COMERCIAL'];
                  $des =  $fetchMed['DESCRIPCION'];
                  $precioAd  =   $fetchMed['PRECIO_ADQUISITIVO'];
                  $precioVen = $fetchMed['PRECIO_VENTA'];
                  $unidadCa = $fetchMed['UNIDADES_CAJA'];
                  $cat = $fetchMed['CATEGORIA'];
                }
                ?>

                  <?php if($fetchEx['EXISTENCIA'] > 0): ?>
                  <tr class="green lighten-2">
                    <td><?php echo $fetchEx['CVE_MEDICAMENTO_EX'];?></td>
                    <td><?php echo $med.'/'.$come; ?></td>
                    <td><?php echo $des; ?></td>
                    <td><?php echo $precioAd;?></td>
                    <td><?php echo $precioVen;?></td>
                    <td><?php echo $unidadCa; ?></td>
                    <td><?php echo $cat; ?></td>
                    <td><?php echo $fetchEx['EXISTENCIA'];?></td>
                  </tr>

                  <?php else: ?>
                    <tr class="red lighten-2">
                    <td><?php echo $fetchEx['CVE_MEDICAMENTO_EX'];?></td>
                    <td><?php echo $med.'/'.$come; ?></td>
                    <td><?php echo $des; ?></td>
                    <td><?php echo $precioAd;?></td>
                    <td><?php echo $precioVen;?></td>
                    <td><?php echo $unidadCa; ?></td>
                    <td><?php echo $cat; ?></td>
                    <td><?php echo $fetchEx['EXISTENCIA'];?></td>
                  </tr>

                    
                  <?php endif; ?>
                
                <?php } ?>
                </tbody>
              </table>
      </div>
    </div>
  </div>
 </div>





<?php endif; ?>