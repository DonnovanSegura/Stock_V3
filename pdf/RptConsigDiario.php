<?php 

	include 'plantilla.php';
	include 'db_connect.php';

	ini_set('date.timezone', 'America/Mexico_City');
	$fecha = date('d/m/Y');

	$query = "SELECT orders.id_order, orders.client_id, orders.fecha_add, orders.total_neto, orders.descuento, orders.total, orders.metodo, orders.fecha_liqui, orders.user_add_id, user.id_user, user.nombre,
			  client.id_client, client.nombre_cte
			  FROM orders
			  INNER JOIN user
			  ON orders.user_add_id = user.id_user
			  INNER JOIN client
			  ON orders.client_id = client.id_client
			  WHERE orders.fecha_add = '$fecha' AND tipo_orden = 1";
	$resultado = $connect->query($query);


	$pdf = new ConsigDiario('L');
	$pdf->AliasNbPages();
	$pdf->AddPage();
		
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
		$pdf->Cell(35,6,'$'.number_format($row['total_neto'],2,'.',','),1,0,'C');
		$pdf->Cell(20,6,'$'.number_format($row['descuento'],2,'.',','),1,0,'C');
		$pdf->Cell(35,6,'$'.number_format($row['total'],2,'.',','),1,0,'C');
		$pdf->Cell(20,6,$row['fecha_liqui'],1,0,'C');
		$pdf->Cell(30,6,utf8_decode($row['nombre']),1,1,'C');
		
		
	}

		$pdf -> SetFont('Arial', 'B', 9);
		$pdf->SetFillColor(232,232,232);
		$pdf -> Cell(187,6,'',0);
		$pdf -> Cell(35,6,'Total: $'.number_format($totalGasto,2,'.','.'),1,1,'L',1);




	$pdf->Output(utf8_decode('Consignaciones Diarias.pdf'), 'I');
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