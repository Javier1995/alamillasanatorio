<?php 
if($dato=='1'){
	$option = 'Datos de Existencia';
}elseif ($dato=='2'){
	$option ='Datos de No Existencia';
}else{
	$option = 'Dato de Existentes y No existentes';
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Generador de pdf</title>
	<style type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet" type="text/css">
		table, td, th {
				    border: 1px solid black;
				}

				table {
				    border-collapse: collapse;
				    width: 100%;
				}

				th {
				    text-align: left;
				}
				th,td{
					padding-top: 8px;
					padding-bottom: 4px;
					padding-left:4px;
				}
				.center-table{
					padding-right:50%;
				}
				
				table .center{
					margin-left:200px;
				}
			  	
			  	#cabezera h1{
			  		float:right;
			  		
			  	}

			  	#cabezera img{
			  		float:left;
			  	}
			  	.center-letra{
			  		text-align: center;
			  	}

			  	#cabezera{
			  		margin-bottom: 40px;
			  	}

			  	.center-elementos{
			  		text-align: center;
		      		 
			  	}
	</style>
</head>
<body>

			<div id="cabezera">
				<img src="../../img/logo.jpg" height="110" width="130">
				<h2 align="center">Reporte de existencia de Medicamentos</h2>

			</div>

			
				<h4 class="center-elementos"><?php echo $option; ?></h4>
		
				  



<?php if($dato=='1'): ?>
    <!-- OPTION NO EN EXISTENCIA -->  
  <?php 

    $selExis = $con->query("SELECT * FROM existenca WHERE EXISTENCIA > 0");
 ?>

  <div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <table class="bordered centered " align="center">
                <thead>
                  <tr >
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

                <tbody style="background:#57A639;">
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
   <?php $selExis = $con->query("SELECT * FROM existenca WHERE EXISTENCIA =0");?>

  <div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <table class="bordered centered" align="center">
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

                <tbody style="background: #F54021;">
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
  <h1><?php echo $dato; ?></h1>
  <div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <table class="bordered centered" align="center">
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

                <tbody >
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
                  <tr style="background-color:#57A639;">
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
                    <tr style="background: #F54021;">
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


	
</body>
</html>