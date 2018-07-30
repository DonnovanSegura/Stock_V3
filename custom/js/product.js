var manageProductTable;

$(document).ready(function() {

	// top nav bar 
	$('#navProduct').addClass('active');
	// manage product data table
	manageProductTable = $('#manageProductTable').DataTable({
		'ajax': 'php_action/fetchProduct.php',
		'order': []
	});

	// add product modal btn clicked
	$("#addProductModalBtn").unbind('click').bind('click', function() {

		// // product form reset
		$("#submitProductForm")[0].reset();		

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		$("#productImage").fileinput({
	      overwriteInitial: true,
		    maxFileSize: 2500,
		    showClose: false,
		    showCaption: false,
		    browseLabel: '',
		    removeLabel: '',
		    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
		    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
		    removeTitle: 'Cancel or reset changes',
		    elErrorContainer: '#kv-avatar-errors-1',
		    msgErrorClass: 'alert alert-block alert-danger',
		    defaultPreviewContent: '<img src="assests/images/photo_default.png" alt="Profile Image" style="width:100%;">',
		    layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
	  		allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
			});

			// submit product form
			$("#submitProductForm").unbind('submit').bind('submit', function() {

				// Validar Campos de Formulario submitProductForm
				var productImage   = $("#productImage").val();
				var productName    = $("#productName").val();
				var productCosto   = $("#costo").val();
				var productPrecio  = $("#precio").val();
				var productMarca   = $("#marca").val();
				var productStock   = $("#quantity").val();
				var productStatus  = $("#productStatus").val();

				if(productImage == "") {
				$("#productImage").closest('.center-block').after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#productImage').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#productImage").find('.text-danger').remove();
				// success out for form 
				$("#productImage").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(productName == "") {
				$("#productName").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#productName').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#productName").find('.text-danger').remove();
				// success out for form 
				$("#productName").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(productCosto == "") {
				$("#costo").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#costo').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#costo").find('.text-danger').remove();
				// success out for form 
				$("#costo").closest('.form-group').addClass('has-success');	  	
			}

			if(productPrecio == "") {
				$("#precio").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#precio').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#precio").find('.text-danger').remove();
				// success out for form 
				$("#precio").closest('.form-group').addClass('has-success');	  	
			}

			if(productMarca == "") {
				$("#marca").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#marca').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#marca").find('.text-danger').remove();
				// success out for form 
				$("#marca").closest('.form-group').addClass('has-success');	  	
			}

			if(productStock == "") {
				$("#quantity").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#quantity').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#quantity").find('.text-danger').remove();
				// success out for form 
				$("#quantity").closest('.form-group').addClass('has-success');	  	
			}

			if(productStatus == "") {
				$("#productStatus").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#productStatus').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#productStatus").find('.text-danger').remove();
				// success out for form 
				$("#productStatus").closest('.form-group').addClass('has-success');	  	
			}

				if(productImage && productName && productPrecio && productMarca && productStock && productStatus && productCosto ) {

					// submit loading button
					$("#createProductBtn").button('loading');	

					var form = $(this);
					var formData = new FormData(this);

					$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: formData,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					success:function(response) {

							if(response.success == true) {
							// submit loading button
							$("#createProductBtn").button('reset');
							
							$("#submitProductForm")[0].reset();

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#add-product-messages').html('<div class="alert alert-success">'+
					            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
					            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
					          '</div>');

							// remove the mesages
		          			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert

		          			// reload the manage student table
							manageProductTable.ajax.reload(null, true);

							// remove text-error 
							$(".text-danger").remove();
							// remove from-group error
							$(".form-group").removeClass('has-error').removeClass('has-success');

							} // /if response.success
						
						} // /success function}

					}); // /ajax function

				}	 // /if validation is ok 	
				
				return false;
			}); // /submit product form

	}); // /add product modal btn clicked

});// document.ready fucntion


function editProduct(productId = null) {

	if (productId) {

		$("#productId").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal div
		$('.div-result').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedProduct.php',
			type: 'post',
			data: {productId: productId},
			dataType: 'json',
			success:function(response) {		
			// alert(response.product_image);
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				

				$("#getProductImage").attr('src', 'stock/'+response.imagen);

				$("#editProductImage").fileinput({		      
				}); 

				// product id 
				$(".editProductFooter").append('<input type="hidden" name="productId" id="productId" value="'+response.id_product+'" />');				
				$(".editProductPhotoFooter").append('<input type="hidden" name="productId" id="productId" value="'+response.id_product+'" />');	
				//id
				$("#idProductName").val(response.id_product)
				// Descripción
				$("#editProductName").val(response.nombre);
				//Descripciion Desabilitada
				$("#editProductDescrip").val(response.nombre);
				//Costo
				$("#editProductCosto").val(response.costo);
				// Precio Escondido Oro
				$("#editProductPrecio").val(response.precio);
				//Precio Desabilidado Oro
				$("#editProduct").val(response.precio);
				// Precio Escondido Plata
				$("#editProductPlata").val(response.plata);
				//Precio Desabilidado Plata
				$("#editProductPlata2").val(response.plata);
				// Precio Escondido Bronce
				$("#editProductBronce").val(response.bronce);
				//Precio Desabilidado Bronce
				$("#editProductBronce2").val(response.bronce);
				// Marca
				$("#editProductMarca").val(response.marca);
				// Stock
				$("#editProductStock").val(response.cantidad);
				//Stock Desabilitado
				$("#editProductStockHidden").val(response.cantidad);
				//Genero
				$("#editProductGenero").val(response.genero);
				// Estado
				$("#editProductStatus").val(response.status);

				// Actualizar datos de Informacion de Productos con funcion Ajax
				$("#editProductForm").unbind('submit').bind('submit', function() {

					// form validation
					var imagen = $("#editProductImage").val();
					var nombre = $("#editProductName").val();
					var costo  = $("#editProductCosto").val();
					var precio = $("#editProductPrecio").val();
					var marca  = $("#editProductMarca").val();
					var stock  = $("#editProductStock").val();
					var status = $("#editProductStatus").val();

					if(nombre == "") {
						$("#editProductName").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editProductName').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editProductName").find('.text-danger').remove();
						// success out for form 
						$("#editProductName").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(costo == "") {
						$("#editProductCosto").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editProductCosto').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editProductCosto").find('.text-danger').remove();
						// success out for form 
						$("#editProductCosto").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(precio == "") {
						$("#editProductPrecio").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editProductPrecio').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editProductPrecio").find('.text-danger').remove();
						// success out for form 
						$("#editProductPrecio").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(marca == "") {
						$("#editProductMarca").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editProductMarca').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editProductMarca").find('.text-danger').remove();
						// success out for form 
						$("#editProductMarca").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(stock == "") {
						$("#editProductStock").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editProductStock').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editProductStock").find('.text-danger').remove();
						// success out for form 
						$("#editProductStock").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(status == "") {
						$("#editProductStatus").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editProductStatus').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editProductStatus").find('.text-danger').remove();
						// success out for form 
						$("#editProductStatus").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(nombre && costo && precio && marca && stock && status) {

						// submit loading button
						$("#editProductBtn").button('loading');

						var form = $(this);
						var formData = new FormData(this);

						$.ajax({

							url : form.attr('action'),
							type: form.attr('method'),
							data: formData,
							dataType: 'json',
							cache: false,
							contentType: false,
							processData: false,
							success:function(response) {
								console.log(response);
								if(response.success == true) {

									// submit loading button
									$("#editProductBtn").button('reset');
									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);

									// shows a successful message after operation
									$('#edit-product-messages').html('<div class="alert alert-success">'+
				            		'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            		'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          			'</div>');

				          			// remove the mesages
				          			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

									// reload the manage student table
									manageProductTable.ajax.reload(null, true);

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');

								} // /if response.success

							} // /success function
						}); // /ajax function

					}	 // /if validation is ok 	

					return false;

				}); // update the product data function
				
				// update the product image				
				$("#updateProductImageForm").unbind('submit').bind('submit', function() {
					// form validation
					var productImage = $("#editProductImage").val();	

					if(productImage == "") {
						$("#editProductImage").closest('.center-block').after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editProductImage').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editProductImage").find('.text-danger').remove();
						// success out for form 
						$("#editProductImage").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(productImage) {
						// submit loading button
						$("#editProductImageBtn").button('loading');

						var form = $(this);
						var formData = new FormData(this);

						$.ajax({

							url : form.attr('action'),
							type: form.attr('method'),
							data: formData,
							dataType: 'json',
							cache: false,
							contentType: false,
							processData: false,
							success:function(response) {

								if(response.success == true) {

									// submit loading button
									$("#editProductImageBtn").button('reset');

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);

									// shows a successful message after operation
									$('#edit-productPhoto-messages').html('<div class="alert alert-success">'+
				            		'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            		'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				         			'</div>');

				         			// remove the mesages
				        		    $(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

									// reload the manage student table
									manageProductTable.ajax.reload(null, true);

									$(".fileinput-remove-button").click();

									$.ajax({
										url: 'php_action/fetchProductImageUrl.php?i='+productId,
										type: 'post',
										success:function(response) {
										$("#getProductImage").attr('src', response);		
										}
									});

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');

								} // /if response.success

							} // /success function

						}); // /ajax function

					}  // /if validation is ok 

					return false;
				
				}); // /update the product image


			} // /success function

		})// /ajax to fetch product image

	}else{
		alert("ERROR")
	}

}//Edit Product

//Eliminar Producto
function removeProduct(productId = null) {
	
	if(productId) {
		// remove product button clicked
		$("#removeProductBtn").unbind('click').bind('click', function() {
			// loading remove button
			$("#removeProductBtn").button('loading');
			$.ajax({
				url: 'php_action/removeProduct.php',
				type: 'post',
				data: {productId: productId},
				dataType: 'json',
				success:function(response) {
					// loading remove button
					$("#removeProductBtn").button('reset');
					if(response.success == true) {
						// remove product modal
						$("#removeProductModal").modal('hide');

						// update the product table
						manageProductTable.ajax.reload(null, false);

						// remove success messages
						$(".remove-messages").html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				            '</div>');

						// remove the mesages
	          			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
								});
							}); // /.alert
					} else {

						// remove success messages
						$(".removeProductMessages").html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				           '</div>');

						// remove the mesages
	          			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert

					} // /error
				} // /success function
			}); // /ajax fucntion to remove the product
			return false;
		}); // /remove product btn clicked
	} // /if productid
} // /remove product function