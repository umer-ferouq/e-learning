<?php
	
session_start();
include 'config/config.php';

	if(isset($_SESSION['id']) && isset($_SESSION['email'])){

		session_destroy();
		session_unset();

		header("location: login.php");
	}else{
		header("location: index.php");
	}
?>