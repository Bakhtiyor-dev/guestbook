<?php
	session_start();
	
	if($_SESSION['loggedIn']){
		require '../database/db.php';
		require '../database/validation.php';
		$pageno=htmlentities($_POST['pageno']);
		$id=htmlentities($_POST['id']);
		$time=htmlentities($_POST['time']);
		$date=htmlentities($_POST['date']);
		$created_at=$date.' '.$time;
		$sql="UPDATE records SET name='$name', email='$email', body='$body', created_at='$created_at' WHERE	id=$id";
		$conn->query($sql);	
		$conn->close();
		header("Location:/admin?pageno=$pageno#record$id");	
	}
