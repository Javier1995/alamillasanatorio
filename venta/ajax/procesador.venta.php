<?php

require_once '../../conexion/conexion.php';
require_once '../../extend/helpers.php';

use Medicamento\Medicamento;
header("Content-Type: application/json; charset=utf-8");
$barcode = filter_input(INPUT_POST, 'codigo');
$medicine = medicine_exists($barcode);
if (!isset($_SESSION['medicamento']['cart'])) {
    $_SESSION['medicamento']['cart'] = array();
}

if (!empty($barcode)) {
    //Validacion de existencia
    if ($medicine->num_rows != 0) {

        //Verifica el stock
        $data = $medicine->fetch_object();
        $stock = medicationStock($data->cve_medicamento);
        if (!empty($_SESSION['medicamento']['cart']) && count($_SESSION['medicamento']['cart']) >= 1) {
            foreach ($_SESSION['medicamento']['cart'] as $index => $value) {

                if ($value['cve_medicamento'] == $barcode) {
                    $stock_envia = $_SESSION['medicamento']['cart'][$index]['unidad'];
                    $nombre = $_SESSION['medicamento']['cart'][$index]['nombre_generico'];
                }
            }
        }

        if ($stock == 0) {
            $_SESSION['medicamento']['warning'] = "No hay stock para este medicamento";
        } elseif (isset($stock_envia) && $stock == $stock_envia) {
            $_SESSION['medicamento']['warning'] = "El medicamento {$nombre} cuenta con un stock disponible de $stock pieza(s)";
        } else {

            $total = 0;
            if (isset($_SESSION['medicamento']['cart'])) {
                $cart = $_SESSION['medicamento']['cart'];
                $cont = 0;

                foreach ($cart as $index => $value) {

                    if ($value['cve_medicamento'] == $barcode) {
                        $_SESSION['medicamento']['cart'][$index]['unidad'] ++;
                        $cont++;
                    }
                }
            }


            if (!isset($cont) || $cont == 0) {
                $_SESSION['medicamento']['cart'][] = array(
                    'cve_medicamento' => $data->cve_medicamento,
                    'precio' => $data->precio_venta,
                    'unidad' => 1,
                    'nombre_generico' => $data->nombre_generico,
                    'nombre_comercial' => $data->nombre_comercial,
                    'presentacion' => $data->presentacion,
                    'descuento' => 0
                );
            }
        }
    } else {

        $_SESSION['medicamento']['error'] = "Este medicamento no existe";
    }
}

// Agrega el descuento de los productos
if (isset($_POST['codigo_desc']) && isset($_POST['descuento']) && isset($_SESSION['medicamento']['cart'])) {
    $codigo_descuento = $_SESSION['medicamento']['cart'];
    $desc = filter_input(INPUT_POST, 'descuento', FILTER_SANITIZE_NUMBER_INT);
    if ($desc >= 0 && $desc <= 100) {
        foreach ($codigo_descuento as $index => $value) {
            if ($value['cve_medicamento'] == $_POST['codigo_desc']) {
                $_SESSION['medicamento']['cart'][$index]['descuento'] = $desc;
            }
        }
    }else {
         $_SESSION['medicamento']['warning'] = 'Descuento no valido ingrese del 1 a 100 tomado como %';
    }
}

if (!empty($_POST['borrar'])) {
    foreach ($_SESSION['medicamento']['cart'] as $index => $value) {
        if ($value['cve_medicamento'] == $_POST['codigo_desc']) {
            $_SESSION['medicamento']['success'] = 'El producto ha sido eliminado';
            unset($_SESSION['medicamento']['cart'][$index]);
            $_SESSION['medicamento']['cart'] = array_values($_SESSION['medicamento']['cart']);
        }
    }
}

echo json_encode($_SESSION['medicamento']);
//Eliminacion de mensajes
deleteSession('error');
deleteSession('warning');
deleteSession('success');
