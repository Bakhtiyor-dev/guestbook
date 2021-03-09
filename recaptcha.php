<?php
	error_reporting(E_ERROR|E_PARSE);

	if(isset($_POST['submit'])){	
	
		$secret_key='6Ld_PnAaAAAAALso1WJ6CFk9TK625l5AOdtUuZZs';
	
		$response=$_POST['g-recaptcha-response'];
	
		$userIP=$_SERVER['REMOTE_ADDR'];
	
		$url="https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$response&remoteip=$userIP";
		
		$response=json_decode(file_get_contents($url));
	}
	