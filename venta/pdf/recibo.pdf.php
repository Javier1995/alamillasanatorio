<?php

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

require_once '../../vendor/autoload.php';
require_once '../../conexion/conexion.php';
require_once '../../extend/helpers.php';
$nota = filter_input(INPUT_GET, 'pe');
$atendio = recibo_pedido($nota);
$pedidos = datos_pedidos($nota);

try {
    ob_start();
    include 'recibo.html.php';
    $content = ob_get_clean();
    $html2pdf = new Html2Pdf('P', 'A4', 'fr');
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);
    $html2pdf->output('nota.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();
    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
