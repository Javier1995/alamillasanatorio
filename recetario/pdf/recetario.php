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
$pdf->SetFont('Times', 'B', 14);
$pdf->SetTitle('Receta', true);
$pdf->SetLineWidth(2);
$pdf->SetDrawColor(130, 80, 200);
$pdf->Line(1, 137.5, 215, 137.5);
$pdf->SetLineWidth(0.2);
$pdf->SetDrawColor(0, 0, 0);
//$pdf->Image('img/receta.jpg', 0 , 0.3, 216.3, 136, 'JPG');
$pdf->SetXY(140,40);
$pdf->Cell(30, 5, 'Folio');
$pdf->SetXY(2,40);
$pdf->Cell(60, 5, "Paciente:");
$pdf->SetXY(2,50);
$pdf->Cell(30, 5, "Medicamento:");
$pdf->SetXY(4,119);
$pdf->Cell(30, 5, utf8_decode("Fecha expedición:".' '.$receta['fecha']));


$pdf->SetFont('Times', '', 12);
$pdf->SetXY(24,40);
$pdf->MultiCell(60, 5, ucwords(strtolower($receta['paciente'])));
$pdf->SetXY(153,40);
$pdf->Cell(30, 5, $receta['folio']);
$pdf->SetXY(2,56);
$pdf->MultiCell(176, 3,  utf8_decode(ucwords(strtolower($receta['medicamento']))));
$pdf->Output();

} else {
    
    header("Location:../../");
    
}
?>

