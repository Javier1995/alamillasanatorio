<?php
require_once '../autoload.php';
use Caja\Caja;
$id_detail = $_POST['id'];
$caja = new Caja();
$caja->setCashoutId($id_detail);
$pedidos = $caja->getOrdersByCashout();

$current_page =(!empty($_POST['page']) && $_POST['page'] > -1)? $_POST['page'] - 1 : 0;
$limit = (!empty($_POST['limit']) && $_POST['limit'] >= 1)? $_POST['limit'] : 5;
$offset = 0 + ($current_page * $limit);
$rows = $pedidos->num_rows;
$paginas = ceil($rows/$limit);
$adjacent = 2;


$header = array('Folio', 'Fecha', 'N° de productos' ,'Atendido por','Detalle');
$result = array('datos'=>array(),'pages'=>$paginas, 'current_page'=>$current_page, 'adjacent'=>$adjacent, 'limit'=>$limit, 'header'=>$header, 'rows'=>$rows);
$orders = $caja->getOrdersByCashout($limit, $offset);



$total_pedido_monto = 0;
$total_pedido= 0;
while($p = $pedidos->fetch_assoc()){
    $total_pedido_monto+=$p['total'];
    $total_pedido+= $caja->getCantidadProducto($p['id']);
}
$result['monto_total_por_pedido'] = $total_pedido_monto;
$result['total_pedido'] = $total_pedido;


while($order = $orders->fetch_assoc()){
    $order['n_productos'] = $caja->getCantidadProducto($order['id']);
    array_push($result['datos'], $order);
}



//Getting a json result
echo json_encode($result);


