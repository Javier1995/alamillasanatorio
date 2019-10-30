<?php
require_once '../autoload.php';
use Medicamento\Medicamento;
header("Content-type: application/json; charset=utf-8");
//DATOS DE ENTRADA
$search = $_POST['search'];
$current_page =(!empty($_POST['page']) && $_POST['page'] > -1)? $_POST['page'] - 1 : 0;
$limit = (!empty($_POST['limit']) && $_POST['limit'] >= 1)? $_POST['limit'] : 5;
$offset = 0 + ($current_page * $limit);

//LISTA DE MEDICAMENTO
$med = new Medicamento();
$rows = $med->getMedication($search);
$medicamentos = $med->getMedication($search, $offset, $limit);


$paginas = ceil($rows->num_rows/$limit);
$adjacent = 2;
$json_data = array();
$header = array('Codigo','Nombre Comercial', 'Formula','Presentacion' ,'Categoria','Precio Entrada' ,'Precio salida','stock Minimo', 'En inventario');
$json_data = array('datos'=>array(),'pages'=>$paginas, 'current_page'=>$current_page, 'adjacent'=>$adjacent, 'limit'=>$limit, 'header'=>$header, 'search'=>$search);

while($medicamento = $medicamentos->fetch_assoc()){

     //Coloca inventario
     $med->setCve_medicamento($medicamento['cve_medicamento']);
     $medicamento['inventario'] = $med->medicationStock();
     array_push($json_data['datos'], $medicamento);

}

echo json_encode($json_data, JSON_INVALID_UTF8_SUBSTITUTE);

