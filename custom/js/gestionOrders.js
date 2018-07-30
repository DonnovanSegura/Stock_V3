//Tabla Gstion Ventas
var manageOrderTableVentas;
//Tabla Gstion Consinaciones
var manageOrderTableConsig;

$(document).ready(function() {

	// top nav bar 
	$('#navOrder').addClass('active');
	// sub manin
	$("#topNavManageOrder").addClass('active');
	// manage ventas data table
	manageOrderTableVentas = $('#manageOrderTableVentas').DataTable({
		'ajax': 'php_action/fetchVentas.php',
		'order': []
	});

	// manage consignaciones data table

	// manage ventas data table
	manageOrderTableConsig = $('#manageOrderTableConsig').DataTable({
		'ajax': 'php_action/fetchConsignaciones.php',
		'order': []
	});

});// document.ready fucntion



