<?php
$inicio = "";$venta = "";$alta = "";$caja = "";$catalogo = "";$recetario = "";$usuario  = "";$cambio  = "";
include_once'../extend/header.php';
require_once "cambiar_contrasena.php";
$selCat = $con->query("SELECT id, nombre FROM cat_niveles WHERE id !=1");
?>
<?php if (isset($_SESSION['nick'])): ?>
    <div class="row">
        <div class="col s12 m12 l12 xl12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Alta de usuarios</span>
                    <form class="form" action="ins_usuario.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col s12 m12 l12 xl12">
                                <div class="input-field">
                                    <input type="text" name="nick" required autofocus title="Debe escribir el nombre"  id="nick" onkeyup="may(this.value, this.id)" onchange="may(this.value, this.id)">
                                    <label for="nick">Usuario</label>
                                    <!--Resultado del ajax_validacion_nick.php -->

                                </div>
                                <div class="validacion"></div>
                            </div>


                        </div>


                        <div class="row">
                            <div class="col s12 m12 l6 xl6">
                                <div class="input-field">
                                    <input type="password" title="Escriba contraseña" id="pass1" name="pass1" required>
                                    <label for="pass1">Contraseña:</label>
                                </div>
                            </div>
                            <div class="col s12 m12 l6 xl6">
                                <div class="input-field">
                                    <input type="password" title="Escriba la verificación de la contraseña" id="pass2" required>
                                    <label for="pass2">Verificar Contraseña:</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="input-field col s12 m12 l4">
                                <!--Nivel de usuario -->
                                <select name="nivel">
                                    <option value="" selected disabled required>ELIGE UN NIVEL DE USUARIO</option>
                                    <?php while ($FetchData = $selCat->fetch_assoc()) { ?>
                                        <option value="<?php echo $FetchData['id']; ?>"><?php echo $FetchData['nombre']; ?></option>
    <?php } ?>
                                </select>
                            </div>
                            <div class="col s12 m12 l4 ">
                                <!--Nombre Completo del usuario-->
                                <div class="input-field">
                                    <input type="text" name="name" title="Coloca tu nombre" id="name" onkeyup="may(this.value, this.id)"  onchange="may(this.value, this.id)" required>
                                    <label for="name">Nombre</label>
                                </div>
                            </div>

                            <div class="col s12 m12 l4">
                                <!--apellidos del usuario-->
                                <div class="input-field">
                                    <input type="text" name="apellidos" title="Coloca tu nombre" id="apellidos" onkeyup="may(this.value, this.id)"  onchange="may(this.value, this.id)" required>
                                    <label for="apellidos">Apellidos</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn blue darken-5 waves-effect btn-medium" id="btn_guardar">Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12 m12 l12 xl12">
            <nav class="blue darken-1">
                <div class="nav-wrapper">
                    <div class="input-field">
                        <input type="search" id="buscar" autocomplete="off">
                        <label for="buscar" class="label-icon"><i class="material-icons" style="font-size:40px;">search</i></label>
                        <i class="material-icons">close</i>
                    </div>

                </div>

            </nav>
        </div>
    </div>

    <!-- Lista de usuarios -->
    <?php
    $sel = $con->query("SELECT u.* , c.nombre as 'nivel' FROM usuarios u INNER JOIN cat_niveles c ON c.id = u.id_nivel  WHERE id_nivel != 1");
    $row = $sel->num_rows;
    ?>

    <div class="row">
        <div class="col s12 l12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Usuarios(<?php echo $row ?>)</span>
                    <table class="responsive-table highlight centered bordered">
                        <thead>
                            <tr>
                                <th>Cuenta de usuario</th>
                                <th>Nombre</th>
                                <th>Cambiar Contraseña</th>
                                <th>Nivel</th>
                                <th>Bloqueo</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php while ($fetch = $sel->fetch_assoc()) { ?>
                                <tr>
                                    <td><?=$fetch['nick']; ?></td>
                                    <td><?= $fetch['nombre'] . ' ' . $fetch['apellidos']; ?></td>
                                    <td><button Onclick="cargar_cambio_contrasena('<?php echo $fetch['id'] ?>', '<?php echo $fetch['nick']; ?>');" class="btn-floating modal-trigger" href="#cambiar_contrasena" ><i class="material-icons">vpn_key</i></button></td>
                                    <td><?=$fetch['nivel']; ?></td>
                                    <td><?php if ($fetch['bloqueo'] == 1): ?>
                                            <a href="bloqueo_manual.php?id=<?=$fetch['id']; ?>&bl=<?=$fetch['bloqueo']; ?>"><i class="material-icons green-text">lock_open</i></a>
                                        <?php else: ?>
                                            <a href="bloqueo_manual.php?id=<?=$fetch['id']; ?>&bl=<?=$fetch['bloqueo']; ?>"><i class="material-icons red-text">lock_outline</i></a>
                                    <?php endif; ?>
                                    </td>
                                    <td><a href="#" class="btn-floating waves-effect red" onclick="swal({title:'¿Realmente quiere eliminar al usuario <?=$fetch['nick']?>?', text: '¡Una vez eliminado no podra recuperarlo!', icon: 'warning', buttons: true, dangerMode: true}).then((willDelete) => {
                                          if (willDelete) {
                                              location.href = 'eliminar_usuario.php?id=<?=$fetch['id'] ?>';
                                          } else {
                                              swal('¡El usuario no ha sido eliminado!');
                                          }
                                      });"><i class="material-icons">clear</i></a></td>
                                </tr>
    <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <?php include_once '../extend/footer.php'; ?>
    <?php include_once'../extend/scripts.php'; ?>
    <script src="../js/validacion_user.js"></script>
    </body>
    </html>
<?php else: header("Location:../"); ?>

<?php endif; ?>
