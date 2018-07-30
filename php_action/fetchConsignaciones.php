<?php 

require_once 'core.php';

$sql = "SELECT orders.id_order, orders.fecha_add, orders.client_id, orders.monto, orders.saldo, orders.total, orders.tipo_orden, orders.estado,
		client.id_client, client.nombre_cte
		FROM orders
		INNER JOIN client	
		ON orders.client_id = client.id_client
		WHERE orders.tipo_orden = 1 
		ORDER BY orders.id_order DESC";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) {

	#$categoria = "";
	$status="";

	while($row = $result->fetch_array()) {
	$id_order = $row[0];

	if($row['estado'] == 1) {
	 		
	 	$status = "<label class='label label-success'>LIQUIDADA</label>";
	} else {
	 		
	 	$status = "<label class='label label-warning'>NO LIQUIDADA</label>";
	}

	//Consulta para contar el total de productos adquiridos 
	$countOrderItemSql = "SELECT count(*) FROM orders_detalle WHERE order_id = $id_order";
 	$itemCountResult = $connect->query($countOrderItemSql);
 	$itemCountRow = $itemCountResult->fetch_row();

 	//Consulta para sumar el total de productos adquiridos por especie en total

 	/*$sumProduct = "SELECT sum(cantidad) FROM orders_detalle WHERE order_id = $id_order";
 	$resSum		= $connect->query($sumProduct);
 	$rowSum		= $resSum->fetch_row();*/


	$button = '<!-- Single button -->
					<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acción <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="editConsignaciones.php?id='.$id_order.'""  type="button" > <i class="glyphicon glyphicon-edit"></i> Editar</a></li>
							<li><a href="pdf/printOrderVta.php?id='.$id_order.'"" type="button"  target=”_blank” > <i class="glyphicon glyphicon-print"></i> Imprimir</a></li>
						</ul>
					</div>';

		$output['data'][] = array( 	
		//Folio
		$row["id_order"],	
		// fecha add
 		$row["fecha_add"],	
		//Codigo del cliente
		$row["client_id"],
 		// Nombre del cliente
 		$row["nombre_cte"],
 		// total
 		"$".number_format($row["total"]), 	 
 		// Monto
 		"$".number_format($row["monto"]),
 		//Saldo
 		"$".number_format($row["saldo"]),  
 		//status
 		$status,   	  	 	
 		// button
 		$button 		
 		);

	} // /while 
}// if num_rows

$connect->close();

echo json_encode($output);