<?php
require_once '../autoload.php';
use Caja\Caja;

$current_page =(!empty($_POST['page']) && $_POST['page'] > -1)? $_POST['page'] - 1 : 0;
$limit = (!empty($_POST['limit']) && $_POST['limit'] >= 1)? $_POST['limit'] : 5;
$offset = 0 + ($current_page * $limit);

$caja = new Caja();
$rows = $caja->getOrders();
$num_rows = $rows->num_rows;
$paginas = ceil($num_rows/$limit);
$adjacent = 2;
$header = array('Folio','Fecha', 'N° de productos', 'Realizado por', 'Detalle');
$orders = array('datos'=>array(),'pages'=>$paginas, 'current_page'=>$current_page, 'adjacent'=>$adjacent, 'limit'=>$limit, 'header'=>$header, 'rows'=>$num_rows);

$pedidos = $caja->getOrders($limit, $offset);




$j = 0;

while($pedido = $pedidos->fetch_assoc()){
    $pedido['n_productos'] = $caja->getCantidadProducto($pedido['id']);
    array_push($orders['datos'], $pedido);
   $j++;
}


echo json_encode($orders);


