<?php 

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

ini_set('date.timezone', 'America/Mexico_City');

if ($_POST) {
	# code...
	$fecha = date('d/m/Y');
  	$hora = date('H:i:s', time());
	$idclient    = $_POST['codCte'];
	$totalneto	 = $_POST['totalAmountValue'];
	$descuento	 = $_POST['discount'];
	$tatal   	 = $_POST['grandTotalValue'];
	$metodopay	 = $_POST['metoPago'];
	$productTotal= $_POST['grandTotalProductos'];
	$tipoorden	 = $_POST['TypeOrder'];
	$montopay	 = $_POST['paid'];
	$saldo   	 = $_POST['dueValue'];
	$estadopay	 = $_POST['paymentStatus'];
	$fchaliqui	 = date('d/m/Y', strtotime($_POST['orderDate']));
	$id_user	 = $_SESSION["iduser"];
		$sql = "INSERT INTO orders (fecha_add, hora_add, client_id, total_neto, descuento, total, metodo, totalProducto, tipo_orden, monto, saldo, estado, fecha_liqui, user_add_id) 
		VALUES ('$fecha', '$hora', '$idclient', '$totalneto', '$descuento', '$tatal', '$metodopay', '$productTotal', '$tipoorden', '$montopay', '$saldo', '$estadopay', '$fchaliqui', '$id_user')";
/*		if($connect->query($sql) === TRUE) {
			$valid['success'] = true;
			$valid['messages'] = "Creado exitosamente";	
		} else {
			$valid['success'] = false;
			$valid['messages'] = "Error no se ha podido guardar";
		}
		

	$connect->close();

	echo json_encode($valid);*/
	$order_id;
	$orderStatus = false;
	if($connect->query($sql) === true) {
		//Devuelve el id autogenerado que se utilizó en la última consulta
		$order_id = $connect->insert_id;
		$valid['order_id'] = $order_id;	

		$orderStatus = true;
	}

		
	// echo $_POST['productName'];
	$orderItemStatus = false;

	for($x = 0; $x < count($_POST['codProd']); $x++) {			
		$updateProductQuantitySql = "SELECT product.cantidad FROM product WHERE product.id_product = ".$_POST['codProd'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);
		
		
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
			$updateQuantity[$x] = $updateProductQuantityResult[0] - $_POST['quantity'][$x];							
				// update product table
				$updateProductTable = "UPDATE product SET cantidad = '".$updateQuantity[$x]."' WHERE id_product = ".$_POST['codProd'][$x]."";
				$connect->query($updateProductTable);

				// add into order_item
				$orderItemSql = "INSERT INTO orders_detalle (order_id, product_id, cantidad, precio, total) 
				VALUES ('$order_id', '".$_POST['codProd'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rateValue'][$x]."', '".$_POST['totalValue'][$x]."')";

				$connect->query($orderItemSql);		

				if($x == count($_POST['codProd'])) {
					$orderItemStatus = true;
				}		
		} // while	
	} // /for quantity

	$valid['success'] = true;
	$valid['messages'] = "Agregado exitosamente";		
	
	$connect->close();

	echo json_encode($valid);

 
} // /if $_POST

 ?>