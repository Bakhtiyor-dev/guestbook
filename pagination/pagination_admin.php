<?php
require('../database/db.php');

if($_SESSION['loggedIn']){
	if (isset($_GET['pageno']) && !empty($_GET['pageno'])) {
		$pageno = (int)$_GET['pageno'];
	} else {
		$pageno = 1;
	}
	$no_of_records_per_page = 5;
	$offset = ($pageno-1) * $no_of_records_per_page;

	$total_pages_sql = "SELECT COUNT(*) FROM records";
	$result = mysqli_query($conn,$total_pages_sql);
	$total_rows = mysqli_fetch_array($result)[0];
	$total_pages = ceil($total_rows / $no_of_records_per_page);

	$sql = "SELECT * FROM records ORDER BY created_at DESC LIMIT $offset, $no_of_records_per_page" ;
	$res_data = $conn->query($sql);
	$conn->close(); 
}   
?>