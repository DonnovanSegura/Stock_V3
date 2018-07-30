<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {

	$orderId = $_POST['orderId'];
	//Codigo de Cliente
	$a	= $_POST['codCte'];
	//Total Neto
	$b	= $_POST['totalAmountValue'];
	//Descuento
	$c	= $_POST['discount'];
	//Total
	$d	= $_POST['grandTotalValue'];
	//Metodo de pago
	$e	= $_POST['metoPago'];
	//total de productos
	$k  = $_POST['grandTotalProductos'];
	//Tipo Orden
	$f	= $_POST['TypeOrder'];
	//Monto pagado
	$g	= $_POST['paid'];
	//Saldo
	$h	= $_POST['dueValue'];
	//Estado
	$i	= $_POST['paymentStatus'];
	//Fecha Liquidación
	$j	= $_POST['orderDate'];


	$sql = "UPDATE orders SET client_id   	= '$a', 
							  total_neto  	= '$b',
							  descuento   	= '$c',
							  total       	= '$d',
							  metodo      	= '$e',
							  totalProducto = '$k',
							  tipo_orden  	= '$f',
							  monto       	= '$g',
							  saldo       	= '$h',
							  estado      	= '$i',
							  fecha_liqui 	= '$j'
				        WHERE id_order = {$orderId}";
	$connect->query($sql);

	$updateDetalleOrden = false;
	// agrego la cantidad del artículo de pedido a la tabla de product
	for($x = 0; $x < count($_POST['codProd']); $x++) {
		//  product table
		$updateProductCantidadSql = "SELECT product.cantidad FROM product WHERE product.id_product = ".$_POST['codProd'][$x]."";
		$updateProductCantidadData = $connect->query($updateProductCantidadSql);

		while ($updateProductCantidadResult = $updateProductCantidadData->fetch_row()) {
			//agrego cantidad de producto a la tabla orders_detalle
			$orderDetalleTableSql = "SELECT orders_detalle.cantidad FROM orders_detalle WHERE orders_detalle.order_id = {$orderId}";
			$orderDetalleResult = $connect->query($orderDetalleTableSql);
			$orderDetalleData = $orderDetalleResult->fetch_row();

			$editCantidad = $updateProductCantidadResult[0] + $orderDetalleData[0];

			$updateCantidadSql = "UPDATE product SET cantidad = $editCantidad WHERE id_product = ".$_POST['codProd'][$x]."";
			$connect->query($updateCantidadSql);
		}//while

		if(count($_POST['codProd']) == count($_POST['codProd'])) {
			$updateDetalleOrden = true;			
		}

	}//for 

	// eliminar los datos del artículo de pedido de la tabla de ordes_detalle
	for($x = 0; $x < count($_POST['codProd']); $x++) {			
		$removeOrderSql = "DELETE FROM orders_detalle WHERE order_id = {$orderId}";
		$connect->query($removeOrderSql);	
	} // /for quantity

	if($updateDetalleOrden) {
		// insert the order item data 
		for($x = 0; $x < count($_POST['codProd']); $x++) {			
			$updateProductCantidadSql = "SELECT product.cantidad FROM product WHERE product.id_product = ".$_POST['codProd'][$x]."";
			$updateProductCantidadData = $connect->query($updateProductCantidadSql);

			while ($updateProductCantidadResult = $updateProductCantidadData->fetch_row()) {
					$updateCantidad[$x] = $updateProductCantidadResult[0] - $_POST['quantity'][$x];							
					// update product table
					$updateProductTable = "UPDATE product SET cantidad = '".$updateCantidad[$x]."' WHERE id_product = ".$_POST['codProd'][$x]."";
					$connect->query($updateProductTable);

					// add into order_item
					$orderDetalleSql = "INSERT INTO orders_detalle (order_id, product_id, cantidad, precio, total) 
					VALUES ({$orderId}, '".$_POST['codProd'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rateValue'][$x]."', '".$_POST['totalValue'][$x]."')";

					$connect->query($orderDetalleSql);	

			}//while

		} // /for quantity

	}//if

	$valid['success'] = true;
	$valid['messages'] = "Modificación Exitosa";		
	
	$connect->close();

	echo json_encode($valid);
} // /if $_POST