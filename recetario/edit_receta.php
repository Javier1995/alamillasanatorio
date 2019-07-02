<?php include_once './selected.php';?>
<?php include_once '../extend/header.php'; ?>
    <?php if ($_SESSION['nivel'] == 'ADMINISTRADOR' || $_SESSION['nivel'] == 'MEDICO'): ?>

    <?php
    //Evitar el cambio en el id
    if (!isset($_SESSION['re'])) {

        $_SESSION['re'] = $_GET['re'];
        $dato = $_SESSION['re'];
    } else {

        $dato = $_SESSION['re'];
    }
    if (isset($dato)) {
        $id = $con->real_escape_string(htmlentities($dato));
        $paciente = mostrar_paciente($id);
        $receta = mostrar_receta($id);
        
        $historiales = historial_paciente($receta['id_paciente']);
        $num_row = $historiales->num_rows;
       
    }
    

    ?>
<link rel="stylesheet" href="css/style_scroll.css">
    <div class="row ">

        <div class="col s12 l8 fadeInRight  animated fast delay-1s">

            <div class="card">
                <div class="card-content" id="resultado_receta">
                    
                    <span class="card-title">Editar receta</span>
                    <form action="#" method="POST">

                        <div class="row">

                            <div class="col s12 l6 input-field">
                                <label for="nombre">Paciente</label>
                                <input value="<?=$receta['paciente']?>" type="text" id="nombre" onkeyup="may(this.value, this.id)" readonly>

                            </div>

                            <div class="col s12 l3 input-field">
                                <label for="nacimiento">Fecha de nacimiento</label>
                                <input type="text" id="nacimiento" value="<?=$receta['nacimiento']?>" readonly> 

                            </div>

                            <div class="col s12 l2 input-field">
                                <label for="edad">Edad</label>
                                <input type="text" id="edad" value="<?=$receta['edad'].' AÑOS'?>" readonly>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col s12 l6 input-field">
                                <label for="diagnosticoNuevo">Diagnostico</label>
                                <textarea type="text" id="diagnosticoNuevo" class="materialize-textarea" onkeyup="may(this.value, this.id)" data-length="1318" maxlength="1318"><?=$receta['diagnostico']?></textarea>

                            </div>

                            <div class="col s12 l6 input-field">
                                <label for="medicamentoNuevo">Medicamento</label>
                                <textarea type="text" id="medicamentoNuevo" class="materialize-textarea" onkeyup="may(this.value, this.id)" data-length="1318" maxlength="1318"><?=$receta['medicamento']?></textarea>

                            </div>

                        </div>

                        <button class="btn" type="submit" onclick="editar_receta_medica('<?=$receta['folio']?>', event)">Editar<i class="material-icons right">edit</i></button>
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
                                <th>Opciones</th>
                               

                            </tr>
                        </thead>
                        <tbody>
                            <?php while($historial = $historiales->fetch_assoc()):?>
                            <tr>
                                <td><?=$historial['folio']?></td>
                                <td><?=$historial['fecha']?></td>
                                <td><a href="pdf/recetario.php?re=<?=$historial['folio']?>" class="btn-floating" target="_blank"> <i class="material-icons">picture_as_pdf</i></a> </td>
                                <td><a href="edit_receta.php?re=<?=$historial['folio']?>" class="btn-floating"> <i class="material-icons">edit</i></a> </td>
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

