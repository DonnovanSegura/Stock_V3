<?php 
require_once 'php_action/core.php';

session_start();
// remove all session variables
session_unset();
//Destruye sesion
session_destroy();

header("Location: index.php")

?>