<?php header('Content-Type: text/html; charset=UTF-8');?>
<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Inicio</a></li>		  
		  <li class="active">Productos</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Listado de productos</div>
			</div> <!-- /panel-heading -->

			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<?php
			
			        if ($_SESSION['rol'] == 1) {
			          			
			        	echo '<button class="btn btn-default button1" data-toggle="modal" id="addProductModalBtn" data-target="#addProductModal"> <i class="glyphicon glyphicon-plus-sign"></i> Agregar producto </button>';
					}else{
						echo '<button class="btn btn-default button1" data-toggle="modal" id="addProductModalBtn" data-target="#mensajeError"> <i class="glyphicon glyphicon-plus-sign"></i> Agregar producto </button>';	
					}
					?>
				</div> <!-- /div-action -->	

				<table class="table" id="manageProductTable">
					<thead>
						<tr>
							<th>Imagen</th>	
							<th>Cod Barras</th>						
							<th>Nombre del producto</th>
							<th>Precio</th>							
							<th>Stock</th>
							<th>Marca</th>
							<th>Género</th>
							<th>Estado</th>
							<th>Opciones</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->	
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<script src="custom/js/product.js?ver=1.0.10"></script>
<?php require_once 'includes/footer.php'; ?>

<!-- MODAL -->
<div id="mensajeError" data-backdrop="static" data-keyboard="false" class="modal fade">  
  <div class="modal-dialog ">  
      <div class="modal-content"> 
          <div class="modal-header">  
                <button type="button" class="close" data-dismiss="modal">&times;</button>  
                <h4 class="modal-title">Cuidado</h4>  
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

<!--Eliminar Producto Modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="removeProductModal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Eliminar producto</h4>
      </div>
      <div class="modal-body">

      	<div class="removeProductMessages"></div>

        <p>Realmente deseas eliminar el Producto?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cancelar</button>
        <button type="button" class="btn btn-primary" id="removeProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Eliminar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--End Eliminar Producto Modal -->


<!-- Edit product  Modal-->

<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" >
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title"><i class="fa fa-edit"></i> Editar producto</h4>
	      	</div>

	      	<div class="modal-body" style="max-height:450px; overflow:auto;">

				<div class="div-loading">
	      			<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
					<span class="sr-only">Cargando...</span>
	      		</div>

	      		<div class="div-result">
				
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active">
							<a href="#photo" aria-controls="home" role="tab" data-toggle="tab">Imagen</a>
						</li>
						<li role="presentation">
							<a href="#productInfo" aria-controls="profile" role="tab" data-toggle="tab" >Información del producto</a>
						</li>
					</ul>

					<!-- Tab panes -->
				 	<div class="tab-content">

				 		<div role="tabpanel" class="tab-pane active" id="photo">
				 			<form action="php_action/editProductImage.php" method="POST" id="updateProductImageForm" class="form-horizontal" enctype="multipart/form-data">
				 				<br />
				    			<div id="edit-productPhoto-messages"></div>

				    			<div class="form-group">
						        	<label for="editProductImage" class="col-sm-3 control-label">Imagen: </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">							    				   
									      <img src="" id="getProductImage" class="thumbnail" style="width:250px; height:250px;" />
									    </div>
			        			</div> <!-- /form-group-->

			        			<div class="form-group">
						        	<label for="editProductImage" class="col-sm-3 control-label">Selecciona imagen: </label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
										    <!-- the avatar markup -->
											<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
										    <div class="kv-avatar center-block">					        
										        <input type="file" class="form-control" id="editProductImage" placeholder="Product Name" name="editProductImage" class="file-loading" style="width:auto;"/>
										    </div>
									      
									    </div>
			        			</div> <!-- /form-group-->

			        			<div class="modal-footer editProductPhotoFooter">
				        			<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
				       				<!-- <button type="submit" class="btn btn-success" id="editProductImageBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar Cambios</button> -->
				      			</div>	<!-- /modal-footer -->

				 			</form><!--FORM-->
				 		</div> <!-- product image -->

						<!-- Información Producto -->
				 		<div role="tabpanel" class="tab-pane" id="productInfo">
				 			<form class="form-horizontal" id="editProductForm" action="php_action/editProduct.php" method="POST">
				 				<br />
								<div id="edit-product-messages"></div>

								<div class="form-group">
						        	<label for="idProductName" class="col-sm-3 control-label">Codigo</label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="idProductName"  name="idProductName" disabled="true" autocomplete="off">
									    </div>
						        </div> <!-- /form-group-->	
					
								<div class="form-group">
						        	<label for="editProductName" class="col-sm-3 control-label">Descripción</label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      	<?php
									        if ($_SESSION['rol'] == 1) {
									          			
									        	echo'<input type="text" class="form-control" id="editProductName" placeholder="Descripción del producto" name="editProductName" autocomplete="off">';
										    }else{
										    	echo'<input type="text" class="form-control" id="editProductDescrip" disabled="true" name="editProduct" autocomplete="off">';
										    	echo'<input type="hidden" class="form-control" id="editProductName" name="editProductName" autocomplete="off">';
										    } 
										    ?>
									    </div>
						        </div> <!-- /form-group-->	

						         <div class="form-group">
						        	
									    <?php
								        if ($_SESSION['rol'] == 1) {
								          			
								        	echo'<label for="editProductCosto" class="col-sm-3 control-label">Costo </label>
						        				<label class="col-sm-1 control-label">$ </label>
									    		<div class="col-sm-8">
								        		<input type="text" class="form-control" id="editProductCosto" placeholder="Costo del producto" name="editProductCosto" autocomplete="off">
									   			</div>';
									    }else{
									    	echo '<input type="hidden" class="form-control" id="editProductCosto" placeholder="Costo del producto" name="editProductCosto" autocomplete="off">';
									    } 
										?>
									    
						        </div> <!-- /form-group-->	 

						        <div class="form-group">
						        	<label for="editProductPrecio" class="col-sm-3 control-label">Precio Oro</label>
						        	<label class="col-sm-1 control-label">$ </label>
									    <div class="col-sm-8">
									    <?php
								        if ($_SESSION['rol'] == 1) {
								          			
								        	echo'<input type="text" class="form-control" id="editProductPrecio" placeholder="Precio del producto" name="editProductPrecio" autocomplete="off">';
									    }else{
									    	echo'<input type="text" class="form-control" id="editProduct" disabled="true" name="editProduct" autocomplete="off">';
									    	echo'<input type="hidden" class="form-control" id="editProductPrecio" name="editProductPrecio" autocomplete="off">';
									    } 
									    ?>
									    </div>
						        </div> <!-- /form-group-->	

						        <div class="form-group">
						        	<label for="editProductPlata" class="col-sm-3 control-label">Precio Plata</label>
						        	<label class="col-sm-1 control-label">$ </label>
									    <div class="col-sm-8">
									    <?php
								        if ($_SESSION['rol'] == 1) {
								          			
								        	echo'<input type="text" class="form-control" id="editProductPlata" placeholder="Precio Plata" name="editProductPlata" autocomplete="off">';
									    }else{
									    	echo'<input type="text" class="form-control" id="editProductPlata2" disabled="true" name="editProductPlata2" autocomplete="off">';
									    	echo'<input type="hidden" class="form-control" id="editProductPlata" name="editProductPlata" autocomplete="off">';
									    } 
									    ?>
									    </div>
						        </div> <!-- /form-group-->

						        <div class="form-group">
						        	<label for="editProductBronce" class="col-sm-3 control-label">Precio Bronce</label>
						        	<label class="col-sm-1 control-label">$ </label>
									    <div class="col-sm-8">
									    <?php
								        if ($_SESSION['rol'] == 1) {
								          			
								        	echo'<input type="text" class="form-control" id="editProductBronce" placeholder="Precio Oro" name="editProductBronce" autocomplete="off">';
									    }else{
									    	echo'<input type="text" class="form-control" id="editProductBronce2" disabled="true" name="editProductBronce2" autocomplete="off">';
									    	echo'<input type="hidden" class="form-control" id="editProductBronce" name="editProductBronce" autocomplete="off">';
									    } 
									    ?>
									    </div>
						        </div> <!-- /form-group-->

						        <div class="form-group">
						        	<label for="editProductMarca" class="col-sm-3 control-label">Marca</label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="editProductMarca" placeholder="Marca del producto" name="editProductMarca" autocomplete="off">
									    </div>
						        </div> <!-- /form-group-->	 

						        <div class="form-group">
						        	<label for="editProductStock" class="col-sm-3 control-label">Stock</label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      	<?php
									        if ($_SESSION['rol'] == 1) {
									          			
									        	echo'<input type="text" class="form-control" id="editProductStock" placeholder="Stock del producto" name="editProductStock" autocomplete="off">';
										    }else{
										    	echo'<input type="text" class="form-control" id="editProductStockHidden" disabled="true" name="editProductStock" autocomplete="off">';
										    	echo'<input type="hidden" class="form-control" id="editProductStock"  name="editProductStock" autocomplete="off">';
										    } 
										    ?>
									    </div>
						        </div> <!-- /form-group-->	

						        <div class="form-group">
						        	<label for="editProductGenero" class="col-sm-3 control-label">Género</label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <select class="form-control" id="editProductGenero" name="editProductGenero">
									      	<option selected disabled hidden>-- Selecciona --</option>
									      	<option value="1">HOMBRE</option>
									      	<option value="2">MUJER</option>
									      	<option value="3">NIÑO</option>
									      	<option value="4">NIÑA</option>
									      </select>
									    </div>
				        		</div> <!-- /form-group-->  

						        <div class="form-group">
						        	<label for="editProductStatus" class="col-sm-3 control-label">Estado</label>
						        	<label class="col-sm-1 control-label">: </label>
									    <div class="col-sm-8">
									      <select class="form-control" id="editProductStatus" name="editProductStatus">
									      	<option selected disabled hidden>-- Selecciona -- </option>
									      	<option value="1">Disponible</option>
									      	<option value="2">No disponible</option>
									      </select>
									    </div>
						        </div> <!-- /form-group-->	

						        <div class="modal-footer editProductFooter">
							        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
							        <button type="submit" class="btn btn-success" id="editProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar Cambios</button>
							    </div> <!-- /modal-footer -->	

				 			</form><!--form-->
				 		</div> <!-- /product info -->




					</div><!--End tab panels-->

	      		</div><!--DIV RESULT-->

	      	</div><!--Modal Body-->

		</div> <!--Modal Conten-->
	</div> <!-- Modal Dialog-->
</div>
<!-- Edit add product  Modal-->

<!-- add product  Modal-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="addProductModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<form class="form-horizontal" id="submitProductForm" action="php_action/createProduct.php" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
				    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				    <h4 class="modal-title"><i class="fa fa-plus"></i> Agregar producto</h4>
			    </div>

			    <div class="modal-body" style="max-height:450px; overflow:auto;">
					
					<div id="add-product-messages"></div>

					<div class="form-group">
			        	<label for="productImage" class="col-sm-3 control-label">Imagen </label>
			        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
						    <!-- the avatar markup -->
							<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
						    <div class="kv-avatar center-block">					        
						        <input type="file" class="form-control" id="productImage" placeholder="Imagen del producto" name="productImage" class="file-loading" style="width:auto;"/>
						    </div>
					    </div>
	        		</div> <!-- /form-group-->	   

	        		<div class="form-group">
			        	<label for="productName" class="col-sm-3 control-label">Descripción </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="productName" placeholder="Descripción del producto" name="productName" autocomplete="off">
						    </div>
	        		</div> <!-- /form-group-->  	
					
					<div class="form-group">
					    <label for="costo" class="col-sm-3 control-label">Costo </label>
					    <label class="col-sm-1 control-label">$ </label>
							<div class="col-sm-8">
								 <input type="text" class="form-control" id="costo" placeholder="Costo" name="costo" autocomplete="off">
							</div>
					</div> <!-- /form-group--> 
	        		
				    <div class="form-group">
					    <label for="precio" class="col-sm-3 control-label">Precio Oro </label>
					    <label class="col-sm-1 control-label">$ </label>
							<div class="col-sm-8">
								 <input type="text" class="form-control" id="precio" placeholder="Precio Oro" name="precio" autocomplete="off">
							</div>
					</div> <!-- /form-group-->  

					<div class="form-group">
					    <label for="Plata" class="col-sm-3 control-label">Precio Plata</label>
					    <label class="col-sm-1 control-label">$ </label>
							<div class="col-sm-8">
								 <input type="text" class="form-control" id="Plata" placeholder="Precio Plata" name="Plata" autocomplete="off">
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
					    <label for="Bronce" class="col-sm-3 control-label">Precio Bronce </label>
					    <label class="col-sm-1 control-label">$ </label>
							<div class="col-sm-8">
								 <input type="text" class="form-control" id="Bronce" placeholder="Precio Bronce" name="Bronce" autocomplete="off">
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
			        	<label for="brandName" class="col-sm-3 control-label">Marca </label>
			        	<label class="col-sm-1 control-label">: </label>
			        		<div class="col-sm-8">
								 <input type="text" class="form-control" id="marca" placeholder="Marca" name="marca" autocomplete="off">
							</div>

			        </div> <!-- /form-group-->

			        <div class="form-group">
						<label for="quantity" class="col-sm-3 control-label">Stock </label>
						<label class="col-sm-1 control-label">: </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="quantity" placeholder="Stock" name="quantity" autocomplete="off">
							</div>
					</div> <!-- /form-group--> 

					<div class="form-group">
			        	<label for="productGenero" class="col-sm-3 control-label">Género </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <select class="form-control" id="productGenero" name="productGenero">
						      	<option selected disabled hidden>-- Selecciona --</option>
						      	<option value="1">HOMBRE</option>
						      	<option value="2">MUJER</option>
						      	<option value="3">NIÑO</option>
						      	<option value="4">NIÑA</option>
						      </select>
						    </div>
	        		</div> <!-- /form-group-->  

					<div class="form-group">
			        	<label for="productStatus" class="col-sm-3 control-label">Estado </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <select class="form-control" id="productStatus" name="productStatus">
						      	<option selected disabled hidden>-- Selecciona --</option>
						      	<option value="1">Disponible</option>
						      	<option value="2">No disponible</option>
						      </select>
						    </div>
	        		</div> <!-- /form-group-->

					
				</div> <!-- /modal-body -->

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
					<button type="submit" class="btn btn-primary" id="createProductBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
				</div><!-- /modal-footer -->	 

			</form> <!-- /.form -->	 

		</div> <!-- /modal-content --> 
	<div><!-- /modal-dailog -->
</div><!-- End add product  Modal-->






