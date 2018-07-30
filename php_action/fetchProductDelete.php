<?php 

require_once 'core.php';

//Clientes Eliminados
$query = "SELECT id_product, nombre, marca, estado
          FROM product 
          WHERE estado = 2 ";
$resultado = $connect->query($query);

$output = array('data' => array());

if($resultado->num_rows > 0) {



	while($row = $resultado->fetch_array()) {
	$prodId = $row[0];

		

	 	$button = '<!-- Single button -->
					<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acción <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a type="button" data-toggle="modal" id="actProdModalBtn" data-target="#actProModal" onclick="activarProduct('.$prodId.')"> <i class="fa fa-unlock-alt" aria-hidden="true"></i> Activar</a></li>     
						</ul>
					</div>';

		
		$output['data'][] = array( 		
		//Codigo Cte
		$prodId,
 		// Nombre Cte
 		$row[1], 
 		// Boton
 		$button 		
 		);

	} // /while 
}// if num_rows

$connect->close();

echo json_encode($output);