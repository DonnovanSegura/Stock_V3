<?php 

	include 'plantilla.php';
	include 'db_connect.php';

	$query = "SELECT * FROM product ";
	$resultado = $connect->query($query);


	$pdf = new Productos('L','mm','legal');
	$pdf->AliasNbPages();
	$pdf->AddPage();

	while($row = $resultado->fetch_assoc() ){
		
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(25,6,$row['id_product'],1,0,'L');
		$pdf->Cell(80,6,utf8_decode($row['nombre']),1,0,'L');
		$pdf->Cell(70,6,utf8_decode($row['marca']),1,0,'L');

		if ($row['genero'] == 1) {
			$pdf->Cell(20,6,utf8_decode('HOMBRE'),1,0,'L');
		}elseif ($row['genero'] == 2) {
			$pdf->Cell(20,6,utf8_decode('MUJER'),1,0,'L');
		}elseif ($row['genero'] == 3) {
			$pdf->Cell(20,6,utf8_decode('NIÑO'),1,0,'L');
		}else{
			$pdf->Cell(20,6,utf8_decode('NIÑA'),1,0,'L');
		}

		$pdf->Cell(20,6,$row['cantidad'],1,0,'C');

		if ($row['status'] == 1) {
			$pdf->Cell(30,6,utf8_decode('DISPONIBLE'),1,1,'L');
		}else{
			$pdf->Cell(30,6,utf8_decode('NO DISPONIBLE'),1,1,'L');
		}
		
	}

	$pdf->Output(utf8_decode('Cátalogo Productos.pdf'), 'I');
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