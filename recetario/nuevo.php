<?php include_once './selected.php';?>
<?php include_once '../extend/header.php'; ?>
    <?php if ($_SESSION['nivel'] == 'ADMINISTRADOR' || $_SESSION['nivel'] == 'MEDICO'): ?>

    <div class="row ">

        <div class="col s12 l8 offset-l2">

            <div class="card">
                <div class="card-content">
                    <span class="card-title">Datos</span>
                    <form action="#">

                        <div class="row">

                            <div class="col s12 l4 input-field fadeInRight  animated fast delay-1s">
                                <label for="nombre">Nombre</label>
                                <input  type="text" id="nombre" onkeyup="may(this.value, this.id)" autofocus="on">

                            </div>
                            <div class="col s12 l5 input-field fadeInRight  animated fast delay-1s">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" id="apellidos" onkeyup="may(this.value, this.id)">

                            </div>

                            <div class="col s12 l3 input-field">
                                <label for="nacimiento">Fecha de nacimiento</label>
                                <input type="text" id="nacimiento" class="datepicker">

                            </div>
                        </div>
                         
                        <div class="row">
                            
                            <button class="btn col s6 l3" onclick="guardar_paciente(event)" type="submit">Guardar<i class="material-icons right" >send</i></button>
                
                        <a href="./" class="btn red col s6 l3">Regresar<i class="material-icons right">arrow_back</i></a>
                            
                        </div>
                        
                    </form>

                </div>
            </div>

        </div>

        </div>

<div class="row">
    <div class="col s12 l6 offset-l3"><div id="respuesta"></div></div>
</div>

  
    <?php include_once '../extend/errorMessage.php' ?>
     <?php include_once '../extend/scripts.php'; ?>
    <?php include_once '../extend/footer.php'; ?>
    <script src="app_recetario.js"></script>
    
    </body>
    </html>
<?php else: header("Location:../"); ?>

<?php endif; ?>

<?php Elimina_id_url(); ?>