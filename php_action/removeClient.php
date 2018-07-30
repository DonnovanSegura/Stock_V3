<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$clientId      = $_POST['clientId'];


	//status del cliente, 1 = Activo 2 = Inactivo
	
	$sql = "UPDATE client SET status = 2 WHERE id_client = $clientId ";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Eliminado exitosamente";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido eliminar";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);