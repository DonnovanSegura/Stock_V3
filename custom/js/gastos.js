var manageGastosTable;

$(document).ready(function() {

	// top nav bar 
	$('#navGastos').addClass('active');
	// manage product data table
	manageGastosTable = $('#manageGastosTable').DataTable({
		'ajax': 'php_action/fetchGasto.php',
		'order': []
	});

	$("#addGastoModalBtn").unbind('click').bind('click', function() {

		// user form reset
		$("#submitGastoForm")[0].reset();	
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		$("#submitGastoForm").unbind('submit').bind('submit', function() {

			var a    = $("#conceptoGasto").val();
			var b    = $("#montoGasto").val();
			
			if(a == "") {
				$("#conceptoGasto").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#conceptoGasto').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#conceptoGasto").find('.text-danger').remove();
				// success out for form 
				$("#conceptoGasto").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(b == "") {
				$("#montoGasto").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#montoGasto').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#montoGasto").find('.text-danger').remove();
				// success out for form 
				$("#montoGasto").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(a && b) {

				$("#createGastoBtn").button('loading');	

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
							$("#createGastoBtn").button('reset');
							
							$("#submitGastoForm")[0].reset();

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#add-gasto-messages').html('<div class="alert alert-success">'+
					            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
					            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
					            '</div>');

							// remove the mesages
		          			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert

		          			// reload the manage 
							manageGastosTable.ajax.reload(null, true);

							// remove text-error 
							$(".text-danger").remove();
							// remove from-group error
							$(".form-group").removeClass('has-error').removeClass('has-success');

						} // /if response.success

					}

				}); // /ajax function

			}// /if validation is ok 	
		return false;	

		}); // /submit product form

	}); // /add user modal btn clicked

});// document.ready fucntion


//Editar Gasto
function editGasto(gastoId = null) {

	if (gastoId) {

		$.ajax({
			url: 'php_action/fetchSelectedGasto.php',
			type: 'post',
			data: {gastoId: gastoId},
			dataType: 'json',
			success:function(response) {		
			// alert(response.product_image);
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				

				// user id 
				$(".editGastoFooter").append('<input type="hidden" name="gastoId" id="gastoId" value="'+response.id_gasto+'" />');				

				// Folio
				$("#editGastoFolio").val(response.id_gasto);
				// Concepto
				$("#editGastoConcep").val(response.concepto);
				// Monto
				$("#editGastoMonto").val(response.monto);

				$("#editGastoForm").unbind('submit').bind('submit', function() {
					// form validation
					var concepto  = $("#editGastoConcep").val();
					var monto     = $("#editGastoMonto").val();

					if(concepto == "") {
						$("#editGastoConcep").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editGastoConcep').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editGastoConcep").find('.text-danger').remove();
						// success out for form 
						$("#editGastoConcep").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(monto == "") {
						$("#editGastoMonto").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editGastoMonto').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editGastoMonto").find('.text-danger').remove();
						// success out for form 
						$("#editGastoMonto").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(concepto && monto) {

						$("#editGastoBtn").button('loading');

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
									$("#editGastoBtn").button('reset');
									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);

									// shows a successful message after operation
									$('#edit-gasto-messages').html('<div class="alert alert-success">'+
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
									manageGastosTable.ajax.reload(null, true);
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


}//End Editar Usuario*/