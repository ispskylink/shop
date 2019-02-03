<?php 
	session_start();
	session_unset($_SESSION['reg']);
	session_destroy();
	header('location: index.php');
?>