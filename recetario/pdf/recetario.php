<?php
require_once "../../conexion/conexion.php";
require_once '../../vendor/autoload.php';
use Fpdf\Fpdf as FPDF;
if(isset($_GET['re']) && isset($_SESSION['nick']) ) {  
    
require_once '../../extend/helpers.php';
$receta = getReceta($_GET['re']);
header("Content-type:application/pdf");
$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
//Times negrita 12
$pdf->SetFont('Times', 'B', 10);
$pdf->SetTitle('Receta', true);
$pdf->SetLineWidth(2);
$pdf->SetDrawColor(130, 80, 200);
$pdf->Line(1, 137.5, 215, 137.5);
$pdf->SetLineWidth(0.2);
$pdf->SetDrawColor(0, 0, 0);
$pdf->Image('img/receta.jpg', 0 , 0.2, 216.5, 137, 'JPG');

$pdf->SetXY(2,40);
$pdf->Cell(60, 5, "Paciente:");
$pdf->SetXY(72,40);
$pdf->Cell(60, 5, "Edad:");
$pdf->SetXY(97,40);
$pdf->Cell(30, 5, "Fecha nacimiento:");
$pdf->SetXY(142,40);
$pdf->Cell(30, 5, "Folio:");
$pdf->SetXY(2,44);
$pdf->Cell(30, 5, "Diagnostico:");
$pdf->SetXY(2,83);
$pdf->Cell(30, 5, "Medicamento:");
$pdf->SetXY(2,120);
$pdf->Cell(30, 5, utf8_decode("Fecha expedición:".' '.$receta['fecha']));


$pdf->SetFont('Times', '', 9);
$pdf->SetXY(17,40);
$pdf->MultiCell(60, 5, ucwords(strtolower($receta['paciente'])));
$pdf->SetXY(82,40);
$pdf->MultiCell(60, 5, utf8_decode(ucwords(strtolower($receta['edad'])).' Año(s)'));
$pdf->SetXY(125,40);
$pdf->MultiCell(60, 5, $receta['nacimiento']);
$pdf->SetXY(153,40);
$pdf->Cell(30, 5, $receta['folio']);
$pdf->SetXY(2,48);
$pdf->MultiCell(176, 3,  utf8_decode(ucwords(strtolower($receta['diagnostico']))));
$pdf->SetXY(2,87);
$pdf->MultiCell(176, 3,  utf8_decode(ucwords(strtolower($receta['medicamento']))));


$pdf->Output();

} else {
    
    header("Location:../../");
    
}
?>

<p>lorem*4</p>