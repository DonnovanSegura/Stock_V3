<?php 

	include 'plantilla.php';
	include 'db_connect.php';

	$query = "SELECT * FROM product ";
	$resultado = $connect->query($query);


	$pdf = new Lista('L');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	while($row = $resultado->fetch_assoc() ){
		
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(25,6,$row['id_product'],1,0,'L');
		$pdf->Cell(80,6,utf8_decode($row['nombre']),1,0,'L');
		$pdf->Cell(70,6,utf8_decode($row['marca']),1,0,'L');
		$pdf->Cell(25,6,'$'.number_format($row['precio'],2,'.',','),1,0,'C');
		$pdf->Cell(25,6,'$'.number_format($row['plata'],2,'.',','),1,0,'C');
		$pdf->Cell(25,6,'$'.number_format($row['bronce'],2,'.',','),1,1,'C');
		
	}

	$pdf->Output(utf8_decode('Lista de Precios.pdf'), 'I');
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