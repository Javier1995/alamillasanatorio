<?php
require '../conexion/conexion.php';

$nick = $con->real_escape_string($_POST['nick']);

$sel = $con->query("SELECT id FROM usuarios WHERE nick = '$nick' ");

$row = mysqli_num_rows($sel);
?>
<?php if($row != 0): ?>
  <label style="color:red;">El usuarios ya existe <i class="material-icons">close</i></label>
<?php else: ?>
  <label style="color:green;">El usuario esta disponible <i class="material-icons">check</i></label>
<?php endif; ?>
<?php $con->close(); ?>
