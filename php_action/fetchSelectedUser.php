<?php 	

require_once 'core.php';

$userId = $_POST['userId'];

$sql = "SELECT * FROM user WHERE id_user = $userId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);