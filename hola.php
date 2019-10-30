<?php
include 'autoload.php';
use Medicamento\Medicamento;

$medicamento = new Medicamento();
$medicamento->setCve_medicamento('4444444444444');
echo $medicamento->medicationStock();