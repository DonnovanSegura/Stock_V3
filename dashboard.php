<?php 

require_once 'includes/header.php'; 

ini_set('date.timezone', 'America/Mexico_City');
$fecha = date('d/m/Y');
  
//Total de Productos 
$sql = "SELECT * FROM product WHERE estado = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;
//Total de Cleintes
$sqlA = "SELECT * FROM client WHERE status = 1";
$queryA = $connect->query($sqlA);
$countProductA = $queryA->num_rows;
//Total de Clintes Oro
$sqlB = "SELECT * FROM client WHERE status = 1 AND categoria = 1";
$queryB = $connect->query($sqlB);
$countProductB = $queryB->num_rows;
//Total de Clintes Plata
$sqlC = "SELECT * FROM client WHERE status = 1 AND categoria = 2";
$queryC = $connect->query($sqlC);
$countProductC = $queryC->num_rows;
//Consignaciones a vencer
$query = "SELECT orders.id_order, orders.fecha_add, orders.estado, orders.client_id, orders.saldo, orders.fecha_liqui, orders.tipo_orden, client.id_client, client.nombre_cte 
          FROM orders 
          INNER JOIN client 
          ON orders.client_id = client.id_client
          WHERE orders.tipo_orden = 1 AND orders.estado = 2 AND orders.fecha_liqui = '$fecha' ";
$resultado = $connect->query($query);
//Ventas a vencer
$queryV ="SELECT orders.id_order, orders.fecha_add, orders.estado, orders.client_id, orders.saldo, orders.fecha_liqui, orders.tipo_orden, client.id_client, client.nombre_cte 
          FROM orders 
          INNER JOIN client 
          ON orders.client_id = client.id_client
          WHERE orders.tipo_orden = 2 AND orders.estado = 2 AND orders.fecha_liqui = '$fecha' ";
$resultadoV = $connect->query($queryV);

?>

<style type="text/css">
	.ui-datepicker-calendar {
		display: none;
	}
</style>

<!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print">


<div class="row">

	<div class="col-md-6">
    <div class="panel panel-success">
      <div class="panel-heading">
        <a href="product.php" style="text-decoration:none;color:black;">
          Total de Clientes Oro:
          <span class="badge pull pull-right"><?php echo $countProductB; ?></span>
        </a>
      </div>
    </div> 
  </div> 

  <div class="col-md-6">
    <div class="panel panel-info">
      <div class="panel-heading">
        <a href="orders.php?o=manord" style="text-decoration:none;color:black;">
          Total de Clientes Plata:
          <span class="badge pull pull-right"><?php echo $countProductC; ?></span>
        </a>  
      </div> 
    </div> 
  </div> 

  <div class="col-md-4">
      <div class="card">
        <div class="cardHeader" style="background-color:#245580;">
            <h1><?php echo $countProductA; ?></h1>
            </div>
            <div class="cardContainer">
            <p> <i class="glyphicon glyphicon-credit-card"></i> Total de Clientes:</p>
        </div>
      </div> 
  </div>
  
  <div class="col-md-4">
      <div class="card">
        <div class="cardHeader" >
            <h1><?php echo $countProduct; ?></h1>
            </div>
            <div class="cardContainer">
            <p> <i class="glyphicon glyphicon-ruble"></i> Total de Productos:</p>
        </div>
      </div>
  </div>

</div><!--/row-->

</br>
<div class="row">

  <div class="col-md-6">
    <div class="card">
        <div class="cardHeader" style="background-color:#673AB7;">
            <h2>Vencimientos de Consignaciones Hoy</h2>
        </div>
        <div class="cardContainer">
           
          <table class="table table-condensed">
              <thead>
                  <tr>
                      <th># Cte.</th>
                      <th>Cliente.</th>
                      <th>Folio.</th> 
                      <th>Fch.Compra.</th> 
                      <th>Saldo.</th> 
                  </tr>
              </thead>
              <?php
              while($row = $resultado->fetch_assoc() ) {
              ?>
              <tr>
                  <td><?php echo $row["client_id"];?></td>
                  <td><?php echo $row["nombre_cte"];?></td>
                  <td><?php echo $row["id_order"];?></td>
                  <td><?php echo $row["fecha_add"];?></td>
                  <td><?php echo number_format($row["saldo"]);?></td>
              </tr>
              <?php
              }
              ?>
          </table>

        </div>
    </div> 
  </div>

  <div class="col-md-6">
    <div class="card">
        <div class="cardHeader" style="background-color:#F44336;">
            <h2>Ventas a Liquidar Hoy</h2>
        </div>
        <div class="cardContainer">
            <table class="table table-condensed">
              <thead>
                  <tr>
                      <th># Cte.</th>
                      <th>Cliente.</th>
                      <th>Folio.</th> 
                      <th>Fch.Compra.</th> 
                      <th>Saldo.</th> 
                  </tr>
              </thead>
              <?php
              while($rowV = $resultadoV->fetch_assoc() ) {
              ?>
              <tr>
                  <td><?php echo $rowV["client_id"];?></td>
                  <td><?php echo $rowV["nombre_cte"];?></td>
                  <td><?php echo $rowV["id_order"];?></td>
                  <td><?php echo $rowV["fecha_add"];?></td>
                  <td><?php echo $rowV["saldo"];?></td>
              </tr>
              <?php
              }
              ?>
          </table>
        </div>
    </div> 
  </div>
  
 
  
</div><!--/row-->

<!-- fullCalendar 2.2.5 -->
<script src="assests/plugins/moment/moment.min.js"></script>
<script src="assests/plugins/fullcalendar/fullcalendar.js"></script>

<script type="text/javascript">
	$(function () {
			// top bar active
	$('#navDashboard').addClass('active');

      //Date for the calendar events (dummy data)
      var date = new Date();
      var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear();
	 


      $('#calendar').fullCalendar({
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
        header: {
          left: '',
          center: 'title'
        },
        buttonText: {
          today: 'today',
          month: 'month'          
        }        
      });


    });
</script>

<?php require_once 'includes/footer.php'; ?>