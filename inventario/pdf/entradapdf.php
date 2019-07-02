<?php
require_once "../../conexion/conexion.php";
$fechaInicio = $con->real_escape_string(htmlentities($_SESSION['fecha_in']));
$fechaFin = $con->real_escape_string(htmlentities($_SESSION['fecha_fin']));

require_once __DIR__.'/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

ob_start();
require_once 'html/entrada_html.php';
$html = ob_get_clean();
$html2pdf = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8');
$html2pdf->setDefaultFont('Arial');
$html2pdf->writeHTML($html);
$html2pdf->output('Generador_pdf.pdf');
