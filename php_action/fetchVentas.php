<?php 

require_once 'core.php';

$sql = "SELECT orders.id_order, orders.fecha_add, orders.hora_add, orders.client_id, orders.monto, orders.saldo, orders.total, orders.tipo_orden, orders.estado,
        client.id_client, client.nombre_cte
		FROM orders
		INNER JOIN client	
		ON orders.client_id = client.id_client
		WHERE orders.tipo_orden = 2 
		ORDER BY orders.id_order DESC";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) {

	#$categoria = "";
	$status="";

	while($row = $result->fetch_array()) {
	$orderId = $row[0];

	if($row['estado'] == 1) {
	 		
	 	$status = "<label class='label label-success'>LIQUIDADA</label>";
	} else {
	 		
	 	$status = "<label class='label label-warning'>NO LIQUIDADA</label>";
	}


	//Consulta para contar el total de productos adquiridos 
	$countOrderItemSql = "SELECT count(*) FROM orders_detalle WHERE order_id = $orderId";
 	$itemCountResult = $connect->query($countOrderItemSql);
 	$itemCountRow = $itemCountResult->fetch_row();

 	//Consulta para sumar el total de productos adquiridos por especie en total

 	/*$sumProduct = "SELECT sum(cantidad) FROM orders_detalle WHERE order_id = $orderId";
 	$resSum		= $connect->query($sumProduct);
 	$rowSum		= $resSum->fetch_row();*/

	$button = '<!-- Single button -->
					<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acción <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="editOrders.php?id='.$orderId.'"" type="button" > <i class="glyphicon glyphicon-edit"></i> Editar</a></li>
							<!-- <li><a type="button" onclick="printOrder('.$orderId.')"> <i class="glyphicon glyphicon-print"></i> Imprimir </a></li> -->
							<li><a href="pdf/printOrderVta.php?id='.$orderId.'"" type="button"  target=”_blank” > <i class="glyphicon glyphicon-print"></i> Imprimir</a></li>
						</ul>
					</div>';

		$output['data'][] = array( 	
		//folio
		$orderId,	
		// fecha add
 		$row["fecha_add"],	
		//Codigo del cliente
		$row["client_id"],
 		// Nombre del cliente
 		$row["nombre_cte"],
 		//Total de Productos
 		//$itemCountRow,
 		//Total
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