<?php
session_start();
require('../database/db.php');

if($_SESSION['loggedIn']){
	$checked=$_POST['checked'];
	$id=$_POST['id'];
	$sql="UPDATE records SET status=$checked WHERE id=$id";
	$conn->query($sql);
	$conn->close();

}