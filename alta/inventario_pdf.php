<?php

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
require_once '../autoload.php';
use Medicamento\Medicamento;
require_once '../vendor/autoload.php';
require_once '../conexion/conexion.php';
require_once '../extend/helpers.php';

//LISTA DE MEDICAMENTO
$med = new Medicamento();
$medicamentos = $med->getMedication();

try {
    ob_start();
    include 'pdf_inventario/invenatio_html.php';
    $content = ob_get_clean();
    $html2pdf = new HTML2PDF('L', 'A4', 'en');
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);
    $html2pdf->output('nota.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();
    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
