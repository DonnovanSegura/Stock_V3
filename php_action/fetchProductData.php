<?php 	

require_once 'core.php';

$sql = "SELECT *  FROM product ";
$result = $connect->query($sql);

$data = $result->fetch_all();

$connect->close();

echo json_encode($data);