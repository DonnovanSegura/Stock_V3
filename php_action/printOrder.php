<?php 

require_once 'core.php';

$orderId = $_POST['a'];

$sql = "SELECT fecha_add, hora_add, client_id FROM orders WHERE id_order = $orderId";
$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch_array();

$orderDate = $orderData[0];
$hora      = $orderData[1];
$cteCod	   = $orderData[2];

 $table = '
 <table border="1" cellspacing="0" cellpadding="20" width="100%">
	<thead>
		<tr >
			<th colspan="5">

			<center>
				Fecha : '.$orderDate.'
				<center>Cliente : '.$hora.' </center>
				Teléfono : '.$cteCod.'
			</center>		
			</th>
				
		</tr>		
	</thead>
</table>';


$connect->close();
