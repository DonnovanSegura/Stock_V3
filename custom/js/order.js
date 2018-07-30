var manageOrderTable;

$(document).ready(function() {
	// top nav bar 
	$("#navOrder").addClass('active');
	// sub manin
	$("#topNavAddOrder").addClass('active');

	// create order form function
	$("#createOrderForm").unbind('submit').bind('submit', function() {

		var form = $(this);

		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		//Validacion de Campos		
		var clientId  		= $("#codCte").val();
		var descuento 		= $("#discount").val();
		var metodo    		= $("#metoPago").val();
		var tipo      		= $("#TypeOrder").val(); 
		var monto     		= $("#paid").val();
		var estado    		= $("#paymentStatus").val();
		var fchliqui  		= $("#orderDate").val();
		var totalProduct	= $("#grandTotalProductos").val();

		// form validation 
		if(clientId == "") {
			$("#codCte").after('<p class="text-danger"> Este campo es obligatorio </p>');
			$('#codCte').closest('.form-group').addClass('has-error');
		} else {
			$('#codCte').closest('.form-group').addClass('has-success');
		} // /else

		if(descuento == "") {
			$("#discount").after('<p class="text-danger"> Este campo es obligatorio </p>');
			$('#discount').closest('.form-group').addClass('has-error');
		} else {
			$('#discount').closest('.form-group').addClass('has-success');
		} // /else

		if(metodo == "") {
			$("#metoPago").after('<p class="text-danger"> Este campo es obligatorio </p>');
			$('#metoPago').closest('.form-group').addClass('has-error');
		} else {
			$('#metoPago').closest('.form-group').addClass('has-success');
		} // /else

		if(tipo == "") {
			$("#TypeOrder").after('<p class="text-danger"> Este campo es obligatorio </p>');
			$('#TypeOrder').closest('.form-group').addClass('has-error');
		} else {
			$('#TypeOrder').closest('.form-group').addClass('has-success');
		} // /else

		if(monto == "") {
			$("#paid").after('<p class="text-danger"> Este campo es obligatorio </p>');
			$('#paid').closest('.form-group').addClass('has-error');
		} else {
			$('#paid').closest('.form-group').addClass('has-success');
		} // /else

		if(estado == "") {
			$("#paymentStatus").after('<p class="text-danger"> Este campo es obligatorio </p>');
			$('#paymentStatus').closest('.form-group').addClass('has-error');
		} else {
			$('#paymentStatus').closest('.form-group').addClass('has-success');
		} // /else

		
		if(fchliqui == "") {
			$("#orderDate").after('<p class="text-danger"> Este campo es obligatorio </p>');
			$('#orderDate').closest('.form-group').addClass('has-error');
		} else {
			$('#orderDate').closest('.form-group').addClass('has-success');
		} // /else

		if(totalProduct == "") {
			$("#grandTotalProductos").after('<p class="text-danger"> Este campo es obligatorio </p>');
			$('#grandTotalProductos').closest('.form-group').addClass('has-error');
		} else {
			$('#grandTotalProductos').closest('.form-group').addClass('has-success');
		} // /else

		// array validation
		var codProd = document.getElementsByName('codProd[]');				
		var validateProduct;
		for (var x = 0; x < codProd.length; x++) {       			
			var productId = codProd[x].id;	    	
		    if(codProd[x].value == ''){	    		    	
		    	$("#"+productId+"").after('<p class="text-danger"> Este campo es obligatorio </p>');
		    	$("#"+productId+"").closest('.form-group').addClass('has-error');	    		    	    	
	     	}else {      	
		    	$("#"+productId+"").closest('.form-group').addClass('has-success');	    		    		    	
	      	}          
	   	} // for

	   	for (var x = 0; x < codProd.length; x++) {       						
		    if(codProd[x].value){	    		    		    	
		    	validateProduct = true;
	     	}else {      	
		    	validateProduct = false;
	      	}          
	   	} // for    

	   	// array validation
	   	var quantity = document.getElementsByName('quantity[]');		   	
	   	var validateQuantity;
	   	for (var x = 0; x < quantity.length; x++) {       
	 			var quantityId = quantity[x].id;
		    if(quantity[x].value == ''){	    	
		    	$("#"+quantityId+"").after('<p class="text-danger"> Este campo es obligatorio </p>');
		    	$("#"+quantityId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+quantityId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < quantity.length; x++) {       						
		    if(quantity[x].value){	    		    		    	
		    	validateQuantity = true;
	      } else {      	
		    	validateQuantity = false;
	      }          
	   	} // for   

		if(clientId && descuento && metodo && tipo && monto && estado && fchliqui && totalProduct ) {

			if(validateProduct == true && validateQuantity == true) {

					$.ajax({
						url : form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),					
						dataType: 'json',
						success:function(response) { 
							console.log(response);
							// reset button
							$("#createOrderBtn").button('reset');
							
							$(".text-danger").remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');	

							if(response.success == true) {

							// create order button
							$(".success-messages").html('<div class="alert alert-success">'+
			            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            	'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			            	' <br /> <br /> <a href="ordersGestion.php" class="btn btn-primary"> <i class="glyphicon glyphicon-print"></i> Imprimir </a>'+
			            	'<a href="orders.php?o=add" class="btn btn-default" style="margin-left:10px;"> <i class="glyphicon glyphicon-plus-sign"></i> Agregar nueva orden </a>'+
			            	
			   		       '</div>');
										
							$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

							// disabled te modal footer button
							$(".submitButtonFooter").addClass('div-hide');
							// remove the product row
							$(".removeProductRowBtn").addClass('div-hide');

							}else {
								alert(response.messages);								
							}

						}//success
					}); // /ajax

			} // if array validate is true
		} // /if 

		return false;

	}); // /create order form function	

});// document.ready fucntion


//Agrega una fila para mas productos a la venta
function addRow(){
	$("#addRowBtn").button("loading");

	var tableLength = $("#productTable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if (tableLength > 0) {
		tableRow = $("#productTable tbody tr:last").attr('id');
		arrayNumber = $("#productTable tbody tr:last").attr('class');
		count = tableRow.substring(3);
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;
	}else{
		count = 1;
		arrayNumber = 0;
	}//else

	$.ajax({
		url: 'php_action/fetchProductData.php',
		type: 'post',
		dataType: 'json',
		success:function(response) {
			$("#addRowBtn").button("reset");

			var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+
					//Campo de Codigo de Productos
					'<td style="margin-left:20px;"">'+
						'<input type="text" name="codProd[]" id="codProd'+count+'" autocomplete="off"  class="form-control" onchange="getProductData('+count+')" />'+
					'</td style="padding-left:20px;">'+
					//Campo eliminado 1-> activo 2->Eliminado -->
					'<td style="display:none">'+
						'<input type="text" name="statusProd[]" id="statusProd'+count+'" autocomplete="off"  class="form-control" style="display:none"  />'+
					'</td>'+
					//Campo de Nombre de Productos
					'<td style="padding-left:20px;"">'+
					'<div class="form-group">'+
					'<input type="text" class="form-control" name="productName[]" id="productName'+count+'" disabled="true" >'+
					//'<option value="">~~SELECCIONA~~</option>';
						// console.log(response);
					//$.each(response, function(index, value) {
					//		tr += '<option value="'+value[0]+'">'+value[1]+'</option>';							
					//});
					//tr += '</select>'+
					'</div>'+
					'</td>'+
					//Campo de Precio
					'<td style="padding-left:20px;"">'+
						'<input type="text" name="rate[]" id="rate'+count+'" autocomplete="off" disabled="true" class="form-control" />'+
						'<input type="hidden" name="rateValue[]" id="rateValue'+count+'" autocomplete="off" class="form-control" />'+
					'</td style="padding-left:20px;">'+
					//Campo Cantidad
					'<td style="padding-left:20px;">'+
						'<div class="form-group">'+
							'<input type="number" name="quantity[]" id="quantity'+count+'" onkeyup="getTotal('+count+')" autocomplete="off" class="form-control" min="1" />'+
						'</div>'+
					'</td>'+
					//Campo TOtal
					'<td style="padding-left:20px;">'+
						'<input type="text" name="total[]" id="total'+count+'" autocomplete="off" class="form-control" disabled="true" />'+
						'<input type="hidden" name="totalValue[]" id="totalValue'+count+'" autocomplete="off" class="form-control" />'+
					'</td>'+
					//Campo Eliminar Producto	
					'<td>'+	
						'<button class="btn btn-default removeProductRowBtn" type="button" onclick="removeProductRow('+count+')"><i class="glyphicon glyphicon-trash"></i></button>'+
					'</td>'+
					'</tr>';

			if(tableLength > 0) {							
				$("#productTable tbody tr:last").after(tr);
			} else {				
				$("#productTable tbody").append(tr);
			}

		} // /success
	}); // get the product data ajax


}//Fin de addRow

//Eliminar Producto registro
function removeProductRow(row = null){
	if (row) {
		$("#row"+row).remove();

		subAmount();
	}else{
		alert('Error !! Actualizar la Pagina (F5)');
	}
}
//End Eliminar Producto registro


function getProductData(row = null){

	if (row) {
		var productId = $("#codProd"+row).val();

		if(productId == "" ){
			$("#productName"+row).val("");
			$("#rate"+row).val("");
			$("#quantity"+row).val("");
			$("#total"+row).val("");
		}else{
			$.ajax({
				url: 'php_action/fetchSelectedProduct.php',
				type: 'post',
				data: {productId : productId},
				dataType: 'json',
				success:function(response) {
					$("#statusProd"+row).val(response.estado);
								

					if($("#statusProd"+row).val() == 1 && $("#clientCatHi").val() == 'PLATA'){

						$("#productName"+row).val(response.nombre);
						$("#rate"+row).val(response.plata);
						$("#rateValue"+row).val(response.plata);
						$("#quantity"+row).val(1);

						var total = Number(response.plata) * 1;
						total = total.toFixed(2);
						$("#total"+row).val(total);
						$("#totalValue"+row).val(total);

     					
					} else if($("#statusProd"+row).val() == 1 && $("#clientCatHi").val() == 'ORO'){

						$("#productName"+row).val(response.nombre);
						$("#rate"+row).val(response.precio);
						$("#rateValue"+row).val(response.precio);
						$("#quantity"+row).val(1);

						var total = Number(response.precio) * 1;
						total = total.toFixed(2);
						$("#total"+row).val(total);
						$("#totalValue"+row).val(total);
					
					} else if ($("#statusProd"+row).val() == 1 && $("#clientCatHi").val() == 'BRONCE') {

						$("#productName"+row).val(response.nombre);
						$("#rate"+row).val(response.bronce);
						$("#rateValue"+row).val(response.bronce);
						$("#quantity"+row).val(1);

						var total = Number(response.bronce) * 1;
						total = total.toFixed(2);
						$("#total"+row).val(total);
						$("#totalValue"+row).val(total);
					}


					else{
						alertify.alert("Producto No Existe o Eliminado");
						$("#statusProd"+row).val("");
						$("#codProd"+row).val("");
					
					}
					
					
					subAmount();
				}//Success ajax
			});// /ajax function to fetch the product data	
		}
		

	}else{
		alert('Error !! Actualizar la Pagina (F5)');
	}//else

}//End getProductData


//Funcion GetClientData
function getClientData(){

		var clientId = $("#codCte").val();
		
		if(clientId == "" ){
			$("#clientName").val("");
			$("#clientCat").val("");
		}else{

			$.ajax({
				url: 'php_action/fetchSelectedClient.php',
				type: 'post',
				data: {clientId : clientId},
				dataType: 'json',
				success:function(response) {
					//var categoria = response.categoria == 1 ? 'ORO' : response.categoria == 2 ? 'PLATA' : 'BRONCE'; 
					var categorias = {1: 'ORO', 2: 'PLATA', 3: 'BRONCE'};
					$("#clientName").val(response.nombre_cte);
					//$("#clientCat").val(categoria);
					$('#clientCat').val(categorias[response.categoria]);
					$('#clientCatHi').val(categorias[response.categoria]);
					$("#clientObser").val(response.comentario);
					
				}//Success ajax
			
			});// /ajax function to fetch the product data	
		}
		
}//End GetClientData





// Funion total (total en el campo de total & totalValue)
function getTotal(row = null) {
	if(row) {

		var total = Number($("#rate"+row).val()) * Number($("#quantity"+row).val());
		total = total.toFixed(2);
		$("#total"+row).val(total);
		$("#totalValue"+row).val(total);
//*---------------------------------------------------------------------------------------------------------		
		     //* inicio
            //* calculo el numero de productos en la orden.
            /*var total_productos_orden = 0;

            //* por cada producto, obtengo su cantidad
            $("#quantity"+row).each(function () {
                // calculo todas la cantidad
                total_productos_orden += parseFloat(this.value);
               
            });

            //* muestro en "Total Productos" el total de productos en la orden.

            $("#grandTotalProductos").val(total_productos_orden);

			//* fin */
//*---------------------------------------------------------------------------------------------------------
			/*Otro metodo para sumar total productos*/
			//*Inicio
			$('[name="quantity[]"]').keyup(function(e) {

   				var totalElems = $('[name="quantity[]"]').get().reduce(function(a, c) {

            	return a + (parseInt(c.value) || 0);

        		}, 0);
			
				$('#grandTotalProductos').val(totalElems);
				$('#grandTotalProductos2').val(totalElems);
			});

 			subAmount();

        


	} else {
		alert('Error !! Actualizar la Pagina (F5)');
	}
}//End Total


function subAmount(){

	var tableProductLength = $("#productTable tbody tr").length;
	var totalSubAmount = 0;
	for(x = 0; x < tableProductLength; x++) {
		var tr = $("#productTable tbody tr")[x];
		var count = $(tr).attr('id');
		count = count.substring(3);

		totalSubAmount = Number(totalSubAmount) + Number($("#total"+count).val());
	} // /for

	totalSubAmount = totalSubAmount.toFixed(2);
	
	//Calcula el total neto de la compra y lo pone en lo campos #totalAmount & totalAmountValue
	$("#totalAmount").val(totalSubAmount);
	$("#totalAmountValue").val(totalSubAmount);

	//Descuento que se establece en la campo discount
	var discount = $("#discount").val();
	if(discount) {
		//restamos el campo de totalAmount - el descuento en el campo discount
		var grandTotal = Number($("#totalAmount").val()) - Number(discount);
		grandTotal = grandTotal.toFixed(2);
		$("#grandTotal").val(grandTotal);
		$("#grandTotalValue").val(grandTotal);
	} else {
		$("#grandTotal").val(totalSubAmount);
		$("#grandTotalValue").val(totalSubAmount);
	} // /else discount	

	var paidAmount = $("#paid").val();
	if(paidAmount) {
		paidAmount =  Number($("#grandTotal").val()) - Number(paidAmount);
		paidAmount = paidAmount.toFixed(2);
		$("#due").val(paidAmount);
		$("#dueValue").val(paidAmount);
	} else {	
		$("#due").val($("#grandTotal").val());
		$("#dueValue").val($("#grandTotal").val());
	} // else

}//End subAmount

//Funcion para hacer el descuento sobre el total

function discountFunc(){

	var discount = $("#discount").val();
	var totalAmount = Number($("#totalAmount").val());
	totalAmount = totalAmount.toFixed(2);

	var grandTotal;
	if (totalAmount) {
		grandTotal = Number($("#totalAmount").val()) - Number($("#discount").val());
		grandTotal = grandTotal.toFixed(2);

		$("#grandTotal").val(grandTotal);
		$("#grandTotalValue").val(grandTotal);
	}else{

	}

	var dueAmount; 	
 	if(paid) {
 		dueAmount = Number($("#grandTotal").val()) - Number($("#paid").val());
 		dueAmount = dueAmount.toFixed(2);

 		$("#due").val(dueAmount);
 		$("#dueValue").val(dueAmount);
 	} else {
 		$("#due").val($("#grandTotal").val());
 		$("#dueValue").val($("#grandTotal").val());
 	}

}//End discountFunc

//Funcion para pago con abonos 
function paidAmount() {
	var grandTotal = $("#grandTotal").val();

	if(grandTotal) {
		var dueAmount = Number($("#grandTotal").val()) - Number($("#paid").val());
		dueAmount = dueAmount.toFixed(2);
		$("#due").val(dueAmount);
		$("#dueValue").val(dueAmount);
	} // /if
} // /paid amoutn function



//Funcion Reset orden form
function resetOrderForm() {
	// reset the input field
	$("#createOrderForm")[0].reset();
	// remove remove text danger
	$(".text-danger").remove();
	// remove form group error 
	$(".form-group").removeClass('has-success').removeClass('has-error');
} // /reset order form

