<?php 	

require_once 'core.php';

$clientId = $_POST['clientId'];

$sql = "SELECT * FROM client WHERE id_client= $clientId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);