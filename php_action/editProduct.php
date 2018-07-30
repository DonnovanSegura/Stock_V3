<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$productId      = $_POST['productId'];
	$productName    = $_POST['editProductName']; 
	$costo 			= $_POST['editProductCosto'];
	$precio 		= $_POST['editProductPrecio'];
	$marca 			= $_POST['editProductMarca'];
	$stock    		= $_POST['editProductStock'];
	$gender			= $_POST['editProductGenero'];
	$productStatus 	= $_POST['editProductStatus'];
	$plata			= $_POST['editProductPlata'];
	$bronce			= $_POST['editProductBronce'];

				
	$sql = "UPDATE product SET nombre = '$productName', costo = '$costo',  precio = '$precio', plata = '$plata', bronce = '$bronce', marca = '$marca', cantidad = '$stock', genero = '$gender',  status = '$productStatus' 
			WHERE id_product = $productId ";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Actualizado exitosamente";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido actualizar";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);