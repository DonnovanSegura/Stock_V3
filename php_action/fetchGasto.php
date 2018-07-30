<?php 

require_once 'core.php';

$sql = "SELECT * FROM gasto";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) {
	
	while($row = $result->fetch_array()) {
	$gastoId = $row[0];

	

	$button = '<!-- Single button -->
					<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acción <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a type="button" data-toggle="modal" id="editGastoModalBtn" data-target="#editGastoModal" onclick="editGasto('.$gastoId.')"> <i class="glyphicon glyphicon-edit"></i> Editar</a>
							</li>
						</ul>
					</div>';

		$output['data'][] = array( 		
		//Codigo
		$gastoId,	
 		// fecha_add
 		$row[1], 
 		// concepto
 		$row[2],
 		// monto
 		"$".number_format($row[3]), 		 	
 		// button
 		$button 		
 		);

	} // /while 
}// if num_rows

$connect->close();

echo json_encode($output);