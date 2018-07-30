<?php 


	$desde = date('d/m/Y', strtotime($_GET['desde']));
	$hasta = date('d/m/Y', strtotime($_GET['hasta']));

	include 'db_connect.php';
	require 'fpdf/fpdf.php';

	$query = "SELECT gasto.id_gasto, gasto.fecha_add, gasto.concepto, gasto.monto, gasto.monto, gasto.user_add, user.id_user, user.nombre 
	          FROM gasto
	          INNER JOIN user
	          ON gasto.user_add = user.id_user
	          WHERE gasto.fecha_add BETWEEN '$desde' AND '$hasta' ";
	$resultado = $connect->query($query);
	
	$pdf = new FPDF('L');
	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Cell(245, 6, 'Reporte de Gastos',0,0,'C');
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(30, 6, 'Hoy: '.date('d/m/Y').'',0,1,'R');
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(90,6,'',0,0);
	$pdf->Cell(80,6, 'Desde: '.$desde.' 		Hasta: '.$hasta,0,1);
	$pdf->Ln(2);


	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(15,6,'Folio',1,0,'C',1);
	$pdf->Cell(20,6,'Fecha',1,0,'C',1);
	$pdf->Cell(120,6,'Concepto',1,0,'C',1);
	$pdf->Cell(30,6,'Monto',1,0,'C',1);
	$pdf->Cell(30,6,'Usuario',1,1,'C',1);

	$totalGasto = 0;
	while($row = $resultado->fetch_assoc() ){
		$totalGasto = $totalGasto + $row['monto'];
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(15,6,$row['id_gasto'],1,0,'L');
		$pdf->Cell(20,6,utf8_decode($row['fecha_add']),1,0,'L');
		$pdf->Cell(120,6,utf8_decode($row['concepto']),1,0,'L');
		$pdf->Cell(30,6,"$".number_format($row['monto']),1,0,'C');
		$pdf->Cell(30,6,utf8_decode($row['nombre']),1,1,'L');
		
	}

		$pdf -> SetFont('Arial', 'B', 9);
		$pdf->SetFillColor(232,232,232);
		$pdf -> Cell(155,6,'',0);
		$pdf -> Cell(30,6,'Total: $'.number_format($totalGasto,2,'.',','),1,1,'L',1);


	$pdf->Output('Historial_Gastos_Fechas.pdf', 'I');
	#$pdf->Output('D');
	#$pdf->Output('F','Catalogo de Clientes');


	




	$pdf->Output(utf8_decode('Consignaciones por Fechas.pdf'), 'I');
	#$pdf->Output('D');
	#$pdf->Output('F','Catalogo de Clientes');

	/**
	* Documentacion
	*$pdf->Cell(70,6,'Direccion',1,0,'C',1);
	*60->Longitud
	*6-> Alto
	*1-> Borde
	*0-> No tiene Salto de Linea, 1-> Si tiene salto de Linea
	*C-> Centrado
	*1-> Relleno (Color)
	*
	*/

?>