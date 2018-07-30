<?php 	

require_once 'core.php';

$cteId = $_POST['cteId'];

$sql = "SELECT id_client, nombre_cte, status, comentario FROM client WHERE status = 2 AND id_client = $cteId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);