<?php require_once 'php_action/core.php'; ?>
<!DOCTYPE html>
<html>
<head>

	<title>TIENDA</title>

	<!-- bootstrap -->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	<!-- bootstrap theme-->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	<!-- font awesome -->
	<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="custom/css/custom.css">

	<!-- DataTables -->
  <link rel="stylesheet" href="assests/plugins/datatables/jquery.dataTables.min.css">

  <!-- file input -->
  <link rel="stylesheet" href="assests/plugins/fileinput/css/fileinput.min.css">

  <!-- jquery -->
	<script src="assests/jquery/jquery.min.js"></script>
  <!-- jquery ui -->  
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>

  <!-- bootstrap js -->
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>

<!-- Alertify -->
  <script src="assests/alertify/js/alertify.min.js"></script>
  <link rel="stylesheet" href="assests/alertify/themes/alertify.core.css">
  <link rel="stylesheet" href="assests/alertify/themes/alertify.default.css">

  <!-- bootstrap js 
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>-->


</head>
<body>

	<nav class="navbar navbar-default navbar-static-top" role="navigation">
		<div class="container">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <!-- <a class="navbar-brand" href="#">Brand</a> -->
		    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      

			      <ul class="nav navbar-nav navbar-right">        

			      	<li id="navDashboard"><a href="dashboard.php"><i class="glyphicon glyphicon-list-alt"></i>  Inicio</a></li> 
			      	<li id="navClient"><a href="client.php"><i class="glyphicon glyphicon-credit-card"></i>  Clientes</a></li> 
			        <li id="navProduct"><a href="product.php"> <i class="glyphicon glyphicon-ruble"></i> Productos </a></li>     
					<li class="dropdown" id="navOrder">
			        	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-shopping-cart"></i> Ordenes <span class="caret"></span></a>
				        <ul class="dropdown-menu">            
				        	<li id="topNavAddOrder"><a href="orders.php"> <i class="glyphicon glyphicon-plus"></i> Agregar Ordenes</a></li>            
				        	<li id="topNavManageOrder"><a href="ordersGestion.php"> <i class="glyphicon glyphicon-edit"></i> Gestionar Ordenes</a></li>          
				        </ul>
			        </li> 
			        <?php
			        if ($_SESSION['rol'] == 1) {
			        	echo '<li id="navGastos"><a href="gastos.php"> <i class="glyphicon glyphicon-usd"></i> Gastos </a></li>';
			        }else{

			          	}
			        ?>    
					<li id="navReports"><a href="reports.php"> <i class="glyphicon glyphicon-hdd"></i> Reportes </a></li> 
			        <li class="dropdown" id="navSetting">
			        	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-user"></i> <span class="caret"></span></a>
			          	<ul class="dropdown-menu">
			          		<li id="topNavUser"><a href=""> <i class="glyphicon glyphicon-user"></i> <span><?php echo $_SESSION['name'];   ?></span> </a></li> 
			          		<?php
			          		if ($_SESSION['rol'] == 1) {
			          			# code...
			          			echo '<li id="topNavSetting"><a href="setting.php"> <i class="glyphicon glyphicon-wrench"></i> Configuración</a></li> ';
			          			echo '<li id="topNavActivaciones"><a href="activaciones.php"><i class="fa fa-unlock-alt" aria-hidden="true"></i>	Activaciones</a></li> ';
			          		}else{

			          		}
			          		?>                 
			            	<li id="topNavLogout"><a data-toggle="modal" data-target="#ModalEnd"> <i class="glyphicon glyphicon-log-out"></i> Salir</a></li>            
			          	</ul>
			        </li>        
			               
			      </ul>
    		</div><!-- /.navbar-collapse -->
  		</div><!-- /.container-fluid -->
	</nav>

<!-- MODAL -->
<div id="ModalEnd" data-backdrop="static" data-keyboard="false" class="modal fade">  
  <div class="modal-dialog ">  
      <div class="modal-content"> 
          <div class="modal-header">  
                <button type="button" class="close" data-dismiss="modal">&times;</button>  
                <h4 class="modal-title">Cerrar Sesión</h4>  
          </div>  
          <div class="modal-body" id="">  

			<div class="row" class="col-sm-6 col-md-4">
				<center><img  src="assests/images/admiracion.png"  height="250"></center>
			    <p class="text-info text-center">¿ ESTAS SEGURO DE SALIR DEL SISTEMA ?</p>
				
			</div>

          </div>  

          <div class="modal-footer">  
          	  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <a href="cerrar_sesion.php" ><button type="button" class="btn btn-success" >Aceptar</button></a>
          </div>  
      </div>  
  </div>  
</div>
<!--End Modal -->

<div class="container">

