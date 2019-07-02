<?php require_once "../../conexion/conexion.php";

$fechaInicio = $con->real_escape_string(htmlentities($_POST['fecha_in']));
$fechaFin = $con->real_escape_string(htmlentities($_POST['fecha_fin']));
$selEntrada = $con->query("SELECT CVE_MED_EN, NO_LOTE_EN,FECHA_CADUCIDAD, FECHA_ENTRADA,NO_PIEZAS FROM entrada_med WHERE FECHA_ENTRADA BETWEEN '$fechaInicio' AND '$fechaFin'");

?>

<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <table class="bordered centered">
                <thead>
                  <tr>
                      <th>CODIGO</th>
                      <th>NO. LOTE</th>
                      <th>MEDICAMENTO</th>
                      <th>FECHA ENTRADA</th>
                      <th>NO. PIEZAS</th>
                      <th>FECHA CADUCIDAD</th>


                  </tr>
                </thead>

                <tbody>
              <?php while($fetchEn = $selEntrada->fetch_assoc()){

                $selMedicamento = $con->query("SELECT NOMBRE_GENERICO, NOMBRE_COMERCIAL FROM medicamento WHERE '{$fetchEn['CVE_MED_EN']}'");
                while($fetchMed = $selMedicamento->fetch_assoc()){
                $gene =   $fetchMed['NOMBRE_GENERICO'];
                $come =   $fetchMed['NOMBRE_COMERCIAL'];
                }
                ?>

                  <tr>
                    <td><?php echo $fetchEn['CVE_MED_EN']; ?></td>
                    <td><?php echo $fetchEn['NO_LOTE_EN']; ?></td>
                    <td><?php echo $gene.'/'.$come; ?></td>
                    <td><?php echo $fetchEn['FECHA_ENTRADA']; ?></td>
                    <td><?php echo $fetchEn['NO_PIEZAS']; ?></td>
                    <td><?php echo $fetchEn['FECHA_CADUCIDAD'];?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
      </div>
    </div>
  </div>
 </div>
