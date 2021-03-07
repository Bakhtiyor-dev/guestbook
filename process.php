<?php
session_start();
	
	$request=$_REQUEST;
	if(isset($request)){
		$email=$request['admin_email'];
		$password=$request['admin_password'];
		if($email=='test@mail.com' && $password=='test'){
			$_SESSION['loggedIn']='true';
			unset($_SESSION['message']);
			header('Location:/admin.php');
		}else{
			$_SESSION['message']='Неправильные данные';
			header('Location:/login.php');
		}
	}
