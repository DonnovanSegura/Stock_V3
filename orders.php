<?php 
header('Content-Type: text/html; charset=UTF-8');
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 
?>



<ol class="breadcrumb">
  <li><a href="dashboard.php">Inicio</a></li>
  <li>Ordenes</li>
  <li class="active">
  		Agregar orden 		
  </li>
</ol>

<!--<h4>
	<i class='glyphicon glyphicon-circle-arrow-right'></i>
	Agregar orden
</h4>-->

<div class="panel panel-default">
	<div class="panel-heading">

  		<i class="glyphicon glyphicon-plus-sign"></i>	Agregar orden.
	</div><!--/panel-heading-->	
	<div class="panel-body">
		<div class="success-messages"></div> <!--/success-messages-->
		
		<form class="form-horizontal" method="POST" action="php_action/createOrder.php" id="createOrderForm">

			<div class="form-group">
			    <label for="codCte" class="col-sm-2 control-label">Código del Cliente:</label>
			    <div class="col-sm-4">
			    	<input type="text" name="codCte" id="codCte" autocomplete="off"  class="form-control" onchange="getClientData()" />	
			    </div>
			</div> <!--/form-group-->

			<div class="form-group">
				<label for="clientName" class="col-sm-2 control-label">Nombre:</label>
				<div class="col-sm-5">
					<input type="text" name="clientName" id="clientName" autocomplete="off" disabled="true" class="form-control" />
				</div>

				<label for="clientCat" class="col-sm-2 control-label">Categoria:</label>
			    <div class="col-sm-2">
			   		<input type="text" name="clientCat" id="clientCat" autocomplete="off" disabled="true" class="form-control" />
			   		<input type="hidden" name="clientCatHi" id="clientCatHi" autocomplete="off"  class="form-control" />
			    </div>
			</div><!--/form-group-->
			<div class="form-group">
				<label for="clientObser" class="col-sm-2 control-label">Observacón:</label>
				<div class="col-sm-9">
					<input type="text" name="clientObser" id="clientObser" autocomplete="off" disabled="true" class="form-control" />
				</div>
			</div><!--/form-group-->
			</br>
			<table class="table" id="productTable">
			  	<thead>
			  		<tr>
			  			<th style="width:6%;">#</th>	
			  			<th style="width:20%;">Codigo Prod</th>			  			
			  			<th style="width:40%;">Producto</th>
			  			<th style="width:10%;">Precio Unidad</th>
			  			<th style="width:10%;">Cantidad</th>			  			
			  			<th style="width:10%;">Total</th>			  			
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<!--Comenzamos a añadir campos para venta -->
			  		<?php
			  		$arrayNumber = 0;
			  		#contador para añadir lineas
			  		$numero = 1;
			  		for ($x=1; $x <26; $x++) { 
			  		 ?>

			  			<!--Se imprime las filas en la tabla -->
				  		<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">

				  			<td style="margin-left:20px;">
								<input type="text" name="num[]" id="num<?php echo $x; ?>" autocomplete="off"  class="form-control"  value="<?php echo $numero; ?>" disabled="true"/>	
							</td>

							<td style="margin-left:20px;">
								<input type="text" name="codProd[]" id="codProd<?php echo $x; ?>" autocomplete="off"  class="form-control" onchange="getProductData(<?php echo $x; ?>)" />	
							</td>
							<!--Campo eliminado 1-> activo 2->Eliminado -->
							<td style="display:none">
								<input type="text" name="statusProd[]" id="statusProd<?php echo $x; ?>" autocomplete="off"  class="form-control" style="display:none"  />	
							</td>
							
				  			<td style="padding-left:20px;">
				  				<div class="form-group">
				  					<input type="text" name="productName[]" id="productName<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />	
				  				</div>
				  			</td>

				  			<td style="padding-left:20px;">
				  				<input type="text" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />	
				  				<input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" />	
				  			</td>

				  			<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" />
			  					</div>
			  				</td>	

			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>

			  				<td>
			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>	 

				  		</tr>
			  		<?php
			  		$arrayNumber++;
			  		$numero++;
			  		}//for donde añadimos los campos
			  		?>
			  	</tbody>
			</table><!-- Table Productos Order-->
			</br>
			
			<!--Campos de Total de Pago-->
			<div class="col-md-6">
				<div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Total Neto:</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
				    </div>
				</div> <!--/form-group-->

				<div class="form-group">
				    <label for="discount" class="col-sm-3 control-label">Descuento:</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" />
				    </div>
				</div> <!--/form-group-->	

				<div class="form-group">
				    <label for="grandTotal" class="col-sm-3 control-label">Total:</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" />
				    </div>
				</div> <!--/form-group-->	

				<div class="form-group">
				    <label for="metoPago" class="col-sm-3 control-label">Método de Pago:</label>
				    <div class="col-sm-9">
				    	<select class="form-control" name="metoPago" id="metoPago">
					      	<option selected disabled hidden value="">-- Selecciona --</option>
					      	<option value="1">Efectivo</option>
					      	<option value="2">Tarjeta de Crédito</option>
				    	</select>
				    </div>
				</div> <!--/form-group-->

				<div class="form-group">
				    <label for="grandTotalProductos" class="col-sm-3 control-label">Total Productos:</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="grandTotalProductos2" name="grandTotalProductos2" disabled="true"/>
				      <input type="hidden" class="form-control" id="grandTotalProductos" name="grandTotalProductos"  />
				    </div>
				</div> <!--/form-group-->	


			</div>
			<!--End Campos de Total de Pago-->

			<!-- Campos de Forma de Pago-->
			<div class="col-md-6">

				<div class="form-group">
				    <label for="TypeOrder" class="col-sm-4 control-label">Tipo Orden:</label>
				    <div class="col-sm-8">
				      <select class="form-control" name="TypeOrder" id="TypeOrder">
				      	<option selected disabled hidden value="">-- Selecciona --</option>
				      	<option value="1">Consignación</option>
				      	<option value="2">Venta</option>
				      </select>
				    </div>
				</div> <!--/form-group-->	

				<div class="form-group">
				    <label for="paid" class="col-sm-4 control-label">Monto pagado:</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" />
				    </div>
				</div> <!--/form-group-->	

				<div class="form-group">
				    <label for="due" class="col-sm-4 control-label">Saldo:</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="due" name="due" disabled="true" />
				      <input type="hidden" class="form-control" id="dueValue" name="dueValue" />
				    </div>
				</div> <!--/form-group-->	

				<div class="form-group">
				    <label for="paymentStatus" class="col-sm-4 control-label">Estado:</label>
				    <div class="col-sm-8">
				    	<select class="form-control" name="paymentStatus" id="paymentStatus">
					      	<option selected disabled hidden value="">-- Selecciona --</option>
					      	<option value="1">Liquidada</option>
					      	<option value="2">No Liquidada</option>
				    	</select>
				    </div>
				</div> <!--/form-group-->	
				
				<div class="form-group">
			    <label for="orderDate" class="col-sm-4 control-label">Fecha Liquidación;</label>
			    <div class="col-sm-8">
			      <input type="date" class="form-control" id="orderDate" name="orderDate" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->

			</div>
			<!-- End Campos de Forma de Pago-->

			<div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
				<!--<button type="button" class="btn btn-warning" onclick="addRow()" id="addRowBtn" data-loading-text="Cargando..."> <i class="glyphicon glyphicon-plus-sign"></i> Añadir fila </button>-->
				    <button type="submit" id="createOrderBtn" data-loading-text="Cargando..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
				    <button type="reset" class="btn btn-info" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Reiniciar</button>
			    </div>
			</div>
		</form><!--Form Order-->


	</div> <!--Panel-Body-->
</div> <!--/Panel Defaul -->


<script src="custom/js/order.js"></script>
<?php require_once 'includes/footer.php'; ?>
