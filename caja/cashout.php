<?php
session_start();
require_once '../autoload.php';
use Caja\Caja;
$location = "Location:index.php";
if(isset($_SESSION['nick'])=='admin') {
    $caja = new Caja();
    $caja->setIdUser($_SESSION['id']);
    $resultado = $caja->createNewCashOut();

    if(is_bool($resultado) and $resultado == true) {

        $location = "location:../extend/alert.php?ms=El corte de caja fue efectuado correctamente&c=caja&p=in&t=success";

    } else {

        $location = "location:../extend/alert.php?ms=No hay ningun pedido para corte de caja&c=caja&p=in&t=error";
    }



}

header($location);