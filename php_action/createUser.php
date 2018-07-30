<?php 

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());
ini_set('date.timezone', 'America/Mexico_City');
if ($_POST) {
	# code...

	$a  = $_POST['UserName'];
	$b  = $_POST['UserNick'];
	$c  = $_POST['UserPass'];
	$d  = $_POST['userRol'];
	$fecha = date('d/m/Y');
	
				
				$sql = "INSERT INTO user (nombre, username, password, rol, fecha_add) 
				VALUES ('$a', '$b', '$c', '$d', '$fecha')";

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