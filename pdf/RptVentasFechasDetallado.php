<?php 


	$desde = date('d/m/Y', strtotime($_GET['desde']));
	$hasta = date('d/m/Y', strtotime($_GET['hasta']));

	include 'db_connect.php';
	require 'fpdf/fpdf.php';

	$query = "SELECT orders.id_order, orders.fecha_add, orders.client_id, orders.tipo_orden, orders_detalle.order_id, orders_detalle.product_id,
			  orders_detalle.cantidad, orders_detalle.precio, orders_detalle.total, product.id_product, product.nombre, client.id_client, 
			  client.nombre_cte
	          FROM orders 
	          INNER JOIN orders_detalle
	          ON orders.id_order = orders_detalle.order_id 
	          INNER JOIN client 
	          ON orders.client_id = client.id_client 
	          INNER JOIN product
	          ON orders_detalle.product_id = product.id_product
	          WHERE orders.fecha_add BETWEEN '$desde' AND '$hasta' AND tipo_orden = 2 ";
	$resultado = $connect->query($query);
	
	$pdf = new FPDF('L');
	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Cell(245, 6, 'Reporte de Ventas Detallado',0,0,'C');
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(30, 6, 'Hoy: '.date('d/m/Y').'',0,1,'R');
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(90,6,'',0,0);
	$pdf->Cell(80,6, 'Desde: '.$desde.' 		Hasta: '.$hasta,0,1);
	$pdf->Ln(2);


	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(15,6,'Folio',1,0,'C',1);
	$pdf->Cell(20,6,'Fecha',1,0,'C',1);
	$pdf -> SetFont('Arial', 'B', 7);
	$pdf->Cell(12,6,'Cod Cte',1,0,'C',1);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(60,6,'Nombre Cte.',1,0,'C',1);
	$pdf -> SetFont('Arial', 'B', 7);
	$pdf->Cell(20,6,'Cod Produc.',1,0,'C',1);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(90,6,utf8_decode('Descripción'),1,0,'C',1);
	$pdf -> SetFont('Arial', 'B', 7);
	$pdf->Cell(12,6,'Cantidad',1,0,'C',1);
	$pdf->Cell(20,6,'Precio Unit.',1,0,'C',1);
	$pdf->Cell(25,6,'Total',1,1,'C',1);
	
	$totalGasto = 0;
	while($row = $resultado->fetch_assoc() ){

		$totalGasto = $totalGasto + $row['total'];
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(15,6,$row['id_order'],1,0,'C');
		$pdf->Cell(20,6,$row['fecha_add'],1,0,'C');
		$pdf->Cell(12,6,$row['client_id'],1,0,'C');
		$pdf->Cell(60,6,utf8_decode($row['nombre_cte']),1,0,'C');
		$pdf->Cell(20,6,$row['product_id'],1,0,'C');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(90,6,utf8_decode($row['nombre']),1,0,'C');
		$pdf->Cell(12,6,$row['cantidad'],1,0,'C');
		$pdf->Cell(20,6,'$'.number_format($row['precio'],2,'.',','),1,0,'R');
		$pdf->Cell(25,6,'$'.number_format($row['total'],2,'.',','),1,1,'R');
		
		
		
	}

		$pdf -> SetFont('Arial', 'B', 8);
		$pdf->SetFillColor(232,232,232);
		$pdf -> Cell(249,6,'',0);
		$pdf -> Cell(25,6,'$'.number_format($totalGasto,2,'.',','),1,1,'R',1);



	




	$pdf->Output(utf8_decode('Ventas_Detallado.pdf'), 'I');
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