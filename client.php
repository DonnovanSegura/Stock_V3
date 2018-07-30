<?php header('Content-Type: text/html; charset=UTF-8');?>
<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Inicio</a></li>		  
		  <li class="active">Clientes</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Listado de Clientes</div>
			</div> <!-- /panel-heading -->

			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" id="addClientModalBtn" data-target="#addClientModal"> <i class="glyphicon glyphicon-plus-sign"></i> Agregar Cliente </button>
				</div> <!-- /div-action -->	

				<table class="table" id="manageClientTable">
					<thead>
						<tr>
							<th>Código</th>
							<th>Nombre</th>							
							<th>Correo Electronico</th>
							<th>Telefono</th>			
							<th>Categoria </th>
							<th style="width:15%;">Opciones</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->	
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<script src="custom/js/client.js"></script>
<?php require_once 'includes/footer.php'; ?>


<!--Eliminar Cliente Modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="removeClientModal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Eliminar Cliente</h4>
      </div>
      <div class="modal-body">

      	<div class="removeClientMessages"></div>

        <p>Realmente deseas eliminar el Cliente?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cancelar</button>
        <button type="button" class="btn btn-primary" id="removeClientBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Eliminar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--End Eliminar Cliente Modal -->


<!-- Edit client  Modal-->
<div class="modal fade" id="editClientModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" >
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title"><i class="fa fa-edit"></i> Editar Cliente</h4>
	      	</div>

	      	<div class="modal-body" style="max-height:450px; overflow:auto;">

				<div class="div-loading">
	      			<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
					<span class="sr-only">Cargando...</span>
	      		</div>

	      		<div class="div-result">

				 			<form class="form-horizontal" id="editClientForm" action="php_action/editClient.php" method="POST">
				 				<br />
								<div id="edit-client-messages"></div>

								<div class="form-group">
						        	<label for="editClientID" class="col-sm-3 control-label">Código: </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="editClientID"name="editClientID" disabled="true" autocomplete="off">
									    </div>
						        </div> <!-- /form-group-->
					
								<div class="form-group">
						        	<label for="editClientName" class="col-sm-3 control-label">Nombre: </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="editClientName" placeholder="Nombre del Cliente" name="editClientName" autocomplete="off">
									    </div>
						        </div> <!-- /form-group-->

						        <div class="form-group">
						        	<label for="editClientAddress" class="col-sm-3 control-label">Dirección: </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="editClientAddress" placeholder="Dirección del Cliente" name="editClientAddress" autocomplete="off">
									    </div>
						        </div> <!-- /form-group-->

						        <div class="form-group">
						        	<label for="editClientEmail" class="col-sm-3 control-label">Email: </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="editClientEmail" placeholder="Email del Cliente" name="editClientEmail" autocomplete="off">
									    </div>
						        </div> <!-- /form-group-->

						        <div class="form-group">
						        	<label for="editClientTelefono" class="col-sm-3 control-label">Telefono: </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="editClientTelefono" placeholder="Telefono del Cliente" name="editClientTelefono" autocomplete="off">
									    </div>
						        </div> <!-- /form-group-->


				        		<div class="form-group">
						        	<label for="editClientStatus" class="col-sm-3 control-label">Categoria: </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <select class="form-control" id="editClientStatus" name="editClientStatus">
									      	<option selected disabled hidden>-- Selecciona --</option>
									      	<option value="1">Oro</option>
									      	<option value="2">Plata</option>
									      	<option value="3">Bronce</option>
									      </select>
									    </div>
				        		</div> <!-- /form-group-->	

				        		<div class="form-group">
						        	<label for="editClientComent" class="col-sm-3 control-label">Comentario: </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="editClientComent" placeholder="Comentario del Cliente" name="editClientComent" autocomplete="off">
									    </div>
						        </div> <!-- /form-group--> 

						        <div class="modal-footer editClientFooter">
							        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
							        <button type="submit" class="btn btn-success" id="editClientBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar Cambios</button>
							    </div> <!-- /modal-footer -->	

				 			</form><!--form-->

	      		</div><!--DIV RESULT-->

	      	</div><!--Modal Body-->

		</div> <!--Modal Conten-->
	</div> <!-- Modal Dialog-->
</div>
<!-- Edit add product  Modal-->



<!-- add Cliente  Modal-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="addClientModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<form class="form-horizontal" id="submitClientForm" action="php_action/createClient.php" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
				    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				    <h4 class="modal-title"><i class="fa fa-plus"></i> Agregar Cliente</h4>
			    </div>

			    <div class="modal-body" style="max-height:450px; overflow:auto;">
					
					<div id="add-client-messages"></div>
					
					<div class="form-group">
			        	<label for="clientName" class="col-sm-3 control-label">Nombre: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="clientName" placeholder="Nombre del Cliente" name="clientName" autocomplete="off">
						    </div>
	        		</div> <!-- /form-group-->  

	        		<div class="form-group">
			        	<label for="clientAddres" class="col-sm-3 control-label">Dirección: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="clientAddres" placeholder="Dirección del Cliente" name="clientAddres" autocomplete="off">
						    </div>
	        		</div> <!-- /form-group--> 

	        		<div class="form-group">
			        	<label for="clientEmail" class="col-sm-3 control-label">Email: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="clientEmail" placeholder="Email del Cliente" name="clientEmail" autocomplete="off">
						    </div>
	        		</div> <!-- /form-group--> 

	        		<div class="form-group">
			        	<label for="clientTelefono" class="col-sm-3 control-label">Telefono: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="clientTelefono" placeholder="Telefono del Cliente" name="clientTelefono" autocomplete="off">
						    </div>
	        		</div> <!-- /form-group-->  

	        		<div class="form-group">
			        	<label for="ClientStatus" class="col-sm-3 control-label">Categoria: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <select class="form-control" id="ClientStatus" name="ClientStatus">
						      	<option selected disabled hidden>-- Selecciona --</option>
						      	<option value="1">Oro</option>
						      	<option value="2">Plata</option>
						      	<option value="3">Bronce</option>
						      </select>
						    </div>
	        		</div> <!-- /form-group-->

	        		<div class="form-group">
			        	<label for="clientComentario" class="col-sm-3 control-label">Comentario </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="clientComentario" placeholder="Comentario del Cliente" name="clientComentario" autocomplete="off">
						    </div>
	        		</div> <!-- /form-group--> 
					
					
				</div> <!-- /modal-body -->

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
					<button type="submit" class="btn btn-primary" id="createClientBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
				</div><!-- /modal-footer -->	 

			</form> <!-- /.form -->	 

		</div> <!-- /modal-content --> 
	<div><!-- /modal-dailog -->
</div><!-- End add Client  Modal-->