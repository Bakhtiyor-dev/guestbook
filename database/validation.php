<?php
$request=$_REQUEST;
$errors=[];

function validate($data,$type){
	global $errors;
	if($data==""){
		$errors[]="Поле $type пустой!";
	}else{
		global $conn;
		$data=stripslashes($data);
		$data=htmlspecialchars(htmlentities($data));
		$data=$conn->real_escape_string($data);
		return $data;	
	}
	
}

$name=validate($request['name'],'имя');
$email=validate($request['email'],'email');
$body=validate($request['body'],'описание');



