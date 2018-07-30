<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$gastoId  = $_POST['gastoId'];
	$a     	  = $_POST['editGastoConcep']; 
	$b   	  = $_POST['editGastoMonto']; 
					
	$sql = "UPDATE gasto SET concepto = '$a', monto = '$b'
			WHERE id_gasto = $gastoId ";

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