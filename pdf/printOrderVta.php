<?php 
include 'db_connect.php';

$orderId = $_GET["id"];

$query = "SELECT orders.id_order, orders.fecha_add, orders.hora_add, orders.client_id, orders.total_neto, orders.descuento, orders.total, orders.tipo_orden, orders.monto, orders.saldo, orders.fecha_liqui, 
client.id_client, client.nombre_cte
FROM orders 
INNER JOIN client
ON orders.client_id = client.id_client
WHERE id_order = $orderId ";
$resultado = $connect->query($query);


	require 'fpdf/fpdf.php';

	
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',14);

	$row = $resultado->fetch_assoc();
		$pdf->SetFont('Arial','',9);
		//$pdf->MultiCell(50,50,'',1,1);
		$pdf->Cell(50,6,'Folio:'.$row['id_order'],0,0,'L');
		$pdf->Cell(92);
		if ($row['tipo_orden'] == 1) {
			$pdf->Cell(50,6,utf8_decode('Tipo Orden: Consignación'),0,1,'R');

		}else{
			$pdf->Cell(50,6,utf8_decode('Tipo Orden: Venta'),0,1,'R');
		}
		//$pdf->Cell(50,6,'Tipo Orden:'.$row['tipo_orden'],1,1,'L');
		$pdf->Cell(112,6,'Nombre del Cliente:'.utf8_decode($row['nombre_cte']),0,0,'L');
		$pdf->Cell(40,6,'Fecha:'.$row['fecha_add'],0,0,'R');
		$pdf->Cell(40,6,'Hora:'.$row['hora_add'],0,1,'R');
		$pdf->Cell(30,6,utf8_decode('Código Cliente:'  .$row['id_client']),0,0,'L');
		$pdf->Cell(112);
		$pdf->Cell(50,6,utf8_decode('Fecha Liquidación:'.$row['fecha_liqui']),0,1,'R');
		$pdf->Ln(4);

		$pdf->SetFillColor(229, 229, 229);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(8,6,'#',1,0,'C',1);
		$pdf->Cell(30,6,'Cod. Producto',1,0,'C',1);
		$pdf->Cell(90,6,utf8_decode('Descripción'),1,0,'C',1);
		$pdf->Cell(25,6,'Precio Uni',1,0,'C',1);
		$pdf->Cell(17,6,'Cantidad',1,0,'C',1);
		$pdf->Cell(25,6,'Total',1,1,'C',1);


		$queryA = "SELECT orders_detalle.order_id, orders_detalle.product_id, orders_detalle.cantidad, orders_detalle.precio, orders_detalle.total,
			       product.id_product, product.nombre 
			       FROM orders_detalle
			       INNER JOIN product
			       ON orders_detalle.product_id = product.id_product
			       WHERE orders_detalle.order_id = $orderId ";
		$res = $connect->query($queryA);
		
		$x = 1;
		$sum = 0;
		while($rowA = $res->fetch_assoc()) {	

			$sum = $sum + $rowA['cantidad'];
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(8,6,$x,1,0,'C');
			$pdf->Cell(30,6,$rowA['product_id'],1,0,'C');
			$pdf->Cell(90,6,utf8_decode($rowA['nombre']),1,0,'C');
			$pdf->Cell(25,6,'$'.number_format($rowA['precio'],2,'.',','),1,0,'C');
			$pdf->Cell(17,6,$rowA['cantidad'],1,0,'C');
			$pdf->Cell(25,6,'$'.number_format($rowA['total'],2,'.',','),1,1,'R');
			$x++;
		}

		/*$pdf->Cell(128);
		$pdf->SetFont('Arial','',8);
		$pdf->SetFillColor(229, 229, 229);
		$pdf->Cell(67,6,'TOTAL PRODUCTOS: '.$sum,1,1,'R',1);
		$pdf->Cell(128);
		$pdf->Cell(67,6,'TOTAL: $'.number_format($row['total'],2,'.',','),1,1,'R',1);
		$pdf->Cell(128);
		$pdf->Cell(67,6,'SALDO POR LIQUIDAR: $'.number_format($row['saldo'],2,'.',','),1,1,'R',1);*/

		$pdf->Cell(128);
		$pdf->SetFont('Arial','',8);
		$pdf->SetFillColor(229, 229, 229);
		$pdf->Cell(42,6,'TOTAL PRODUCTOS: ',1,0,'R',1);
		$pdf->Cell(25,6,'#'.$sum,1,1,'R',1);
		$pdf->Cell(128);
		$pdf->Cell(42,6,'TOTAL:',1,0,'R',1);
		$pdf->Cell(25,6,'$'.number_format($row['total'],2,'.',','),1,1,'R',1);
		$pdf->Cell(128);
		$pdf->Cell(42,6,'SALDO POR LIQUIDAR',1,0,'R',1);
		$pdf->Cell(25,6,'$'.number_format($row['saldo'],2,'.',','),1,1,'R',1);

		$pdf->SetY(-89);
		$pdf->SetX(100);
		$pdf->Cell(50,6,'',1,0);
		$pdf->Cell(50,6,'',1,1);
		$pdf->SetX(100);
		$pdf->Cell(50,6,'',1,0);
		$pdf->Cell(50,6,'',1,1);
		$pdf->SetX(100);
		$pdf->Cell(50,6,'',1,0);
		$pdf->Cell(50,6,'',1,1);
		$pdf->SetX(100);
		$pdf->Cell(50,6,'',1,0);
		$pdf->Cell(50,6,'',1,1);
		$pdf->Ln(2);
		$pdf->SetFont('Arial','I', 6);
		$pdf->MultiCell(190,6,utf8_decode('Debe(mos) y Pagare(mos) incondicionalmente por este Documento el día: ___________________________ a la orden de: ___________________________________________________, la cantidad de: _________________________________________________________________________, Valor que recibi(mos) a mi (nuestra) entera satisfacion. Este documento esta sujeto a la condición de que, al no pagarsea su vencimiento, sera(n) exigible(s), si no fuere puntualmente cubierto el valor que este documento expresa, pagaré(mos) ademas sin que por ello se considere prorrogando el plazo fijado para el cumplimiento de esta obligación.'),1,1,'L',false);
		$pdf->Cell(60,12,'',0);
		$pdf->Cell(70,18,'Acepto(mos): _____________________________________________',1,0);

	$pdf->Output('Folio'.$row['id_order'].'_Orden.pdf','I');

?>