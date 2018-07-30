<?php 	

require_once 'core.php';

$id_client = $_POST['clientCod'];

$sql = "SELECT * FROM client WHERE id_client= $id_client";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);