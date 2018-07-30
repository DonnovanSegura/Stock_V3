<?php 

require_once 'core.php';

$sql = "SELECT * FROM product WHERE estado = 1";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) {

	$active = "";  
	$gender = "";

	while($row = $result->fetch_array()) {
	$productId = $row[0];

		if($row[10] == 1) {
	 		// activate member
	 		$active = "<label class='label label-success'>Disponible</label>";
	 	} else {
	 		// deactivate member
	 		$active = "<label class='label label-danger'>No disponible</label>";
	 	} // /else


	 	if($row[9] == 1) {
		 	$gender = "<label class='label label-primary'>HOMBRE</label>";
		} elseif ($row[9] == 2) {
		 	$gender = "<label class='label label-success'>MUJER</label>";
		} elseif ($row[9] == 3) {
			$gender = "<label class='label label-info'>NIÑO</label>";
		}elseif ($row[9] == 4) {
			$gender = "<label class='label label-warning'>NIÑA</label>";
		}

		if ($_SESSION['rol'] == 1) {
			# code...
			$button = '<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acción <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">

							<li><a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="editProduct('.$productId.')"> <i class="glyphicon glyphicon-edit"></i> Editar</a></li>
							<li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$productId.')"> <i class="glyphicon glyphicon-trash"></i> Eliminar</a></li>';	
							
						'</ul>';
					'</div>';
		}else{

			$button = '<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acción <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">

							<li><a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="editProduct('.$productId.')"> <i class="glyphicon glyphicon-edit"></i> Editar</a></li>
							<li><a type="button" data-toggle="modal" data-target="#mensajeError" id="removeProductModalBtn" > <i class="glyphicon glyphicon-trash"></i> Eliminar</a></li>';
						'</ul>';
					'</div>';
		}
	 	
		$imageUrl = substr($row[2], 3);
		$productImage = "<img class='img-round' src='".$imageUrl."' style='height:30px; width:50px;'  />";

		$output['data'][] = array( 		
 		// image
 		$productImage,
 		//Codigo
 		$productId,
 		// Nombre
 		$row[1], 
 		// Precio
 		"$".number_format($row[4]),
 		// Stock
 		$row[8], 		 	
 		// Marca
 		$row[7], 
 		//Género
 		$gender,
 		// active
 		$active,
 		// button
 		$button 		
 		);

	} // /while 
}// if num_rows

$connect->close();

echo json_encode($output);