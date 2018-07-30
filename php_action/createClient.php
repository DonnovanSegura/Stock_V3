<?php 

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());
ini_set('date.timezone', 'America/Mexico_City');
if ($_POST) {
	# code...

	$NameClient    = $_POST['clientName'];
	$AddresClient  = $_POST['clientAddres'];
	$EmailClient   = $_POST['clientEmail'];
	$TelClient     = $_POST['clientTelefono'];
	$CatClient	   = $_POST['ClientStatus'];
	$comentario	   = $_POST['clientComentario'];

	$fecha = date('d/m/Y');
				//status del cliente, 1 = Activo 2 = Inactivo
				$sql = "INSERT INTO client (nombre_cte, direccion, email, telefono, categoria, status, comentario, fecha_add) 
				VALUES ('$NameClient', '$AddresClient', '$EmailClient', '$TelClient', '$CatClient', 1, '$comentario', '$fecha')";

				if($connect->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "Creado exitosamente";	
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error no se ha podido guardar";
				}
		

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST



?>