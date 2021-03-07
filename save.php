<?php
	require('db.php');
	require('recaptcha.php');
	require('validation.php');

	$created=false;
	if($response->success===true){
		$name=mysqli_real_escape_string($conn,$name);
		$email=mysqli_real_escape_string($conn,$email);
		$body=mysqli_real_escape_string($conn,$body);

		$sql="INSERT INTO records (name,email,body) VALUES('$name','$email','$body')";
		$conn->query($sql);
		$created=true;
		$conn->close();
	}	
	header('Location:/add.php');
?>



