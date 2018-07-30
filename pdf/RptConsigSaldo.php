<?php 


	include 'plantilla.php';
	include 'db_connect.php';

	$query = "SELECT  orders.fecha_add, orders.id_order, orders.client_id, orders.total, orders.monto, orders.saldo, orders.fecha_liqui, client.id_client, client.nombre_cte
			  FROM orders 
			  INNER JOIN client
			  ON orders.client_id = client.id_client
			  WHERE  tipo_orden = 1 AND  saldo != 0";
	$resultado = $connect->query($query);


	$pdf = new ConsigSaldo('L');
	$pdf->AliasNbPages();
	$pdf->AddPage();

	while($row = $resultado->fetch_assoc() ){

		//$totalGasto = $totalGasto + $row['total'];
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(25,6,$row['fecha_add'],1,0,'C');
		$pdf->Cell(15,6,$row['id_order'],1,0,'C');
		$pdf->Cell(15,6,$row['client_id'],1,0,'C');
		$pdf->Cell(70,6,utf8_decode($row['nombre_cte']),1,0,'C');
		$pdf->Cell(30,6,'$'.number_format($row['total'],2,'.',','),1,0,'C');
		$pdf->Cell(30,6,'$'.number_format($row['monto'],2,'.',','),1,0,'C');
		$pdf->Cell(30,6,'$'.number_format($row['saldo'],2,'.',','),1,0,'C');
		$pdf->Cell(35,6,$row['fecha_liqui'],1,1,'C');
		
		
		
	}



	$pdf->Output('Consinaciones con Saldo.pdf', 'I');
	#$pdf->Output('D');
	#$pdf->Output('F','Catalogo de Clientes');

	/**$pdf->Cell(25,6,'$'.number_format($row['total'],2,'.',','),1,0,'C');
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