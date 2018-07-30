<?php 

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());
ini_set('date.timezone', 'America/Mexico_City');
if ($_POST) {
	# code...

	$a  = $_POST['conceptoGasto'];
	$b  = $_POST['montoGasto'];
	$c	= $_SESSION["iduser"];
	$fecha = date('d/m/Y');
	
				
				$sql = "INSERT INTO gasto (fecha_add, concepto, monto, user_add) 
				VALUES ('$fecha', '$a', '$b', '$c')";

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