<?php 
session_start();
	if(isset($_SESSION['loggedIn']))
		require('admin.template.php');
	else
		require('login.php');
				
