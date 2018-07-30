<?php 

	require 'fpdf/fpdf.php';

	//$pdf = new FPDF();
	//$pdf = new FPDF('P','mm','legal');
	$pdf = new FPDF('L','mm',array(100,50));
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',11);

	//$pdf->SetX(50);
	$pdf->Cell(100, 10, 'Hola Mundo', 1, 1, 'L');
	//$pdf->SetXY(50,50);
	//$pdf->Cell(100, 10, 'Hola Mundo', 0, 1, 'L');

	//$pdf->MultiCell(100,5,'hola mundo lalsldlasldoadlaodsdslasdad',1,'L',0);
	$pdf->AddPage();
	$pdf->Output();


	

?>