<?php
	session_start();
	require('../database/db.php');
	require('../recaptcha.php');
	require('../database/validation.php');

	if($response->success===false)
		$errors[]='Пройдите тест recaptcha!';

	if($response->success===true && empty($errors)){
		$sql="INSERT INTO records (name,email,body) VALUES('$name','$email','$body')";
		$conn->query($sql);
		$_SESSION['success']='Запись отправлена в модерацию.';
		$conn->close();
	}else{

		$_SESSION['old']=[
			'name'=>$name,
			'email'=>$email,
			'body'=>$body
		];
		$_SESSION['errors']=$errors;	
	}
	header('Location:/add.php');
?>



