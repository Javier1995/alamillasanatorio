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
$rows = $med->getEntries($search);
$entries = $med->getEntries($search, $offset, $limit);

//Paginas
$paginas = ceil($rows->num_rows/$limit);
$adjacent = 2;
$json_data = array();
$header = array('Codigo','Medicamento', 'Lote','Caducidad' ,'Cantidad', 'Fecha alta');
$json_data = array('datos'=>array(),'pages'=>$paginas, 'current_page'=>$current_page, 'adjacent'=>$adjacent, 'limit'=>(int)$limit, 'header'=>$header, 'search'=>$search);



//Returna
while($entrada = $entries->fetch_assoc()){
    
     array_push($json_data['datos'], $entrada);

}

echo json_encode($json_data, JSON_INVALID_UTF8_SUBSTITUTE);