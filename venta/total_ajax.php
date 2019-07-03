<?php
require_once '../autoload.php';
use Caja\Caja;
$caja = new Caja();
$pedidos = $caja->getOrders();
$resultado = array();
$total = 0;
$productos = 0;
//Comments
while($pedido = $pedidos->fetch_object()){
    $total+= $pedido->total;
    $productos+= $caja->getCantidadProducto($pedido->id);
}
$resultado['total'] = $total;
$resultado['productos'] = $productos;
echo json_encode($resultado);