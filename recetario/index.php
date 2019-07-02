<?php include_once './selected.php';?>
<?php include_once '../extend/header.php'; ?>
<link rel="stylesheet" href="css/style_scroll.css">
<?php if ($_SESSION['nivel'] == 'ADMINISTRADOR' || $_SESSION['nivel'] == 'MEDICO'): ?>
    <?php
    $pacientes = atendidos_hoy();
    $num_rows = $pacientes->num_rows;
    $num_pacientes = num_pacientes();
    $num_recetas   = num_recetas();
    
    ?>

    <div class="row ">

        <div class="col s12 l6 fadeInRight  animated fast delay-1s">

            <div class="card">
                <div class="card-content">

                    <form action="#" method="POST" id="form-busqueda">
                        <div class="row">

                            <div class="col l12 s12 input-field">
                                <label for="busqueda-paciente">Buscar paciente</label>
                                <input type="text" id="paciente" autofocus="on" onkeyup="may(this.value, this.id)">

                            </div>

                        </div>
                        <div class="row">
                            <div class="col s6 l4 ">
                                <a id="busca-paciente" type="submit" class="btn" href="#" accesskey="s"><i class="material-icons left">search</i> Buscar</a>
                            </div>
                            <div class="col s6 l4 ">
                                <a href="nuevo" class="btn"> <i class="material-icons left">person_add</i> Registrar</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>

        <div class="col s12 l6 animated fadeInUp fast delay-1s">

            <div class="card">

                <div class="card-content">

                    <span class="card-title">Pacientes antendidos 24 horas</span>
    <?php if ($num_rows != 0): ?>
                        <table class="striped highlight">

                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Paciente</th>
                                    <th>Atendido por</th>
                                    <th>Hora</th>
                                    <th>Receta</th>

                                </tr>
                            </thead>
                            <tbody>
        <?php while ($paciente = $pacientes->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $paciente['folio'] ?></td>
                                        <td><?= $paciente['paciente'] ?></td>
                                        <td><?= $paciente['medico'] ?></td>
                                        <td><?= $paciente['hora'] ?></td>
                                        <td><a class="btn-floating" target="_blank" href="pdf/recetario.php?re=<?= $paciente['folio'] ?>"><i class="material-icons">picture_as_pdf</i></a></td>

                                    </tr>
        <?php endwhile; ?>
                            </tbody>


                        </table>
    <?php else: ?>

                        <h5>No se han atendido pacientes por el momento</h5>

    <?php endif; ?>

                </div>

            </div>



        </div>
    </div>

    <div class="row">
        <div class="col s12 l6 fadeInUp  animated fast delay-2s">

            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div id="tabla-pacientes" class="col s12 l12"><h4>Busqueda paciente</h4></div>
                    </div>
                </div>
            </div>

        </div>
        
        <div class="col s12 l3 fadeInUp  animated fast delay-2s">

            <div class="card blue purple">
                <div class="card-content">
                    <span class="card-title">Consultas</span>
                    <div class="row">
                         <div class="col s6 l6 ">
                            
                            <h2><?=$num_recetas['recetas']?></h2>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
         <div class="col s12 l3 fadeInUp  animated fast delay-2s">

            <div class="card orange">
                <div class="card-content">
                    <span class="card-title">Pacientes</span>
                    <div class="row">
                        <div class="col s6 l6">
                            
                            <h2><?=$num_pacientes['pacientes']?></h2>                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <?php include_once '../extend/errorMessage.php' ?>
    <?php include '../extend/scripts.php'; ?>
    <?php include_once '../extend/footer.php'; ?>
    <script src="./app_recetario.js"></script>

    <script src="../js/validacion_user.js"></script>

    </body>
    </html>
<?php else: header("Location:../"); ?>

<?php endif; ?>

<?php Elimina_id_url(); ?>