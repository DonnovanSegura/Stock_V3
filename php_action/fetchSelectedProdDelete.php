<?php 	

require_once 'core.php';

$prodId = $_POST['prodId'];

$sql = "SELECT id_product, nombre, marca, estado FROM product WHERE estado = 2 AND id_product = $prodId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);