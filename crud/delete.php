<?php 
	session_start();
	require('../database/db.php');
	if($_SESSION['loggedIn']){
		$id=mysqli_real_escape_string($conn,$_REQUEST['id']);
		$sql="DELETE FROM records WHERE id=$id";
		$conn->query($sql);
		header('Location:/admin');
	}