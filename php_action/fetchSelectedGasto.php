<?php 	

require_once 'core.php';

$gastoId = $_POST['gastoId'];

$sql = "SELECT * FROM gasto WHERE id_gasto = $gastoId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);