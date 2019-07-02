<?php
require_once "../../conexion/conexion.php";
$fecha_in = $_POST['fecha_in'];
$fecha_fin = $_POST['fecha_fin'];

$_SESSION['fecha_in'] = $fecha_in;
$_SESSION['fecha_fin'] = $fecha_fin;

echo "<script>window.open('pdf/entradapdf.php','_blank');</script>";

 ?>
