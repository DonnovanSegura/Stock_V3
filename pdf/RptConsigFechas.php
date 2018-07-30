<?php 


	$desde = date('d/m/Y', strtotime($_GET['desde']));
	$hasta = date('d/m/Y', strtotime($_GET['hasta']));

	include 'db_connect.php';
	require 'fpdf/fpdf.php';

	$query = "SELECT orders.id_order, orders.client_id, orders.fecha_add, orders.total_neto, orders.descuento, orders.total, orders.metodo, orders.fecha_liqui, orders.user_add_id, user.id_user, user.nombre, client.id_client, client.nombre_cte
	          FROM orders 
	          INNER JOIN user 
	          ON orders.user_add_id = user.id_user 
	          INNER JOIN client 
	          ON orders.client_id = client.id_client 
	          WHERE orders.fecha_add BETWEEN '$desde' AND '$hasta' AND tipo_orden = 1 ";
	$resultado = $connect->query($query);
	
	$pdf = new FPDF('L');
	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Cell(245, 6, 'Reporte de Consignaciones',0,0,'C');
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(30, 6, 'Hoy: '.date('d/m/Y').'',0,1,'R');
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(90,6,'',0,0);
	$pdf->Cell(80,6, 'Desde: '.$desde.' 		Hasta: '.$hasta,0,1);
	$pdf->Ln(2);


	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(15,6,'Folio',1,0,'C',1);
	$pdf->Cell(15,6,'Cod Cte',1,0,'C',1);
	$pdf->Cell(60,6,'Nombre Cte.',1,0,'C',1);
	$pdf->Cell(25,6,'Fcha. Consig',1,0,'C',1);
	$pdf->Cell(17,6,'Pago',1,0,'C',1);
	$pdf->Cell(30,6,'Sub Total',1,0,'C',1);
	$pdf->Cell(20,6,'Descuento',1,0,'C',1);
	$pdf->Cell(30,6,'Total',1,0,'C',1);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(20,6,'Fcha. Liquidar',1,0,'C',1);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(40,6,'Usuario',1,1,'C',1);

	$totalGasto = 0;
	while($row = $resultado->fetch_assoc() ){

		$totalGasto = $totalGasto + $row['total'];
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(15,6,$row['id_order'],1,0,'C');
		$pdf->Cell(15,6,$row['client_id'],1,0,'C');
		$pdf->Cell(60,6,utf8_decode($row['nombre_cte']),1,0,'C');
		$pdf->Cell(25,6,$row['fecha_add'],1,0,'C');
		
		if ($row['metodo'] == 1) {
			# code...
			$pdf->Cell(17,6,'Efectivo',1,0,'C');
		}else{
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(17,6,utf8_decode('Tarjeta Crédito'),1,0,'C');
		}
		
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(30,6,'$'.number_format($row['total_neto'],2,'.',','),1,0,'R');
		$pdf->Cell(20,6,'$'.number_format($row['descuento'],2,'.',','),1,0,'C');
		$pdf->Cell(30,6,'$'.number_format($row['total'],2,'.',','),1,0,'R');
		$pdf->Cell(20,6,$row['fecha_liqui'],1,0,'C');
		$pdf->Cell(40,6,utf8_decode($row['nombre']),1,1,'C');
		
		
	}

		$pdf -> SetFont('Arial', 'B', 8);
		$pdf->SetFillColor(232,232,232);
		$pdf -> Cell(182,6,'',0);
		$pdf -> Cell(30,6,'$'.number_format($totalGasto,2,'.',','),1,1,'R',1);


	




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