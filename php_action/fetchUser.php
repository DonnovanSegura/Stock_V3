<?php 

require_once 'core.php';

$sql = "SELECT * FROM user ";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) {

	$rol = "";  

	while($row = $result->fetch_array()) {
	$userId = $row[0];

		if($row[4] == 1) {
	 		// activate member
	 		$rol = "<label class='label label-success'>Administrador</label>";
	 	} else {
	 		// deactivate member
	 		$rol = "<label class='label label-primary'>Estandar</label>";
	 	} // /else

	 	$button = '<!-- Single button -->
					<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acción <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a type="button" data-toggle="modal" id="editUserModalBtn" data-target="#editUserModal"     onclick="editUser('.$userId.')"> <i class="glyphicon glyphicon-edit"></i> Editar</a></li>     
						</ul>
					</div>';

		
		$output['data'][] = array( 		
		//Codigo
		$userId,
 		// Nombre
 		$row[1], 
 		// Usuario
 		$row[2],
 		// Password
 		$row[3], 		 	
 		// Rol
 		$rol,
 		// button
 		$button 		
 		);

	} // /while 
}// if num_rows

$connect->close();

echo json_encode($output);