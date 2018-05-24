<?php 
	session_start();
	$_SESSION["girisBilgisi"] = "";
	header("Location:login.php");
?>