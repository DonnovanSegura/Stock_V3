<?php 

require_once 'core.php';
//status del cliente, 1 = Activo 2 = Inactivo
$sql = "SELECT * FROM client WHERE status = 1 ";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) {

	$categoria = "";

	
	while($row = $result->fetch_array()) {
	$clientId = $row[0];

	if($row[5] == 1) {
	 		
	 	$categoria = "<label class='label label-warning'>ORO</label>";
	} elseif ($row[5] == 2) {
	 		
	 	$categoria = "<label class='label label-default'>PLATA</label>";
	} elseif ($row[5] == 3) {
		# code...
		$categoria = "<label class='label label-danger'>BRONCE</label>";
	}

	$button = '<!-- Single button -->
					<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acción <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a type="button" data-toggle="modal" id="editClientModalBtn" data-target="#editClientModal"     onclick="editClient('.$clientId.')"> <i class="glyphicon glyphicon-edit"></i> Editar</a></li>
							<li><a type="button" data-toggle="modal" data-target="#removeClientModal" id="removeClientModalBtn" onclick="removeClient('.$clientId.')"> <i class="glyphicon glyphicon-trash"></i> Eliminar</a></li>       
						</ul>
					</div>';

		$output['data'][] = array( 		
		//Codigo
		$clientId,	
 		// Nombre
 		$row[1], 
 		// email
 		$row[3],
 		// telefono
 		$row[4], 		 	
 		// Categoria
 		$categoria,
 		// button
 		$button 		
 		);

	} // /while 
}// if num_rows

$connect->close();

echo json_encode($output);