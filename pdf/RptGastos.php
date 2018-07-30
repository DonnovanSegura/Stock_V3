<?php 

	include 'plantilla.php';
	include 'db_connect.php';

	$query = "SELECT gasto.id_gasto, gasto.fecha_add, gasto.concepto, gasto.monto, gasto.monto, gasto.user_add, user.id_user, user.nombre 
	          FROM gasto
	          INNER JOIN user
	          ON gasto.user_add = user.id_user ";
	$resultado = $connect->query($query);


	$pdf = new Gastos('L');
	$pdf->AliasNbPages();
	$pdf->AddPage();

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
		$pdf -> Cell(30,6,'Total: $'.number_format($totalGasto),1,1,'L',1);


	$pdf->Output('Historial_Gastos.pdf', 'I');
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