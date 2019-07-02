<?php
require_once '../../conexion/conexion.php';
$dato = array();
$dato['warning'] = null;
if(isset($_SESSION['medicamento']['cart'])){
    unset($_SESSION['medicamento']['cart']);
    $dato['warning'] = 'delete';
} else {
    $dato['warning'] = 'error';
}

echo json_encode($dato);