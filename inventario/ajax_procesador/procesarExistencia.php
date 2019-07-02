<?php


require_once "../../conexion/conexion.php";
$_SESSION['dato'] = $_POST['dato'];
echo "<script>window.open('pdf/existenciapdf.php','_blank');</script>";

