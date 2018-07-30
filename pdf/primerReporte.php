<?php 

	include 'plantilla.php';
	include 'db_connect.php';

	$query = "SELECT id_client, nombre_cte, direccion, telefono, categoria, status FROM client ";
	$resultado = $connect->query($query);

	$pdf = new PDF('L');
	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(15,6,'Clave',1,0,'C',1);
	$pdf->Cell(70,6,'Nombre',1,0,'C',1);
	$pdf->Cell(70,6,'Direccion',1,0,'C',1);
	$pdf->Cell(50,6,'Telefono',1,0,'C',1);
	$pdf->Cell(25,6,'Categoria',1,0,'C',1);
	$pdf->Cell(25,6,'Status',1,1,'C',1);

	
	while($row = $resultado->fetch_assoc() ){

		$pdf->SetFont('Arial','',9);
		$pdf->Cell(15,6,$row['id_client'],1,0,'L');
		$pdf->Cell(70,6,utf8_decode($row['nombre_cte']),1,0,'L');
		$pdf->Cell(70,6,utf8_decode($row['direccion']),1,0,'L');
		$pdf->Cell(50,6,utf8_decode($row['telefono']),1,0,'L');

		if ($row['categoria'] == 1) {
			# code...
			$pdf->Cell(25,6,'ORO',1,0,'L');
		}elseif ($row['categoria'] == 2) {
			# code...
			$pdf->Cell(25,6,'PLATA',1,0,'L');
		}else{
			$pdf->Cell(25,6,'BRONCE',1,0,'L');
		}
		
		if ($row['status'] == 1) {
			# code...
			$pdf->Cell(25,6,'ACTIVO',1,1,'L');
		}else{
			$pdf->Cell(25,6,'INACTIVO',1,1,'L');
		}
		
	}

	$pdf->Output(utf8_decode('Catálogo de Clientes.pdf'), 'I');
	#$pdf->Output('D');
	#$pdf->Output('F','Catalogo de Clientes');
?>