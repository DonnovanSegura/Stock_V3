<?php header('Content-Type: text/html; charset=UTF-8');?>
<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>



<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="cardHeader" style="background-color:#155876;">
				<h2>Activar Clientes Eliminados</h2>
			</div>
			<div class="cardContainer">
           
				<table class="table table-condensed" id="actCteTable">
					<thead>
					<tr>
						<th># Cte.</th>
						<th>Cliente.</th>
						<th>Activar.</th> 
					</tr>
					</thead>
		          
				</table>

			</div>
		</div> 
	</div>

<div class="col-md-6">
	<div class="card">
		<div class="cardHeader" style="background-color:#331513;">
			<h2>Activar Productos Eliminados</h2>
		</div>
		<div class="cardContainer">
		           
			<table class="table table-condensed" id="actProducTable">
				<thead>
				<tr>
					<th>Codigo Barras.</th>
					<th>Descripcion.</th>
					<th>Activar.</th> 
				</tr>
				</thead>
			          
			</table>

		</div>
		</div> 
	</div>

</div> <!-- Row-->

<script src="custom/js/activaciones.js"></script>
<?php require_once 'includes/footer.php'; ?>

<!-- Activar Cliente  Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="actCteModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title"><i class="fa fa-unlock" aria-hidden="true"></i> Activar Cliente</h4>
	      	</div>

	      	<div class="modal-body" style="max-height:450px; overflow:auto;">

				<div class="div-loading">
	      			<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
					<span class="sr-only">Cargando...</span>
	      		</div>

	      		<div class="div-result">

				 			<form class="form-horizontal" id="editUsertForm" action="php_action/editClientDelete.php" method="POST">
				 				<br />
								<div id="edit-user-messages"></div>
					
								<div class="form-group">
						        	<label for="codCteDelete" class="col-sm-3 control-label">Codigo </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="codCteDelete" placeholder="Codigo del Cliente" name="codCteDelete" disabled="true" autocomplete="off">
									    </div>
						        </div> 

						        <div class="form-group">
						        	<label for="nameCteDelete" class="col-sm-3 control-label">Nombre </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="nameCteDelete" placeholder="Nombre" name="nameCteDelete" disabled="true" autocomplete="off">
									    </div>
						        </div> 

						        <div class="form-group">
						        	<label for="comenCteDelete" class="col-sm-3 control-label">Comentario </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="comenCteDelete" placeholder="Comentario" name="comenCteDelete" autocomplete="off">
									    </div>
						        </div> 

						        <div class="form-group">
						        	<label for="statusCteDelete" class="col-sm-3 control-label">Status </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <select class="form-control" id="statusCteDelete" name="statusCteDelete">
									      	<option selected disabled hidden> Selecciona </option>
									      	<option value="1">Activado</option>
									      	<option value="2">Desactivado</option>
									      </select>
									    </div>
				        		</div> 

						      
						        <div class="modal-footer editUserFooter">
							        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
							        <button type="submit" class="btn btn-success" id="editUsertBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar Cambios</button>
							    </div> 

				 			</form>
	      		</div>
	      	</div>
		</div> 
	</div> 
</div> 

<!-- Activar Producto  Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="actProModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title"><i class="fa fa-unlock" aria-hidden="true"></i> Activar Cliente</h4>
	      	</div>

	      	<div class="modal-body" style="max-height:450px; overflow:auto;">

				<div class="div-loading">
	      			<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
					<span class="sr-only">Cargando...</span>
	      		</div>

	      		<div class="div-result">

				 			<form class="form-horizontal" id="editProducttForm" action="php_action/editProductDelete.php" method="POST">
				 				<br />
								<div id="edit-product-messages"></div>
					
								<div class="form-group">
						        	<label for="codProdDelete" class="col-sm-3 control-label">Codigo Barras </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="codProdDelete" placeholder="Codigo del Producto" name="codProdDelete" disabled="true" autocomplete="off">
									    </div>
						        </div> 

						        <div class="form-group">
						        	<label for="descProdDelet" class="col-sm-3 control-label">Descripción </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="descProdDelet" placeholder="Descripción" name="descProdDelet" disabled="true" autocomplete="off">
									    </div>
						        </div> 

						        <div class="form-group">
						        	<label for="marcaProdDelete" class="col-sm-3 control-label">Marca </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="marcaProdDelete" placeholder="Marca" disabled="true" name="marcaProdDelete" autocomplete="off">
									    </div>
						        </div> 

						        <div class="form-group">
						        	<label for="statusProdDelete" class="col-sm-3 control-label">Status </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <select class="form-control" id="statusProdDelete" name="statusProdDelete">
									      	<option selected disabled hidden>Selecciona </option>
									      	<option value="1">Activado</option>
									      	<option value="2">Desactivado</option>
									      </select>
									    </div>
				        		</div> 

						      
						        <div class="modal-footer activarProdDelete">
							        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
							        <button type="submit" class="btn btn-success" id="editProdDelete" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar Cambios</button>
							    </div> 

				 			</form>
	      		</div>
	      	</div>
		</div> 
	</div> 
</div>