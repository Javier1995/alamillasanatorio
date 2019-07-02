<?php 
$selEntrada = $con->query("SELECT CVE_MED_EN, NO_LOTE_EN,FECHA_CADUCIDAD, FECHA_ENTRADA,NO_PIEZAS FROM entrada_med WHERE FECHA_ENTRADA BETWEEN '$fechaInicio' AND '$fechaFin'");
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Generador de pdf</title>
	<style type="text/css">
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
				<h2>Reporte de Entrada de Medicamentos</h2>
			</div>

			
				<h4 class="center-elementos">Fecha de <?php echo $fechaInicio;?> al <?php echo $fechaFin; ?></h4>
		
				<div class="center-letra">
				<table class="center" align="center" style="margin: 0 auto;">
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

                $selMedicamento = $con->query("SELECT NOMBRE_GENERICO, NOMBRE_COMERCIAL FROM medicamento WHERE CVE_MED = '{$fetchEn['CVE_MED_EN']}'");
                while($fetchMed = $selMedicamento->fetch_assoc()){
                $gene = $fetchMed['NOMBRE_GENERICO'];
                $come = $fetchMed['NOMBRE_COMERCIAL'];
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
		


	
</body>
</html>

