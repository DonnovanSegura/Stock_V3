<?php header('Content-Type: text/html; charset=UTF-8');?>
<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<?php 
$user_id = $_SESSION["iduser"];
$sql = "SELECT * FROM user WHERE id_user = {$user_id}";
$query = $connect->query($sql);
$result = $query->fetch_assoc();

$query = "SELECT id_client, nombre, status FROM client WHERE  status = 2";
$resultado = $connect->query($query);

//Clientes Eliminados
$query = "SELECT id_client, nombre_cte, status
          FROM client 
          WHERE status = 2 ";
$resultado = $connect->query($query);


$connect->close();
?>

<div class="row">
	<div class="col-md-12">

		<div class="panel panel-info">
				<div class="panel-heading">
					<div class="page-heading"> <i class="glyphicon glyphicon-wrench"></i> Configuración</div>
				</div> <!-- /panel-heading -->

				<div class="panel-body">

					<div class="remove-messages"></div>

					<div class="div-action pull pull-right" style="padding-bottom:20px;">
						<button class="btn btn-default button1" data-toggle="modal" id="addUserModalBtn" data-target="#addUserModal"> <i class="glyphicon glyphicon-plus-sign"></i> Agregar Usuario </button>
					</div> <!-- /div-action -->	

					<table class="table" id="manageUserTable">
						<thead>
							<tr>
								<th>Codigo</th>							
								<th>Nombre</th>
								<th>Usuario</th>							
								<th>Contraseña</th>
								<th>Rol</th>
								<th style="width:15%;">Opciones</th>
								</tr>
						</thead>
					</table>
						<!-- /table -->

				</div> <!-- /panel-body -->
		</div> <!-- /panel -->
	</div> 
</div> 

</br>
</br>

<div class="row">
	<div class="col-md-12">

		<div class="panel panel-warning">
				<div class="panel-heading">
					<div class="page-heading"> <i class="glyphicon glyphicon-download-alt"></i>  Respaldar Base de Datos</div>
				</div> <!-- /panel-heading -->

				<div class="panel-body">

					<p class="text-justify" >Copia de Seguridad (Backup) de la base de datos del Sistema, se creara una copia de los datos originales que almacena la BD. El proceso de 
					la copia de seguridad se completa dando clic en el boton "Expotar BD", y en automatico mandara a una ventana donde solo se le da click en el boton continuar, y se importara toda la base de datos
					con sus registros y tablas, se almacenara en la ubicacion que le de el usuario (Administrador), con el nombre, store_fecharespaldo.sql . Se recomienda que el proceso
					sea cada semana, pero se podra hacer en el momento que el Usuario lo desee. El proceso puede tardar algunos minutos.</p>
				</br>

				<div class="div-action pull pull-left" style="padding-bottom:20px;">
					<a href="http://localhost:8080/phpmyadmin/db_export.php?db=store"><button class="btn btn-primary"  > <i class="glyphicon glyphicon-download-alt"></i>&nbsp;&nbsp;Exportar BD</button></a>
				</div> <!-- /div-action -->	

				</div> <!-- /panel-body -->
		</div> <!-- /panel -->
	</div> 
</div> 

<!--<div class="row">

  <div class="col-md-6">
    <div class="card">
        <div class="cardHeader" style="background-color:#155876;">
            <h2>Activar Clientes Vencidos</h2>
        </div>
        <div class="cardContainer">
           
          <table class="table table-condensed">
              <thead>
                  <tr>
                      <th># Cte.</th>
                      <th>Cliente.</th>
                      <th>Activar.</th> 
                  </tr>
              </thead>
              <?php
              //while($row = $resultado->fetch_assoc() ) {
              ?>
              <tr>
                  <td><?php //echo $row["id_client"];?></td>
                  <td><?php //echo $row["nombre_cte"];?></td>
                  <td>
					<input type="button" name="activar" value="Activar" id=""  title="Activar" class="btn btn-warning btn-sm edit_data" data-toggle="modal" id="addProductModalBtn" data-target="#mensajeError"/> 
                  </td>
                  
              </tr>
              <?php
              //}
              ?>
   	     </table>

        </div>
    </div> 
  </div>


</div>/row-->


<script src="custom/js/setting.js"></script>
<?php require_once 'includes/footer.php'; ?>

<!-- MODAL -->
<div id="mensajeError" data-backdrop="static" data-keyboard="false" class="modal fade">  
  <div class="modal-dialog ">  
      <div class="modal-content"> 
          <div class="modal-header">  
                <button type="button" class="close" data-dismiss="modal">&times;</button>  
                <h4 class="modal-title">Activar Clientes</h4>  
          </div>  
          <div class="modal-body" id="">  

			<div class="row" class="col-sm-6 col-md-4">
				<center><img  src="assests/images/warning.png"  height="250"></center>
			    <p class="text-info text-center">SOLO LOS ADMINISTRADORES PUEDEN HACER ESTA ACCIÓN</p>
				
			</div>

          </div>  

          <div class="modal-footer">  
        <!--  	 <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>-->
            <a><button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button></a>
          </div>  
      </div>  
  </div>  
</div>
<!--End Modal -->

<!-- edit User  Modal-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="editUserModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title"><i class="fa fa-edit"></i> Editar Usuario</h4>
	      	</div>

	      	<div class="modal-body" style="max-height:450px; overflow:auto;">

				<div class="div-loading">
	      			<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
					<span class="sr-only">Cargando...</span>
	      		</div>

	      		<div class="div-result">

				 			<form class="form-horizontal" id="editUsertForm" action="php_action/editUser.php" method="POST">
				 				<br />
								<div id="edit-user-messages"></div>
					
								<div class="form-group">
						        	<label for="ediUsertName" class="col-sm-3 control-label">Nombre </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="editUserName" placeholder="Nombre del Usuario" name="editUserName" autocomplete="off">
									    </div>
						        </div> <!-- /form-group-->

						        <div class="form-group">
						        	<label for="ediUsertNick" class="col-sm-3 control-label">Usuario </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="editUserNick" placeholder="Usuario" name="editUserNick" autocomplete="off">
									    </div>
						        </div> <!-- /form-group-->

						        <div class="form-group">
						        	<label for="ediUsertPass" class="col-sm-3 control-label">Contraseña </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="editUserPass" placeholder="Contraseña" name="editUserPass" autocomplete="off">
									    </div>
						        </div> <!-- /form-group-->

						        <div class="form-group">
						        	<label for="editUserRol" class="col-sm-3 control-label">Rol: </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <select class="form-control" id="editUserRol" name="editUserRol">
									      	<option selected disabled hidden>-- Selecciona --</option>
									      	<option value="1">Administrador</option>
									      	<option value="2">Estandar</option>
									      </select>
									    </div>
				        		</div> <!-- /form-group-->

						      
						        <div class="modal-footer editUserFooter">
							        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
							        <button type="submit" class="btn btn-success" id="editUsertBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar Cambios</button>
							    </div> <!-- /modal-footer -->	

				 			</form><!--form-->
	      		</div><!--DIV RESULT-->
	      	</div><!--Modal Body-->
		</div> <!--Modal Conten-->
	</div> <!-- Modal Dialog-->
</div><!-- end edit User  Modal-->

<!-- add User  Modal-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="addUserModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<form class="form-horizontal" id="submitUsertForm" action="php_action/createUser.php" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
				    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				    <h4 class="modal-title"><i class="fa fa-plus"></i> Agregar Usuario</h4>
			    </div>

			    <div class="modal-body" style="max-height:450px; overflow:auto;">
					
					<div id="add-user-messages"></div>
					
					<div class="form-group">
			        	<label for="UserName" class="col-sm-3 control-label">Nombre: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="UserName" placeholder="Nombre" name="UserName" autocomplete="off">
						    </div>
	        		</div> <!-- /form-group--> 

	        		<div class="form-group">
			        	<label for="UserNick" class="col-sm-3 control-label">Usuario: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="UserNick" placeholder="Usuario" name="UserNick" autocomplete="off">
						    </div>
	        		</div> <!-- /form-group-->   

	        		<div class="form-group">
			        	<label for="UserPass" class="col-sm-3 control-label">Contraseña: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="UserPass" placeholder="Contraseña" name="UserPass" autocomplete="off">
						    </div>
	        		</div> <!-- /form-group-->   

	        		<div class="form-group">
			        	<label for="userRol" class="col-sm-3 control-label">Rol: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <select class="form-control" id="userRol" name="userRol">
						      	<option selected disabled hidden>-- Selecciona --</option>
						      	<option value="1">Administrador</option>
						      	<option value="2">Estandar</option>
						      </select>
						    </div>
	        		</div> <!-- /form-group-->


					
				</div> <!-- /modal-body -->

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
					<button type="submit" class="btn btn-primary" id="createUserBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
				</div><!-- /modal-footer -->	 

			</form> <!-- /.form -->	 

		</div> <!-- /modal-content --> 
	<div><!-- /modal-dailog -->

</div><!-- End add User  Modal-->