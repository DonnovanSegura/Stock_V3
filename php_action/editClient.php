<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$clientId       = $_POST['clientId'];
	$clientName     = $_POST['editClientName']; 
	$clientAddres   = $_POST['editClientAddress']; 
	$clientEmail    = $_POST['editClientEmail']; 
	$clientTele     = $_POST['editClientTelefono']; 
	$clientCat      = $_POST['editClientStatus']; 
	$comentario     = $_POST['editClientComent']; 
				
	$sql = "UPDATE client SET nombre_cte = '$clientName', direccion = '$clientAddres', email = '$clientEmail', telefono = '$clientTele', categoria = '$clientCat', comentario = '$comentario'
			WHERE id_client = $clientId ";

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