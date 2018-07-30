var manageClientTable;

$(document).ready(function() {

	// top nav bar 
	$('#navClient').addClass('active');
	// manage client data table
	manageClientTable = $('#manageClientTable').DataTable({
		'ajax': 'php_action/fetchClient.php',
		'order': []
	});

	// add client modal btn clicked
	$("#addClientModalBtn").unbind('click').bind('click', function() {

		// // client form reset
		$("#submitClientForm")[0].reset();		

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

			// submit client form
			$("#submitClientForm").unbind('submit').bind('submit', function() {

				// Validar Campos de Formulario submitClientForm
				var NameClient   = $("#clientName").val();
				var AddresClient = $("#clientAddres").val();
				var EmailClient  = $("#clientEmail").val();
				var TelClient    = $("#clientTelefono").val();
				var CatCliente   = $("#ClientStatus").val();
				var comenCliente = $("#clientComentario").val();

			if(NameClient == "") {
				$("#clientName").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#clientName').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#clientName").find('.text-danger').remove();
				// success out for form 
				$("#clientName").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(AddresClient == "") {
				$("#clientAddres").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#clientAddres').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#clientAddres").find('.text-danger').remove();
				// success out for form 
				$("#clientAddres").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(EmailClient == "") {
				$("#clientEmail").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#clientEmail').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#clientEmail").find('.text-danger').remove();
				// success out for form 
				$("#clientEmail").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(TelClient == "") {
				$("#clientTelefono").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#clientTelefono').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#clientTelefono").find('.text-danger').remove();
				// success out for form 
				$("#clientTelefono").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(CatCliente == "") {
				$("#ClientStatus").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#ClientStatus').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#ClientStatus").find('.text-danger').remove();
				// success out for form 
				$("#ClientStatus").closest('.form-group').addClass('has-success');	  	
			}	// /else	

			if(comenCliente == "") {
				$("#clientComentario").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#clientComentario').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#clientComentario").find('.text-danger').remove();
				// success out for form 
				$("#clientComentario").closest('.form-group').addClass('has-success');	  	
			}	// /else			

				if(NameClient && AddresClient && EmailClient  && TelClient && CatCliente && comenCliente) {

					// submit loading button
					$("#createClientBtn").button('loading');	

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
							$("#createClientBtn").button('reset');
							
							$("#submitClientForm")[0].reset();

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#add-client-messages').html('<div class="alert alert-success">'+
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
							manageClientTable.ajax.reload(null, true);

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

//Editar Client
function editClient(clientId = null) {

	if (clientId) {

		$.ajax({
			url: 'php_action/fetchSelectedClient.php',
			type: 'post',
			data: {clientId: clientId},
			dataType: 'json',
			success:function(response) {		
			// alert(response.product_image);
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				


				// Client id 
				$(".editClientFooter").append('<input type="hidden" name="clientId" id="clientId" value="'+response.id_client+'" />');				

				//Codigo
				$("#editClientID").val(response.id_client);
				// Nombre
				$("#editClientName").val(response.nombre_cte);
				//Direccion
				$("#editClientAddress").val(response.direccion);
				//Email
				$("#editClientEmail").val(response.email);
				//Telefono
				$("#editClientTelefono").val(response.telefono);
				//Categoria
				$("#editClientStatus").val(response.categoria);
				//Comentario
				$("#editClientComent").val(response.comentario);

				// Actualizar datos de Informacion de Clientes con funcion Ajax
				$("#editClientForm").unbind('submit').bind('submit', function() {

					// form validation
					var name   = $("#editClientName").val();
					var addres = $("#editClientAddress").val();
					var email  = $("#editClientEmail").val();
					var tel    = $("#editClientTelefono").val();
					var cate   = $("#editClientStatus").val();
					var comen  = $("#editClientComent").val();

					if(name == "") {
						$("#editClientName").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editClientName').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editClientName").find('.text-danger').remove();
						// success out for form 
						$("#editClientName").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(addres == "") {
						$("#editClientAddress").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editClientAddress').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editClientAddress").find('.text-danger').remove();
						// success out for form 
						$("#editClientAddress").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(email == "") {
						$("#editClientEmail").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editClientEmail').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editClientEmail").find('.text-danger').remove();
						// success out for form 
						$("#editClientEmail").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(tel == "") {
						$("#editClientTelefono").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editClientTelefono').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editClientTelefono").find('.text-danger').remove();
						// success out for form 
						$("#editClientTelefono").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(cate == "") {
						$("#editClientStatus").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editClientStatus').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editClientStatus").find('.text-danger').remove();
						// success out for form 
						$("#editClientStatus").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(comen == "") {
						$("#editClientComent").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editClientComent').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editClientStatus").find('.text-danger').remove();
						// success out for form 
						$("#editClientComent").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(name && addres && email && tel && cate && comen) {

						// submit loading button
						$("#editClientBtn").button('loading');

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
									$("#editClientBtn").button('reset');
									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);

									// shows a successful message after operation
									$('#edit-client-messages').html('<div class="alert alert-success">'+
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
									manageClientTable.ajax.reload(null, true);

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

		})// /ajax to fetch Client

	}else{
		alert("ERROR")
	}

}//Edit Client


//Eliminar Cliente
function removeClient(clientId = null) {
	
	if(clientId) {
		// remove cliente button clicked
		$("#removeClientBtn").unbind('click').bind('click', function() {
			// loading remove button
			$("#removeClientBtn").button('loading');
			$.ajax({
				url: 'php_action/removeClient.php',
				type: 'post',
				data: {clientId: clientId},
				dataType: 'json',
				success:function(response) {
					// loading remove button
					$("#removeClientBtn").button('reset');
					if(response.success == true) {
						// remove cliente modal
						$("#removeClientModal").modal('hide');

						// update the cliente table
						manageClientTable.ajax.reload(null, false);

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
						$(".removeClientMessages").html('<div class="alert alert-success">'+
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
} // /remove cliente function