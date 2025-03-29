<?php
require_once('vendor/autoload.php');

$pdf = new TCPDF();
$pdf->addPage();
$pdf->setFont('Helvetica', '', 12);
$pdf->Cell(0, 10 , 'Reporte de ventas' , 1 , 1 , 'C');
$pdf->Output('reporteDeVentas', 'D');