<?php 
session_start();


$errors = array();

if (isset($_POST['username']) and isset($_POST['password'])) {
	# code...
	include('db_connect.php');
	$usuario = mysqli_real_escape_string($connect,$_POST['username']);
	$contrasena = mysqli_real_escape_string($connect,$_POST['password']);

	$query = 'SELECT * FROM user WHERE username="'.$usuario.'" ';
	$res = $connect->query($query);

	if ($row = mysqli_fetch_array($res)) {
		# code...
		if ($row["password"] == $contrasena) {
			# code...
			$_SESSION["k_username"] = $row['username'];
			$_SESSION["k_password"] = $row['password'];
			$_SESSION["name"]= $row['nombre'];
			//$_SESSION["e-mail"]=$row['correo'];
			$_SESSION["iduser"]=$row['id_user'];
			$_SESSION["rol"]=$row['rol'];

			header('Location: ../dashboard.php');
		}else{

			echo "<script  languaje=’javascript’>alert('LA CONTRASENA NO ES CORRECTA');window.location='../index.php'</script>";

		}

	}else{
		echo "<script  languaje=’javascript’>alert('EL NOMBRE DE USUARIO NO ES CORRECTO');window.location='../index.php'</script>";
	}
	mysqli_free_result($res);

}else{
	header('Location: ../index.php');
}



mysqli_close($connect);

?>
