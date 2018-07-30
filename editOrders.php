<?php
header('Content-Type: text/html; charset=UTF-8');
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 

$orderId = $_GET["id"];

//$data = "SELECT * FROM orders WHERE tipo_orden = 2 AND id_order = $orderId";
//$resData = $connect->query($data);
//$rowData = $resData->fetch_row();
//$rowData = $resData->fetch_array(); -> se imprime $rowData['id_order'];

$data = "SELECT orders.id_order, orders.fecha_add, orders.hora_add, orders.client_id, orders.total_neto, orders.descuento, orders.total, orders.metodo, orders.totalProducto, orders.tipo_orden, orders.monto, orders.saldo, orders.estado, orders.fecha_liqui, orders.user_add_id, client.id_client, client.nombre_cte, client.categoria, client.comentario 
		 FROM orders 
		 INNER JOIN client 
		 ON orders.client_id = client.id_client 
		 WHERE orders.tipo_orden = 2 AND orders.id_order = $orderId";
$resData = $connect->query($data);
$rowData = $resData->fetch_array();
?>



<ol class="breadcrumb">
  <li><a href="dashboard.php">Inicio</a></li>
  <li>Ordenes</li>
  <li class="active">
  		Editar Orden Venta		
  </li>
</ol>


<div class="panel panel-default">
	<div class="panel-heading">
			<i class="glyphicon glyphicon-pencil"></i> Orden Venta <strong class="text-danger">Folio:  <?php echo $rowData['id_order'];?></strong>

	</div><!--/panel-heading-->	
	<div class="panel-body">
		<div class="edit-success-messages"></div> <!--/success-messages-->
		
		<form class="form-horizontal" method="POST" action="php_action/editOrder.php" id="editOrderFormVentas">

			<div class="form-group">
			    <label for="codCte" class="col-sm-2 control-label">Código del Cliente:</label>
			    <div class="col-sm-4">
			    	<input type="text" name="codCte" id="codCte" autocomplete="off"  class="form-control"  value="<?php echo $rowData['client_id']; ?>" />	
			    </div>
			</div> <!--/form-group-->

			<div class="form-group">
				<label for="clientName" class="col-sm-2 control-label">Nombre:</label>
				<div class="col-sm-5">
					<input type="text" name="clientName" id="clientName" autocomplete="off" disabled="true" class="form-control" value="<?php echo $rowData['nombre_cte']; ?>" />
				</div>

				<label for="clientCat" class="col-sm-2 control-label">Categoria:</label>
			    <div class="col-sm-2">
			    	<?php 
			    	if ($rowData['categoria'] == 1) {
			    		# code...
			    		echo '<input type="text" name="clientCat" id="clientCat" autocomplete="off" disabled="true" class="form-control" value="ORO" />';
			    		echo '<input type="hidden" name="clientCatHi2" id="clientCatHi2" autocomplete="off"  class="form-control" value="ORO" />';
			    	}elseif ($rowData['categoria'] == 3) {
			    		# code...
			    		echo '<input type="text" name="clientCat" id="clientCat" autocomplete="off" disabled="true" class="form-control" value="BRONCE" />';
			    		echo '<input type="hidden" name="clientCatHi2" id="clientCatHi2" autocomplete="off"  class="form-control" value="BRONCE" />';
			    	}else{
			    		echo '<input type="text" name="clientCat" id="clientCat" autocomplete="off" disabled="true" class="form-control" value="PLATA" />';
			    		echo '<input type="hidden" name="clientCatHi2" id="clientCatHi2" autocomplete="off"  class="form-control" value="PLATA" />';
			    	}
			    	?>
			   		
			    </div>
			</div><!--/form-group-->
			<div class="form-group">
				<label for="clientObser" class="col-sm-2 control-label">Observacón:</label>
				<div class="col-sm-9">
					<input type="text" name="clientObser" id="clientObser" autocomplete="off" disabled="true" class="form-control" value="<?php echo $rowData['comentario']; ?>" />
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
			  		//qry para obtener los prductos de la orden a modificar 
			  		$orderItemSql = "SELECT orders_detalle.order_detalle_id, orders_detalle.order_id, orders_detalle.product_id, orders_detalle.cantidad, 
			  								orders_detalle.precio, orders_detalle.total FROM orders_detalle WHERE orders_detalle.order_id = {$orderId}";
					$orderItemResult = $connect->query($orderItemSql);
					// $orderItemData = $orderItemResult->fetch_all();

			  		$arrayNumber = 0;
			  		#contador para añadir lineas 
			  		//for ($x=1; $x <4; $x++) { 
			  		  $numero = 1;
			  		  $x = 1;
			  		  while($orderItemData = $orderItemResult->fetch_array()) {
			  	      
			  	      ?>
			  			<!--Se imprime las filas en la tabla -->
				  		<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">

							<td style="margin-left:20px;">
								<input type="text" name="num[]" id="num<?php echo $x; ?>" autocomplete="off"  class="form-control"  value="<?php echo $numero; ?>" disabled="true" />	
							</td>
							<!--Campo eliminado 1-> activo 2->Eliminado -->
							<td style="display:none">
								<input type="text" name="statusProd[]" id="statusProd<?php echo $x; ?>" autocomplete="off"  class="form-control" style="display:none"  />	
							</td>

							<td style="margin-left:20px;">
								<input type="text" name="codProd[]" id="codProd<?php echo $x; ?>" autocomplete="off"  class="form-control" onchange="getProductData(<?php echo $x; ?>)" value="<?php echo $orderItemData['product_id']; ?>" />	
							</td>

				  			<td style="padding-left:20px;">
				  				<div class="form-group">
				  					<?php
			  							//$productSql = "SELECT * FROM product WHERE estado = 1 AND cantidad != 0";
				  						$productSql = "SELECT * FROM product ";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								#$selected = "";
			  								if($row['id_product'] == $orderItemData['product_id']) {
			  									#$selected = "selected";
			  									echo "<input type='text' name='productName[]'' id='productName'  disabled='true' class='form-control' value='".$row['nombre']."' /> ";
			  								} else {
			  									#$selected = "";
			  									#echo "<input type='text' name='productName[]'' id='productName'  disabled='true' class='form-control' / > ";
			  								}

										 } // /while 

			  						?>
				  					<!--<input type="text" name="productName[]" id="productName<?php echo $x; ?>"  disabled="true" class="form-control" />-->	
				  				</div>
				  			</td>

				  			<td style="padding-left:20px;">
				  				<input type="text" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" value="<?php echo $orderItemData['precio']; ?>" />	
				  				<input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['precio']; ?>" />	
				  			</td>

				  			<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" value="<?php echo $orderItemData['cantidad']; ?>" />
			  					</div>
			  				</td>	

			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" value="<?php echo $orderItemData['total']; ?>" />			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['total']; ?>" />			  					
			  				</td>

			  				<td>
			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>	 

				  		</tr>
			  		<?php
			  		$arrayNumber++;
			  		$numero++;
			  		$x++;
			  		}//While
			  		?>
			  	</tbody>
			</table><!-- Table Productos Order-->
			</br>

			<!--Campos de Total de Pago-->
			<div class="col-md-6">
				<div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Total Neto:</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true" value="<?php echo $rowData['total_neto'] ?>"/>
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" value="<?php echo $rowData['total_neto'] ?>" />
				    </div>
				</div> <!--/form-group-->

				<div class="form-group">
				    <label for="discount" class="col-sm-3 control-label">Descuento:</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" value="<?php echo $rowData['descuento'] ?>" />
				    </div>
				</div> <!--/form-group-->	

				<div class="form-group">
				    <label for="grandTotal" class="col-sm-3 control-label">Total:</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" value="<?php echo $rowData['total'] ?>" />
				      <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" value="<?php echo $rowData['total'] ?>" />
				    </div>
				</div> <!--/form-group-->	

				<div class="form-group">
				    <label for="metoPago" class="col-sm-3 control-label">Método de Pago:</label>
				    <div class="col-sm-9">
				    	<select class="form-control" name="metoPago" id="metoPago">
					      	<option selected disabled hidden value="">-- Selecciona --</option>
					      	<option value="1" 
					      	<?php if($rowData[7] == 1) {
				      		echo "selected";
				      		} ?>  >Efectivo
							</option>
					      	<option value="2"
					      	<?php if($rowData[7] == 2) {
				      		echo "selected";
				      		} ?>  >Tarjeta Crédito
					      	</option>
				    	</select>
				    </div>
				</div> <!--/form-group-->

				<div class="form-group">
				    <label for="grandTotalProductos" class="col-sm-3 control-label">Total Productos:</label>
				    <div class="col-sm-9">
				       <input type="text" class="form-control" id="grandTotalProductos2" name="grandTotalProductos2" disabled="true" value="<?php echo $rowData['totalProducto'] ?>"/>
				      <input type="hidden" class="form-control" id="grandTotalProductos" name="grandTotalProductos"  value="<?php echo $rowData['totalProducto'] ?>"/>
				     
				    </div>
				</div> <!--/form-group-->	

			</div><!--End Campos de Total de Pago-->

			<!-- Campos de Forma de Pago-->
			<div class="col-md-6">

				<div class="form-group">
				    <label for="TypeOrder" class="col-sm-4 control-label">Tipo Orden:</label>
				    <div class="col-sm-8">
				      <select class="form-control" name="TypeOrder" id="TypeOrder">
				      	<option selected disabled hidden value="">-- Selecciona --</option>
				      	<option value="1"
				      	<?php if($rowData[9] == 1) {
				      	echo "selected";
				      	}?>  >Consignación
				      	</option>
				      	<option value="2"
				      	<?php if($rowData[9] == 2) {
				      	echo "selected";
				      	} ?>  >Venta
				      	</option>
				      </select>
				    </div>
				</div> <!--/form-group-->	

				<div class="form-group">
				    <label for="paid" class="col-sm-4 control-label">Monto pagado:</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" value="<?php echo $rowData['monto'] ?>"/>
				    </div>
				</div> <!--/form-group-->	

				<div class="form-group">
				    <label for="due" class="col-sm-4 control-label">Saldo:</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="due" name="due" disabled="true" value="<?php echo $rowData['saldo'] ?>" />
				      <input type="hidden" class="form-control" id="dueValue" name="dueValue" value="<?php echo $rowData['saldo'] ?>" />
				    </div>
				</div> <!--/form-group-->	

				<div class="form-group">
				    <label for="paymentStatus" class="col-sm-4 control-label">Estado:</label>
				    <div class="col-sm-8">
				    	<select class="form-control" name="paymentStatus" id="paymentStatus">
					      	<option selected disabled hidden value="">-- Selecciona --</option>
					      	<option value="1"
							<?php if($rowData[12] == 1) {
					      	echo "selected";
					      	} ?>  >Liquidada
					      	</option>
					      	<option value="2"
							<?php if($rowData[12] == 2) {
					      	echo "selected";
					      	} ?>  >No Liquidada
					      	</option>
				    	</select>
				    </div>
				</div> <!--/form-group-->	
				
				<div class="form-group">
			    <label for="orderDate" class="col-sm-4 control-label">Fecha Liquidación;</label>
			    <div class="col-sm-8">
			        <input type="text" class="form-control" id="orderDate" name="orderDate" autocomplete="off" value="<?php echo $rowData['fecha_liqui'] ?>" />
			    </div>
			  </div> <!--/form-group-->

			</div>
			<!-- End Campos de Forma de Pago-->
			
			
			<div class="modal-footer editButtonFooter">
			    
				    <button type="button"  class="btn btn-warning" onclick="addRow()" id="addRowBtn" data-loading-text="Cargando..."> <i class="glyphicon glyphicon-plus-sign"></i> Añadir fila </button>
				    <input  type="hidden"  name="orderId" id="orderId" value="<?php echo $rowData[0]?>" />
				    <button type="submit"  id="editOrderBtn" data-loading-text="Cargando..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
			<!--    <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Reiniciar</button>-->
			    
			</div>
		</form><!--Form Order-->


	</div> <!--Panel-Body-->
</div> <!--/Panel Defaul -->



<script src="custom/js/orderVenta.js?ver=1.0.35"></script>
<?php require_once 'includes/footer.php'; ?>


