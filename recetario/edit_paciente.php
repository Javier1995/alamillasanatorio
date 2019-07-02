<?php include_once './selected.php';?>
<?php include_once '../extend/header.php';?>
<?php if ($_SESSION['nivel'] == 'ADMINISTRADOR' || $_SESSION['nivel'] == 'MEDICO'): ?>
    <?php
    if (!isset($_SESSION['edit'])) {

        $_SESSION['edit'] = $_GET['edit'];
        
        $dato = $_SESSION['edit'];
    } else {

        $dato = $_SESSION['edit'];
        
    }
    
    if (isset($dato)) {
        $id = $con->real_escape_string(htmlentities($dato));
        $paciente = mostrar_paciente($id);
     }
    
    
    ?>

    <div class="row ">

        <div class="col s12 l8 offset-l2">

            <div class="card">
                <div class="card-content">
                    <span class="card-title">Editar datos del paciente</span>
                    <form action="#">

                        <div class="row">

                            <div class="col s12 l4 input-field fadeInRight  animated fast delay-1s">
                                <label for="nombre">Nombre</label>
                                <input value="<?=$paciente['nombre']?>" type="text" id="nombre" onkeyup="may(this.value, this.id)" autofocus="on">

                            </div>
                            <div class="col s12 l5 input-field fadeInRight  animated fast delay-1s">
                                <label for="apellidos">Apellidos</label>
                                <input value="<?=$paciente['apellidos']?>" type="text" id="apellidos" onkeyup="may(this.value, this.id)">

                            </div>

                            <div class="col s12 l3 input-field">
                                <label for="nacimiento">Fecha de nacimiento</label>
                                <input value="<?=$paciente['fecha_nacimiento']?>" type="text" id="nacimiento" class="datepicker">

                            </div>
                        </div>

                        <div class="row">

                            <button class="btn col s6 l3" onclick="edit_paciente(event, '<?=$id?>')" type="submit">Editar<i class="material-icons left" >edit</i></button>
                            <a href="./" class="btn red col s6 l3">Regresar<i class="material-icons left">arrow_back</i></a>
                            <a href="paciente.php?paciente=<?=$id?>" class="btn blue col s6 l3" title="Generar nueva consulta a este paciente">Nueva consulta<i class="material-icons left">add</i></a>

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
<?php else: header("Location:./"); ?>

<?php endif; ?>

<?php Elimina_id_url() ?>