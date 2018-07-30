<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$userId  = $_POST['userId'];
	$a     	 = $_POST['editUserName']; 
	$b   	 = $_POST['editUserNick']; 
	$c    	 = $_POST['editUserPass']; 
	$d    	 = $_POST['editUserRol']; 
				
	$sql = "UPDATE user SET nombre = '$a', username = '$b', password = '$c', rol = '$d'
			WHERE id_user = $userId ";

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