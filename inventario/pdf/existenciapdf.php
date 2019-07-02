<?php
require_once  "../../conexion/conexion.php";	
$dato = $con->real_escape_string(htmlentities($_SESSION['dato']));
require_once  __DIR__.'/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;


ob_start();
require_once 'html/existencia_html.php';
$html = ob_get_clean();
$html2pdf = new Html2Pdf('L', 'A4', 'es',true,'UTF-8');
$html2pdf->setDefaultFont('Arial');
$html2pdf->writeHTML($html);
$html2pdf->output('Existencia_pdf.pdf');

?>