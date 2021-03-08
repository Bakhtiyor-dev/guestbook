<?php
require('db.php');
$checked=$_POST['checked'];
$id=$_POST['id'];
$sql="UPDATE records SET status=$checked WHERE id=$id";
$conn->query($sql);
$conn->close();
