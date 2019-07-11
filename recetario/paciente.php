<?php include_once './selected.php';?>
<?php include_once '../extend/header.php'; ?>
    <?php if ($_SESSION['nivel'] == 'ADMINISTRADOR' || $_SESSION['nivel'] == 'MEDICO'): ?>

    <?php
    //Evitar el cambio en el id
    if (!isset($_SESSION['paciente'])) {

        $_SESSION['paciente'] = $_GET['paciente'];
        $dato = $_SESSION['paciente'];
    } else {

        $dato = $_SESSION['paciente'];
    }
    if (isset($dato)) {
        $id = $con->real_escape_string(htmlentities($dato));
        $paciente = mostrar_paciente($id);
        
       $historiales = historial_paciente($id);
       $num_row = $historiales->num_rows;
       
    }
    

    ?>
<link rel="stylesheet" href="css/style_scroll.css">
    <div class="row ">

        <div class="col s12 l8 fadeInRight  animated fast delay-1s">

            <div class="card">
                <div class="card-content" id="resultado_receta">
                    
                    <span class="card-title">Nueva receta</span>
                    <form action="#" method="POST">

                        <div class="row">

                            <div class="col s12 l6 input-field">
                                <label for="nombre">Paciente</label>
                                <input value="<?=$paciente['nombre'].' '.$paciente['apellidos']?>" type="text" id="nombre" onkeyup="may(this.value, this.id)" readonly>

                            </div>

                            <!-- <div class="col s12 l3 input-field">
                                <label for="nacimiento">Fecha de nacimiento</label>
                                <input type="text" id="nacimiento" value="<?=$paciente['fecha_nacimiento']?>" readonly> 

                            </div>

                            <div class="col s12 l2 input-field">
                                <label for="edad">Edad</label>
                                <input type="text" id="edad" value="<?=$paciente['edad'].' AÑOS'?>" readonly>

                            </div> -->

                        </div>

                        <div class="row">

                            <!-- <div class="col s12 l6 input-field">
                                <label for="diagnosticoNuevo">Diagnostico</label>
                                <textarea type="text" id="diagnosticoNuevo" class="materialize-textarea" onkeyup="may(this.value, this.id)" data-length="1318" maxlength="1318"></textarea>

                            </div> -->

                            <div class="col s12 l12 input-field">
                                <label for="medicamentoNuevo">Medicamento</label>
                                <textarea type="text" id="medicamentoNuevo" class="materialize-textarea" onkeyup="may(this.value, this.id)" data-length="1318" maxlength="1318"></textarea>

                            </div>

                        </div>

                        <button class="btn" type="submit" onclick="guardar_receta_medica('<?=$paciente['id']?>', event)">Guardar<i class="material-icons right">send</i></button>
                        <a href="./" class="btn red">Regresar<i class="material-icons right">arrow_back</i></a>
                    </form>

                </div>
            </div>
            
       </div>

        <div class="col s12 l4 fadeInUp animated fast delay-1s">

            <div class="card">
                <div class="card-content">
                    <span class="card-title">Historial de recetas del paciente</span>
                   <?php if($num_row != 0):?>
                    
                    <table>
                        <thead>
                            <tr>
                                <th>Folio</th>
                                <th>Fecha/Hora</th>
                                <th>Imprimir</th>
                                <th>Editar</th>
                               

                            </tr>
                        </thead>
                        <tbody>
                            <?php while($historial = $historiales->fetch_assoc()):?>
                           
                            <tr>
                                <td><?=$historial['folio']?></td>
                                <td><?=$historial['fecha']?></td>
                                <td><button onclick="printJS({printable:'<?=RUTA_BASE?>recetario/pdf/recetario.php?re=<?=$historial['folio']?>', type:'pdf', showModal:true})" class="btn-floating"> <i class="material-icons">picture_as_pdf</i></button></td>
                                <td><a href="edit_receta.php?re=<?=$historial['folio']?>" class="btn-floating" <?=($historial['id_usuario']==$_SESSION['id'] || $_SESSION['nivel']=='ADMINISTRADOR')? '': 'disabled'?> > <i class="material-icons">edit</i></a> </td>
                            </tr>
                             <?php endwhile;?>
                        </tbody>
                    </table>
                   
                    <?php else:?>
                        
                       <h5>No hay historial de este paciente</h5>
                    
                    <?php endif;?>

                </div>
            </div>

        </div>


    </div>
    <div class="row">
                <div class="col s12 l6 offset-l3" id="carga"></div>
    </div>

    <?php include_once '../extend/errorMessage.php' ?>
    <?php include '../extend/scripts.php'; ?>
    <?php include_once '../extend/footer.php'; ?>
    <script src="./app_recetario.js"></script>
   

    </body>
    </html>
<?php else: header("Location:../"); ?>

<?php endif; ?>

