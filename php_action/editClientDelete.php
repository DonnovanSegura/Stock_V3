<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$cteId   = $_POST['cteId'];
	$a     	 = $_POST['comenCteDelete']; 
	$b   	 = $_POST['statusCteDelete']; 

				
	$sql = "UPDATE client SET comentario = '$a', status = '$b'
			WHERE id_client = $cteId ";

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