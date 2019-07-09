<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require_once '../../conexion/conexion.php';
    require_once '../../extend/helpers.php';
    header("Content-Type: application/json; charset=utf-8");
    $money = filter_input(INPUT_POST, 'money');
    $dato = array();
    $dato['warning'] = null;
    $dato['change'] = null;
    $dato['pedido'] = null;
    if (is_numeric($money)) {
        $subtotal = 0;
        $descuento = 0;
        $total = 0;
        $id_usuario = $_SESSION['id'];
        if (isset($_SESSION['medicamento']['cart'])) {
            foreach ($_SESSION['medicamento']['cart'] as $index => $value) {
                
                $value['descuento'] = (strlen($value['descuento']) == 0)? 0 : $value['descuento'];
                $subtotal += ($value['precio'] * $value['unidad']);
                $descuento += ($value['precio'] * $value['unidad']) * ($value['descuento'] / 100);
                $total += ($value['precio'] * $value['unidad']) - ($value['precio'] * $value['unidad']) * $value['descuento'] / 100;
                
            }

            if ($money >= $total) {
                $pedido = crea_pedido($money, $total, $id_usuario, $descuento);
                
                
                if (is_int($pedido)) {
                    foreach ($_SESSION['medicamento']['cart'] as $index => $value) {
                        $value['descuento'] = (strlen($value['descuento']) == 0)? 0 : $value['descuento'];
                        efectua_compra($value['unidad'], $value['descuento'], $value['precio'], $value['cve_medicamento'], $pedido);
                        unset($_SESSION['medicamento']['cart']);
                    }
                      $dato['change'] = $money - $total;
                      $dato['pedido'] = $pedido;
                } else {
                    $dato['warning'] = "No se puede hacer el pedido";
                }
            } else {
                $dato['warning'] = "No se pudo efectuar el pago porque el efectivo es menor que el monto a pagar";
            }
        } else {
            $dato['warning'] = "No hay ningún valor establecido";
        }
    } else {
        $dato['warning'] = "Este efectivo no es valido. Por favor ingrese uno valido";
    }

    echo json_encode($dato);
} else {
    header("../");
}