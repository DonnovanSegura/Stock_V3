<?php header('Content-Type: text/html; charset=UTF-8');?>
<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Inicio</a></li>		  
		  <li class="active">Gastos</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Listado de Gastos</div>
			</div> <!-- /panel-heading -->

			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					
					<button class="btn btn-default button1" data-toggle="modal" id="addGastoModalBtn" data-target="#addGastoModal"> <i class="glyphicon glyphicon-plus-sign"></i> Agregar Gasto </button>
					
				</div> <!-- /div-action -->	

				<table class="table" id="manageGastosTable">
					<thead>
						<tr>
							<th>Folio Gasto</th>	
							<th>Fecha</th>						
							<th>Concepto</th>
							<th>Monto</th>							
							<th>Opciones</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->	
	</div> <!-- /col-md-12 -->

</div> <!-- /row -->

	<div class="panel panel-info" >
			<div class="panel-heading" >
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Reportes de Gastos</div>
			</div> <!-- /panel-heading -->

			<div class="panel-body">

				<div class="col-md-4">

					<div class="div-action " style="padding-bottom:20px;">
					<p>Imprimir Historial de Gastos</p>
					<a href="pdf/RptGastos.php" title=""  target=”_blank” ><button class="btn btn-danger button1" data-toggle="modal" > <i class="glyphicon glyphicon-print"></i> Imprimir </button></a>
					</div> <!-- /div-action -->	
					
				</div>

				<div class="col-md-8">
					<div class="div-action " style="padding-bottom:20px;">
						<p>Imprimir Gastos por Fechas</p>
						<form action="" method="POST" accept-charset="utf-8" class="form-inline" role="form">
							<div class="form-group"><label>Fecha Inicial:</label>
								<input type="date" class="form-control" name="fcha1G" id="fcha1G"  required/>
							</div>
							<div class="form-group"><label>Fecha Final:</label>
								<input type="date" class="form-control" name="fcha2G" id="fcha2G" required/>
							</div>
							<div class="form-group">
								<a href="javascript:reportePDFGastosxFechas();" class="btn btn-danger" rol="button"><i class="glyphicon glyphicon-print" ></i>  Imprimir</a>
							</div>
						</form>
					</div>
				</div>

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->	



<!-- edit Gasto  Modal-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="editGastoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title"><i class="fa fa-edit"></i> Editar Gasto</h4>
	      	</div>

	      	<div class="modal-body" style="max-height:450px; overflow:auto;">

				<div class="div-loading">
	      			<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
					<span class="sr-only">Cargando...</span>
	      		</div>

	      		<div class="div-result">

				 			<form class="form-horizontal" id="editGastoForm" action="php_action/editGasto.php" method="POST">
				 				<br />
								<div id="edit-gasto-messages"></div>

								<div class="form-group">
						        	<label for="editGastoFolio" class="col-sm-3 control-label">Folio </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="editGastoFolio" placeholder="Concepto" name="editGastoFolio" disabled="true">
									    </div>
						        </div> <!-- /form-group-->
					
								<div class="form-group">
						        	<label for="editGastoConcep" class="col-sm-3 control-label">Concepto </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="editGastoConcep" placeholder="Concepto" name="editGastoConcep" autocomplete="off">
									    </div>
						        </div> <!-- /form-group-->

						        <div class="form-group">
						        	<label for="ediUGastoMonto" class="col-sm-3 control-label">Monto </label>
						        	<label class="col-sm-1 control-label">$ </label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="editGastoMonto" placeholder="Monto" name="editGastoMonto" autocomplete="off">
									    </div>
						        </div> <!-- /form-group-->

						        <div class="modal-footer editGastoFooter">
							        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
							        <button type="submit" class="btn btn-success" id="editGastoBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar Cambios</button>
							    </div> <!-- /modal-footer -->	

				 			</form><!--form-->
	      		</div><!--DIV RESULT-->
	      	</div><!--Modal Body-->
		</div> <!--Modal Conten-->
	</div> <!-- Modal Dialog-->
</div><!-- end edit Gasto  Modal-->

<!-- add Gasto  Modal-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="addGastoModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<form class="form-horizontal" id="submitGastoForm" action="php_action/createGasto.php" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
				    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				    <h4 class="modal-title"><i class="fa fa-plus"></i> Agregar Gasto</h4>
			    </div>

			    <div class="modal-body" style="max-height:450px; overflow:auto;">
					
					<div id="add-gasto-messages"></div>
					
					<div class="form-group">
			        	<label for="conceptoGasto" class="col-sm-3 control-label">Conceto </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="conceptoGasto" placeholder="Concepto" name="conceptoGasto" autocomplete="off">
						    </div>
	        		</div> <!-- /form-group--> 

	        		<div class="form-group">
			        	<label for="montoGasto" class="col-sm-3 control-label">Monto </label>
			        	<label class="col-sm-1 control-label">$ </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="montoGasto" placeholder="Monto" name="montoGasto" autocomplete="off">
						    </div>
	        		</div> <!-- /form-group-->   

				</div> <!-- /modal-body -->

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
					<button type="submit" class="btn btn-primary" id="createGastoBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
				</div><!-- /modal-footer -->	 

			</form> <!-- /.form -->	 

		</div> <!-- /modal-content --> 
	<div><!-- /modal-dailog -->

</div><!-- End add User  Modal-->

<script src="custom/js/gastos.js"></script>
<?php require_once 'includes/footer.php'; ?>

<script  type="text/javascript">

	function reportePDFGastosxFechas(){
		var desde   = $('#fcha1G').val();
		var hasta   = $('#fcha2G').val();
		window.open('pdf/RptGastosFechas.php?desde='+desde+'&hasta='+hasta);

	}
</script>






