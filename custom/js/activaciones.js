var actCteTable;
var actProducTable;

$(document).ready(function() {

	// top nav bar 
	$('#navSetting').addClass('active');
	// sub manin
	$("#topNavActivaciones").addClass('active');
	// manage user data table
	actCteTable = $('#actCteTable').DataTable({
		'ajax': 'php_action/fetchCteDelete.php',
		'order': []
	});
	// manage user data table
	actProducTable = $('#actProducTable').DataTable({
		'ajax': 'php_action/fetchProductDelete.php',
		'order': []
	});

});// document.ready fucntion


//Reactivar Clientes
/*function activarCte(cteId = null) {

	if (cteId) {

		$.ajax({
			url: 'php_action/fetchSelectedCteDelete.php',
			type: 'post',
			data: {cteId: cteId},
			dataType: 'json',
			success:function(response) {		
			// alert(response.product_image);
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				

				// client id 
				$(".editUserFooter").append('<input type="hidden" name="cteId" id="cteId" value="'+response.id_client+'" />');				

				// Nombre
				$("#codCteDelete").val(response.id_client);
				// Usuario
				$("#nameCteDelete").val(response.nombre_cte);
				// Password
				$("#comenCteDelete").val(response.comentario);
				// Rol
				$("#statusCteDelete").val(response.status);

			} // /success function

		})// /ajax

	}else{
		alert("ERROR")
	}


}//End Reactivar Clientes*/


//Reactivar Clientes
function activarCte(cteId = null) {

	if (cteId) {

		$.ajax({
			url: 'php_action/fetchSelectedCteDelete.php',
			type: 'post',
			data: {cteId: cteId},
			dataType: 'json',
			success:function(response) {		
			// alert(response.product_image);
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				

				// client id 
				$(".editUserFooter").append('<input type="hidden" name="cteId" id="cteId" value="'+response.id_client+'" />');				

				// Codiggo
				$("#codCteDelete").val(response.id_client);
				// Nombre
				$("#nameCteDelete").val(response.nombre_cte);
				// Comentario
				$("#comenCteDelete").val(response.comentario);
				// Status -> Activado/Desactivado
				$("#statusCteDelete").val(response.status);

				$("#editUsertForm").unbind('submit').bind('submit', function() {

					var comentario  = $("#comenCteDelete").val();
					var status      = $("#statusCteDelete").val();

					if(comentario == "") {
						$("#comenCteDelete").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#comenCteDelete').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#comenCteDelete").find('.text-danger').remove();
						// success out for form 
						$("#comenCteDelete").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(status == "") {
						$("#statusCteDelete").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#statusCteDelete').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#statusCteDelete").find('.text-danger').remove();
						// success out for form 
						$("#statusCteDelete").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(comentario && status) {

						// submit loading button
						$("#editUsertBtn").button('loading');

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
									$("#editUsertBtn").button('reset');
									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);

									// shows a successful message after operation
									$('#edit-user-messages').html('<div class="alert alert-success">'+
				            		'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            		'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          			'</div>');

				          			// remove the mesages
				          			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

									// reload the manage client table
									actCteTable.ajax.reload(null, true);
									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');

								}  // /if response.success

							} // /success function

						}); // /ajax function



					}	 // /if validation is ok
					return false;
					
				}); // update the clientes data function


			} // /success function

		})// /ajax

	}else{
		alert("ERROR")
	}


}//End Reactivar Clientes*/


//Reactivar  Producto
function activarProduct(prodId = null) {

	if (prodId) {

		$.ajax({
			url: 'php_action/fetchSelectedProdDelete.php',
			type: 'post',
			data: {prodId: prodId},
			dataType: 'json',
			success:function(response) {		
			// alert(response.product_image);
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				

				// client id 
				$(".activarProdDelete").append('<input type="hidden" name="prodId" id="prodId" value="'+response.id_product+'" />');				

				// Codigo de Barras
				$("#codProdDelete").val(response.id_product);
				// Descripcion
				$("#descProdDelet").val(response.nombre);
				// Marca
				$("#marcaProdDelete").val(response.marca);
				// estado -> Activado/Desactivado
				$("#statusProdDelete").val(response.estado);

				$("#editProducttForm").unbind('submit').bind('submit', function() {

					var estado      = $("#statusProdDelete").val();

					if(estado == "") {
						$("#statusProdDelete").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#statusProdDelete').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#statusProdDelete").find('.text-danger').remove();
						// success out for form 
						$("#statusProdDelete").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(estado) {

						// submit loading button
						$("#editProdDelete").button('loading');

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
									$("#editProdDelete").button('reset');
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

									// reload the manage client table
									actProducTable.ajax.reload(null, true);
									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');

								}  // /if response.success

							} // /success function

						}); // /ajax function
					}	 // /if validation is ok
				return false;
					
				}); // update the clientes data function

			} // /success function

		})// /ajax

	}else{
		alert("ERROR")
	}


}//End Reactivar Clientes*/