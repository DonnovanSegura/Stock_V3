<?php 

	include 'plantilla.php';
	include 'db_connect.php';

	$query = "SELECT * FROM product WHERE genero = 1";
	$resultado = $connect->query($query);


	$pdf = new Hombre('L');
	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(25,6,'Cod Barras',1,0,'C',1);
	$pdf->Cell(80,6,'Nombre',1,0,'C',1);
	$pdf->Cell(70,6,'Marca',1,0,'C',1);
	$pdf->Cell(20,6,'Precio',1,1,'C',1);
	

	while($row = $resultado->fetch_assoc() ){
				
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(25,6,$row['id_product'],1,0,'L');
		$pdf->Cell(80,6,utf8_decode($row['nombre']),1,0,'L');
		$pdf->Cell(70,6,utf8_decode($row['marca']),1,0,'L');
		$pdf->Cell(20,6,'$'.($row['precio']),1,1,'C');
	
	}

	$pdf->Output(utf8_decode('Productos Caballero.pdf'), 'I');
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