<?php 
	if($_SESSION['loggedIn'])
		include('login.php');
	else
		include('admin.template.php');
		
