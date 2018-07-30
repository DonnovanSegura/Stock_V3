var manageUserTable;

$(document).ready(function() {

	// top nav bar 
	$('#navSetting').addClass('active');
	// sub manin
	$("#topNavSetting").addClass('active');
	// manage user data table
	manageUserTable = $('#manageUserTable').DataTable({
		'ajax': 'php_action/fetchUser.php',
		'order': []
	});

	// add user  modal btn clicked
	$("#addUserModalBtn").unbind('click').bind('click', function() {

		// user form reset
		$("#submitUsertForm")[0].reset();	
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		// submit user form
			$("#submitUsertForm").unbind('submit').bind('submit', function() {

				// Validar Campos de Formulario submitUsertForm
				var userName    = $("#UserName").val();
				var userNick    = $("#UserNick").val();
				var userPassword= $("#UserPass").val();
				var userRol     = $("#userRol").val();

			if(userName == "") {
				$("#UserName").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#UserName').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#UserName").find('.text-danger').remove();
				// success out for form 
				$("#UserName").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(userNick == "") {
				$("#UserNick").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#UserNick').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#UserNick").find('.text-danger').remove();
				// success out for form 
				$("#UserNick").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(userPassword == "") {
				$("#UserPass").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#UserPass').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#UserPass").find('.text-danger').remove();
				// success out for form 
				$("#UserPass").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(userRol == "") {
				$("#userRol").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#userRol').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#userRol").find('.text-danger').remove();
				// success out for form 
				$("#userRol").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(userName && userNick && userPassword && userRol ) {

				// submit loading button
				$("#createUserBtn").button('loading');	

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
							$("#createUserBtn").button('reset');
							
							$("#submitUsertForm")[0].reset();

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#add-user-messages').html('<div class="alert alert-success">'+
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
							manageUserTable.ajax.reload(null, true);

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

//Editar Usuario
/*function editUser(userId = null) {

	if (userId) {

		$.ajax({
			url: 'php_action/fetchSelectedUser.php',
			type: 'post',
			data: {userId: userId},
			dataType: 'json',
			success:function(response) {		
			// alert(response.product_image);
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				

				// user id 
				$(".editUserFooter").append('<input type="hidden" name="userId" id="userId" value="'+response.id_user+'" />');				

				// Nombre
				$("#editUserName").val(response.nombre);
				// Usuario
				$("#editUserNick").val(response.username);
				// Password
				$("#editUserPass").val(response.password);
				// Rol
				$("#editUserRol").val(response.rol);

			} // /success function

		})// /ajax

	}else{
		alert("ERROR")
	}


}//End Editar Usuario*/

//Editar Usuario
function editUser(userId = null) {

	if (userId) {

		$.ajax({
			url: 'php_action/fetchSelectedUser.php',
			type: 'post',
			data: {userId: userId},
			dataType: 'json',
			success:function(response) {		
		
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				

				// user id 
				$(".editUserFooter").append('<input type="hidden" name="userId" id="userId" value="'+response.id_user+'" />');				

				// Nombre
				$("#editUserName").val(response.nombre);
				// Usuario
				$("#editUserNick").val(response.username);
				// Password
				$("#editUserPass").val(response.password);
				// Rol
				$("#editUserRol").val(response.rol);

				// Actualizar datos de Informacion de Usuario con funcion Ajax
				$("#editUsertForm").unbind('submit').bind('submit', function() {
					// form validation
					var name      = $("#editUserName").val();
					var usuario   = $("#editUserNick").val();
					var password  = $("#editUserPass").val();
					var rol       = $("#editUserRol").val();

					if(name == "") {
						$("#editUserName").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editUserName').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editUserName").find('.text-danger').remove();
						// success out for form 
						$("#editUserName").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(usuario == "") {
						$("#editUserNick").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editUserNick').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editUserNick").find('.text-danger').remove();
						// success out for form 
						$("#editUserNick").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(password == "") {
						$("#editUserPass").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editUserPass').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editUserPass").find('.text-danger').remove();
						// success out for form 
						$("#editUserPass").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(rol == "") {
						$("#editUserRol").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editUserRol').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editUserRol").find('.text-danger').remove();
						// success out for form 
						$("#editUserRol").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(name && usuario && password && rol) {
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
									manageUserTable.ajax.reload(null, true);
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


}//End Editar Usuario
